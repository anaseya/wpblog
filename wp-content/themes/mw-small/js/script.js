jQuery(document).ready(function($){
	$('ul.sf-menu').superfish({
		delay: 200,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		speedOut: 'normal', 
		autoArrows: false,
		dropShadows: false
	});

	$('.flexslider').flexslider({
		animation: "slide",
	});
  
	$('.top-icon .fa-search').click(function() {		
		$("header .search-box-wrapper").slideToggle('slow', function(){
            $('.top-icon .fa-search').toggleClass('active');
        });
        return false;

	});		
	
	$(window).scroll(function () {
		if ($(this).scrollTop() > 200) {
			$('.mw-go-top').fadeIn();
		} else {
			$('.mw-go-top').fadeOut();
		}
    });
	
	$('.mw-go-top').click(function() {
		$("html, body").animate({ scrollTop: 0 }, 1000);
	});

});