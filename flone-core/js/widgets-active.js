(function($){
"use strict";


// instagram active
var OwlActivattion = function ($scope, $) {
    var carousel_elem = $scope.find('.owl-carousel').eq(0);

    carousel_elem.each(function () {
    	var $this = jQuery(this);
    	var settings = jQuery(this).data('settings');

    	var autoplay = settings.autoplay == 'true' ? true : false;
    	var autoplay_timeout = settings.autoplay_timeout ? parseInt(settings.autoplay_timeout) : 3000;
    	var dots = settings.dots == 'true' ? true : false;;
    	var nav = settings.nav == 'true' ? true : false;
    	var margin = settings.margin  ? parseInt(settings.margin) : 0;
    	var loop = settings.loop === 'true' ? true : false;
    	var prev_icon = settings.prev_icon ? '<i class="'+ settings.prev_icon +'"></i>' : '<i class="fa-chevron-left"></i>';
    	var next_icon = settings.next_icon ? '<i class="'+ settings.next_icon +'"></i>' : '<i class="fa-chevron-right"></i>';

    	var columns_on_desktop = settings.columns_on_desktop  ? parseInt(settings.columns_on_desktop) : '1';
    	var columns_on_mobile = settings.columns_on_mobile  ? parseInt(settings.columns_on_mobile) : '1';
    	var columns_on_tablet = settings.columns_on_tablet  ? parseInt(settings.columns_on_tablet) : '1';

    	$this.owlCarousel({
    	    loop: loop,
    	    nav: nav,
    	    dots: dots,
    	    margin: margin,
    	    autoplay: autoplay,
    	    navText: [prev_icon, next_icon],
    	    autoplayTimeout: autoplay_timeout,
    	    animateOut: 'fadeOut',
    	    animateIn: 'fadeIn',
    	    item: columns_on_desktop,
    	    responsive: {
    	        0: {
    	            items: columns_on_mobile
    	        },
    	        768: {
    	            items: columns_on_tablet
    	        },
    	        1000: {
    	            items: columns_on_desktop
    	        }
    	    }
    	});

    });
}


var CountDownActivattion = function ($scope, $) {
	var element = $scope.find('[data-countdown]').eq(0);
    element.each(function () {
    	var $this = $(this),
    	    due_date = $(this).data('countdown').due_date,
    	    daytxt = $(this).data('countdown').daytxt,
    	    hourtxt = $(this).data('countdown').hourtxt,
    	    minutestxt = $(this).data('countdown').minutestxt,
    	    secondstxt = $(this).data('countdown').secondstxt;

    		$this.countdown(due_date, function(event) {
    	    	$this.html(event.strftime('<span class="cdown day">%-D <p>'+ daytxt +'</p></span> <span class="cdown hour">%-H <p>'+ hourtxt +'</p></span> <span class="cdown minutes">%M <p>'+ minutestxt +'</p></span class="cdown second"> <span>%S <p>'+ secondstxt +'</p></span>'));
    		});

    });
}


// Google Map
var GoogleMapActivation = function ($scope, $) {
	var element = $scope.find('#map').eq(0);

	element.each(function () {
		var $this = jQuery(this);
		var $settings = jQuery(this).data('settings');

		// lat_long
		var lat_long = $settings.lat_long;
		var lat_long = lat_long.split(",");
		var lat = lat_long[0] ? lat_long[0] : 40.709896;
		var long = lat_long[1] ? lat_long[1]  : -73.995481;
		
		// scroll_wheel
		var scroll_wheel = $settings.scroll_wheel == 'true' ? true : false;

		// zoom_level
		var zoom_level = $settings.zoom_level ? parseInt($settings.zoom_level) : 10;

		// marker_lat_long
		var marker_lat_long = $settings.marker_lat_long;
		var marker_lat_long = marker_lat_long.split(",");
		var marker_lat = marker_lat_long[0] ? marker_lat_long[0] : 40.709896;
		var marker_long = marker_lat_long[1] ? marker_lat_long[1]  : -73.995481;

		// marker_img_url
		var marker_img_url = $settings.marker_img_url;

		// style
		var style = $settings.style;
		style = JSON.parse(style);

		function init() {
		    var mapOptions = {
		        zoom: zoom_level,
		        scrollwheel: scroll_wheel,
		        center: new google.maps.LatLng(lat, long),
		        styles: style
		    };
		    var mapElement = document.getElementById('map');
		    var map = new google.maps.Map(mapElement, mapOptions);
		    var marker = new google.maps.Marker({
		        position: new google.maps.LatLng(marker_lat, marker_long),
		        map: map,
		        icon: marker_img_url,
		        animation:google.maps.Animation.BOUNCE,
		        title: ''
		    });
		}
		google.maps.event.addDomListener(window, 'load', init);
	 });
}

// Run this code under Elementor.
$(window).on('elementor/frontend/init', function () {
	 elementorFrontend.hooks.addAction( 'frontend/element_ready/flone_instagram.default', OwlActivattion);
	 elementorFrontend.hooks.addAction( 'frontend/element_ready/flone_slider.default', OwlActivattion);
	 elementorFrontend.hooks.addAction( 'frontend/element_ready/flone_product_categories.default', OwlActivattion);
	 elementorFrontend.hooks.addAction( 'frontend/element_ready/flone_testimonial.default', OwlActivattion);
	 elementorFrontend.hooks.addAction( 'frontend/element_ready/flone_brands.default', OwlActivattion);
	 elementorFrontend.hooks.addAction( 'frontend/element_ready/flone_countdown.default', CountDownActivattion);
	 elementorFrontend.hooks.addAction( 'frontend/element_ready/flone_map.default', GoogleMapActivation);
});

})(jQuery);