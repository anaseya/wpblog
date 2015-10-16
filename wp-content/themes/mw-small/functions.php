<?php

if ( ! function_exists( 'mwsmall_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function mwsmall_setup() {
	global $content_width;
	
	if ( ! isset( $content_width ) ) {
		$content_width = 870;
	}
	
	load_theme_textdomain( 'mwsmall', get_template_directory() . '/languages' );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'blog_img', 870, 400, true );
	set_post_thumbnail_size( 55, 55, true );
	
	add_theme_support( 'custom-background', apply_filters( 'mwsmall_custom_background_args', array(
		'default-color' => 'e5e5e5',
		'default-image' => '',
	) ) );
	
	$args = array(
		'flex-width' => true,
		'width' => 1980,
		'flex-height' => true,
		'height' => 250,
		'header-text' => true,
		'default-text-color'  => '#ffffff',
	);
	add_theme_support( 'custom-header', $args );
	
	// Post Formats
	
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'link', 'audio', 'status' ) );
	
	register_nav_menus( array(
		'primary'		=>	__( 'Main Navigation', 'mwsmall' )
	) );
} 
endif;
add_action( 'after_setup_theme', 'mwsmall_setup' );

/**
 * Enqueue scripts and styles
 */
function mwsmall_scripts() {
	wp_enqueue_style( 'blog-icons', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css' );
	wp_enqueue_style( 'bootstrap-framework', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	$color_scheme = get_theme_mod( 'mwsmall_color_theme' );
	if ( $color_scheme == 'dark' )
		wp_enqueue_style( 'dark', get_template_directory_uri() . '/css/dark.css', array(), null );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '201408', true  );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ) );
	wp_enqueue_script( 'mwsmall-js', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '201408', true  );
	wp_enqueue_script( 'mwsmall-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '201408', true  );
	wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '201408', true  );

}
add_action( 'wp_enqueue_scripts', 'mwsmall_scripts' );

function mwsmall_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'mwsmall_add_editor_styles' );

function mwsmall_post_icon() {

 	if ( get_post_format() === 'quote' ) {
 		$post_icon = '<i class="fa fa-2x fa-quote-right"></i>';
 	} else if ( get_post_format() == 'gallery' ) {
 		$post_icon = '<i class="fa fa-2x fa-camera"></i>';
 	} else if ( get_post_format() == 'image' ) {
 		$post_icon = '<i class="fa fa-2x fa-picture-o"></i>';
 	} else if ( get_post_format() == 'status' ) {
 		$post_icon = '<i class="fa fa-2x fa-bullhorn"></i>';
 	} else if ( get_post_format() == 'video' ) {
 		$post_icon = '<i class="fa fa-2x fa-film"></i>';
 	} else if ( get_post_format() == 'audio' ) {
 		$post_icon = '<i class="fa fa-2x fa-music"></i>';
 	} else if ( get_post_format() == 'link' ) {
 		$post_icon = '<i class="fa fa-2x fa-link"></i>';
 	}  else {
 		$post_icon = '<i class="fa fa-2x fa-pencil-square-o"></i>';
 	}

 	$output = '<div class="post-icon">';
	$output .= '<span>'.$post_icon.'</span>';
	$output .= '</div>';

	echo $output;
}

/* Register Widget Areas
----------------------------------- */
function mwsmall_widgets_init() {
	register_sidebar(array(
		'name' => __( 'Blog Widget', 'mwsmall' ),
		'id' => 'blog-widget',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __( 'Footer Widget 1', 'mwsmall' ),
		'id' => 'footer1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __( 'Footer Widget 2', 'mwsmall' ),
		'id' => 'footer2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __( 'Footer Widget 3', 'mwsmall' ),
		'id' => 'footer3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'mwsmall_widgets_init');

function mwsmall_pagination_nav(){
	global $wp_query, $post;
	
	if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
	<nav class="navigation paging-navigation" role="navigation">
		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'mwsmall' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'mwsmall' ) ); ?></div>
		<?php endif; ?>
	<?php endif; ?>

	</nav>

	<?php
}

/*  Custom Comments Callback
----------------------------------- */
function mwsmall_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	
?>
<li id="li-comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<div class="comment-author">
			<?php echo get_avatar($comment, $args['avatar_size']); ?>
			<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
		</div>

		<div class="comment-meta">
			
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<time datetime="<?php comment_time( 'c' ); ?>">
					<?php printf( _x( '%1$s', '1: date', 'mwsmall' ), get_comment_date() ); ?>
				</time>
			</a>

			
			<?php if($comment->comment_approved == '0') : ?>
				<div class="comment-awaiting-moderation"><?php _e('Your comment is awaiting approval', 'mwsmall'); ?></div>
			<?php endif; ?>
		</div>
		
		<div class="comment-content">
			<?php comment_text(); ?>			
		</div>
		
		<div class="reply">
		<?php 
			comment_reply_link(array_merge($args, array(
				'add_below' => 'div-comment',
				'depth' => $depth,
				'max_depth' => $args['max_depth']
			)));
		?>
		</div>		
	</article><!-- .comment-body -->
<?php
}

/*	Customize font-size of tag cloud widget
----------------------------------- */
 
function set_number_tags($args) {
	$args['smallest'] = 12;
	$args['largest'] = 12;
	return $args;
}
add_filter('widget_tag_cloud_args','set_number_tags');

/*  Page title
----------------------------------- */
function mwsmall_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mwsmall' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mwsmall_wp_title', 10, 2 );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
?>