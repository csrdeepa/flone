(function($){
"use strict";

	// key press event
	$(document).ready(function(){
		$('.flone_widget_psa input').keyup(function(e) {
		    clearTimeout($.data(this, 'timer'));
		    if (e.keyCode == 13){
		      doSearch(true);
		    } else {
		      $(this).data('timer', setTimeout(doSearch, 500));
		    }
		});

		$('.flone_widget_psa_clear_icon').on('click', function(){
			$('#flone_psa_results_wrapper').html('');
			$('.flone_widget_psa').removeClass('flone_widget_psa_clear');
			$('.flone_widget_psa input[type="search"]').val('');
		});
	});

	function doSearch() {
	    var searchString = $('.flone_widget_psa input').val();
	    if(searchString == ''){
	    	$('#flone_psa_results_wrapper').html('');
	    	$('.flone_widget_psa').removeClass('flone_widget_psa_clear');
	    }
	    if (searchString.length < 3) return; //wasn't enter, not > 2 char
	    var wrapper_width = $('.flone_widget_psa').width(),
	    settings	= $('.flone_widget_psa form').data('settings'),
	    limit	=	settings.limit ? parseInt(settings.limit) : 10;

	    $.ajax({
	    	url: flone_psa_localize.ajaxurl,
	    	data: {
	    		'action': 'flone_ajax_search_callback',
	    		's': searchString,
	    		'limit': limit,
	    		'nonce': flone_psa_localize.ajax_nonce
	    	},
	    	beforeSend:function(){
	    		$('.flone_widget_psa').addClass('flone_widget_psa_loading');
	    	},
	    	success:function(response) {
	    		$('#flone_psa_results_wrapper').css({'width': wrapper_width});
	    		$('#flone_psa_results_wrapper').html(response);
	    		$('.flone_widget_psa').removeClass('flone_widget_psa_loading');

	    		// nice scroll
	    		$(".flone_psa_inner_wrapper").niceScroll({cursorborder:"",cursorcolor:"#666"});
	    	},
	    	error: function(errorThrown){
	    	    console.log(errorThrown);
	    	}
	    }).done(function(response){
	    	$('.flone_widget_psa').addClass('flone_widget_psa_clear');
	    });
	}

})(jQuery);