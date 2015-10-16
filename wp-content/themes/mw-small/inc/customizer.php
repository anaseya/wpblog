<?php
/**
 * 
 *
 * @package mwsmall
 */

/**
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mwsmall_customize_register($wp_customize){

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
    $wp_customize->add_section('mwsmall_logo', array(
        'title'    => __('Logo', 'mwsmall'),
        'priority' => 40,
    ));
	
    $wp_customize->add_setting('logo_mwsmall', array(
        //'capability'        => 'edit_theme_options',
        'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_image', array(
        'label'    => __('Upload logo', 'mwsmall'),
        'section'  => 'mwsmall_logo',
        'settings' => 'logo_mwsmall',
    )));
	
	// page option 
	$wp_customize->add_section( 'mwsmall_general' , array(
		'title'       => __( 'Options', 'mwsmall' ),
		'priority'    => 41,
		'description' => '',
	) );
	
 	$wp_customize->add_setting( 'mwsmall_head_search', array (
		'default'        => '',
		'sanitize_callback' => 'mwsmall_sanitize_checkbox',
	) );

	$wp_customize->add_control('hide_search', array(
		'label' => __('Hide top icon search', 'mwsmall'),
		'section' => 'mwsmall_general',
		'settings' => 'mwsmall_head_search',
		'type' => 'checkbox',
	));

	$wp_customize->add_setting('mwsmall_header_position', array(
		'default' => 'default',
		'sanitize_callback' => 'mwsmall_sanitize_header_position',
	));
	
	$wp_customize->add_control('header_position', array(
		'label'      => __('Header position', 'mwsmall'),
		'section'    => 'mwsmall_general',
		'settings'   => 'mwsmall_header_position',
		'type'       => 'radio',
		'choices'    => array(
			'default'   => 'Default',
			'center'  => 'Center',
			),
	));
	
	$wp_customize->add_setting('mwsmall_sidebar_position', array(
		'default' => 'right',
		'sanitize_callback' => 'mwsmall_sanitize_sidebar_position',
	));
	
	$wp_customize->add_control('sidebar_position', array(
		'label'      => __('Sidebar position', 'mwsmall'),
		'section'    => 'mwsmall_general',
		'settings'   => 'mwsmall_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => 'Left',
			'right'  => 'Right',
			),
	));	
	
	$wp_customize->add_setting('mwsmall_color_theme', array(
		'default' => 'default',
		'sanitize_callback' => 'mwsmall_sanitize_color',
	));
	
	$wp_customize->add_control('color_theme', array(
		'label'      => __('Color scheme', 'mwsmall'),
		'section'    => 'mwsmall_general',
		'settings'   => 'mwsmall_color_theme',
		'type'       => 'select',
		'choices'    => array(
			'default'  => 'Default',
			'dark'   => 'Dark',
			),
	));
	
	// Home Box
	$wp_customize->add_section( 'mwsmall_homepage_settings', array(
		'title' => __( 'Homepage Settings', 'mwsmall' ),
		'priority' => 42
	));
	
	$wp_customize->add_setting( 'mwsmall_home_title', array(
		'sanitize_callback' => 'mwsmall_sanitize_text',
	));
	
	$wp_customize->add_control( 'home_title', array(
		'label' => __('Title Box Home', 'mwsmall'),
		'section' => 'mwsmall_homepage_settings',
		'settings' => 'mwsmall_home_title',
		'type' => 'text',		
	));
	$wp_customize->add_setting( 'mwsmall_home_text', array(
		'sanitize_callback' => 'mwsmall_sanitize_text',
	));
	
	$wp_customize->add_control( 'home_text', array(
		'label' => __('Text Box Home', 'mwsmall'),
		'section' => 'mwsmall_homepage_settings',
		'settings' => 'mwsmall_home_text',
		'type' => 'textarea',		
	));
	
	// Featured Posts Area
	$wp_customize->add_section( 'mwsmall_featured', array(
		'title' => __( 'Featured Posts Area', 'mwsmall' ),
		'description' => '<span>' . __( 'Option available in the <a target="_blank" href="http://mwthemes.net/portfolio/mw-small-pro">PRO version.</a>', 'mwsmall' ) . '</span>',
		'priority' => 42,
		)	
	);
	
	$wp_customize->add_setting( 'mwsmall_show_post_top_info', array(
		'sanitize_callback' => 'esc_attr',
	));
	
	$wp_customize->add_control('show_post_top_info', array(
		'section' => 'mwsmall_featured',
		'settings' => 'mwsmall_show_post_top_info'
	));
	
	// Icon
	$wp_customize->add_section('mwsmall_social', array(
        'title'    => __('Social Media Links', 'mwsmall'),
        'priority' => 42,
    ));
	
    $wp_customize->add_setting('icon_facebook', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
    ));
 
    $wp_customize->add_control('mwsmall_icon_facebook', array(
        'label'      => __('Facebook', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_facebook',
    ));
	
	$wp_customize->add_setting('icon_twitter', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_twitter', array(
        'label'      => __('Twitter', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_twitter',
    ));	
	
	$wp_customize->add_setting('icon_google', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_google', array(
        'label'      => __('Google+', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_google',
    ));
	
	$wp_customize->add_setting('icon_linkedin', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_linkedin', array(
        'label'      => __('LinkedIn', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_linkedin',
    ));
	
	$wp_customize->add_setting('icon_instagram', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_instagram', array(
        'label'      => __('Instagram', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_instagram',
    ));
	
	$wp_customize->add_setting('icon_flickr', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_flickr', array(
        'label'      => __('Flickr', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_flickr',
    ));
	
	$wp_customize->add_setting('icon_pinterest', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_pinterest', array(
        'label'      => __('Pinterest', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_pinterest',
    ));
	
	$wp_customize->add_setting('icon_vimeo', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_vimeo', array(
        'label'      => __('Vimeo', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_vimeo',
    ));
	
	$wp_customize->add_setting('icon_tumblr', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_tumblr', array(
        'label'      => __('Tumblr', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_tumblr',
    ));
	
	$wp_customize->add_setting('icon_dribbble', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_dribbble', array(
        'label'      => __('Dribbble', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_dribbble',
    ));
	
	$wp_customize->add_setting('icon_rss', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	   
	$wp_customize->add_control('mwsmall_icon_rss', array(
        'label'      => __('RSS', 'mwsmall'),
        'section'    => 'mwsmall_social',
        'settings'   => 'icon_rss',
    ));
	
	// Setting Color
    $wp_customize->add_setting('header_bg_color', array(
        'default'           => '#3E4A57',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'   => 'postMessage',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label'    => __('Header Background Color', 'mwsmall'),
        'section'  => 'colors',
        'settings' => 'header_bg_color',
    )));

	// Info Theme 
	$wp_customize->add_section('mwsmall_info', array(
        'title'    => __('Info Theme', 'mwsmall'),
		'description' => sprintf( __( '<a target="_blank" href="%1$s">%2$s</a><br/><a target="_blank" href="%3$s" class="button-pro mwfb">Facebook</a><br/><a target="_blank" href="%4$s" class="button-pro mwtwitter">Twitter</a><br/><a target="_blank" href="%5$s" class="button-pro paypal">Donate</a><br/><a target="_blank" href="%7$s">%8$s</a><br/><a target="_blank" href="%7$s" class="button-pro mwfb">Upgrade to PRO</a><br/><a target="_blank" href="%6$s" class="button-pro">DEMO PRO</a>', 'mwsmall' ), 
		__( 'http://mwthemes.net', 'mwsmall' ), 
		__('If you need assistance, please do not hesitate to contact us.', 'mwsmall'), 
		__('http://facebook.com/mwthemes', 'mwsmall'), 
		__('https://twitter.com/mwthemes', 'mwsmall'), 
		__('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UEV9GM57HQUHA', 'mwsmall'), 
		__('http://demo.mwthemes.net/mw-small-pro', 'mwsmall'),
		__('http://mwthemes.net/portfolio/mw-small-pro', 'mwsmall'),
		__('If you need more useful options, see the MW Small PRO version.', 'mwsmall')
		),
        'priority' => 110,		
    ));
	
	$wp_customize->add_setting( 
		'more_info_mwthemes',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
		
	);
	$wp_customize->add_control( 'more_info_mwthemes', array(
		'section' => 'mwsmall_info'
	) );
	
	// Theme PRO 
	$wp_customize->add_section('mwsmall_info_up', array(
        'title'    => __('Upgrade MW Small ', 'mwsmall'),
		'description' => sprintf( __( '<a target="_blank" href="%1$s">%2$s</a>', 'mwsmall' ), 
		__('http://mwthemes.net/portfolio/mw-small-pro', 'mwsmall'),
		__('If you need more useful options, see the MW Small PRO version.', 'mwsmall')
		),
        'priority' => 10,		
    ));
	
	$wp_customize->add_setting( 
		'up_mwsmall',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
		
	);
	$wp_customize->add_control( 'up_mwsmall', array(
		'section' => 'mwsmall_info_up'
	) );
	
	// footer
	$wp_customize->add_section( 'mwsmall_footer', array(
        'title'    => __('Footer', 'mwsmall'),
        'priority' => 43,
    ));
	
 	$wp_customize->add_setting('mwsmall_text_footer', array(
		'sanitize_callback' => 'mwsmall_sanitize_text',
	));

	$wp_customize->add_control( 'footer_text', array(
		'label' => __( 'Your text in footer.', 'mwsmall' ),
		'section' => 'mwsmall_footer',
		'settings' => 'mwsmall_text_footer',
		'priority' => 1
	)); 
}

add_action('customize_register', 'mwsmall_customize_register');

/**
 * Sanitize checkbox
 */
if (!function_exists( 'mwsmall_sanitize_checkbox' ) ) :
	function mwsmall_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
endif;
/**
 * Text
 */
function mwsmall_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
/**
 * Choices
 */
function mwsmall_sanitize_header_position( $input ) {
	$valid = array(
		'default'   => 'Default',
		'center'  => 'Center',
	);
 
	if ( array_key_exists( $input, $valid  ) ) {
		return $input;
	} else {
		return '';
	}
}
// Sidebar
function mwsmall_sanitize_sidebar_position( $content ) {
	if ( 'left' == $content ) {
		return 'left';
	} else {
		return 'right';
	}
}
// Color
function mwsmall_sanitize_color( $content ) {
	if ( 'dark' == $content ) {
		return 'dark';
	} else {
		return 'default';
	}
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mwsmall_customize() {
	wp_enqueue_script( 'js_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), true );
}
add_action( 'customize_preview_init', 'mwsmall_customize' );

function mwsmall_css() {
	$header_text_color = get_header_textcolor();
    ?>
		<style type="text/css">
			#masthead,
			header .search-box-wrapper { 
				background-color: <?php echo get_theme_mod('header_bg_color'); ?>; 
			}
			.mw_header_image h2 {
				color: #<?php echo $header_text_color; ?>;
			}
		</style>
    <?php
}
add_action( 'wp_head', 'mwsmall_css');

function promo_info_none(){
	?>
	<style type="text/css">
		#customize-control-show_post_top_info input,
		#customize-control-up_mwsmall input,
		#customize-control-more_info_mwthemes input{
			display: none;
		}
		#customize-theme-controls #accordion-section-mwsmall_info_up .accordion-section-title,
		#customize-theme-controls #accordion-section-mwsmall_info .accordion-section-title {
			background-color: #8CBEDD;
		}
		#accordion-section-mwsmall_info .description {
			text-align: center;
		}
		.button-pro {
			background-color: #FF0000;
			box-shadow: 0 0 0 0;
			color: #FFFFFF;
			display: inline-block;
			font-size: 14px;
			font-weight: 700;
			margin-top: 8px;
			padding: 5px;
			text-align: center;
			width: 160px;
		}
		.paypal {
			background-color: #35AA00;
		}
		.mwfb {
			background-color: #3D5B99;
		}
		.mwtwitter {
			background-color: #55ACEE;
		}
		a.button-pro:hover {
			color: #222;
		}
	</style>
	<?php
}
add_action('customize_controls_print_styles', 'promo_info_none');