<?php
add_action( 'wp_enqueue_scripts', 'aplite_enqueue_styles' );

function aplite_enqueue_styles() {
    wp_enqueue_style( 'aplite-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'aplite-style', get_stylesheet_uri(), array('aplite-parent-style') );

    $fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Gentium Basic: on or off', 'aplite' ) ) {
		$fonts[] = 'Gentium+Basic:400,700,400italic';
	}

	if ( 'off' !== _x( 'on', 'Advent Pro: on or off', 'aplite' ) ) {
		$fonts[] = 'Advent+Pro:400,700,600,500,300';
	}

	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'aplite' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}
	
	wp_dequeue_style( 'accesspresslite-google-fonts' );
	wp_enqueue_style( 'aplite-google-fonts', $fonts_url );
	
}
