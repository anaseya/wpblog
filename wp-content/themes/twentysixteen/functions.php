<?php


require_once( 'wp_bootstrap_navwalker.php');
require_once( 'blogform.php');
//require_once(ABSPATH .'wp-includes/pluggable.php');

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'TwentySixteen' ),
) );

function twentysixteen_styles() {
	wp_enqueue_style( 'bootstrap',  get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'custom',  get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'font opensans',  'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' );
	wp_enqueue_style( 'font josefinslab',  'http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic' );
}

add_action( 'wp_enqueue_scripts', 'twentysixteen_styles' );


function new_excerpt_more( $more ) {
    return '<a href="" class="view" title="View More"> ...view more</a>.';
}
add_filter('excerpt_more', 'new_excerpt_more');


function add_login_logout_link($items, $args) {
    ob_start();
      wp_loginout('index.php');
      $loginoutlink = ob_get_contents();
    ob_end_clean();
    $items .= '<li>'. $loginoutlink .'</li>';

    return $items;
}
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);


function loginout_text_change($text) {

    $text = str_replace('Log in', 'Log in | Sign up' ,$text);
    return $text;
}
add_filter('loginout','loginout_text_change');

function blog_form_ajax_callback(){

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' &&
        isset($_POST) && $_POST['blogform']=='newpost') {

        // if has error i.e. "(bool)true" return the result from validate_blog_form()
        $valid_res = validate_blogform();
        if ( $valid_res['status'] > 0 ) { // returns valid params

            $store_post = array(
                'post_title' => sanitize_text_field($_POST['post_title']),
                'post_content' => $_POST['blogtextarea'],//esc_textarea(),
                'post_status' => 'publish',
                'post_date' => date('Y-m-d H:i:s'),
                'post_author' => 1,
                'post_category' => null//array(8,39)
            );
            $post_id = wp_insert_post($store_post);

            $response = wp_remote_get( esc_url_raw(get_permalink(13)) );// DB table holds ID#13<<< for /blog pageid | no need to escape entities

            if ( !is_wp_error( $response ) )
                 $page_src = wp_remote_retrieve_body( $response );
            else
                $page_src = '';
            $patternlp = '/(?<=startlistposts-ajaxcall9382 -->)(.*)(?=<!-- endlistposts-ajaxcall9382)/s';
            preg_match($patternlp, $page_src, $listposts);

            exit_json(array(
                'status' => $post_id,
                'post_url' => get_permalink($post_id),
                'msg' => $valid_res['msg'],
                'page_src' => $listposts[0]
            ));
        }
        else {
            exit_json($valid_res);
        }

    }
    exit;
}
add_action( 'wp_ajax_nopriv_blog_form_ajax_callback', 'blog_form_ajax_callback' );
add_action( 'wp_ajax_blog_form_ajax_callback', 'blog_form_ajax_callback' );

function exit_json( $arr=array() ) {
    header("Content-type: application/json");
    exit(json_encode($arr));
}

function image_uploadform(){


    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {// &&
//        isset($_POST['blogform']) && $_POST['blogform']=='newpost2') {
//        var_dump($_POST);
        exit('xxx');
    }
//simple Security check
    check_ajax_referer('image_upload');

    $post_id = $_POST['post_id'];

    if (!function_exists('wp_generate_attachment_metadata')){
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }


    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                echo "upload error : " . $_FILES[$file]['error'];
                die();
            }
            $attach_id = media_handle_upload( $file, $post_id );
        }
    }

    if ( is_wp_error( $attach_id ) ) {
        exit('There was an error uploading the image.');
        //and if you want to set that image as Post  then use:
//        update_post_meta($new_post,'_thumbnail_id',$attach_id);
    } else {
        exit('The image was uploaded successfully!');
    }

    echo "uploaded the new Thumbnail";
    exit;
}
add_action('wp_ajax_image_upload', 'image_uploadform');
add_action('wp_ajax_nopriv_image_upload', 'image_uploadform');


function sui_process_image($file, $post_id, $caption){

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    $attachment_id = media_handle_upload($file, $post_id);

    update_post_meta($post_id, '_thumbnail_id', $attachment_id);

    $attachment_data = array(
        'ID' => $attachment_id,
        'post_excerpt' => $caption
    );

    wp_update_post($attachment_data);

    return $attachment_id;

}

function sui_delete_user_images($images_to_delete){

    $images_deleted = 0;

    foreach($images_to_delete as $user_image){

        if (isset($_POST['sui_image_delete_id_' . $user_image]) && wp_verify_nonce($_POST['sui_image_delete_id_' . $user_image], 'sui_image_delete_' . $user_image)){

            if($post_thumbnail_id = get_post_thumbnail_id($user_image)){

                wp_delete_attachment($post_thumbnail_id);

            }

            wp_trash_post($user_image);

            $images_deleted ++;

        }
    }

    return $images_deleted;

}

function wp_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="pager"><ul>' . "\n";

    /**	Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="previous">%s</li>' . "\n", get_previous_posts_link() );

    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        if( $paged == $link) {
            $class = ' class="active"';
            $otag = '<span>';
            $ctag = '</span>';
        }
        else {
            $class = '';
            $otag = '<a href="'. esc_url( get_pagenum_link( $link ) ) .'">';
            $ctag = '</a>';
        }
        printf( '<li%s>%s %s %s</a></li>' . "\n", $class, $otag, $link, $ctag  );
    }

    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /**	Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next">%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";
}

function customCommentForm() {

    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
    $post_id = get_the_ID();
    $args = array(
                'title_reply'          => '',
                'title_reply_to'       => __( 'Leave a Comment to %s' ),
                'cancel_reply_link'    => __( 'Cancel Comment' ),
                'comment_notes_before' => '',
                'logged_in_as' => '<p class="logged-in-as">'
                                                 . sprintf( __( '<a href="%1$s">%2$s</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="%3$s" class="btn btn-xs btn-primary" title="Log out of this account">Log out</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) .
                                           '</p>
                                           <div class="form-group"></div>',

                'comment_field' => '<div class="form-group">
                                        <textarea aria-required="true" rows="3" class="form-control" id="comment" name="comment" placeholder="Comment"></textarea>
                                        <span class="help-block" style="display: none;">Please enter a comment.</span>
                                    </div>',
                'fields'        => apply_filters( 'comment_form_default_fields', array(
                                    'author' => '<div class="form-group">
                                                    <input type="text" class="form-control" id="author" name="author" placeholder="Name">
                                                    <span class="help-block" style="display: none;">Please enter your name.</span>
                                                </div>',
                                    'email'  => '',
                                    'url'    => '',
                                )),
                'name_submit'   => 'comsubmit',
                'id_submit'     => 'comsubmit',
                'class_submit'  => 'btn btn-primary',
                'label_submit'  => __('Comment'),
                'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">Comment</button>'
            );
    return $args;
}