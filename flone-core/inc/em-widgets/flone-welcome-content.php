<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Welcome_Content extends Widget_Base {

    public function get_name() {
        return 'flone_welcome_content';
    }
    
    public function get_title() {
        return __( 'Welcome Content', 'flone' );
    }

    public function get_icon() {
        return ' eicon-post-content';
    }
    public function get_categories() {
        return [ 'flone' ];
    }

	public function flone_content_fields(){
		$this->start_controls_section(
		    'content_section_1',
		    [
		        'label' => __( 'Content', 'flone' ),
		    ]
		);

		// title
		$this->add_control(
		    'title',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('Welcome To Flone','flone'),
		    ]
		);

		// sub_title
		$this->add_control(
		    'sub_title',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('Who Are We','flone'),
		    ]
		);

		// desc
		$this->add_control(
		    'desc',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commo consequat irure','flone'),
		    ]
		);
    

	$this->end_controls_section(); // Content Fields End
}


// style fields
public function flone_style_fields(){
	$this->start_controls_section(
	    'style_section_1',
	    [
	        'label' => __( 'Stying Options', 'flone' ),
	        'tab' => Controls_Manager::TAB_STYLE,
	    ]
	);

	// title_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'title_typography',
	        'label' => __( 'Title Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .welcome-content h1
	        '
	    ]
	);

	// title_color
	$this->add_control(
	    'title_color',
	    [
	        'label'     => __( 'Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .welcome-content h1' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	// title_border_color
	$this->add_control(
	    'title_border_color',
	    [
	        'label'     => __( 'Title Border Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .welcome-content h1::before' => 'background-color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// sub_title_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'sub_title_typography',
	        'label' => __( 'Sub Title Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .welcome-content h5
	        '
	    ]
	);

	// sub_title_color
	$this->add_control(
	    'sub_title_color',
	    [
	        'label'     => __( 'Sub Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .welcome-content h5' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// desc_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'desc_typography',
	        'label' => __( 'Desc Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .welcome-content p
	        '
	    ]
	);

	// desc_color
	$this->add_control(
	    'desc_color',
	    [
	        'label'     => __( 'Desc Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .welcome-content p' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	

	$this->end_controls_section(); // title style section
}

protected function _register_controls() {

	$this->flone_content_fields();
	$this->flone_style_fields();
}

protected function render( $instance = [] ) {

    $settings = $this->get_settings_for_display();
    $id = substr( $this->get_id_int(), 0, 3 );
    ob_start(); ?>

    <div class="welcome-content text-center">
        <h5><?php echo esc_html($settings['sub_title']) ?></h5>
        <h1><?php echo esc_html($settings['title']) ?></h1>
        <p><?php echo esc_html($settings['desc']) ?></p>
    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Welcome_Content() );