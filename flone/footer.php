<?php

/**

 * The template for displaying the footer

 *

 * Contains the closing of the #content div and all content after.

 *

 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials

 *

 * @package flone

 */



$footer_1_class = flone_get_option('footer_column_1_class', 'col-lg-3 col-sm-6 col-xs-12');

$footer_2_class = flone_get_option('footer_column_2_class', 'col-lg-3 col-sm-6 col-xs-12');

$footer_3_class = flone_get_option('footer_column_3_class', 'col-lg-3 col-sm-6 col-xs-12');

$footer_4_class = flone_get_option('footer_column_4_class', 'col-lg-3 col-sm-6 col-xs-12');

$footer_5_class = flone_get_option('footer_column_5_class', '');



$show_footer_widget_area = flone_get_option('show_footer_widget_area', '1');

$footer_style = flone_get_option('footer_style', '1');

$footer_color = flone_get_option('footer_color', 'gray');

?>

		

	</div><!-- #content -->

	<div>
		<?php //the_widget( 'hstngr_widget' ); 
		if ( is_home() ) {
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Slider Widget Area')) :
			endif;
		}
			//echo do_shortcode( '[espro-slider id=1100]' );
			
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Area')) :
			endif;
		?>
	</div>


	<?php if($show_footer_widget_area && $footer_style == '3'): ?>


	
	<footer class="footer-area flone-bg-<?php echo esc_attr($footer_color); ?> pt-80 footer_style_<?php echo esc_attr( $footer_style ); ?>">

	    <div class="footer-top text-center">

	        <div class="container">

	            <div class="footer-logo">

	            	<?php

	            	if(flone_get_option('footer_logo')):

	            		if($footer_color == 'gray'):

	            			flone_logo();

	            		else: ?>

		                <a href="<?php the_permalink(); ?>">

	                    	<?php $logo_light = get_theme_mod('custom_logo_light'); ?>

	                    	<img src="<?php echo esc_attr($logo_light); ?>" alt="<?php echo esc_attr__('Logo', 'flone') ?>">

		                </a>

	            	<?php

	            		endif;

	            	endif;

	            	?>

	            </div>



	            <?php if(flone_get_option('footer_text')){

	            	echo wp_kses_post(wpautop(flone_get_option('footer_text')));

	            } ?>



				<?php if(flone_get_option('enable_social_icons') && function_exists('flone_get_social_networks_html')): ?>

	            <div class="footer-social">

					<?php echo flone_get_social_networks_html(); ?>

	            </div>

	        	<?php endif; ?>



	        	<?php if(flone_get_option('enable_footer3_widget_area')){

	        		dynamic_sidebar('footer-1');

	        	} ?>



	        </div>

	    </div>



	    <?php if(flone_get_option('copyright_text')): ?>

	    <div class="footer-bottom text-center">

	        <div class="container">

	            <div class="copyright-2">

	                 <?php echo wp_kses_post(wpautop(flone_get_option('copyright_text'))); ?>

	            </div>

	        </div>

	    </div>

		<?php endif; ?>

		

	</footer>



	<?php elseif($show_footer_widget_area && $footer_style == '2'): ?>



	<footer id="colophon" class="site-footer footer-area flone-bg-<?php echo esc_attr($footer_color); ?> pt-60 footer_style_<?php echo esc_attr( $footer_style ); ?>">

		<div class="container">

		    <div class="row">



		    	<?php if(is_active_sidebar('footer-1')): ?>

			        <div class="<?php echo esc_attr($footer_1_class); ?>">

			            <?php dynamic_sidebar( 'footer-1' ); ?>

			        </div>

		    	<?php endif; ?>

				

				<?php if(is_active_sidebar('footer-2')): ?>

			        <div class="<?php echo esc_attr($footer_2_class); ?>">

			            <?php dynamic_sidebar( 'footer-2' ); ?>

			        </div>

				<?php endif; ?>



				<?php if(is_active_sidebar('footer-3')): ?>

			        <div class="<?php echo esc_attr($footer_3_class); ?>">

			            <?php dynamic_sidebar( 'footer-3' ); ?>

			        </div>

		        <?php endif; ?>

					

				<?php if(is_active_sidebar('footer-4')): ?>

			        <div class="<?php echo esc_attr($footer_4_class); ?>">

			            <?php dynamic_sidebar( 'footer-4' ); ?>

			        </div>

		        <?php endif; ?>



        		<?php if(is_active_sidebar('footer-5')): ?>

        	        <div class="<?php echo esc_attr($footer_5_class); ?>">

        	            <?php dynamic_sidebar( 'footer-5' ); ?>

        	        </div>

                <?php endif; ?>

		    </div>

		</div>

	</footer><!-- #colophon -->





	<?php if(flone_get_option('show_copyright_area') && flone_get_option('copyright_text')): ?>

		<div class="footer-bottom text-center">

		    <div class="container">

		        <div class="copyright">

		            <?php echo wp_kses_post(wpautop(flone_get_option('copyright_text'))); ?>

		        </div>

		    </div>

		</div>

	<?php endif; ?>



	<?php else:



		if($show_footer_widget_area && (

			is_active_sidebar('footer-1') ||

			is_active_sidebar('footer-2') ||

			is_active_sidebar('footer-3') ||

			is_active_sidebar('footer-4')

		)):

			

	?>



	<?php

		endif; // footer widgets



		$copyright_default_text = esc_html__('Coryright All Right Reserved.', 'flone');

		$copyright_text = flone_get_option('copyright_text', $copyright_default_text );

		if(flone_get_option('show_copyright_area', '1') && $copyright_text):

	?>

	<div class="footer-bottom text-center">

	    <div class="container">

	        <div class="copyright">

	            <?php echo wp_kses_post( wpautop( $copyright_text ) ); ?>

	        </div>

	    </div>

	</div>

		<?php endif; // copyright ?>



	<?php endif; // style ?>







	<?php

		if( flone_get_option('header_style') == '5' ){

			flone_slinky_menu();

		}

	?>

</div><!-- #page end -->



<?php wp_footer(); ?>



</body>

</html>