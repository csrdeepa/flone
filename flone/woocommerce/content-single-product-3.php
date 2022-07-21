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

$gallery_style = flone_get_option('gallery_style', '1');
$gallery_style_class = 'single_pro_style_'. esc_attr($gallery_style);

// woocommerce gallery thumbnail size filter
$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );

// woocommerce gallery main image size filter
$main_image_size        = apply_filters( 'woocommerce_gallery_image_size', 'woocommerce_single' );

// woocommerce gallery main image full size filter
$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );

// get gallery image ids
$attachment_ids = $product->get_gallery_image_ids();

// get main image id
$post_thumbnail_id = $product->get_image_id();

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('row '. $gallery_style_class ); ?>>
	<div class="col-xl-7 col-lg-7 col-md-12 single_product_image_wrapper">
		<div class="product-details-img mr-20 product-details-tab single_pro_style_2">
		   <div class="zoompro-wrap zoompro-2 pr-20">
		        <div class="zoompro-border zoompro-span">
                	
						<!-- main product image -->
	                	<?php
	                    	if ( has_post_thumbnail() ) {
	                    		$full_src = wp_get_attachment_image_src( $post_thumbnail_id, 'large');
	                    		$html = '<div class="woocommerce-product-gallery__image">';
	                    		$html .= '<img class="zoompro  wp-post-image" src="'. $full_src[0] .'">';
	                    		$html .= '</div>';

	                    	} else {

	    						$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
	    						$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image zoompro " />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'flone' ) );
	    						$html .= '</div>';
	                    	}

	                    	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
	                	?>

	                    <?php flone_show_product_loop_sale_flash(); ?>

	                    <?php
	                    	$video_url = get_post_meta(get_the_id(), '_flone_video_url', true);
	                    	if($video_url):
	                    ?>
	                    <div class="product-video">
	                        <a class="video-popup" href="<?php echo esc_url( $video_url ); ?>">
	                            <i class="fa fa-video"></i>
	                            <?php echo esc_html__('View Video', 'flone'); ?>
	                        </a>
	                    </div>
	                	<?php endif; ?>

		        </div>
		    </div>
		    <div id="gallery" class="product-dec-slider-2">
				<!-- gallery thumbnails -->
				<?php foreach( $attachment_ids as $index => $attachment_id ):
					if($index == 0 && has_post_thumbnail()):

						$post_image_full_src =  wp_get_attachment_image_src($post_thumbnail_id, 'full');
						$post_image_large_src = wp_get_attachment_image_src($post_thumbnail_id, 'large');
				?>

					<a data-image="<?php echo esc_url(  $post_image_large_src[0] ); ?>" data-zoom-image="<?php echo esc_url($post_image_full_src[0]); ?>">
	                    <?php echo wp_get_attachment_image( $post_thumbnail_id, $thumbnail_size ); ?>
	                </a> 

				<?php
					endif;

					$gallery_image_full_src = wp_get_attachment_image_src( $attachment_id, $full_size );
					$gallery_image_large_src = wp_get_attachment_image_src( $attachment_id, $full_size );
				?>
				
					<a data-image="<?php echo esc_url( $gallery_image_large_src[0] ); ?>" data-zoom-image="<?php echo esc_url( $gallery_image_full_src[0] ); ?>">
	                    <?php echo wp_get_attachment_image( $attachment_id, $thumbnail_size ); ?>
	                </a> 

            	<?php endforeach; ?>
		    </div>
		</div>
	</div>
	
	<div class="col-lg-5 col-lg-5 col-md-12">
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