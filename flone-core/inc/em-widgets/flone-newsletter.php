<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Newsletter extends Widget_Base {

    public function get_name() {
        return 'flone_newsletter';
    }
    
    public function get_title() {
        return __( 'Newsletter', 'flone' );
    }

    public function get_icon() {
        return 'eicon-email-field';
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

		$this->add_control(
		    'style',
		    [
		        'label' => __( 'Style', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '1',
		        'options' => [
		            '1'   => __( 'Style One', 'flone' ),
		            '2'   => __( 'Style Two', 'flone' ),
		        ],
		    ]
		);
		$this->add_control(
		    'title',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('Subscribe','flone'),
		    ]
		);
		$this->add_control(
		    'desc',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('Subscribe to our newsletter to receive news on update','flone'),
		    ]
		);
		$this->add_control(
		    'shortcode',
		    [
		        'label'   => __( 'Shortcode', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
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


	// title
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'title_typography',
	        'label' => __( 'Title Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .flone_newsletter h2
	        '
	    ]
	);

	// title_color
	$this->add_control(
	    'title_color',
	    [
	        'label'     => __( 'Desc Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .flone_newsletter h2' => 'color: {{VALUE}};',
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
	        	{{WRAPPER}} .flone_newsletter p
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
	            '{{WRAPPER}} .flone_newsletter p' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// email_text_color
	$this->add_control(
	    'email_text_color',
	    [
	        'label'     => __( 'Email Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .flone_newsletter .flone_subscribe_form input' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	// email_placeholder_color
	$this->add_control(
	    'email_placeholder_color',
	    [
	        'label'     => __( 'Email Placeholder Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .flone_newsletter .flone_subscribe_form input::placeholder' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .flone_newsletter .flone_subscribe_form input:-ms-input-placeholder' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .flone_newsletter .flone_subscribe_form input::-ms-input-placeholder' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	// email_border_color
	$this->add_control(
        'email_border_color',
        [
            'label' => __( 'Email Border Color', 'flone' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .flone_newsletter .flone_subscribe_form input' => 'border-bottom-color: {{VALUE}};',
            ],
            'separator' => 'after',
        ]
    );

	// submit_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'submit_typography',
	        'label' => __( 'Submit Button Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .subscribe-style-3 .subscribe-form-3 .clear-2 input
	        ',
	        'condition' => [
	            'style' => '2',
	        ],
	    ]
	);

	// submit_color
	$this->add_control(
	    'submit_color',
	    [
	        'label'     => __( 'Submit Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .subscribe-style-3 .subscribe-form-3 .clear-2 input' => 'color: {{VALUE}};',
	        ],
	        'condition' => [
	            'style' => '2',
	        ],
	    ]
	);

	// submit_bg_color
	$this->add_control(
	    'submit_bg_color',
	    [
	        'label'     => __( 'Submit BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .subscribe-style-3 .subscribe-form-3 .clear-2 input' => 'background-color: {{VALUE}};',
	        ],
	        'condition' => [
	            'style' => '2',
	        ],
	    ]
	);

	// submit_hover_color
	$this->add_control(
	    'submit_hover_color',
	    [
	        'label'     => __( 'Submit Hover Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .subscribe-style-3 .subscribe-form-3 .clear-2 input:hover' => 'color: {{VALUE}};',
	        ],
	        'condition' => [
	            'style' => '2',
	        ],
	    ]
	);

	// submit_hover_bg_color
	$this->add_control(
	    'submit_hover_bg_color',
	    [
	        'label'     => __( 'Submit Hover BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .subscribe-style-3 .subscribe-form-3 .clear-2 input:hover' => 'background-color: {{VALUE}};',
	        ],
	        'condition' => [
	            'style' => '2',
	        ],
	    ]
	);
	$this->add_control(
		'button_border_radious',
		[
			'label' => __( 'Border Radius', 'flone' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors' => [
				'{{WRAPPER}} .subscribe-style-3 .subscribe-form-3 .clear-2 input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

	<?php if($settings['style'] == '2'): ?>
		<div class="flone_newsletter subscribe-style-3 text-center">
            <h2><?php echo esc_attr( $settings['title'] ) ?> </h2>
            <p><?php echo esc_attr( $settings['desc'] ) ?></p>
            <div id="mc_embed_signup" class="subscribe-form-3 mt-35 flone_subscribe_form">
                <?php echo do_shortcode( $settings['shortcode'] ); ?>
            </div>
        </div>
	<?php else: ?>
    <div class="flone_newsletter subscribe-style-2 text-center">
    	<h2><?php echo esc_attr( $settings['title'] ) ?> </h2>
    	<p><?php echo esc_attr( $settings['desc'] ) ?></p>
        <div class="subscribe-form-2 flone_subscribe_form">
            <?php echo do_shortcode( $settings['shortcode'] ); ?>
        </div>
    </div>
	<?php endif; ?>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Newsletter() );