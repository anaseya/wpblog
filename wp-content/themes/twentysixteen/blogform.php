<?php

require_once( 'functions.php');




/*
  Inserting and publishing new post
*/
if (isset($_GET['blogform']) && $_GET['blogform']=='newpost') {



    /*
            update_post_meta($post_id, $meta_key, $meta_value);
            if(!wp_set_post_terms($id, $values['complaint_type'], 'complaint-type'))
                $errors['wp_set_post_terms'] = 'There was an error adding the complaint type.';
     */
}



/*
   Create an nonce, and add it as a query var in a link to perform an action.
 */
function secure_blog_form() {

    $nonce = wp_create_nonce( 'test-nonce' );
    echo $nonce;
}
// END Create an nonce, and add it as a query var in a link to perform an action.

/*
    Validation before inserting post
        Checks for invalid UTF-8 (uses wp_check_invalid_utf8())
        Converts single < characters to entity
        Strips all tags
        Remove line breaks, tabs and extra white space
        Strip octets

*/

function validate_blogform() {

    $result = array(
        'msg' => 'Post is created.',
        'status' => 1
    );
    $validate_txt = explode(': ', $_POST['count_words']);

    if (!empty($_POST) && isset($_POST)) {

        if ( ! wp_verify_nonce($_POST['_wpnonce'], 'blog_form_ajax_callback')) {
            $result['msg'] = 'Nonce is invalid';
            $result['status'] = -1;
        }
        if (trim($_POST['post_title']) === '') {
            $result['msg'] = 'Please enter a title.';
            $result['status'] = -1;
        }
        if ( $validate_txt[1] < 3 ) {// content must include more than/equals to 3<<< words
            $result['msg'] = 'Please enter content with at least 3 words.';
            $result['status'] = -1;
        }
        if (preg_match('/(?:<|&lt;)iframe|iframe(>|&gt;)/sm', $_POST['blogtextarea'])) {
            $result['msg'] = 'Iframes are not allowed.';
            $result['status'] = -1;
        }
    }
    else {
        $result['msg'] = 'Problem in submitting form!';
        $result['status'] = -1;
    }

    return $result;
}
// END validation before inserting post


