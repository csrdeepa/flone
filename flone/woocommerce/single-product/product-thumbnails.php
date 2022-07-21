<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.6
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;


// woocommerce gallery thumbnail size filter
$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );

// get main image id
$post_thumbnail_id = $product->get_image_id();

// woocommerce gallery main image full size filter
$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) {

	echo '<div id="gallery" class="product-dec-slider-1 shop-details-tab nav-style-1">';

	$html ='';
	foreach ( $attachment_ids as $index => $attachment_id ):
		if($index == 0 && has_post_thumbnail()):

			$post_image_full_src =  wp_get_attachment_image_src($post_thumbnail_id, 'full');
			$post_image_large_src = wp_get_attachment_image_src($post_thumbnail_id, 'large');

			$html .= '<a data-image="'. esc_url(  $post_image_large_src[0] ) .'" data-zoom-image="'. esc_url($post_image_full_src[0]). '">';
			$html .= wp_get_attachment_image( $post_thumbnail_id, $thumbnail_size );
			$html .= ' </a> ';

		endif;

		$gallery_image_full_src = wp_get_attachment_image_src( $attachment_id, $full_size );
		$gallery_image_large_src = wp_get_attachment_image_src( $attachment_id, $full_size );


		$html .= '<a data-image="'. esc_url( $gallery_image_large_src[0] ) .'" data-zoom-image="'. esc_url( $gallery_image_full_src[0] ) .'">';
        $html .= wp_get_attachment_image( $attachment_id, $thumbnail_size );
        $html .= '</a>'; 

    endforeach;

	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );

	echo '</div>';
}