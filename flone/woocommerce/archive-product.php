<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );


// style
$style = flone_get_option('shop_style');

// shop_sidebar
$shop_sidebar = flone_get_option('shop_sidebar', 'left');

// view
$shop_view = flone_get_option('shop_view');

// check if there any widget used in the sidebar
if(!is_active_sidebar( 'sidebar-shop' ) || $style =='2'){
	$shop_sidebar = 'none';
}

switch($shop_sidebar){
 case 'left':
  $shop_col_class = 8;
  break;
  
 case 'right':
  $shop_col_class = 8;
  break;
 
 default:
  $shop_col_class = 12;
}


/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20 #removed
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
		<?php if($shop_sidebar == 'left' && $style != '2'): ?>

			<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-2 order-lg-1 pr-lg-5 viki">

				<div class="sidebar-style">
					<?php do_action( 'woocommerce_sidebar' ); ?>
				</div>

			</div><!-- /.col-md-3 -->

		<?php endif; ?>



		<div class="col-lg-<?php echo esc_attr($shop_col_class); ?> col-md-12 col-sm-12 col-12 smt-30 order-1 order-lg-2">
			<div class="shop-top-bar">
				<div class="select-shoing-wrap hidden-xs">
					<?php woocommerce_catalog_ordering(); ?>
					<?php woocommerce_result_count(); ?>
				</div>

				<?php if( $style == '2' ): ?>
					<div class="filter-active">
                        <a href="#"><i class="fa fa-plus"></i> <?php echo esc_html__('filter', 'flone'); ?></a>
                    </div>
				<?php elseif(woocommerce_get_loop_display_mode() != 'subcategories'): ?>
				<!-- Nav tabs -->
				<ul class="shop-tab nav">
					<li><a href="#product_grid" data-toggle="tab" class="<?php echo esc_attr($shop_view != 'list' ? 'active' : ''); ?>"><i class="fa fa-th"></i></a></li>
					<li><a href="#product_list" data-toggle="tab" class="<?php echo esc_attr($shop_view == 'list' ? 'active' : ''); ?>"><i class="fa fa-th-list"></i></a></li>
				</ul>
				<?php endif; ?>
			</div>

			<?php if( $style == '2' ): ?>
			<div class="product-filter-wrapper">
			    <div class="row">
			        <?php do_action( 'woocommerce_sidebar' ); ?>
			    </div>
			</div>
			<?php endif; ?>

			<header class="woocommerce-products-header">
				<?php if ( apply_filters( 'woocommerce_show_page_title', false ) ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>
				
				<?php
				/**
				 * Hook: woocommerce_archive_description.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
				?>
				
			</header>



			<div class="shop-bottom-area mt-35 is_<?php echo esc_attr(flone_get_option('shop_view', 'grid')); ?>_view">
				<?php

				if ( have_posts() ) {

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked wc_print_notices - 10 #removed
					 * @hooked woocommerce_result_count - 20 #removed
					 * @hooked woocommerce_catalog_ordering - 30 #removed
					 */
					do_action( 'woocommerce_before_shop_loop' );

					echo '<div class="tab-content jump">';
					echo '<div id="product_grid" class="tab-pane '. esc_attr($shop_view != 'list' ? 'active' : '') .'">';

					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();

					echo '</div> <!-- /#product_grid -->';
					echo '<div id="product_list" class="tab-pane '. esc_attr($shop_view == 'list' ? 'active' : '') .'">';

					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product-list' );
						}
					}

					woocommerce_product_loop_end();

					echo '</div> <!-- /#product_list -->';
					echo '</div> <!-- /.tab-content -->';

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				} ?>
			</div>
		</div> <!-- ./col-md-9 -->

		
		<?php if($shop_sidebar == 'right' && $style != '2'): ?>

			<div class="col-lg-3 col-md-12 col-sm-12 col-12 order-3 order-lg-3">

				<div class="sidebar-style ml-30">
					<?php do_action( 'woocommerce_sidebar' ); ?>
				</div>

			</div><!-- /.col-md-3 -->

		<?php endif; ?>


<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );