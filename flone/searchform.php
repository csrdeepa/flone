<?php 
/**
 * The template for displaying Search form.
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package flone
 */
?>

<form class="pro-sidebar-search-form" action="<?php echo esc_url(home_url( '/' )); ?>" method="GET">
    <input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search Here', 'placeholder', 'flone' ); ?>" value="<?php echo get_search_query(); ?>">
    <button class="button-search">
        <i class="pe-7s-search"></i>
    </button>

    <?php if(class_exists('WooCommerce') && (is_woocommerce() || is_product_tag() || is_cart() || is_checkout() || is_account_page() || is_view_order_page() || is_filtered() ) ): ?>
    	<input type="hidden" name="post_type" value="product" />
    <?php endif; ?>
</form>