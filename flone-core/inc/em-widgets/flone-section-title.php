<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Section_Title extends Widget_Base {

    public function get_name() {
        return 'flone_section_title';
    }
    
    public function get_title() {
        return __( 'Section Title', 'flone' );
    }

    public function get_icon() {
        return 'eicon-site-title';
    }
    public function get_categories() {
        return [ 'flone' ];
    }

	public function flone_content_fields(){
		$this->start_controls_section(
		    'content_section_1',
		    [
		        'label' => __( 'Section Title', 'flone' ),
		    ]
		);
		$this->add_control(
		    'title',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('New Arrival','flone'),
		    ]
		);
		$this->add_control(
		    'desc',
		    [
		        'label' => __( 'Description', 'flone' ),
		        'type' => Controls_Manager::TEXTAREA,
		        'default' => __( 'Free shipping on all order', 'flone' ),
		    ]
		);
    

	$this->end_controls_section(); // Slider Option end
}


// style fields
public function flone_style_fields(){
	$this->start_controls_section(
	    'style_section_1',
	    [
	        'label' => __( 'Slider Stying Options', 'flone' ),
	        'tab' => Controls_Manager::TAB_STYLE,
	    ]
	);


	// title
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'title_typography',
	        'label' => __( 'Title Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .section-title-2 h2
	        '
	    ]
	);
	$this->add_control(
	    'title_color',
	    [
	        'label'     => __( 'Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .section-title-2 h2' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// desc
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'desc_typography',
	        'label' => __( 'Description Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .section-title-2 p
	        '
	    ]
	);
	$this->add_control(
	    'desc_color',
	    [
	        'label'     => __( 'Description Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .section-title-2 p' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

    // border
	$this->add_control(
        'border_color',
        [
            'label' => __( 'Border Color', 'flone' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .section-title-2 h2::before' => 'background-color: {{VALUE}};',
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

	<div class="section-title-2 text-center">
		<?php if($settings['title']): ?>
	    	<h2><?php echo wp_kses_post( $settings['title'] ); ?></h2>
		<?php endif; ?>

		<?php if($settings['desc']): ?>
	    	<p><?php echo wp_kses_post( $settings['desc'] ); ?></p>
		<?php endif; ?>
	</div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Section_Title() );