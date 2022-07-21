<?php

/**
* Load cmb2 tabs
*/
require_once FLONE_CORE_DIR . '/inc/metabox/cmb2-tabs/cmb2-tabs.class.php';


/**
* Start Meta fields
*/
add_filter( 'cmb2_init', 'flone_metaboxes' );
function flone_metaboxes() {
	$prefix = '_flone_';

	/**
	* Start Page options [tab]
	*/
	$page_metabox_options = array(
		'id'           		 => $prefix . 'page_options',
		'title'        		 => __( 'Page Options', 'flone' ),
		'object_types' 		 => array('post', 'page'),
		'context'      		 => 'normal',
		'priority'     		 => 'high',
		'show_names'         => true,
	);

	// Setup meta box
	$page_options = new_cmb2_box( $page_metabox_options );


	// Setting tabs
	$tabs_setting   = array(
		'config' 	=> $page_metabox_options,
		'layout' 	=> 'vertical', // Default : horizontal
		'tabs'  	=> array()
	);


	// Page Tab
	$tabs_setting['tabs'][] = array(
		'id'     => $prefix.'page',
		'title'  => __( 'Page', 'flone' ),
		'fields' => array(
			array(
				'name'    		=> __( 'Show Topbar', 'flone' ),
				'desc'    		=> __( 'Show / Hide topbar for this page', 'flone' ),
				'id'      		=> $prefix.'show_topbar',
				'type'    		=> 'radio_inline',
				'options' 		=> array(
					'default' 	=> __( 'Default', 'flone' ),
					'1' 		=> __( 'Show', 'flone' ),
					'0' 	=> __( 'Hide', 'flone' ),
				),
				'default' 		=> 'default',
			),
			array(
				'name'    		=> __( 'Topbar Width', 'flone' ),
				'id'      		=> $prefix.'topbar_width',
				'type'    		=> 'radio_inline',
				'options' 		=> array(
					'default' 	=> __( 'Default', 'flone' ),
					'normal' 	=> __( 'Normal', 'flone' ),
					'full' 		=> __( 'Full Width', 'flone' ),
				),
				'default' 		=> 'default',
			),
			array(
				'name'    		=> __( 'Header Width', 'flone' ),
				'id'      		=> $prefix.'header_width',
				'type'    		=> 'radio_inline',
				'options' 		=> array(
					'default' 	=> __( 'Default', 'flone' ),
					'normal' 		=> __( 'Normal', 'flone' ),
					'full' 		=> __( 'Full Width', 'flone' ),
				),
				'default' 		=> 'default',
			),
			array(
				'name'    		=> __( 'Show Breadcrumb', 'flone' ),
				'desc'    		=> __( 'Show / Hide breadcrumb for this page', 'flone' ),
				'id'      		=> $prefix.'show_breadcrumb',
				'type'    		=> 'radio_inline',
				'options' 		=> array(
					'default' 	=> __( 'Default', 'flone' ),
					'1' 		=> __( 'Show', 'flone' ),
					'0' 	=> __( 'Hide', 'flone' ),
				),
				'default' 		=> 'default',
			),
		)
	);

	// Set tabs
	$page_options->add_field( array(
		'id'   => $prefix.'page_tabs',
		'type' => 'tabs',
		'tabs' => $tabs_setting
	) );

}