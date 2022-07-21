<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Countdown extends Widget_Base {

    public function get_name() {
        return 'flone_countdown';
    }
    
    public function get_title() {
        return __( 'Countdown', 'flone' );
    }

    public function get_icon() {
        return 'eicon-countdown';
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

		// title
		$this->add_control(
		    'title',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => __('Deal of the day','flone'),
		    ]
		);

		// due_date
		$this->add_control(
			'due_date',
			[
				'label' => __( 'Due Date', 'flone' ),
				'type' => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime'	=> false,
				]
			]
		);

		// custom_label
		$this->add_control(
            'custom_labels',
            [
                'label'        => __( 'Custom Label', 'flone' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'customlabel_days',
            [
                'label'       => __( 'Days', 'flone' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Days', 'flone' ),
                'condition'   => [
                    'custom_labels!'     => '',
                ],
            ]
        );

        $this->add_control(
            'customlabel_hours',
            [
                'label'       => __( 'Hours', 'flone' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Hours', 'flone' ),
                'condition'   => [
                    'custom_labels!'     => '',
                ],
            ]
        );

        $this->add_control(
            'customlabel_minutes',
            [
                'label'       => __( 'Minutes', 'flone' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Minutes', 'flone' ),
                'condition'   => [
                    'custom_labels!'     => '',
                ],
            ]
        );

        $this->add_control(
            'customlabel_seconds',
            [
                'label'       => __( 'Seconds', 'flone' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Seconds', 'flone' ),
                'condition'   => [
                    'custom_labels!'     => '',
                ],
            ]
        );

		// button_text
		$this->add_control(
		    'button_text',
		    [
		        'label'   => __( 'Button Text', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => __('Show Now','flone'),
		    ]
		);

		// button_link_arr
		$this->add_control(
			'button_link_arr',
			[
				'label' => __( 'Button Link', 'flone' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'flone' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => true,
				],
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
	// title_typograply
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'title_typography',
	        'label' => __( 'Title Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .funfact-content h2
	        '
	    ]
	);

	//  title_color
	$this->add_responsive_control(
	    'title_color',
	    [
	        'label'     => __( 'Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .funfact-content h2' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// counter_text_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'counter_text_typography',
	        'label' => __( 'Counter Text Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .funfact-content .timer p
	        '
	    ]
	);


	// counter_text_color
	$this->add_control(
	    'counter_text_color',
	    [
	        'label'     => __( 'Counter Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .funfact-content .timer p' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// counter_number_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'counter_number_typography',
	        'label' => __( 'Counter Number Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .funfact-content .timer span
	        '
	    ]
	);


	// counter_number_color
	$this->add_control(
	    'counter_number_color',
	    [
	        'label'     => __( 'Counter Number Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .funfact-content .timer span' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);



	// button
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'button_typography',
	        'label' => __( 'Button Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .funfact-content .funfact-btn a
	        ',
	    ]
	);
	$this->add_control(
	    'button_color',
	    [
	        'label'     => __( 'Button Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .funfact-content .funfact-btn a' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	$this->add_control(
	    'button_hover_color',
	    [
	        'label'     => __( 'Button Hover Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .funfact-content .funfact-btn a:hover' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	$this->add_control(
	    'button_bg_color',
	    [
	        'label'     => __( 'Button BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .funfact-content .funfact-btn a' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);
	$this->add_control(
	    'button_hover_bg_color',
	    [
	        'label'     => __( 'Button Hover BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .btn-hover a::after' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);
	$this->add_group_control(
	    Group_Control_Border::get_type(),
	    [
	        'name' => 'button_border',
	        'label' => __( 'Button Border', 'flone' ),
	        'selector' => '{{WRAPPER}} .funfact-content .funfact-btn a',
	    ]
	);
		$this->add_control(
			'button_border_radious',
			[
				'label' => __( 'Border Radius', 'flone' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .funfact-content .funfact-btn a,
					{{WRAPPER}} .btn-hover a::before,
					{{WRAPPER}} .btn-hover a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 	
	$this->add_responsive_control(
	    'button_padding',
	    [
	        'label' => __( 'Button Padding', 'flone' ),
	        'type' => Controls_Manager::DIMENSIONS,
	        'size_units' => [ 'px', '%', 'em' ],
	        'selectors' => [
	            '{{WRAPPER}} .funfact-content .funfact-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	        ],
	        'separator' => 'after',
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

    // link generate
    $target = $settings['button_link_arr']['is_external'] ? ' target="_blank"' : '';
    $nofollow = $settings['button_link_arr']['nofollow'] ? ' rel="nofollow"' : '';
    $link_html =  '<div class="funfact-btn btn-hover"><a href="' . esc_url($settings['button_link_arr']['url']) . '"' . $target . $nofollow . '>'. esc_html($settings['button_text']) .'</a></div>';

    // Custom Label
    $data_options['due_date'] = $settings['due_date'];
    $data_options['daytxt'] = ! empty( $settings['customlabel_days'] ) ? $settings['customlabel_days'] : 'Days';
    $data_options['hourtxt'] = ! empty( $settings['customlabel_hours'] ) ? $settings['customlabel_hours'] : 'Hours';
    $data_options['minutestxt'] = ! empty( $settings['customlabel_minutes'] ) ? $settings['customlabel_minutes'] : 'Minutes';
    $data_options['secondstxt'] = ! empty( $settings['customlabel_seconds'] ) ? $settings['customlabel_seconds'] : 'Seconds';
    ob_start();
    ?>

    <div class="funfact-content text-center">
        <h2><?php echo wp_kses_post($settings['title']); ?></h2>
        <div class="timer">
            <div data-countdown='<?php echo wp_json_encode( $data_options ); ?>'></div>
        </div>

        <?php echo wp_kses_post( $link_html ); ?>
    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Countdown() );