<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package flone
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function flone_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	if( !flone_get_option('enable_image_zoom', '1') ){
	remove_theme_support( 'wc-product-gallery-zoom' );
	}else{
		add_theme_support( 'wc-product-gallery-zoom' );
	}
}
add_action( 'after_setup_theme', 'flone_woocommerce_setup' );


/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function flone_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'flone_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function flone_woocommerce_products_per_page() {
	$per_page = flone_get_option('prod_per_page', 9);
	
	return $per_page;
}
add_filter( 'loop_shop_per_page', 'flone_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function flone_woocommerce_thumbnail_columns() {
	return 3;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'flone_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function flone_woocommerce_loop_columns() {
	$columns = flone_get_option('shop_columns', 3);
	
	return $columns;
}
add_filter( 'loop_shop_columns', 'flone_woocommerce_loop_columns' );

/**
 * Add to cart text
 *
 * @return string
 */
function flone_cart_button_text($text) {
	$custom_cart_text = flone_get_option('add_to_cart_text');
	if($custom_cart_text){
		$text = $custom_cart_text;
	}

	return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'flone_cart_button_text' );
add_filter('woocommerce_product_single_add_to_cart_text', 'flone_cart_button_text');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function flone_woocommerce_related_products_args( $args ) {
	$related_prod_per_page = flone_get_option('related_prod_per_page', 3);
	$related_prod_columns = flone_get_option('related_prod_columns', 2);

	$defaults = array(
		'posts_per_page' => $related_prod_per_page,
		'columns'        => $related_prod_columns,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'flone_woocommerce_related_products_args' );

if ( ! function_exists( 'flone_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function flone_woocommerce_product_columns_wrapper() {
		$columns = flone_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'flone_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'flone_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function flone_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'flone_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'flone_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function flone_woocommerce_wrapper_before() {
		$layout = flone_get_option('shop_layout');
		$sidebar = flone_get_option('shop_sidebar');
		$container_class = $layout == 'full_width' ? 'container-fluid' : 'container';

		$row_class = 'row';
		if(is_single()){
			$row_class = 'product_details_wrapper';
		} elseif($sidebar == 'left'){
			$row_class = 'row';
		}

		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<div class="<?php echo esc_attr($container_class); ?>">
					<div class="<?php echo esc_attr($row_class); ?>">
					<?php
	}
}
add_action( 'woocommerce_before_main_content', 'flone_woocommerce_wrapper_before' );

if ( ! function_exists( 'flone_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function flone_woocommerce_wrapper_after() {
					?>
					</div><!-- .row -->
				</div>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'flone_woocommerce_wrapper_after' );


if ( ! function_exists( 'flone_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function flone_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;

	    ob_start();
	    ?>
	   	<span class="count-style"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
	    <?php

	    $fragments['.count-style'] = ob_get_clean();

	    return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'flone_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'flone_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function flone_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'flone' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'flone' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}


// shop page customization
add_action( 'init', 'flone_shop_page_action_customize' );
function flone_shop_page_action_customize(){
	//archive product
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	//content product
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

	//content product
	add_action( 'woocommerce_before_shop_loop_item_title', 'flone_woocommerce_template_loop_product_thumbnail',10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open',5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close',15 );

	// cotnent product cat
	remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
	remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
	remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

	// content product cat
	add_action('woocommerce_before_subcategory', 'flone_subcategory_thumbnail', 10, 1);
	add_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_link_open', 5);
	add_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_link_close', 15);

}

// shop page category thumbnail
function flone_subcategory_thumbnail($category){
	?>
	<div class="collection-img">
		<a href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) ); ?>">
			<?php woocommerce_subcategory_thumbnail($category); ?>
		</a>
	</div>
	<?php
}

// shop single page actions customize
add_action( 'wp', 'flone_shop_single_page_action_customize' );
function flone_shop_single_page_action_customize(){

	if(is_product()){
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );


	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',15 );

	if(flone_get_option('single_prod_sharing', '0')){
		add_action( 'woocommerce_share', 'flone_woocommerce_single_product_sharing',10 );
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'flone_add_to_wishlist_button', 10);
}

// prouduct thumbnail
function flone_woocommerce_template_loop_product_thumbnail(){
	global $product;
	$gallery_ids = $product->get_gallery_image_ids();

	$secondary_img = isset($gallery_ids[0]) ? $gallery_ids[0] : '';
	$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
	?>

	<a href="<?php the_permalink(); ?>">
		<?php
			woocommerce_template_loop_product_thumbnail();

			if($secondary_img){
				echo wp_get_attachment_image( $secondary_img, $image_size, false, array('class' => 'hover-img') );
			}
		?>
	</a>
	<?php flone_show_product_loop_sale_flash(); ?>
		<div class="product-action noi-product-action <?php if(flone_get_option('quickview_control') == '0') {echo 'quickview_removed'; } ?> <?php if(class_exists('YITH_WCWL')){ echo esc_attr('has_wishlist'); } else { echo esc_attr('no_wishlist'); } ?>">

	    <?php
	    	if(function_exists('flone_add_to_wishlist_button')){
	    		echo flone_add_to_wishlist_button();
	    	}
	    	?>
</div>
	<?php
}


// modify saleflash with discount
add_filter( 'woocommerce_sale_flash', 'flone_modify_saleflash_by_discount');
function flone_modify_saleflash_by_discount($content){
	global $post, $product;

	 $discount = '';
	 $regurlar_price = get_post_meta( get_the_ID(), '_regular_price', true);
	 $sale_price  = get_post_meta( get_the_ID(), '_sale_price', true);
	 
	 if($regurlar_price && $sale_price ){
	     $price = $sale_price * 100 / $regurlar_price;
	     $discount = round(100 - $price);
	     $discount = __( '-', 'flone' ) . $discount . __( '%', 'flone' );
	}

	if ( $product->is_on_sale() && $product->get_type() == 'simple') {

		$content =  '<span class="onsale pink">' . esc_html($discount) . '</span>';

	} 

	return $content;
}

// add extra metabox tab to woocommerce
add_filter( 'woocommerce_product_data_tabs', 'flone_add_wc_extra_metabox_tab' );
function flone_add_wc_extra_metabox_tab($tabs){
	$flone_tab = array(
		'label'    => esc_html__( 'Flone', 'flone' ),
		'target'   => 'flone_product_data',
		'class'    => '',
		'priority' => 80,
	);

	$tabs[] = $flone_tab;

	return $tabs;
}

// add metabox to general tab
add_action( 'woocommerce_product_data_panels', 'flone_add_metabox_to_general_tab' );
function flone_add_metabox_to_general_tab(){

	echo '<div id="flone_product_data" class="panel woocommerce_options_panel hidden">';
	woocommerce_wp_text_input( array(
		'id'          => '_saleflash_text',
		'label'       => esc_html__( 'Custom SaleFlash Text', 'flone' ),
		'placeholder' => esc_html__( 'New!', 'flone' ),
		'description' => esc_html__( 'Enter your prefered SaleFlash text. Ex: Sale / New / Free etc', 'flone' ),
	) );
	woocommerce_wp_text_input( array(
		'id'          => '_flone_video_url',
		'label'       => esc_html__( 'Video Link', 'flone' ),
		'placeholder' => esc_html__( 'Youtube / Vimeo Video Link', 'flone' ),
		'description' => esc_html__( 'Place the video link. Only youtube and vimeo video link will be support.', 'flone' ),
	) );
	echo '</div>';

}

// save meta
add_action( 'woocommerce_process_product_meta', 'flone_save_metabox_of_general_tab');
function flone_save_metabox_of_general_tab($post_id){
	$saleflash_text = wp_kses_post( stripslashes( $_POST['_saleflash_text'] ) );
	$video_url = wp_kses_post( stripslashes( $_POST['_flone_video_url'] ) );
	
	update_post_meta( $post_id, '_saleflash_text', $saleflash_text);
	update_post_meta( $post_id, '_flone_video_url', $video_url);
}


// custom sale_flash function for non sale_flash products
function flone_show_product_loop_sale_flash(){
	global $product;

	$custom_saleflash_text = get_post_meta( get_the_id(), '_saleflash_text', true );

	if(!empty($custom_saleflash_text)){
		echo '<span class="onsale">' . esc_html($custom_saleflash_text) . '</span>';
	} elseif($product->is_on_sale()) {
		woocommerce_show_product_loop_sale_flash();
	}
}

// custom wishlist button
function flone_add_to_wishlist_button() {
	global $product, $yith_wcwl;

	if ( ! class_exists( 'YITH_WCWL' ) || !get_option( 'yith_wcwl_wishlist_page_id' )) return;

	$url          = YITH_WCWL()->get_wishlist_url();
	$product_type = $product->get_type();
	$exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
	$classes      = 'class="add_to_wishlist viki"';
	$add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
	$browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
	$added        = get_option( 'yith_wcwl_product_added_text' );

	$output = '';

	$output  .= '<div class="pro-same-action pro-wishlist yith-wcwl-add-to-wishlist add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';

		$output .= '<div class="yith-wcwl-add-button';
			$output .= $exists ? ' hide" style="display:none;"' : ' show"';
			

			$output .= '><a title="'.esc_attr__( 'Add to wishlist', 'flone' ).'" href="' . esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="pe-7s-like"></i></a>';



			$output .= '<i class="fa fa-spinner fa-pulse ajax-loading" style="visibility:hidden"></i>';
		$output .= '</div>';

		$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a title="'.esc_attr__( 'Wishlist added', 'flone' ).'" class="" href="' . esc_url( $url ) . '"><i class="pe-7s-check"></i></a></div>';

		$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a title="'.esc_attr__( 'View Wishlist', 'flone' ).'" href="' . esc_url( $url ) . '" class=""><i class="fa fa-heart"></i></a></div>';
	
	$output .= '</div>';

	return $output;
}


// customize rating html
add_filter( 'woocommerce_product_get_rating_html', 'flone_wc_get_rating_html', '', 3 );
function flone_wc_get_rating_html($html, $rating, $count){
	global $product;

	if ( $rating > 0) {
		$rating_whole = floor($rating);
		$rating_fraction = $rating - $rating_whole;

		$wrapper_class = is_single() ? 'product-rating' : 'product-rating';
		ob_start();
	?>
	<div class="<?php echo esc_attr( $wrapper_class ); ?>">
    	<?php for($i = 1; $i <= 5; $i++){
			if($i <= $rating_whole){
				echo '<i class="fas fa-star yellow"></i> ';
			} else {
				if($rating_fraction){
					echo '<i class="fas fa-star-half yellow"></i> ';
				} else {
					echo '<i class="fas fa-star"></i> ';
				}
			}
    	} ?>
	</div>

	 <?php
		$html = ob_get_clean();
	} else {
		$html  = '';
	}

	return $html;
}

// customize pagination
add_filter('woocommerce_pagination_args', 'flone_woocommerce_pagination_args');
function flone_woocommerce_pagination_args( $content ){
	$content['prev_text'] = '<i class="fa fa-angle-double-left"></i>';
	$content['next_text'] = '<i class="fa fa-angle-double-right"></i>';

	return $content;
}

// layerd nav count customize
add_filter( 'woocommerce_layered_nav_count', 'flone_layered_nav_count', '', 2 );
function flone_layered_nav_count( $count, $term ){
	return '<span class="count">' . absint( $term ) . '</span>';
}

// flone yith compare button
if(class_exists('YITH_Woocompare_Frontend')){

	// add icon to compare button
	add_filter('wpml_translate_single_string', 'flone_customize_compare_button');
	function flone_customize_compare_button(){
		return '<i class="pe-7s-shuffle"></i>';
	}

	class Flone_YITH_Compare_Extend extends YITH_Woocompare_Frontend{	
		function __construct(){
			add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'flone_compare_button_sc'), 15);
		}

		function flone_compare_button_sc(){
			echo wp_kses_post($this->compare_button_sc( $atts = null ));
		}
		
	}

	new Flone_YITH_Compare_Extend();
}


// product shere
function flone_woocommerce_single_product_sharing(){
	$product_title 	= get_the_title();
	$product_url	= get_permalink();
	$product_img	= wp_get_attachment_url( get_post_thumbnail_id() );

	$facebook_url 	= 'https://www.facebook.com/sharer/sharer.php?u=' . $product_url;
	$tumblr_url 	= 'http://tumblr.com/widgets/share/tool?canonicalUrl=' . $product_url;
	$twitter_url	= 'http://twitter.com/intent/tweet?status=' . rawurlencode( $product_title ) . '+' . $product_url;
	$pinterest_url	= 'http://pinterest.com/pin/create/bookmarklet/?media=' . $product_img . '&url=' . $product_url . '&is_video=false&description=' . rawurlencode( $product_title );
	$reddit_url		= 'https://reddit.com/submit?url={'.  $product_url .'}&title={'. $product_title .'}';

	?>
	<div class="pro-details-social">
	    <ul>
          <li><a href="<?php echo esc_url($facebook_url); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
          <li><a href="<?php echo esc_url($pinterest_url); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
          <li><a href="<?php echo esc_url($twitter_url); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="<?php echo esc_url($reddit_url); ?>" target="_blank"><i class="fab fa-reddit"></i></a></li>
          <li><a href="<?php echo esc_url($tumblr_url); ?>" target="_blank"><i class="fab fa-tumblr"></i></a></li>          
      </ul>
	</div>
<?php }


// manage product details tabs
add_filter( 'woocommerce_product_tabs', 'flone_reorder_product_tabs' );
function flone_reorder_product_tabs( $tabs ){
	// rename product tabs
	if(flone_get_option('enable_product_tabs_rename') == '1'){
		if(flone_get_option('tab_additional_info_text')){
			$tabs['additional_information']['title'] = flone_get_option('tab_additional_info_text');
		}
		
		if(flone_get_option('tab_description_text')){
			$tabs['description']['title'] = flone_get_option('tab_description_text');
		}
		
		if(flone_get_option('tab_reviews_text')){
			$tabs['reviews']['title'] = flone_get_option('tab_reviews_text');
		}
	}

	// reorder product tabs
	if(flone_get_option('enable_woo_tab_custom_ordering') == '1'){
		$tabs_order_enabled = flone_get_option('woo_tab_custom_ordering')['enabled'];
		$i = 5;
		foreach ($tabs_order_enabled as $key => $value) {
			switch($key) {
				case 'additional_information':
					if(isset($tabs['additional_information']['priority'])){
						$tabs['additional_information']['priority'] = $i;
					}
				break;
				
				case 'description':
					if(isset($tabs['description']['priority'])){
						$tabs['description']['priority'] = $i;
					}
				break;
				
				case 'reviews':
					if(isset($tabs['reviews']['priority'])){
						$tabs['reviews']['priority'] = $i;
					}
				break;
			}

			$i = $i + 5;
		}

		// disable product tabs
		$tabs_order_disabled = flone_get_option('woo_tab_custom_ordering')['disabled'];
		foreach ($tabs_order_disabled as $key => $value) {
			switch($key) {
				case 'additional_information':
					unset( $tabs['additional_information'] );
				break;
				
				case 'description':
					unset( $tabs['description'] );
				break;
				
				case 'reviews':
					unset( $tabs['reviews'] );
				break;
			}
		}
	}

	return $tabs;
}


// quickview ajax
add_action('wp_head','flone_woo_ajaxurl');
function flone_woo_ajaxurl() {
?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
<?php
	// Enqueue variation scripts
	wp_enqueue_script( 'wc-add-to-cart-variation' );
}
add_action( 'wp_ajax_flone_product_quickview', 'flone_product_quickview' );
add_action( 'wp_ajax_nopriv_flone_product_quickview', 'flone_product_quickview' );
function flone_product_quickview() {
	$product_id = (int) $_POST['data'];

	$params = array('p' => $product_id,'post_type' => array('product','product_variation'));
	$query = new WP_Query( $params );
	if( $query->have_posts() ){
		while ($query->have_posts()){
			$query->the_post();

			include get_template_directory().'/woocommerce/content-quickview.php';
		}
	}
	wp_reset_postdata();
	die();
}


// clear cart url
function flone_get_woocommerce_clear_cart_url(){
	return add_query_arg( 'clear-cart', '', get_permalink( wc_get_page_id( 'cart' ) ) );
}

add_action( 'init', 'flone_woocommerce_clear_cart' );
function flone_woocommerce_clear_cart() {
    if ( isset( $_GET['clear-cart'] ) ) {
        global $woocommerce;
        $woocommerce->cart->empty_cart();
    }
}

// customize breadcrumb
add_filter('woocommerce_breadcrumb_defaults', 'flone_woocommerce_breadcrumb_defaults');
function flone_woocommerce_breadcrumb_defaults( $args ){
	$args['delimiter']   = '';
	$args['wrap_before']   = '<div class="breadcrumb-content text-center"><ul>';
	$args['wrap_after']   = '</ul></div>';
	$args['before']   = '<li>';
	$args['after']   = '</li>';

	return $args;
}

// compare button
function flone_compare_button(){
	if( !class_exists('YITH_Woocompare') ) return;

	global $product;

	$product_id = $product->get_id();
	$comp_link = home_url() . '?action=yith-woocompare-add-product';
	$comp_link = add_query_arg('id', $product_id, $comp_link);

	echo '<a title="'. esc_attr__('Compare', 'flone') .'" href="'. esc_url( $comp_link ) .'" class="compare" data-product_id="'. esc_attr( $product_id ) .'" rel="nofollow"><i class="fa fa-retweet"></i></a>';
}

// gallery thumbnail size
$gallery_style = flone_get_option('gallery_style');
if($gallery_style == 1){
	add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
		return array('150', '150');
	} );
} else {
	add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
		return array('150', '200');
	} );
}


// Remove WooCommerce product and WordPress page results from the search form widget
function flone_modify_search_query( $query ) {
  // Make sure this isn't the admin or is the main query
  if( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  // Make sure this isn't the WooCommerce product search form
  if( isset($_GET['post_type']) && ($_GET['post_type'] == 'product') ) {
    return;
  }

  if( $query->is_search() ) {
    $in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

    // The post types you're removing (example: 'product' and 'page')
    $post_types_to_remove = array( 'product' );

    foreach( $post_types_to_remove as $post_type_to_remove ) {
      if( is_array( $in_search_post_types ) && in_array( $post_type_to_remove, $in_search_post_types ) ) {
        unset( $in_search_post_types[ $post_type_to_remove ] );
        $query->set( 'post_type', $in_search_post_types );
      }
    }
  }

}
add_action( 'pre_get_posts', 'flone_modify_search_query' );


// modify subcategory count html
add_filter('woocommerce_subcategory_count_html', '__return_false');

add_filter('woocommerce_after_output_product_categories', 'flone_after_output_product_categories');
function flone_after_output_product_categories($content){
	if(woocommerce_get_loop_display_mode() == 'both'){
		$row_class = 'row products columns-'.wc_get_loop_prop( 'columns' );
		$content .= '</div>';
		$content .= '<div class="'. esc_attr( $row_class ). '">';
	}
	?>
	<?php

	return $content;
}

// gallery image size option
add_filter( 'woocommerce_gallery_thumbnail_size', 'flone_woocommerce_single_gallery_thumbnail_size', 15);
function flone_woocommerce_single_gallery_thumbnail_size( $size ) {
	if( flone_get_option('gallery_thumbnail_size') ){
		return flone_get_option('gallery_thumbnail_size');
	}

	return $size;
}

// gravatar image size change
add_filter( 'woocommerce_review_gravatar_size', 'flone_woocommerce_review_gravatar_size');
function flone_woocommerce_review_gravatar_size( $size ){
	return '80';
}


// WCMC shortcode output modify
add_filter( 'pre_do_shortcode_tag', 'flone_modify_multicurrency_sc', 10, 4 );
function flone_modify_multicurrency_sc($output, $tag, $attr, $m){

	if($tag != 'WCMC'){
		return $output;
	}

	$current_url =APBD_current_url();
	$currencies=APBDWMC_general::GetModuleInstance()->getActiveCurrencies();
	$_default_mc_cur=APBDWMC_general::GetModuleInstance()->active_currency;
	ob_start();
	?>
	<div class="same-language-currency use-style">
		<a href="#"><?php echo esc_html(isset($_default_mc_cur->code) ? $_default_mc_cur->code : 'Currency'); ?>  <i class="fa fa-angle-down"></i></a>
		<div class="lang-car-dropdown" style="display: none;">
			<ul>
				<?php foreach($currencies as $currency):
					$currencyName = ! empty( $currencies_name[ $currency->code ] ) ? $currencies_name[ $currency->code ] : $currency->code;
				?>
				<li><a href="<?php echo $current_url; ?>?_amc-currency=<?php echo esc_attr($currency->code);?>" ><?php echo esc_html($currencyName); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php

	return ob_get_clean();
}