<?php

/**
 * Load Elementor widgets
 */
add_action('elementor/widgets/widgets_registered','flone_register_addons');
function flone_register_addons(){
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-slider.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-service.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-section-title.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-blog.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-banner.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-newsletter.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-welcome-content.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-instagram.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-testimonial.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-brands.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-countdown.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-counter.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-team.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-map.php' );
    include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-icon-with-info.php' );
    if(class_exists('WooCommerce')){
    	include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-products.php' );
    	include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-masonary-products.php' );
    	include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-tabbed-products.php' );
    	include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-tabbed-products-2.php' );
    	include_once( FLONE_CORE_DIR. '/inc/em-widgets/flone-product-categories.php' );
    }
}

/**
 * Elementor Custom Category
 */
add_action( 'elementor/elements/categories_registered', 'flone_elementor_category' );
function flone_elementor_category ( $elements_manager ) {
    $elements_manager->add_category(
        'flone',
        array(
            'title' => 'Flone',
            'icon'  => 'fonts',
        )
    );
}

/**
 * Add pe7 icon css to elementor editor
 */
add_action( 'elementor/editor/before_enqueue_scripts', 'flone_elementor_add_custom_icon_css' );
function flone_elementor_add_custom_icon_css() {
    wp_enqueue_style( 'pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css' );
}

/**
 * register google map and widget active script
 */
add_action( 'elementor/frontend/after_register_scripts', 'flone_register_frontend_scripts');
function flone_register_frontend_scripts(){
	if(function_exists('flone_get_option')){
		$map_api_key = flone_get_option('google_map_api_key', 'AIzaSyCGM-62ap9R-huo50hJDn05j3x-mU9151Y');
		wp_register_script( 'google-map', '//maps.googleapis.com/maps/api/js?key='. $map_api_key, array('jquery'), '' );
		wp_register_script( 'flone-widgets-active', FLONE_CORE_URI . '/js/widgets-active.js', array('jquery'), '1.0.0', true );
	}
}


/*
 * Get product id list
 * return array
 */
function flone_get_products(){
	$options = array();
	$args = array(
		'post_type' => 'product',
		'posts_per_page'	=> -1
	);

	$query = new \WP_Query($args);

	while($query->have_posts()){
		$query->the_post();
		$options[get_the_id()] = get_the_title() . ' #'. get_the_id();
	}

	wp_reset_postdata();

	return $options;
}

/*
 * Get Taxonomy
 * return array
 */
function flone_get_taxonomies( $taxonomy = 'category'){
    $terms = get_terms( array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ));
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $options[ $term->slug ] = $term->name;
        }
        return $options;
    }
}