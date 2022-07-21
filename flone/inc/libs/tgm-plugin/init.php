<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Flone
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/libs/tgm-plugin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'flone_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function flone_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// load pre packaged plugin
		array(
			'name'               => 'Flone Core', // The plugin name.
			'slug'               => 'flone-core', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/inc/libs/tgm-plugin/plugins/flone-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Slider Revolution', // The plugin name.
			'slug'               => 'slider-revolution', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/inc/libs/tgm-plugin/plugins/slider-revolution.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '6.2.13', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		// Load wporg plugins
		array(
			'name'      => 'CMB2',
			'slug'      => 'cmb2',
			'required'  => false,
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => false,
		),
		array(
			'name'      => 'WooLentor – WooCommerce Elementor Addons + Builder',
			'slug'      => 'woolentor-addons',
			'required'  => false,
		),
		array(
			'name'      => 'HashBar',
			'slug'      => 'hashbar-wp-notification-bar',
			'required'  => false,
		),
		array(
			'name'      => 'HT Slider For Elementor',
			'slug'      => 'ht-slider-for-elementor',
			'required'  => false,
		),
		array(
			'name'      => 'MailChimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),
		array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => false,
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => 'WooCommerce Variation Swatches',
			'slug'      => 'woo-variation-swatches',
			'required'  => false,
		),
		array(
			'name'      => 'Multi Currency For WooCommerce',
			'slug'      => 'wc-multi-currency',
			'required'  => false,
		),
		array(
			'name'      => 'WP Plugin Manager – Deactivate plugins per page',
			'slug'      => 'wp-plugin-manager',
			'required'  => false,
		),
		array(
			'name'      => 'YITH WooCommerce Compare',
			'slug'      => 'yith-woocommerce-compare',
			'required'  => false,
		),
		array(
			'name'      => 'YITH WooCommerce Wishlist',
			'slug'      => 'yith-woocommerce-wishlist',
			'required'  => false,
		),
		array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'flone',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'return'                          => __( 'Return to Required Plugins Installer', 'flone' ),
		'plugin_activated'                => __( 'Plugin activated successfully.', 'flone' ),
		'activated_successfully'          => __( 'The following plugin was activated successfully:', 'flone' ),
	);

	tgmpa( $plugins, $config );
}
