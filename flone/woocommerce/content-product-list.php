<?php
/**
 * The template for displaying list view products within loops
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$gallery_ids = $product->get_gallery_image_ids();

$secondary_img = isset($gallery_ids[0]) ? $gallery_ids[0] : '';
$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
?>

<div <?php wc_product_class('col-lg-12 col-md-12 col-12 list_view'); ?>>
    <div class="shop-list-wrap mb-30 scroll-zoom">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-6">
                <div class="product-wrap">
                    <div class="product-img">
                        <a href="<?php the_permalink(); ?>">
                        	<?php
                        		woocommerce_template_loop_product_thumbnail();

                        		if($secondary_img){
                        			echo wp_get_attachment_image( $secondary_img, $image_size, false, array('class' => 'hover-img') );
                        		}
                        	?>
                        </a>
                        <?php flone_show_product_loop_sale_flash(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 col-sm-6">
                <div class="shop-list-content">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="product-list-price">
                        <?php woocommerce_template_loop_price(); ?>
                    </div>

                    <?php woocommerce_template_single_rating(); ?>

                    <?php woocommerce_template_single_excerpt(); ?>
                    <div class="shop-list-btn btn-hover">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
