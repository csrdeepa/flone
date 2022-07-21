<?php

	// topbar options

	$show_topbar = flone_get_option('show_topbar', '0');

	if( flone_get_meta_otpion('show_topbar') != 'default' ){

		$show_topbar = ( flone_get_meta_otpion('show_topbar') ? flone_get_meta_otpion('show_topbar') : '0' );

	}

	$show_topbar = apply_filters( 'flone_show_topbar', $show_topbar );



	$topbar_style = flone_get_option('topbar_style', '');

	$topbar_width = flone_get_option('topbar_width', '');

	if(flone_get_meta_otpion('topbar_width')){

		$topbar_width = flone_get_meta_otpion('topbar_width');

	}



	$wrapper_class = 'topbar_style_' . $topbar_style .' ';

	$wrapper_class .= $topbar_width == 'full' ? 'header-top-area header-padding-2' : 'header-top-area';

	$container_class = $topbar_width == 'full' ? 'container-fluid' : 'container';

	$show_topbar_language = flone_get_option('show_topbar_language');

	$show_topbar_currency = flone_get_option('show_topbar_currency');

	$topbar_text_1 = flone_get_option('topbar_text_1');

	$topbar_text_2 = flone_get_option('topbar_text_2');



	if($show_topbar == '1'):

		if($topbar_style == '2') :

?>

	    	<div class="<?php echo esc_attr($wrapper_class); ?>">

	            <div class="<?php echo esc_attr($container_class); ?>">

	                <div class="header-top-wap">

	                	

						<?php flone_header_quick_contents(); ?>

	    				

	                    <?php echo flone_get_social_networks_html(); ?>



	                </div>

	            </div>

	        </div>



		<?php else: ?>



			<div class="<?php echo esc_attr($wrapper_class); ?>">

		        <div class="<?php echo esc_attr($container_class); ?>">

		            <div class="header-top-wap">



		            	<?php if($show_topbar_language || $show_topbar_currency || $topbar_text_1): ?>

		                <div class="language-currency-wrap">



		                	<?php if($show_topbar_language): ?>

		                    <div class="same-language-currency language-style">

		                        <?php

		                        	if(function_exists('flone_language_selector')){

		                        		flone_language_selector();

		                        	}

		                        ?>

		                    </div>

		                	<?php endif; ?>



		                	<?php if($show_topbar_currency && function_exists('flone_currency_dropdown')): ?>



		                		<?php

		                			if(flone_get_option('currency_switcher_type') == 'plugin'){

		                				echo do_shortcode('[WCMC style="all"]');

		                			} else {

		                				flone_currency_dropdown();

		                			}

		                		?>



		                    <?php endif; ?>



		                    <?php if($topbar_text_1): ?>

		                    <div class="same-language-currency ">

		                        <!-- <p></p> -->
		                        <?php echo wp_kses_post($topbar_text_1); ?>

		                    </div>

		                    <?php endif; ?>



		                </div>

						<?php endif; ?>

						

						<?php if($topbar_text_2): ?>

		                <div class="header-offer">

		                    <p><?php echo wp_kses_post($topbar_text_2); ?></p>

		                </div>

		            	<?php endif; ?>



		            </div>

		        </div>

		    </div>



		<?php endif; // styles ?>

    <?php endif; // show/hide ?>