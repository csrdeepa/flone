<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Map extends Widget_Base {

    public function get_name() {
        return 'flone_map';
    }
    
    public function get_title() {
        return __( 'Google Map', 'flone' );
    }

    public function get_icon() {
        return 'htmega-icon fa fa-clone';
    }
    public function get_categories() {
        return [ 'flone' ];
    }
    public function get_script_depends() {
        return [
            'google-map',
            'flone-widgets-active',
        ];
    }

	public function flone_content_fields(){
		$this->start_controls_section(
		    'content_section_1',
		    [
		        'label' => __( 'Content', 'flone' ),
		    ]
		);

		// lat_long
		$this->add_control(
		    'lat_long',
		    [
		        'label'   => __( 'Google Maps Latitude & Longitude', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'description'   => __('Google Maps Latitude & Longitude, e.g. 40.6700, -73.9400', 'flone'),
		        'default' => __('40.6700, -73.9400','flone'),
		    ]
		);

		// height
		$this->add_control(
		    'height',
		    [
		        'label' => __( 'Map Height', 'flone' ),
		        'type'  => Controls_Manager::SLIDER,
		        'range' => [
		        	'px' => [
		        		'min' => 0,
		        		'max' => 2000,
		        		'step' => 5,
		        	],
		        ],
		        'default' => [
		            'size' => 560,
		        ],
		        'selectors' => [
		        	'{{WRAPPER}} .contact-map #map' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);


		// scroll_wheel
		$this->add_control(
		    'scroll_wheel',
		    [
		        'label' => __( 'Enable Wheel Zoom', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'description'   => __(' Disable the zoom action when mouse wheel focus on maps.', 'flone'),
		        'default' => 'false',
		    ]
		);

		// zoom_level
		$this->add_control(
		    'zoom_level',
		    [
		        'label' => __( 'Zoom Level', 'flone' ),
		        'type'  => Controls_Manager::SLIDER,
		        'size_units' => '',
		        'range' => [
	                'min' => 1,
	                'max' => 100,
		        ],
		        'default' => [
		            'size' => 10,
		        ],
		    ]
		);

		// marker_lat_long
		$this->add_control(
		    'marker_lat_long',
		    [
		        'label'   => __( 'Marker Latitude & Longitude', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'description'   => __('Marker Latitude & Longitude, e.g. 40.6700, -73.9400', 'flone'),
		        'default' => __('40.6700, -73.9400','flone'),
		    ]
		);

		// marker_img_arr
		$this->add_control(
		    'marker_img_arr',
		    [
		        'label' => __( 'Marker Image', 'flone' ),
		        'type' => Controls_Manager::MEDIA,
		    ]
		);

		// style
		$this->add_control(
		    'style',
		    [
		        'label'   => __( 'Style', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]',
		        'description'	=> __( 'Go to <a href="https://snazzymaps.com/" target=_blank>Snazzy Maps</a> and Choose/Customize your Map Style. Click on your demo and copy JavaScript Style Array', 'flone' ),
		    ]
		);


    

	$this->end_controls_section(); // Content Fields End
}

protected function _register_controls() {

	$this->flone_content_fields();
}

protected function render( $instance = [] ) {

    $settings = $this->get_settings_for_display();
    $id = substr( $this->get_id_int(), 0, 3 );

    $marker_img_url = $settings['marker_img_arr']['url'] ? $settings['marker_img_arr']['url'] : '';

    $map_settings = array();
    $map_settings['lat_long'] = $settings['lat_long'];
    $map_settings['scroll_wheel'] = $settings['scroll_wheel'];
    $map_settings['zoom_level'] = $settings['zoom_level']['size'];
    $map_settings['marker_lat_long'] = $settings['marker_lat_long'];
    $map_settings['marker_img_url'] = $marker_img_url;
    $map_settings['style'] = $settings['style'];

    $map_settings = wp_json_encode($map_settings);

    ob_start(); ?>

    <div class="contact-map">
    	<?php if( function_exists('flone_get_option') && !flone_get_option('google_map_api_key', 'AIzaSyCGM-62ap9R-huo50hJDn05j3x-mU9151Y') ): ?>
			<div class="alert alert-danger" role="alert">
			  <?php echo esc_html__( 'Enter your Google Maps API from: Flone WP > Flone Options > General tab.', 'flone' ); ?>
			</div>
    	<?php endif; ?>
        <div id="map" data-settings='<?php echo $map_settings; ?>'></div>
    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Map() );