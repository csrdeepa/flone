<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Slider extends Widget_Base {
	public function get_name() {
	    return 'flone_slider';
	}
	public function get_title() {
	    return __( 'Slider', 'flone' );
	}

	public function get_icon() {
	    return 'eicon-post-slider';
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
		        'label' => __( 'Slider Content', 'flone' ),
		    ]
		);

			$this->add_responsive_control(
			    'height',
			    [
			        'label'   => __( 'Slider Height', 'flone' ),
			        'type'    => Controls_Manager::SLIDER,
			        'range' => [
			        	'px' => [
			        		'min' => 0,
			        		'max' => 1000,
			        		'step' => 5,
			        	],
			        ],
			        'default' => [
			        	'unit' => 'px',
			        	'size' => 850,
			        ],
			        'selectors' => [
			            '{{WRAPPER}} .flone_slider_1' => 'height: {{SIZE}}{{UNIT}};',
			            '{{WRAPPER}} .flone_slider_2' => 'height: {{SIZE}}{{UNIT}};',
			            '{{WRAPPER}} .flone_slider_5' => 'height: {{SIZE}}{{UNIT}};',
			            '{{WRAPPER}} .flone_slider_8' => 'height: {{SIZE}}{{UNIT}};'
			        ],
			    ]
			);

		    $repeater = new Repeater();
		    $repeater->add_control(
		        'style',
		        [
		            'label' => __( 'Style', 'flone' ),
		            'type' => Controls_Manager::SELECT,
		            'default' => '1',
		            'options' => [
		                '1'   => __( 'Style One', 'flone' ),
		                '2'   => __( 'Style Two', 'flone' ),
		                '3'   => __( 'Style Three', 'flone' ),
		                '4'   => __( 'Style Four', 'flone' ),
		                '5'   => __( 'Style Five', 'flone' ),
		                '6'   => __( 'Style Six', 'flone' ),
		                '7'   => __( 'Style Seven', 'flone' ),
		                '8'   => __( 'Style Eight', 'flone' ),
		                '9'   => __( 'Style Nine', 'flone' ),
		                '10'   => __( 'Style Ten', 'flone' ),
		                '11'   => __( 'Style Eleven', 'flone' ),
		            ],
		            'description'	=>	__('Use Same Style For All Slides', 'flone')
		        ]
		    );
		    $repeater->add_control(
		        'image_arr',
		        [
		            'label' => __( 'Image', 'flone' ),
		            'type' => Controls_Manager::MEDIA,
		        ]
		    );
		    $repeater->add_group_control(
		        Group_Control_Image_Size::get_type(),
		        [
		            'name' => 'image_size',
		            'default' => 'large',
		            'separator' => 'none',
		        ]
		    );
		    $repeater->add_control(
		        'title',
		        [
		            'label'   => __( 'Title', 'flone' ),
		            'type'    => Controls_Manager::TEXTAREA,
		            'placeholder' => __('Summer Offer','flone'),
		        ]
		    );
		    $repeater->add_control(
		        'sub_logo',
		        [
		            'label'   => __( 'Left Image', 'flone' ),
		            'type'    => Controls_Manager::MEDIA,
		            'condition' => [
		                'style' => '11',
		            ],
		        ]
		    );

		    $repeater->add_control(
		        'sub_title',
		        [
		            'label'   => __( 'Sub Title', 'flone' ),
		            'type'    => Controls_Manager::TEXTAREA,
		            'placeholder' => __('Summer Offer','flone'),
		            'condition' => [
		                'style' => array( '1','2','3', '4', '5', '7','8','9','10' ),
		            ],
		        ]
		    );
		    $repeater->add_control(
		        'sub_title_2',
		        [
		            'label'   => __( 'Sub Title 2', 'flone' ),
		            'type'    => Controls_Manager::TEXTAREA,
		            'placeholder' => __('30% off Summer Vacation','flone'),
		            'condition' => [
		                'style' => array( '3', '4', '5', '7','10' ),
		            ],
		        ]
		    );

		    // price
		    $repeater->add_control(
		        'price_label',
		        [
		            'label'   => __( 'Price Label', 'flone' ),
		            'type'    => Controls_Manager::TEXT,
		            'default' => __('Sale','flone'),
		            'condition' => [
		                'style' => array( '4' ),
		            ],
		        ]
		    );
		    $repeater->add_control(
		        'price',
		        [
		            'label'   => __( 'Price', 'flone' ),
		            'type'    => Controls_Manager::TEXT,
		            'default' => __('$99.00','flone'),
		            'condition' => [
		                'style' => array( '4' ),
		            ],
		        ]
		    );
		    $repeater->add_control(
		        'price_shape_bg_arr',
    			[
    				'label' => __( 'Price Shape BG', 'flone' ),
    				'type' => Controls_Manager::MEDIA,
    				'default' => [
    					'url' => Utils::get_placeholder_image_src(),
    				],
    				'description'	=>	__('Recommended Size Is: 130x126 px', 'flone'),
    				'condition' => [
    				    'style' => array( '4' ),
    				],
    			]
		    );


		    $repeater->add_control(
		        'btn_text',
		        [
		            'label'   => __( 'Button Text', 'flone' ),
		            'type'    => Controls_Manager::TEXT,
		            'default' => __('SHOP NOW','flone'),
		        ]
		    );
		    $repeater->add_control(
		    	'btn_link',
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

		    $this->add_control(
		        'slider_list',
    			[
    				'label' => __( 'Slide List', 'flone' ),
    				'type' => Controls_Manager::REPEATER,
    				'fields' => $repeater->get_controls(),
    				'default' => [
    					[
    						'title' => __( 'Title #1', 'flone' ),
    						'sub_title' => __( 'Sub Title', 'flone' ),
    					],
    					[
    						'title' => __( 'Title #2', 'flone' ),
    						'sub_title' => __( 'Sub Title 2', 'flone' ),
    					],
    				],
    				'title_field' => '{{{ title }}}',
    			]
		    );

		$this->end_controls_section();


		$this->start_controls_section(
		    'content_section_2',
		    [
		        'label' => __( 'Slider Options', 'flone' ),
		    ]
		);

		$this->add_control(
		    'autoplay',
		    [
		        'label' => __( 'Slider Auto Play', 'flone' ),
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

		$this->add_control(
		    'dots',
		    [
		        'label' => __( 'Slider Dots', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'default' => 'false',
		    ]
		);

		$this->add_control(
		    'nav',
		    [
		        'label' => __( 'Slider Arrow', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'default' => 'false',
		    ]
		);
		$this->add_control(
		    'nav_style',
		    [
		    	'label'   => __( 'Arrow Style', 'flone' ),
		    	'type'    => Controls_Manager::SELECT,
		    	'default' => '1',
		    	'options' => [
		    	    '1'    => __( 'Style 1', 'flone' ),
		    	    '2' => __( 'Style 2', 'flone' ),
		    	    '3' => __( 'Style 3', 'flone' ),
		    	],
		    	'condition' => [
		    	    'nav' => 'true',
		    	],
		    ]
		);
		$this->add_control(
		    'prev_icon',
		    [
		        'label' => __( 'Previous Icon', 'flone' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		        	'value' => 'pe-7s-angle-left angle_left',
		        	'library'	=> 'regular'
		        ],
		        'condition' => [
		            'nav' => 'true',
		        ],
		    ]
		);

		$this->add_control(
		    'next_icon',
		    [
		        'label' => __( 'Next Icon', 'flone' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		        	'value' => 'pe-7s-angle-right angle_right',
		        	'library'	=> 'regular'
		        ],
		        'condition' => [
		            'nav' => 'true',
		        ]
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

		$this->add_responsive_control(
		    'slide_bg_color',
		    [
		        'label'     => __( 'Slide BG Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider.slider-height-1.bg-purple.flone_slider_1' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .single-slider-2.slider-height-1.d-flex.align-items-center.slider-height-res.bg-img.flone_slider_2' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .single-slider.single-slider-10.slider-height-8.bg-aqua.flone_slider_9' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-area .flone_slider_8.slider-height-7' => 'background-color: {{VALUE}};'
		        ],
		        'separator' => 'after',
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
		        	{{WRAPPER}} .slider-content h1,
		        	{{WRAPPER}} .slider-content-2 h1,
		        	{{WRAPPER}} .slider-content-3 h1,
		        	{{WRAPPER}} .slider-content-5 h1,
		        	{{WRAPPER}} .slider-content-6 h1,
		        	{{WRAPPER}} .slider-content-7 h1
		        '
		    ]
		);
		$this->add_responsive_control(
		    'title_color',
		    [
		        'label'     => __( 'Title Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content h1' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 h1' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 h1' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 h1' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 h1' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 h1' => 'color: {{VALUE}};',
		        ],
		        'separator' => 'after',
		        
		    ]
		);
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Title Margin', 'flone' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content h1,
		        	{{WRAPPER}} .slider-content-2 h1,
		        	{{WRAPPER}} .slider-content-3 h1,
		        	{{WRAPPER}} .slider-content-5 h1,
		        	{{WRAPPER}} .slider-content-6 h1,
		        	{{WRAPPER}} .slider-content-7 h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',

            ]
        ); 
		// subtitle
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'sub_title_typography',
		        'label' => __( 'Sub Title Typography', 'flone' ),
		        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
		        'selector' => '
		        	{{WRAPPER}} .single-slider .slider-content h3,
		        	{{WRAPPER}} .slider-content-2 h3,
		        	{{WRAPPER}} .slider-content-3 h3,
		        	{{WRAPPER}} .slider-content-5 h3,
		        	{{WRAPPER}} .slider-content-6 p,
		        	{{WRAPPER}} .slider-content-7 h3
		        ',
		    ]
		);
		$this->add_responsive_control(
		    'sub_title_color',
		    [
		        'label'     => __( 'Sub Title Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content h3' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 h3' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 h3' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 h3' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 p' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 h3' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 h3::before' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 h3::before' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 h3::after' => 'background-color: {{VALUE}};',
		        ],
		        'separator' => 'after',
		    ]
		);
        $this->add_responsive_control(
            'sub_title_padding',
            [
                'label' => __( 'Subtitle Padding', 'flone' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slider-content-2 h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        ); 
		$this->add_responsive_control(
			'sub_title_border_width',
			[
				'label' => __( 'Subtitle Border Width', 'flone' ),
				'type' => Controls_Manager::NUMBER,
				'min' => '',
				'max' => 500,
				'step' => 1,
				'default' => 120,
				'selectors' => [
					'{{WRAPPER}} .slider-content-2 h3::before' => 'width: {{VALUE}}px;',
				],
			]
		);

		// subtitle 2
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'sub_title_2_typography',
		        'label' => __( 'Sub Title 2 Typography', 'flone' ),
		        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
		        'selector' => '
		        	{{WRAPPER}} .slider-content-3 p,
		        	{{WRAPPER}} .slider-content-5 p,
		        	{{WRAPPER}} .slider-animated-1 p',
		    ]
		);
		$this->add_responsive_control(
		    'sub_title_2_color',
		    [
		        'label'     => __( 'Sub Title 2 Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .slider-content-3 p,
		            {{WRAPPER}} .slider-content-5 p,
		            {{WRAPPER}} .slider-animated-1 p' => 'color: {{VALUE}};',
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
		        	{{WRAPPER}} .single-slider .slider-content .slider-btn a,
		        	{{WRAPPER}} .slider-content-2 .slider-btn a,
		        	{{WRAPPER}} .slider-content-3 .slider-btn a,
		        	{{WRAPPER}} .slider-content-5 .slider-btn-5 a,
		        	{{WRAPPER}} .slider-content-6 .slider-btn-5 a,
		        	{{WRAPPER}} .slider-content-7 .slider-btn-9 a
		        ',
		    ]
		);
		$this->add_responsive_control(
			'button_border_radious',
			[
				'label' => __( 'Border Radius', 'flone' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .single-slider .slider-content .slider-btn a,
		        	{{WRAPPER}} .slider-content-2 .slider-btn a,
		        	{{WRAPPER}} .slider-content-3 .slider-btn a,
		        	{{WRAPPER}} .slider-content-5 .slider-btn-5 a,
		        	{{WRAPPER}} .slider-content-6 .slider-btn-5 a,
		        	{{WRAPPER}} .slider-content-7 .slider-btn-9 a,
		        	{{WRAPPER}} .btn-hover a::before,
		        	{{WRAPPER}} .btn-hover a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		); 
	$this->add_responsive_control(
	    'button_padding_readmore',
	    [
	        'label' => __( 'Button Padding', 'flone' ),
	        'type' => Controls_Manager::DIMENSIONS,
	        'size_units' => [ 'px', '%', 'em' ],
	        'selectors' => [
	            '{{WRAPPER}} .single-slider .slider-content .slider-btn a,
		        	{{WRAPPER}} .slider-content-2 .slider-btn a,
		        	{{WRAPPER}} .slider-content-3 .slider-btn a,
		        	{{WRAPPER}} .slider-content-5 .slider-btn-5 a,
		        	{{WRAPPER}} .slider-content-6 .slider-btn-5 a,
		        	{{WRAPPER}} .slider-content-7 .slider-btn-9 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	        ],
	        'separator' => 'after',
	    ]
	);				
		$this->add_control(
		    'button_color',
		    [
		        'label'     => __( 'Button Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content .slider-btn a' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 .slider-btn a' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 .slider-btn a' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 .slider-btn-5 a' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 .slider-btn-5 a' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 .slider-btn-9 a' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'button_hover_color',
		    [
		        'label'     => __( 'Button Hover Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content .slider-btn a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 .slider-btn a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 .slider-btn a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 .slider-btn-5 a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 .slider-btn-5 a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 .slider-btn-9 a:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'flone_button_border_color',
		    [
		        'label'     => __( 'Button Border Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content .slider-btn a' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 .slider-btn a' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 .slider-btn a' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 .slider-btn-5 a' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 .slider-btn-5 a' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 .slider-btn-9 a' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'flone_button_border_hover_color',
		    [
		        'label'     => __( 'Button Border Hover Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content .slider-btn a:hover' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 .slider-btn a:hover' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 .slider-btn a:hover' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 .slider-btn-5 a:hover' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 .slider-btn-5 a:hover' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 .slider-btn-9 a:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'button_bg_color',
		    [
		        'label'     => __( 'Button BG Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content .slider-btn a' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 .slider-btn a' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 .slider-btn a' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 .slider-btn-5 a' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 .slider-btn-5 a' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 .slider-btn-9 a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'button_hover_bg_color',
		    [
		        'label'     => __( 'Button Hover BG Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .btn-hover a::after' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-2 .slider-btn a::after' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-3 .slider-btn a::after' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-5 .slider-btn-5 a::after' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-6 .slider-btn-5 a::after' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .slider-content-7 .slider-btn-9 a::after' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'label' => __( 'Button Border', 'flone' ),
		        'selector' => '{{WRAPPER}} .single-slider .slider-content .slider-btn a',
		        'selector' => '{{WRAPPER}} .slider-content-2 .slider-btn a',
		        'selector' => '{{WRAPPER}} .slider-content-3 .slider-btn a',
		        'selector' => '{{WRAPPER}} .slider-content-5 .slider-btn-5 a',
		        'selector' => '{{WRAPPER}} .slider-content-6 .slider-btn-5 a',
		        'selector' => '{{WRAPPER}} .slider-content-7 .slider-btn-9 a',
		    ]
		);
		$this->add_responsive_control(
		    'button_padding',
		    [
		        'label' => __( 'Button Padding', 'flone' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content .slider-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .slider-content-2 .slider-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .slider-content-3 .slider-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .slider-content-5 .slider-btn-5 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .slider-content-6 .slider-btn-5 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .slider-content-7 .slider-btn-9 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'separator' => 'after',
		    ]
		);
		$this->add_responsive_control(
		    'button_margin_slider',
		    [
		        'label' => __( 'Button Margin', 'flone' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .single-slider .slider-content .slider-btn a,
		            {{WRAPPER}} .slider-content-2 .slider-btn a,
		            {{WRAPPER}} .slider-content-3 .slider-btn a,
		            {{WRAPPER}} .slider-content-5 .slider-btn-5 a,
		            {{WRAPPER}} .slider-content-6 .slider-btn-5 a,
		            {{WRAPPER}} .slider-content-7 .slider-btn-9 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'separator' => 'after',
		    ]
		);		
		$this->add_control(
		    'price_text_color',
		    [
		        'label'     => __( 'Price Text Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-price-wrap .single-price span' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		// price
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'price_typography',
		        'label' => __( 'Price Text Typography', 'flone' ),
		        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
		        'selector' => '
		        	{{WRAPPER}} .single-price-wrap .single-price span
		        ',
		    ]
		);
		$this->add_responsive_control(
		    'price_position_right',
		    [
		        'label' => __( 'Price Position From Right.', 'flone' ),
		        'type'  => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -24,
		                'max' => 1100,
		            ],
		        ],
		        'default' => [
		            'size' => -24,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .single-slider-img4 .single-price-wrap' => 'right: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'price_position_top',
		    [
		        'label' => __( 'Price Position From Top.', 'flone' ),
		        'type'  => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 1100,
		            ],
		        ],
		        'default' => [
		            'size' => 0,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .single-slider-img4 .single-price-wrap' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'after',
		    ]
		);

		// arrow
		$this->add_responsive_control(
		    'arrow_color',
		    [
		        'label'     => __( 'Arrow Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .owl-carousel .owl-nav div' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'arrow_bg_color',
		    [
		        'label'     => __( 'Arrow BG Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .owl-carousel .owl-nav div' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'arrow_hover_color',
		    [
		        'label'     => __( 'Arrow Hover Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .owl-carousel .owl-nav div:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'arrow_hover_bg_color',
		    [
		        'label'     => __( 'Arrow Hover BG Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .owl-carousel .owl-nav div:hover' => 'background-color: {{VALUE}};',
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

	    // owl options
	    $owl_options = array();
	    $owl_options['autoplay'] = $settings['autoplay'];
	    $owl_options['autoplay_timeout'] = $settings['autoplay_timeout'];
	    $owl_options['nav'] = $settings['nav'];
	    $owl_options['dots'] = $settings['dots'];
	    $owl_options['loop'] = $settings['loop'];
	    $owl_options['prev_icon'] = (isset($settings['prev_icon']['value']) ? $settings['prev_icon']['value'] : '');
	    $owl_options['next_icon'] = (isset($settings['next_icon']['value']) ? $settings['next_icon']['value'] : '');

	    $owl_options = wp_json_encode($owl_options);
	    ob_start(); ?>

		<div class="slider-area">
		    <div class="slider-active owl-carousel owl-dot-style nav-style-<?php echo esc_attr($settings['nav_style']); ?>" data-settings='<?php echo $owl_options; ?>'>
				<?php
					foreach (  $settings['slider_list'] as $item ) :
						// link generate
						$target = $item['btn_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $item['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
						$link_html =  '<a class="animated" href="' . esc_url($item['btn_link']['url']) . '"' . $target . $nofollow . '> '. $item['btn_text'] .' </a>';

						if( $item['style'] == '1' ):
				?>
		        <div class="single-slider slider-height-1 bg-purple flone_slider_<?php echo esc_attr( $item['style'] ); ?>">
		            <div class="container">
		                <div class="row">
		                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
		                        <div class="slider-content slider-animated-1">
		                            <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
		                            <h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>

		                            <?php if( $item['btn_link']['url'] ): ?>
		                            <div class="slider-btn btn-hover">
		                                <?php echo wp_kses_post($link_html); ?>
		                            </div>
		                       		 <?php endif; ?>

		                        </div>
		                    </div>
		                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
		                        <div class="slider-single-img slider-animated-1">
		                            <?php echo wp_get_attachment_image( $item['image_arr']['id'], $item['image_size_size'], null,  array( 'class' => 'animated') ); ?>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <?php elseif( $item['style'] == '2' ): ?>
		        	<div class="single-slider-2 slider-height-1 d-flex align-items-center slider-height-res bg-img flone_slider_<?php echo esc_attr( $item['style'] ); ?>" style="background-image:url(<?php echo esc_url( $item['image_arr']['url'] ) ?>);">
		        	    <div class="container">
		        	        <div class="row">
		        	            <div class="col-xl-6 col-lg-6 col-md-7 ml-auto">
		        	                <div class="slider-content-2 slider-animated-1">
		        	                	<?php if($item['sub_title']): ?>
		        	                    <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
		        	                	<?php endif; ?>

		        	                    <h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>

	        	                         <?php if( $item['btn_link']['url'] ): ?>
	        	                         <div class="slider-btn btn-hover">
	        	                             <?php echo wp_kses_post($link_html); ?>
	        	                         </div>
	        	                    	<?php endif; ?>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>

		        <?php elseif( $item['style'] == '3' ): ?>
		        	<div class="single-slider-2 slider-height-2 d-flex align-items-center bg-img flone_slider_<?php echo esc_attr( $item['style'] ); ?>" style="background-image:url(<?php echo esc_url( $item['image_arr']['url'] ) ?>);">
		        	    <div class="container">
		        	        <div class="row">
		        	            <div class="col-xl-6 col-lg-7 col-md-8 col-12 ml-auto">
		        	                <div class="slider-content-3 slider-animated-1 text-center">
		        	                 	<?php if($item['sub_title']): ?>
		        	                     <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
		        	                 	<?php endif; ?>
										
		        	                 	<h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>
		        	                 	<p class="animated"><?php echo wp_kses_post( $item['sub_title_2'] ); ?></p>
		        	                    
	        	                         <?php if( $item['btn_link']['url'] ): ?>
	        	                         <div class="slider-btn btn-hover">
	        	                             <?php echo wp_kses_post($link_html); ?>
	        	                         </div>
	        	                    	<?php endif; ?>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>

		        <?php elseif( $item['style'] == '4' ): ?>
		        	<div class="single-slider-3 slider-height-3 bg-gray-2 d-flex align-items-center slider-height-res-hm4 flone_slider_<?php echo esc_attr( $item['style'] ); ?>">
		        	    <div class="container">
		        	        <div class="row align-items-center">
		        	            <div class="col-xl-7 col-lg-7 col-md-6 col-12 col-sm-6">
		        	                <div class="slider-content-3 slider-content-4 slider-animated-1 text-center">
	        	                    	<?php if($item['sub_title']): ?>
	        	                        <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
	        	                    	<?php endif; ?>
		        	                    <h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>
		        	                   <p class="animated"><?php echo wp_kses_post( $item['sub_title_2'] ); ?></p>
	        	                         <?php if( $item['btn_link']['url'] ): ?>
	        	                         <div class="slider-btn btn-hover">
	        	                             <?php echo wp_kses_post($link_html); ?>
	        	                         </div>
	        	                    	<?php endif; ?>
		        	                </div>
		        	            </div>
		        	            <div class="col-xl-5 col-lg-5 col-md-6 col-12 col-sm-6">
		        	                <div class="single-slider-img4 slider-animated-1">
		        	                    <?php echo wp_get_attachment_image( $item['image_arr']['id'], $item['image_size_size'], null,  array( 'class' => 'animated') ); ?>
		        	                    <div class="single-price-wrap">
		        	                        <?php echo wp_get_attachment_image( $item['price_shape_bg_arr']['id'],'large' ); ?>
		        	                        <div class="single-price">
		        	                            <span><?php echo esc_html( $item['price_label'] ); ?></span>
		        	                            <span class="dollar"><?php echo esc_html( $item['price'] ); ?></span>
		        	                        </div>
		        	                    </div>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>

    		        <?php elseif( $item['style'] == '5' ): ?>
		        	<div class="slider-height-4 d-flex align-items-center bg-img flone_slider_<?php echo esc_attr( $item['style'] ); ?>"  style="background-image:url(<?php echo esc_url( $item['image_arr']['url'] ) ?>);">
		        	    <div class="container">
		        	        <div class="row">
		        	            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
		        	                <div class="slider-content-5 slider-animated-1 text-center">
		        							
	        	                		<?php if($item['sub_title']): ?>
	        	                	    <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
	        	                		<?php endif; ?>
	        	                	
	        	                		<h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>
	        	                		<p class="animated"><?php echo wp_kses_post( $item['sub_title_2'] ); ?></p>

	        	                		<?php if( $item['btn_link']['url'] ): ?>
		        	                    <div class="slider-btn-5 btn-hover">
		        	                         <?php echo wp_kses_post($link_html); ?>
		        	                    </div>
										<?php endif; ?>

		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>

    		        <?php elseif( $item['style'] == '6' ): ?>
		        	<div class="slider-height-5 d-flex align-items-center bg-img flone_slider_<?php echo esc_attr( $item['style'] ); ?>" style="background-image:url(<?php echo esc_url( $item['image_arr']['url'] ) ?>);">
		        	    <div class="container">
		        	        <div class="row">
		        	            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
		        	                <div class="slider-content-6 slider-animated-1 text-center">
	        	                		<?php if($item['sub_title']): ?>
	        	                	    <h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>
	        	                		<?php endif; ?>
	        	                		<p class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></p>

	        	                		<?php if( $item['btn_link']['url'] ): ?>
		        	                    <div class="slider-btn-5 btn-hover">
		        	                         <?php echo wp_kses_post($link_html); ?>
		        	                    </div>
										<?php endif; ?>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>

    		        <?php elseif( $item['style'] == '7' ): ?>
		        	<div class="slider-height-6 d-flex align-items-center justify-content-center bg-img flone_slider_<?php echo esc_attr( $item['style'] ); ?>" style="background-image:url(<?php echo esc_url( $item['image_arr']['url'] ) ?>);">
		        	    <div class="slider-content-5 slider-animated-1 text-center">
	        	        	<?php if($item['sub_title']): ?>
	        	            <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
	        	        	<?php endif; ?>
	        	        
	        	        	<h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>
	        	        	<p class="animated"><?php echo wp_kses_post( $item['sub_title_2'] ); ?></p>

	                		<?php if( $item['btn_link']['url'] ): ?>
    	                    <div class="slider-btn-5 btn-hover">
    	                         <?php echo wp_kses_post($link_html); ?>
    	                    </div>
							<?php endif; ?>
		        	    </div>
		        	</div>
					
					<?php elseif( $item['style'] == '8' ): ?>
		        	<div class="slider-height-7 bg-glaucous d-flex align-items-center flone_slider_<?php echo esc_attr( $item['style'] ); ?>">
		        	    <div class="container">
		        	        <div class="row align-items-center slider-h9-mrg">
		        	            <div class="col-lg-6 col-md-6 col-12 col-sm-6">
		        	                <div class="slider-content-7 slider-animated-1">
	        	                		<?php if($item['sub_title']): ?>
	        	                	    <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
	        	                		<?php endif; ?>
	        	                	
	        	                		<h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>

	        	                		<?php if( $item['btn_link']['url'] ): ?>
		        	                    <div class="slider-btn-9 btn-hover">
		        	                        <?php echo wp_kses_post($link_html); ?>
		        	                    </div>
		        	                    <?php endif; ?>
		        	                </div>
		        	            </div>
		        	            <div class="col-lg-6 col-md-6 col-12 col-sm-6">
		        	                <div class="slider-singleimg-hm9 slider-animated-1">
		        	                    <?php echo wp_get_attachment_image( $item['image_arr']['id'], $item['image_size_size'], null,  array( 'class' => 'animated') ); ?>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>
						
					<?php elseif( $item['style'] == '9' ): ?>
		        	<div class="single-slider single-slider-10 slider-height-8 bg-aqua flone_slider_<?php echo esc_attr( $item['style'] ); ?>">
		        	    <div class="container">
		        	        <div class="row">
		        	            <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6 d-flex align-items-center">
		        	                <div class="slider-content slider-content-10 slider-animated-2">
	        	                    	<?php if($item['sub_title']): ?>
	        	                        <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
	        	                    	<?php endif; ?>
	        	                    
	        	                    	<h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>

	        	                    	<?php if( $item['btn_link']['url'] ): ?>
		        	                    <div class="slider-btn btn-hover">
		        	                         <?php echo wp_kses_post($link_html); ?>
		        	                    </div>
		        	                    <?php endif; ?>
		        	                </div>
		        	            </div>
		        	            <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
		        	                <div class="slider-singleimg-hm10 slider-animated-2 ml-40 mr-40">
		        	                    <?php echo wp_get_attachment_image( $item['image_arr']['id'], $item['image_size_size'], null,  array( 'class' => 'animated') ); ?>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>
		        <?php elseif( $item['style'] == '10' ): ?>
		        	<div class="single-slider-2 slider-height-1 d-flex align-items-center slider-height-res bg-img flone_slider_<?php echo esc_attr( $item['style'] ); ?>" style="background-image:url(<?php echo esc_url( $item['image_arr']['url'] ) ?>);">
		        	    <div class="container">
		        	        <div class="row">
		        	            <div class="col-xl-6 col-lg-6 col-md-7">
		        	                <div class="slider-content-2 slider-animated-1">
		        	                	<?php if($item['sub_title']): ?>
		        	                    <h3 class="animated"><?php echo wp_kses_post( $item['sub_title'] ); ?></h3>
		        	                	<?php endif; ?>

		        	                    <h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>
									<?php if($item['sub_title_2']): ?>
										<p class="animated"><?php echo wp_kses_post( $item['sub_title_2'] ); ?></p>
										<?php endif; ?>
	        	                         <?php if( $item['btn_link']['url'] ): ?>
	        	                         <div class="slider-btn btn-hover">
	        	                             <?php echo wp_kses_post($link_html); ?>
	        	                         </div>
	        	                    	<?php endif; ?>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>
		        <?php elseif( $item['style'] == '11' ): ?>
		        	<div class="single-slider-2 slider-height-1 d-flex align-items-center slider-height-res bg-img flone_slider_<?php echo esc_attr( $item['style'] ); ?>" style="background-image:url(<?php echo esc_url( $item['image_arr']['url'] ) ?>);">
		        	    <div class="container">
		        	        <div class="row">
		        	            <div class="col-xl-6 col-lg-6 col-md-7">
		        	                <div class="slider-content-2 slider-animated-1">
		        	                	<?php if( $item['sub_logo']['url']): ?>
		        	                		<div class="animated">
		        	                		<img src="<?php echo esc_url($item['sub_logo']['url']); ?>" alt="<?php esc_attr_e('logo','flone'); ?>">
		        	                		</div>
		        	                    
		        	                	<?php endif; ?>

		        	                    <h1 class="animated"><?php echo wp_kses_post( $item['title'] ); ?></h1>
								
	        	                         <?php if( $item['btn_link']['url'] ): ?>
	        	                         <div class="slider-btn btn-hover">
	        	                             <?php echo wp_kses_post($link_html); ?>
	        	                         </div>
	        	                    	<?php endif; ?>
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	</div>
		   		<?php endif; ?>

				<?php endforeach; ?>
		    </div>
		</div>

	    <?php echo ob_get_clean();

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Slider() );