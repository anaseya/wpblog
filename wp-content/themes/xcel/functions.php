<?php
/**
 * xcel functions and definitions
 *
 * @package xcel
 */
define( 'XCEL_THEME_VERSION' , '1.0.8' );

if ( ! function_exists( 'xcel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function xcel_setup() {
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 700; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on xcel, use a find and replace
	 * to change 'xcel' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'xcel', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'xcel_blog_img_side', 352, 230, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'xcel' ),
		'footer-bar' => __( 'Footer Bar Menu', 'xcel' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	
	// The custom header is used for the logo
	add_theme_support( 'custom-header', array(
        'default-image' => '',
		'width'         => 280,
		'height'        => 82,
		'flex-width'    => false,
		'flex-height'   => false,
		'header-text'   => false,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'xcel_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    add_theme_support( 'woocommerce' );
}
endif; // xcel_setup
add_action( 'after_setup_theme', 'xcel_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function xcel_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'xcel' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );
	
	// Create Widget areas according to the footer layout setting
	register_sidebar(array(
		'name' => __( 'Xcel Footer Standard', 'xcel' ),
		'id' => 'xcel-site-footer-standard',
        'description' => __( 'The footer will divide into however many widgets are placed here.', 'xcel' )
	));
}
add_action( 'widgets_init', 'xcel_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function xcel_scripts() {
	wp_enqueue_style( 'xcel-google-body-font-default', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic', array(), XCEL_THEME_VERSION );
    wp_enqueue_style( 'xcel-google-heading-font-default', '//fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,400,300', array(), XCEL_THEME_VERSION );
    
	wp_enqueue_style( 'xcel-font-awesome', get_template_directory_uri().'/includes/font-awesome/css/font-awesome.css', array(), '4.2.0' );
	wp_enqueue_style( 'xcel-style', get_stylesheet_uri(), array(), XCEL_THEME_VERSION );
    wp_enqueue_style( 'xcel-woocommerce-style', get_template_directory_uri().'/templates/css/xcel-woocommerce-style.css', array(), XCEL_THEME_VERSION );
    
    wp_enqueue_style( 'xcel-header-standard-style', get_template_directory_uri().'/templates/css/xcel-header-standard.css', array(), XCEL_THEME_VERSION );
    
    if ( get_theme_mod( 'xcel-setting-footer-layout', false ) == 'xcel-setting-footer-layout-none' ) :
	    wp_enqueue_style( 'xcel-header-centered-style', get_template_directory_uri().'/templates/css/xcel-footer-none.css', array(), XCEL_THEME_VERSION );
	else :
		wp_enqueue_style( 'xcel-header-centered-style', get_template_directory_uri().'/templates/css/xcel-footer-standard.css', array(), XCEL_THEME_VERSION );
	endif;

	wp_enqueue_script( 'xcel-navigation', get_template_directory_uri() . '/js/navigation.js', array(), XCEL_THEME_VERSION, true );
	wp_enqueue_script( 'xcel-caroufredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), XCEL_THEME_VERSION, true );
	
	wp_enqueue_script( 'xcel-customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'), XCEL_THEME_VERSION, true );
	
	wp_enqueue_script( 'xcel-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), XCEL_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'xcel_scripts' );

function xcel_add_editor_styles() {
    add_editor_style( 'style-theme-editor.css' );
}
add_action( 'admin_init', 'xcel_add_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/inc/jetpack.php';

// Helper library for the theme customizer.
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';

// Define options for the theme customizer.
require get_template_directory() . '/customizer/customizer-options.php';

// Output inline styles based on theme customizer selections.
require get_template_directory() . '/customizer/styles.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/customizer/mods.php';

/**
 * Enqueue Dustland Express custom customizer styling.
 */
function xcel_load_customizer_script() {
    wp_enqueue_script( 'xcel-customizer-js', get_template_directory_uri() . '/customizer/customizer-library/js/customizer-custom.js', array('jquery'), XCEL_THEME_VERSION, true );
    
    wp_enqueue_style( 'xcel-customizer-css', get_template_directory_uri() . '/customizer/customizer-library/css/customizer.css' );
}    
add_action( 'customize_controls_enqueue_scripts', 'xcel_load_customizer_script' );

/* Display the recommended plugins notice that can be dismissed */
add_action('admin_notices', 'xcel_recommended_plugin_notice');

function xcel_recommended_plugin_notice() {
    global $pagenow;
    global $current_user;
    
    $user_id = $current_user->ID;
    
    /* If on plugins page, check that the user hasn't already clicked to ignore the message */
    if ( $pagenow == 'plugins.php' ) {
	    if ( ! get_user_meta( $user_id, 'xcel_recommended_plugin_ignore_notice' ) ) {
	        echo '<div class="updated"><p>';
            printf( __( '<p>Install the plugins we at <a href="http://www.kairaweb.com/" target="_blank">Kaira</a> recommended | <a href="%1$s">Hide Notice</a></p>', 'xcel' ), '?xcel_recommended_plugin_nag_ignore=0' ); ?>
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'WooCommerce', 'xcel' ), 'xcel' ); ?></a><br />
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'SiteOrigin\'s Page Builder', 'xcel' ), 'xcel' ); ?></a><br />
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'Meta Slider', 'xcel' ), 'xcel' ); ?></a><br />
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'Breadcrumb NavXT', 'xcel' ), 'xcel' ); ?></a>
            <?php
	        echo '</p></div>';
	    }
	}
}
add_action('admin_init', 'xcel_recommended_plugin_nag_ignore');

function xcel_recommended_plugin_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
        
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset($_GET['xcel_recommended_plugin_nag_ignore']) && '0' == $_GET['xcel_recommended_plugin_nag_ignore'] ) {
        add_user_meta( $user_id, 'xcel_recommended_plugin_ignore_notice', 'true', true );
    }
}

// Create function to check if WooCommerce exists.
if ( ! function_exists( 'xcel_is_woocommerce_activated' ) ) :
    
function xcel_is_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
}

endif; // xcel_is_woocommerce_activated

if ( xcel_is_woocommerce_activated() ) {
    require get_template_directory() . '/includes/inc/woocommerce-inc.php';
}

/**
 * Adjust is_home query if xcel-setting-blog-cats is set
 */
function xcel_set_blog_queries( $query ) {
    $blog_query_set = '';
    if ( get_theme_mod( 'xcel-setting-blog-cats', false ) ) {
        $blog_query_set = get_theme_mod( 'xcel-setting-blog-cats' );
    }
    
    if ( $blog_query_set ) {
        // do not alter the query on wp-admin pages and only alter it if it's the main query
        if ( !is_admin() && $query->is_main_query() ){
            if ( is_home() ){
                $query->set( 'cat', $blog_query_set );
            }
        }
    }
}
add_action( 'pre_get_posts', 'xcel_set_blog_queries' );

/**
 * Display the upgrade to Premium page & losd styles.
 *
 * @action admin_menu
 */
function xcel_premium_admin_menu() {
    global $xcel_upgrade_page;
    $xcel_upgrade_page = add_theme_page( __( 'XCEL PRO Features', 'xcel' ), __( 'XCEL PRO Features', 'xcel' ), 'edit_theme_options', 'premium_upgrade', 'xcel_upgrade_page_render' );
}

add_action( 'admin_menu', 'xcel_premium_admin_menu' );

/**
 * Render the theme upgrade page
 */
function xcel_upgrade_page_render() {
    locate_template( 'upgrade/kaira-upgrade-page.php', true, false );
}

/**
 * Enqueue Xcel admin stylesheet only on upgrade page.
 */
function xcel_load_admin_style($hook) {
    global $xcel_upgrade_page;
 
    if( $hook != $xcel_upgrade_page ) 
        return;
    
    wp_enqueue_style( 'xcel-upgrade-css', get_template_directory_uri() . '/upgrade/css/kaira-admin.css' );
}    
add_action( 'admin_enqueue_scripts', 'xcel_load_admin_style' );