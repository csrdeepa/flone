<?php
function flone_import_files() {

  return array(

    array(
      'import_file_name'           	 => esc_html__('Flone Fashion', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/fashion/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/fashion/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/fashion/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/fashion/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/fashion/fashion.jpg',
    ),

    array(
      'import_file_name'           	 => esc_html__('Flone Home Accessories', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/accessories/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/accessories/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/accessories/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/accessories/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/accessories/accessories.jpg',
    ),

    array(
      'import_file_name'           	 => esc_html__('Flone BookStore', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/bookstore/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/bookstore/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/bookstore/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/bookstore/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/bookstore/bookstore.jpg',
    ),

    array(
      'import_file_name'           	 => esc_html__('Flone Electronics', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/electronics/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/electronics/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/electronics/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/electronics/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/electronics/electronics.jpg',
    ),

    array(
      'import_file_name'           	 => esc_html__('Flone Festival', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/festival/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/festival/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/festival/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/festival/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/festival/festival.jpg',
    ),

    array(
      'import_file_name'           	 => esc_html__('Flone Food', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/food/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/food/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/food/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/food/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/food/food.jpg',
    ),

    array(
      'import_file_name'           	 => esc_html__('Medical Demo', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/medical/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/medical/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/medical/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/medical/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/medical/medical.jpg',
    ),

    array(
      'import_file_name'           	 => esc_html__('Flone Extra', 'flone'),
      'local_import_file'            => get_template_directory() . '/inc/importdata/extra/content.xml',
      'local_import_widget_file'     => get_template_directory() . '/inc/importdata/extra/widgets.wie',
      'local_import_customizer_file' => get_template_directory() . '/inc/importdata/extra/customizer.dat',
      'import_redux'                 => array(
          array(
              'file_url'    => get_template_directory_uri() . '/inc/importdata/extra/options.json',
              'option_name' => 'flone_opt',
          ),
      ),
      'import_preview_image_url'     => get_template_directory_uri().'/inc/importdata/extra/extra.jpg',
    )

  );

}
add_filter( 'pt-ocdi/import_files', 'flone_import_files' );


function flone_after_import_setup() {
	// set front page
	$front_page_id = get_page_by_title( 'Home' );
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );

	// set blog page
	$blog_page_id  = get_page_by_title( 'Blog Standard' );
	update_option( 'page_for_posts', $blog_page_id->ID );

	// set shop page
	$shop_page_id = get_page_by_title('shop');
	$shop_page_id = $shop_page_id ? $shop_page_id->ID : get_option( 'woocommerce_shop_page_id');
	update_option( 'woocommerce_shop_page_id', $shop_page_id);

	// set cart page
	$cart_page_id = get_page_by_title('cart');
	$cart_page_id = $cart_page_id ? $cart_page_id->ID : get_option( 'woocommerce_cart_page_id');
	update_option( 'woocommerce_cart_page_id', $cart_page_id);

	// set chekcout page
	$checkout_page_id = get_page_by_title('checkout');
	$checkout_page_id = $checkout_page_id ? $checkout_page_id->ID : get_option( 'woocommerce_checkout_page_id');
	update_option( 'woocommerce_checkout_page_id', $checkout_page_id);

	// set myaccount page
	$account_page_id = get_page_by_title('my account ');
	$account_page_id = $account_page_id ? $account_page_id->ID : get_option( 'woocommerce_myaccount_page_id');
	update_option( 'woocommerce_myaccount_page_id', $account_page_id);

	// set wishlist page
	$wishlist_page_id = get_page_by_title('wishlist');
	$wishlist_page_id = $wishlist_page_id ? $wishlist_page_id->ID : get_option( 'yith_wcwl_wishlist_page_id');
	update_option( 'yith_wcwl_wishlist_page_id', $wishlist_page_id);

	// assign quick menu location
	$primary_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$extra_header_menu = get_term_by( 'name', 'Extra Header Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations' , array( 
			'menu-1' => $primary_menu->term_id,
			'extra-header-menu' => $extra_header_menu->term_id,
		)
	);

	// disable elementor color
	update_option('elementor_disable_color_schemes', 'yes');

	// disable elementor font
	update_option('elementor_disable_typography_schemes', 'yes');

	// set content width
	update_option('elementor_container_width', '1170');

	// set widget space
	update_option('elementor_space_between_widgets', '30');

	// set tablet breakpoint
	update_option('elementor_viewport_lg', '992');

	// disable lightbox
	update_option('elementor_global_image_lightbox', '');
    
    flush_rewrite_rules();
}
add_action( 'pt-ocdi/after_import', 'flone_after_import_setup' );


function flone_admin_footer(){
	$license_notice_text = '<p>In order to import the theme demo, you have to activate the theme license. Please go <a target="_blank" href="'.  esc_url(admin_url( 'admin.php?page=flone')) .'">Here</a> and active your theme license. <br> <br>If you don\'t know where to get the license/purchase key please follow <a href="//hasthemes.com/how-to-get-the-purchase-code/" target="_blank">This</a> article.</p>';
	?>
	<div id="di_license_notice" style="display:none">
		<?php echo wp_kses_post($license_notice_text); ?>
	</div>
	<?php
}
add_action( 'admin_footer', 'flone_admin_footer' );