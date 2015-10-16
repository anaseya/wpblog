/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Site title
	wp.customize('header_bg_color',function( value ) {
		value.bind( function( newval ) {
			$('#masthead, header .search-box-wrapper').css('background-color', newval );
		} );
	});
	// Site description
	wp.customize('header_textcolor',function( value ) {
		value.bind( function( newval ) {
			$('.mw_header_image h2').css('color', newval );
		} );
	});

} )( jQuery );
