<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

global $product;

// woocommerce gallery main image size filter
$main_image_size        = apply_filters( 'woocommerce_gallery_image_size', 'woocommerce_single' );

// woocommerce gallery main image full size filter
$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );

// get gallery image ids
$attachment_ids = $product->get_gallery_image_ids();

// get main image id
$post_thumbnail_id = $product->get_image_id();

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('row single_pro_style_6'); ?>>
	<div class="col-lg-12 col-md-12 single_product_image_wrapper">
	    <div class="product-details-slider-active owl-carousel nav-style-1  text-center testtest">
        	<?php
            	if ( has_post_thumbnail() ) {
            		$full_src = wp_get_attachment_image_src( $post_thumbnail_id, $full_size);

            		$html = '<div class="dec-img-wrap">';
            		$html .= '<a class="img-popup" href="'. $full_src[0] .'">';
            		$html .= wp_get_attachment_image(
            			$post_thumbnail_id,
            			$main_image_size
            		);
            		$html .= '</a>';
            		$html .= '</div>';
            	} else {

					$html  = '<div class="dec-img-wrap woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'flone' ) );
					$html .= '</div>';
            	}

            	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
        	?>


				<?php foreach( $attachment_ids as $attachment_id ):
					$thumb_src = wp_get_attachment_image_src( $attachment_id, $full_size );
					$full_src = wp_get_attachment_image_src( $attachment_id, $full_size );
				?>

                <div class="dec-img-wrap">
                    <a class="img-popup" href="<?php echo esc_attr( $full_src[0] ) ?>">
                    	<?php echo wp_get_attachment_image( $attachment_id,  $main_image_size); ?>
                    </a>
                </div>

            	<?php endforeach; ?>

	    </div>
	</div>
	
	<div class="col-lg-6 col-md-6 col-lg-12 col-md-12 mt-50 text-center">
		<div class="summary entry-summary">
			<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>
		</div>
	</div>
</div>

<div  <?php wc_product_class('row'); ?>>
	<div class="col-lg-12 description-review-area">
		<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
