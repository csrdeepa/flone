<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Icon_With_Info extends Widget_Base {

    public function get_name() {
        return 'flone_icon_with_info';
    }
    
    public function get_title() {
        return __( 'Icon With Info', 'flone' );
    }

    public function get_icon() {
        return 'eicon-product-info';
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

		// icon
		$this->add_control(
		    'icon',
		    [
		        'label' => __( 'Icon', 'flone' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		        	'value' => 'fa fa-chevron-left',
		        	'library' => 'solid',
		        ],
		    ]
		);

		// text
		$this->add_control(
		    'text',
		    [
		        'label'   => __( 'Text', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('+012 345 678 102','flone'),
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

	// text_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'text_typography',
	        'label' => __( 'Text Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .single-contact-info .contact-info-dec p
	        '
	    ]
	);

	// text_color
	$this->add_control(
	    'text_color',
	    [
	        'label'     => __( 'Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-contact-info .contact-info-dec p' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	// icon_color
	$this->add_control(
	    'icon_color',
	    [
	        'label'     => __( 'Icon Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-contact-info .contact-icon i' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	// icon_bg_color
	$this->add_control(
	    'icon_bg_color',
	    [
	        'label'     => __( 'Icon Bg Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-contact-info .contact-icon i' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
	        ],
	    ]
	);

	// icon_hover_color
	$this->add_control(
	    'icon_hover_color',
	    [
	        'label'     => __( 'Icon Hover Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-contact-info:hover .contact-icon i' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	// icon_hover_bg_color
	$this->add_control(
	    'icon_hover_bg_color',
	    [
	        'label'     => __( 'Icon Bg Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-contact-info:hover .contact-icon i' => 'background-color: {{VALUE}};',
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

    <div class="single-contact-info">
    	
    	<?php if($settings['icon']): ?>
        <div class="contact-icon">
            <i class="<?php echo esc_attr($settings['icon']['value']); ?>"></i>
        </div>
    	<?php endif; ?>

        <div class="contact-info-dec">
            <p><?php echo wp_kses_post( $settings['text'] ) ?></p>
        </div>
    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Icon_With_Info() );