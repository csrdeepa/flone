<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Brands extends Widget_Base {

    public function get_name() {
        return 'flone_brands';
    }
    
    public function get_title() {
        return __( 'Brands', 'flone' );
    }

    public function get_icon() {
        return 'eicon-media-carousel';
    }
    public function get_categories() {
        return [ 'flone' ];
    }
    public function get_script_depends() {
        return [
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
		$this->add_control(
			'image_list',
			[
				'label' => __( 'Add Images', 'flone' ),
				'type' => Controls_Manager::GALLERY,
			]
		);
		$this->end_controls_section(); // Content Fields End


		// carousel settings
		$this->start_controls_section(
		    'content_section_2',
		    [
		        'label' => __( 'Slider Settings', 'flone' ),
		    ]
		);

		$this->add_control(
		    'autoplay',
		    [
		        'label' => __( 'Enable Auto Play', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'separator' => 'before',
		        'default' => 'false',
		    ]
		);

		$this->add_control(
		    'autoplay_timeout',
		    [
		        'label' => __('Autoplay speed', 'flone'),
		        'type' => Controls_Manager::NUMBER,
		        'default' => 5000,
		        'condition' => [
		            'autoplay' => 'true',
		        ]
		    ]
		);

		$this->add_control(
		    'loop',
		    [
		        'label' => __( 'Loop', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'default' => 'false',
		    ]
		);
		// columns_on_desktop
		$this->add_control(
		    'columns_on_desktop',
		    [
		        'label' => __( 'Columns On Desktop', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '4',
		        'options' => [
		            '1'		=> __( 'One Column', 'flone' ),
		            '2'		=> __( 'Two Column', 'flone' ),
		            '3'		=> __( 'Three Column', 'flone' ),
		            '4'		=> __( 'Four Column', 'flone' ),
		            '5'		=> __( 'Five Column', 'flone' ),
		        ],
		    ]
		);

		// columns_on_tablet
		$this->add_control(
		    'columns_on_tablet',
		    [
		        'label' => __( 'Columns On Tablet', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '2',
		        'options' => [
		            '1'		=> __( 'One Column', 'flone' ),
		            '2'		=> __( 'Two Column', 'flone' ),
		            '3'		=> __( 'Three Column', 'flone' ),
		            '4'		=> __( 'Four Column', 'flone' ),
		            '5'		=> __( 'Five Column', 'flone' ),
		        ],
		    ]
		);

		// columns_on_mobile
		$this->add_control(
		    'columns_on_mobile',
		    [
		        'label' => __( 'Columns On Mobile', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '2',
		        'options' => [
		            '1'		=> __( 'One Column', 'flone' ),
		            '2'		=> __( 'Two Column', 'flone' ),
		            '3'		=> __( 'Three Column', 'flone' ),
		            '4'		=> __( 'Four Column', 'flone' ),
		            '5'		=> __( 'Five Column', 'flone' ),
		        ],
		    ]
		);
		// section 2 end
    

	$this->end_controls_section(); // Content Fields End
}


protected function _register_controls() {

	$this->flone_content_fields();
}

protected function render( $instance = [] ) {

    $settings = $this->get_settings_for_display();
    $id = substr( $this->get_id_int(), 0, 3 );

    // owl options
    $owl_settings = array();
    $owl_settings['autoplay'] = $settings['autoplay'];
    $owl_settings['autoplay_timeout'] = $settings['autoplay_timeout'];
    $owl_settings['loop'] = $settings['loop'];
    $owl_settings['columns_on_desktop'] = $settings['columns_on_desktop'];
    $owl_settings['columns_on_tablet'] = $settings['columns_on_tablet'];
    $owl_settings['columns_on_mobile'] = $settings['columns_on_mobile'];

    $owl_settings = wp_json_encode($owl_settings);
    ob_start(); ?>

    <div class="brand-logo-active owl-carousel" data-settings="<?php echo esc_attr( $owl_settings ) ?>">

    	<?php foreach($settings['image_list'] as $image_arr): ?>
        <div class="single-brand-logo">
            <?php echo wp_get_attachment_image( $image_arr['id'], 'large'); ?>
        </div>
    	<?php endforeach; ?>

    </div>


    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Brands() );