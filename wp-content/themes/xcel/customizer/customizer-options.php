<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_xcel_options() {

	// Theme defaults
	$primary_color = '#0c3768';
    $secondary_color = '#0d4a87';
    
    $title_color = '#2B598E';
    $title_font_color = '#FFFFFF';
    
    $body_font_color = '#4F4F4F';
    $heading_font_color = '#5E5E5E';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;
    
    
    // Layout Settings
    $section = 'xcel-setting-layout';
    $font_choices = customizer_library_get_font_choices();

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Site Options', 'xcel' ),
        'priority' => '30'
    );
    
    // Upsell Button One
    $options['xcel-setting-upsell-one'] = array(
        'id' => 'xcel-setting-upsell-one',
        'label'   => __( 'Full Width / Boxed Layout', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    $options['xcel-setting-main-color'] = array(
        'id' => 'xcel-setting-main-color',
        'label'   => __( 'Main Color', 'xcel' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $primary_color,
    );
    $options['xcel-setting-main-color-hover'] = array(
        'id' => 'xcel-setting-main-color-hover',
        'label'   => __( 'Secondary Color', 'xcel' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $secondary_color,
    );
    
    $options['xcel-setting-body-font'] = array(
        'id' => 'xcel-setting-body-font',
        'label'   => __( 'Body Font', 'xcel' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Open Sans'
    );
    $options['xcel-setting-body-font-color'] = array(
        'id' => 'xcel-setting-body-font-color',
        'label'   => __( 'Body Font Color', 'xcel' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $body_font_color,
    );
    $options['xcel-setting-heading-font'] = array(
        'id' => 'xcel-setting-heading-font',
        'label'   => __( 'Headings Font', 'xcel' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Raleway'
    );
    $options['xcel-setting-heading-font-color'] = array(
        'id' => 'xcel-setting-heading-font-color',
        'label'   => __( 'Heading Font Color', 'xcel' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $heading_font_color,
    );
    
    
    // Header Settings
    $section = 'xcel-setting-header';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Header Options', 'xcel' ),
        'priority' => '30'
    );
    
    // Upsell Button Two
    $options['xcel-setting-upsell-two'] = array(
        'id' => 'xcel-setting-upsell-two',
        'label'   => __( 'Header Standard / Right Layout', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    $options['xcel-setting-header-search'] = array(
        'id' => 'xcel-setting-header-search',
        'label'   => __( 'Show Search', 'xcel' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'Enable a search box on your site', 'xcel' ),
        'default' => 0,
    );
    
    // Upsell Button Two-one
    $options['xcel-setting-upsell-two-one'] = array(
        'id' => 'xcel-setting-upsell-two-one',
        'label'   => __( 'Header Color', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Title Settings
    $section = 'xcel-setting-title';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Page Title Options', 'xcel' ),
        'priority' => '30'
    );
    
    // Upsell Button Three
    $options['xcel-setting-upsell-three'] = array(
        'id' => 'xcel-setting-upsell-three',
        'label'   => __( 'Extra Title Bar Settings', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    $options['xcel-setting-title-color'] = array(
        'id' => 'xcel-setting-title-color',
        'label'   => __( 'Title Bar Color', 'xcel' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $title_color,
    );
    $options['xcel-setting-title-font-color'] = array(
        'id' => 'xcel-setting-title-font-color',
        'label'   => __( 'Title Bar Font Color', 'xcel' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $title_font_color,
    );
    
    $choices = array(
        'xcel-setting-title-bgimg-top' => 'Align Top',
        'xcel-setting-title-bgimg-middle' => 'Align Centered',
        'xcel-setting-title-bgimg-bottom' => 'Align Bottom'
    );
    $options['xcel-setting-title-bgimg'] = array(
        'id' => 'xcel-setting-title-bgimg',
        'label'   => __( 'Background Image Position', 'xcel' ),
        'section' => $section,
        'type'    => 'select',
        'description' => __( 'To set the image for the post/page you need to set a "Featured Image" on each post/page.', 'xcel' ),
        'choices' => $choices,
        'default' => 'xcel-setting-title-bgimg-middle'
    );
    
    
    // Slider Settings
    $section = 'xcel-setting-slider';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Slider Options', 'xcel' ),
        'priority' => '35'
    );
    
    $choices = array(
        'xcel-setting-slider-default' => 'Default Slider',
        'xcel-setting-meta-slider' => 'Meta Slider',
        'xcel-setting-no-slider' => 'None'
    );
    $options['xcel-setting-slider-type'] = array(
        'id' => 'xcel-setting-slider-type',
        'label'   => __( 'Choose a Slider', 'xcel' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'xcel-setting-slider-default'
    );
    $options['xcel-setting-slider-cats'] = array(
        'id' => 'xcel-setting-slider-cats',
        'label'   => __( 'Slider Categories', 'xcel' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s)', 'xcel' )
    );
    $choices = array(
        'xcel-setting-slider-size-small' => 'Small Slider',
        'xcel-setting-slider-size-medium' => 'Medium Slider',
        'xcel-setting-slider-size-large' => 'Large Slider'
    );
    
    // Upsell Button Four
    $options['xcel-setting-upsell-four'] = array(
        'id' => 'xcel-setting-upsell-four',
        'label'   => __( 'Extra Slider Settings', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    $options['xcel-setting-meta-slider-shortcode'] = array(
        'id' => 'xcel-setting-meta-slider-shortcode',
        'label'   => __( 'Slider Shortcode', 'xcel' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the shortcode give by meta slider.', 'xcel' )
    );

    
    // Blog Settings
    $section = 'xcel-setting-blog';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog Options', 'xcel' ),
        'priority' => '50'
    );
    
    $options['xcel-setting-blog-title'] = array(
        'id' => 'xcel-setting-blog-title',
        'label'   => __( 'Blog Page Title', 'xcel' ),
        'section' => $section,
        'type'    => 'text',
        'default' => 'Blog'
    );
    $options['xcel-setting-blog-cats'] = array(
        'id' => 'xcel-setting-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'xcel' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.', 'xcel' )
    );
    // Upsell Button Five
    $options['xcel-setting-upsell-five'] = array(
        'id' => 'xcel-setting-upsell-five',
        'label'   => __( 'Extra Blog Settings', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Layout Settings
    $section = 'xcel-setting-footer';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Footer Layout Options', 'xcel' ),
        'priority' => '85'
    );
    
    // Upsell Button Six
    $options['xcel-setting-upsell-six'] = array(
        'id' => 'xcel-setting-upsell-six',
        'label'   => __( 'Select from 5 footer layouts', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $choices = array(
        'xcel-setting-footer-layout-standard' => 'Standard Layout',
        'xcel-setting-footer-layout-none' => 'None'
    );
    $options['xcel-setting-footer-layout'] = array(
        'id' => 'xcel-setting-footer-layout',
        'label'   => __( 'Footer Layout', 'xcel' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'xcel-setting-footer-layout-standard'
    );
    
    // Upsell Button Seven
    $options['xcel-setting-upsell-seven'] = array(
        'id' => 'xcel-setting-upsell-seven',
        'label'   => __( 'Remove Footer Bottom Bar', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Social Settings
    $section = 'xcel-setting-social';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Social Links', 'xcel' ),
        'priority' => '80'
    );
    
    // Upsell Button Eight
    $options['xcel-setting-upsell-eight'] = array(
        'id' => 'xcel-setting-upsell-eight',
        'label'   => __( 'Add Social Links', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Site Text Settings
    $section = 'xcel-setting-website';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Website Text', 'xcel' ),
        'priority' => '50'
    );
    
    // Upsell Button Nine
    $options['xcel-setting-upsell-nine'] = array(
        'id' => 'xcel-setting-upsell-nine',
        'label'   => __( 'Edit Footer Copyright Text', 'xcel' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $options['xcel-setting-website-error-head'] = array(
        'id' => 'xcel-setting-website-error-head',
        'label'   => __( '404 Error Page Heading', 'xcel' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! <span>404</span>', 'xcel'),
        'description' => __( 'Enter the heading for the 404 Error page', 'xcel' )
    );
    $options['xcel-setting-website-error-msg'] = array(
        'id' => 'xcel-setting-website-error-msg',
        'label'   => __( 'Error 404 Message', 'xcel' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'It looks like that page does not exist. <br />Return home or try a search', 'xcel'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'xcel' )
    );
    $options['xcel-setting-website-nosearch-msg'] = array(
        'id' => 'xcel-setting-website-nosearch-msg',
        'label'   => __( 'No Search Results', 'xcel' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'xcel'),
        'description' => __( 'Enter the default text for when no search results are found', 'xcel' )
    );

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_xcel_options' );
