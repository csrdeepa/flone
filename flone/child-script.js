jQuery( document ).ready(function() {
    jQuery(".btn_position").click(function () {
           let arr=[];
		   jQuery('#mytable tbody tr').each(function(index) {
				arr.push({catid: this.id, position: index+1});
			  })

	    jQuery.ajax({
	        type: "POST",
			//dataType:"json",
	        url: concivescriptAjax.cajaxurl,
	        data: {
	            action: 'update_position',
	            updateposition: arr,
	        },
	        success: function (response) {
	           console.log("Output  : ", response);
	        }
	        });
		});
});
