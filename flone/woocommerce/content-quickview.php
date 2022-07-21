<div id="product-<?php the_ID(); ?>" <?php wc_product_class('row'); ?>>

	<div class="col-lg-5 col-md-6 single_product_image_wrapper">
	<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	</div>
	
	<div class="col-lg-7 col-md-6">
		<div class="summary entry-summary">
			<?php
				woocommerce_template_single_title();
				woocommerce_template_loop_price();
				woocommerce_template_single_rating();
				woocommerce_template_single_excerpt();
				woocommerce_template_single_add_to_cart();
				woocommerce_template_single_meta();
				flone_woocommerce_single_product_sharing();
			?>
		</div>
	</div>
</div>
