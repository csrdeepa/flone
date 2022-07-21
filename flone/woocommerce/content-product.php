<?php
/**
 * The template for displaying product content within loops
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$columns_in_mobile = flone_get_option('shop_columns_mobile', '1');
if($columns_in_mobile == 1){
	$flone_col_class = 'flone-col-12';
} else {
	$flone_col_class = 'flone-col-2';
}
?>
<div <?php wc_product_class('col-md-6 col-sm-6 '. $flone_col_class .' col-12'); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>

	<div class="product-wrap mb-35 scroll-zoom">
		<div class="product-img">
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</div>
		<div class="product-content text-center">
			<?php
			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			  <div class="pro-same-action pro-cart">
	        <?php woocommerce_template_loop_add_to_cart(); ?>
	    </div>
		</div>

	<?php
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item' );
	?>
	</div>
</div>
<!---->