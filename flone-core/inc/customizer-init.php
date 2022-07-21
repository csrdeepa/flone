<?php

/*
* add custom uploader control to upload logo light
*/ 
function flone_additional_customizer_settings( $wp_customize ) {
	$wp_customize->add_setting( 'custom_logo_light', array(
		'theme_supports' => array( 'custom-logo' ),
		'transport'      => 'postMessage',
	) );

	$custom_logo_args = get_theme_support( 'custom-logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_light', array(
		'label'         => __( 'Logo Light', 'flone'  ),
		'section'       => 'title_tagline',
		'priority'      => 10,
		'button_labels' => array(
			'select'       => __( 'Select logo', 'flone' ),
			'change'       => __( 'Change logo', 'flone'  ),
			'remove'       => __( 'Remove', 'flone'  ),
			'default'      => __( 'Default', 'flone'  ),
			'placeholder'  => __( 'No logo selected', 'flone'  ),
			'frame_title'  => __( 'Select logo Light', 'flone'  ),
			'frame_button' => __( 'Choose logo Light', 'flone'  ),
		),
	) ) );
}
add_action( 'customize_register', 'flone_additional_customizer_settings' );


/*
* Elementor Icon Control modify
*/
function flone_modify_controls( $controls_registry ) {

  // Get existing icons
  $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );

  // Append new icons
  $new_icons = array_merge(
    array(
      'pe-7s-angle-left'=> 		__('Left Arrow', 'flone'),
      'pe-7s-angle-right'=> 	__('Right Arrow', 'flone'),
      'pe-7s-portfolio'=> 	__('pe-portfolio', 'flone'),
      'pe-7s-cup'=> 	__('pe-cup', 'flone'),
      'pe-7s-light'=> 	__('pe-light', 'flone'),
      'pe-7s-smile'=> 	__('pe-smile', 'flone'),
    ),
    $icons
  );

  // Then we set a new list of icons as the options of the icon control
  $controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
}
add_action( 'elementor/controls/controls_registered', 'flone_modify_controls', 10, 1 );