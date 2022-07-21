<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Counter extends Widget_Base {

    public function get_name() {
        return 'flone_counter';
    }
    
    public function get_title() {
        return __( 'Counter', 'flone' );
    }

    public function get_icon() {
        return 'eicon-counter';
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
		        'type'    => Controls_Manager::TEXT,
		        'default'   => __( 'Project Done', 'flone' ),
		    ]
		);

		// number
		$this->add_control(
		    'number',
		    [
		        'label'   => __( 'Number', 'flone' ),
		        'type'    => Controls_Manager::NUMBER,
		        'default'   => __( '360', 'flone' ),
		    ]
		);

		// icon
		$this->add_control(
		    'icon',
		    [
		        'label' =>esc_html__('Icon','flone'),
		        'type'=>Controls_Manager::ICONS,
		        'default' => [
		        	'value' => 'fas fa-pencil-alt',
		        	'library'	=> 'solid'
		        ]
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
	        	{{WRAPPER}} .single-count span
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
	            '{{WRAPPER}} .single-count span' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// number_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'number_typography',
	        'label' => __( 'Number Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .single-count h2
	        '
	    ]
	);

	// number_color
	$this->add_control(
	    'number_color',
	    [
	        'label'     => __( 'Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-count h2' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// icon_color
	$this->add_control(
	    'icon_color',
	    [
	        'label'     => __( 'Icon Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-count .count-icon i' => 'color: {{VALUE}};',
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

    <div class="single-count text-center mb-30">
        <div class="count-icon">
            <i class="<?php echo esc_attr( $settings['icon']['value'] ) ?>"></i>
        </div>
        <h2 class="count"><?php echo esc_html($settings['number']); ?></h2>
        <span><?php echo wp_kses_post($settings['title']); ?></span>
    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Counter() );