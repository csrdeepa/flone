(function($){
"use strict";
	
	// click event ajax
	$(document).on('click', '.flone.widget_product_categories li a, .flone.widget_product_tag_cloud a, .flone.woocommerce-widget-layered-nav li a, .woocommerce-pagination li a, .widget_rating_filter.flone li a, .woocommerce .flone.widget_price_filter .price_slider_amount .button', function (event) {
	    $(this).flone_ajax_filter(event, this);
	});

	// chagne event ajax
	$(document).ready(function(){
	    $('.woocommerce').delegate('form.woocommerce-ordering', 'submit', function (event) {
	        event.preventDefault();
	    }).delegate( 'select.orderby', 'change', function(event){
	    	$(this).flone_ajax_filter(event, this);
	    });
	});

	// ajax filter
	$.fn.flone_ajax_filter = function (event, obj) {
	    event.preventDefault();

	    var current_location_obj = window.location,
		    current_url = window.location.href,
		    shop_url = current_location_obj.origin + current_location_obj.pathname,
		    url = shop_url;

	    if( $(this).attr('href') != undefined ){
	    	url = event.currentTarget.href;
	    }

	    // price filter url generate
	    if( $('.flone.widget_price_filter').length && obj.type == 'submit' ){

	    	var min_price = $('.flone.widget_price_filter #min_price').val();
	    	var max_price = $('.flone.widget_price_filter #max_price').val();

	    	// add price query string
    		if( current_location_obj.search.length < 1 ){

	    		// if url has no query string add by ?
				current_url += '?min_price='+ min_price + '&' + 'max_price='+ max_price;
				url = current_url;

    		} else if( current_location_obj.search.length > 1 && current_location_obj.href.indexOf('max_price=') < 1 ){

	    		// if url has query string && max_price is not present then add by &
				current_url += '&min_price='+ min_price + '&' + 'max_price='+ max_price;
				url = current_url;

    		}
	    	
	    	// update min/max_price query string
			if( current_location_obj.href.indexOf('max_price=') >= 1 ){

	    		// if url has max_price then update it's value only
				var existing_url = new URL(current_url),
				query_string = existing_url.search,
				search_params = new URLSearchParams(query_string);

				// new value of "max_price"
				search_params.set('min_price', min_price);
				search_params.set('max_price', max_price);

				// change the max_price property of the main url
				existing_url.search = search_params.toString();

				// the new url string
				url = existing_url.toString();

			}
	    }

	    // orderby url generate
	    if( $(this).hasClass('orderby') ){

	    	// add orderby query string
    		if( current_location_obj.search.length < 1 ){

	    		// if url has no query string add by ?
				current_url += '?orderby='+ $(this).val();
				url = current_url;

    		} else if( current_location_obj.search.length > 1 && current_location_obj.href.indexOf('orderby=') < 1 ){

	    		// if url has query string && orderby is not present then add by &
				current_url += '&orderby='+ $(this).val();
				url = current_url;

    		}

	    	// update orderby query string
    		if( current_location_obj.href.indexOf('orderby=') >= 1 ){

	    		// if url has orderby then update it's value only
				var existing_url = new URL(current_url),
				query_string = existing_url.search,
				search_params = new URLSearchParams(query_string);

				// new value of "orderby"
				search_params.set('orderby', $(this).val());

				// change the orderby property of the main url
				existing_url.search = search_params.toString();

				// the new url string
				url = existing_url.toString();

    		}
	    }
	    
	    // update browser history
	    if ( !navigator.userAgent.match( /msie/i ) ) {
	        window.history.pushState( {}, "", url );
	    }

	    // finally make the ajax request
	    $.ajax({
	        url: url,
	        beforeSend:function() {
	        	$('body').addClass('flone-ajax-loading');
	        },
	        success:function(response) {
	        	// global selectors
	        	var main_content_wrapper_selector = 'ul.products',
	        		no_results_wrapper_selector = 'ul.products',
	        		pagination_wrapper_selector = '.woocommerce-pagination',
	        		result_count_wrapper_selector = '.woocommerce-result-count';

	        	// for flone
	        	// var main_content_wrapper_selector = '.tab-content',
	        	// 	no_results_wrapper_selector = '#product_grid',
	        	// 	pagination_wrapper_selector = '.woocommerce-pagination',
	        	// 	result_count_wrapper_selector = '.woocommerce-result-count';

	        	$('body').removeClass('flone-ajax-loading');

	            // container
	            if ($(response).find( main_content_wrapper_selector ).length > 0) {
	                $( main_content_wrapper_selector ).html( $(response).find( main_content_wrapper_selector ) );
	            } else {
	                $( no_results_wrapper_selector ).html( $(response).find('.woocommerce-info') );
	            }

	            // pagination
	            if ($(response).find( pagination_wrapper_selector ).length > 0) {
	                $( pagination_wrapper_selector ).html($(response).find( pagination_wrapper_selector ).html()).show();
	            } else {
	                $( pagination_wrapper_selector ).empty();
	            }

	            // result count
	            if ($(response).find( result_count_wrapper_selector ).length > 0) {
	                $( result_count_wrapper_selector ).html($(response).find( result_count_wrapper_selector ).html()).show();
	            }

	            // orderby
	            if ($(response).find('.woocommerce-ordering').length > 0) {
	                $('.woocommerce-ordering').html($(response).find('.woocommerce-ordering').html()).show();
	            }

	            // load new widgets
	            $('.flone.woocommerce-widget-layered-nav').add('.flone.widget_product_categories').add('.flone.widget_rating_filter').add('.flone.widget_price_filter').each( function() {
	                widget_refresh( $(this) );
	            });

	            // reset filter widget
	            $('.flone_widget_reset_filters').each(function () {
	                widget_refresh( $(this) );
	            });

	            function widget_refresh( widget ) {
	                var widget_id = widget.attr('id'),
	                	new_widget_html  = $(response).find('#' + widget_id),
	                	href = window.location.href;

	                if( widget.find('.flone-reset-filters-button').length == 1 ){
                		if( href.indexOf('?') != -1 ){
                		   widget.show();
                		} else{
                		   widget.hide();
                		}
	                } else {
	                	if( new_widget_html.length == 0 ){
	                	    widget.hide();
	                	} else {
	                	    widget.html( new_widget_html.html() );
	                	    widget.show();
	                	}
	                }
	            };

	            init_price_filter();
	        },
	        error: function(errorThrown){
	            console.log(errorThrown);
	        }
	    }); 
	}

	function init_price_filter(){
	    $( '.widget.flone input#min_price, input#max_price' ).hide();
	    $( '.widget.flone .price_slider, .widget.flone .price_label' ).show();

	    var min_price         = $( '.widget.flone .price_slider_amount #min_price' ).data( 'min' ),
	    	max_price         = $( '.widget.flone .price_slider_amount #max_price' ).data( 'max' ),
	    	step              = $( '.widget.flone .price_slider_amount' ).data( 'step' ) || 1,
	    	current_min_price = $( '.widget.flone .price_slider_amount #min_price' ).val(),
	    	current_max_price = $( '.widget.flone .price_slider_amount #max_price' ).val();

	    $( '.widget.flone  .price_slider:not(.ui-slider)' ).slider({
	    	range: true,
	    	animate: true,
	    	min: min_price,
	    	max: max_price,
	    	step: step,
	    	values: [ current_min_price, current_max_price ],
	    	create: function() {

	    		$( '.widget.flone .price_slider_amount #min_price' ).val( current_min_price );
	    		$( '.widget.flone .price_slider_amount #max_price' ).val( current_max_price );

	    		$( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );
	    	},
	    	slide: function( event, ui ) {

	    		$( '.widget.flone input#min_price' ).val( ui.values[0] );
	    		$( '.widget.flone input#max_price' ).val( ui.values[1] );

	    		$( document.body ).trigger( 'price_slider_slide', [ ui.values[0], ui.values[1] ] );
	    	},
	    	change: function( event, ui ) {

	    		$( document.body ).trigger( 'price_slider_change', [ ui.values[0], ui.values[1] ] );
	    	}
	    });
	}

})(jQuery);