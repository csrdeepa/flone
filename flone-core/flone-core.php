<?php
/**
 * Plugin Name: Flone Core
 * Plugin URI: https://hasthemes.com/
 * Description: After install the Flone WordPress Theme, you must need to install this "Flone Core Plugin" first to get all functions of flone Theme.
 * Version: 2.0.2
 * Author: codecarnival
 * Author URI: https://hasthemes.com/
 * Text Domain: flone
*/

// define path
defined( 'ABSPATH' ) or die( "No Direct Access" );
define( 'FLONE_CORE_URI', plugins_url('', __FILE__) );
define( 'FLONE_CORE_DIR', dirname( __FILE__ ) );
define( 'FLONE_CORE_LIBS_URI', plugins_url('inc/libs', __FILE__) );

/**
 * Load helper functions
 */
require FLONE_CORE_DIR . '/inc/helper-functions.php';

/**
 * Load megamenu
 */
require FLONE_CORE_DIR . '/inc/megamenu/megamenu-init.php';

/**
 * Load Currency
 */
require FLONE_CORE_DIR . '/inc/currency/init.php';

/**
 * Load metaboxes
 */
if( defined( 'CMB2_LOADED' ) ){
	require FLONE_CORE_DIR . '/inc/metabox/metabox-init.php';
}

/**
 * Load WordPress custom widgets
 */
require FLONE_CORE_DIR . '/inc/widgets/widget-recent-posts.php';
require FLONE_CORE_DIR . '/inc/widgets/widget-footer-logo.php';

/**
 * Load Customizer Controls
 */
require FLONE_CORE_DIR . '/inc/customizer-init.php';

/**
 * Load elementor addons
 */
require FLONE_CORE_DIR . '/inc/elementor-init.php';

/**
 * Load dynamic style generator
 */
add_action( 'plugins_loaded', 'flone_redux_dynamic_style_load' );
function flone_redux_dynamic_style_load(){
	if( class_exists('Redux') ){
		require FLONE_CORE_DIR . '/inc/redux-dynamic-style.php';
	}
}