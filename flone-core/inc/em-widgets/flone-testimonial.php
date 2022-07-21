<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Testimonial extends Widget_Base {

    public function get_name() {
        return 'flone_testimonial';
    }
    
    public function get_title() {
        return __( 'Testimonial', 'flone' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
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

		$repeater = new Repeater();

		// author_image_arr
		$repeater->add_control(
		    'author_image_arr',
		    [
		        'label' => __( 'Image', 'flone' ),
		        'type' => Controls_Manager::MEDIA,
		    ]
		);

		// image_size
		$repeater->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
		        'name' => 'image_size',
		        'default' => 'large',
		        'separator' => 'none',
		    ]
		);

		// author_name
		$repeater->add_control(
		    'author_name',
		    [
		        'label'   => __( 'Name', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		    ]
		);

		// author_designation
		$repeater->add_control(
		    'author_designation',
		    [
		        'label'   => __( 'Designation', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		    ]
		);

		// author_comment
		$repeater->add_control(
		    'author_comment',
		    [
		        'label'   => __( 'Comment', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		    ]
		);


	    $this->add_control(
	        'testimonial_list',
			[
				'label' => __( 'Testimonial List', 'flone' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'author_name' => __( 'John Doe', 'flone' ),
						'author_designation' => __( 'Customer', 'flone' ),
						'author_comment' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio nisi sed, molestias voluptatum accusantium repudiandae dolorum, dolorem soluta et quo! Rem, voluptatibus. Ratione sint aliquid explicabo laudantium repellendus voluptas aut.', 'flone' ),
					],
					[
						'author_name' => __( 'John Doe', 'flone' ),
						'author_designation' => __( 'Customer', 'flone' ),
						'author_comment' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio nisi sed, molestias voluptatum accusantium repudiandae dolorum, dolorem soluta et quo! Rem, voluptatibus. Ratione sint aliquid explicabo laudantium repellendus voluptas aut.', 'flone' ),
					],
				],
				'title_field' => '{{{ author_name }}}',
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


	// comment_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'comment_typography',
	        'label' => __( 'Comment Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .single-testimonial p
	        '
	    ]
	);

	// comment_color
	$this->add_control(
	    'comment_color',
	    [
	        'label'     => __( 'Comment Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-testimonial p' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// name_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'name_typography',
	        'label' => __( 'Name Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .single-testimonial .client-info h5
	        '
	    ]
	);

	// name_color
	$this->add_control(
	    'name_color',
	    [
	        'label'     => __( 'Name Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-testimonial .client-info h5' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// designation_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'designation_typography',
	        'label' => __( 'Designation Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .single-testimonial .client-info span
	        '
	    ]
	);

	// designation_color
	$this->add_control(
	    'designation_color',
	    [
	        'label'     => __( 'Designation Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-testimonial .client-info span' => 'color: {{VALUE}};',
	        ],
	    ]
	);


	$this->add_control(
	    'separator_icon_color',
	    [
	        'label'     => __( 'Separator Icon Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .single-testimonial .client-info i' => 'color: {{VALUE}};',
	        ],
	    ]
	);

	$this->add_control(
	    'author_image_arr',
	    [
	        'label' => __( 'Image', 'flone' ),
	        'type' => Controls_Manager::MEDIA,
	    ]
	);

	$this->end_controls_section(); // title style section

	// carousel settings
	$this->start_controls_section(
	    'content_section_2',
	    [
	        'label' => __( 'Testimonial Options', 'flone' ),
	    ]
	);

	$this->add_control(
	    'show_hide_sign',
	    [
	        'label' => __( 'Icon Hide', 'flone' ),
	        'type' => Controls_Manager::SWITCHER,
	        'return_value' => 'true',
	        'default' => 'true',
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
	        	'value' => 'pe-7s-angle-left',
	        	'library' => 'solid',
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
	        	'value' => 'pe-7s-angle-right',
	        	'library' => 'solid',
	        ],
	        'condition' => [
	            'nav' => 'true',
	        ]
	    ]
	);

	$this->end_controls_section(); // Slider Option end

    // Style tab section
    $this->start_controls_section(
        '_img_carousel_style',
        [
            'label' => __( 'Carousel Button', 'flone' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
    $this->start_controls_tabs(
            'flone__img_carousel_carousel_style_tabs'
        );
        $this->start_controls_tab(
            'flone__img_carousel_carouse_style_normal_tab',
            [
                'label' => __( 'Normal', 'flone' ),
            ]
        );
        

	// arrow
	$this->add_control(
	    'arrow_color',
	    [
	        'label'     => __( 'Arrow Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .owl-carousel .owl-nav div' => 'color: {{VALUE}};',
	        ],
	    ]
	);
	$this->add_control(
	    'arrow_bg_color',
	    [
	        'label'     => __( 'Arrow BG Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .owl-carousel .owl-nav div' => 'background-color: {{VALUE}};',
	        ],
	    ]
	);

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'arrwo_border',
                    'label' => __( 'Border', 'flone' ),
                    'selector' => '{{WRAPPER}} .owl-carousel .owl-nav div',
                ]
            ); 
            $this->add_control(
                'carousel_nav_border_radius',
                [
                    'label' => __( 'Border Radius', 'flone' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-carousel .owl-nav div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],

                ]
            );

            $this->add_responsive_control(
                'carousel_navicon_width',
                [
                    'label' => __( 'Width', 'flone' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                    'selectors' => [
                        '{{WRAPPER}} .owl-carousel .owl-nav div' => 'width: {{VALUE}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'carousel_navicon_height',
                [
                    'label' => __( 'Height', 'flone' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                    'selectors' => [
                        '{{WRAPPER}} .owl-carousel .owl-nav div' => 'height: {{VALUE}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'carousel_nav_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'selector' => '{{WRAPPER}} .owl-carousel .owl-nav div',
                ]
            );
            
        $this->end_controls_tab();
        $this->start_controls_tab(
            'flone__img_carousel_carouse_style_hover_tab',
            [
                'label' => __( 'Hover', 'flone' ),
            ]
        );

			$this->add_control(
			    'arrow_hover_color',
			    [
			        'label'     => __( 'Arrow Hover Color', 'flone' ),
			        'type'      => Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .owl-carousel .owl-nav div:hover' => 'color: {{VALUE}};',
			        ],
			    ]
			);			
			$this->add_control(
			    'arrow_bg_color_hover',
			    [
			        'label'     => __( 'Arrow BG Color', 'flone' ),
			        'type'      => Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .owl-carousel .owl-nav div:hover' => 'background-color: {{VALUE}};',
			        ],
			    ]
			); 
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'arrwo_border_hover',
                    'label' => __( 'Border', 'flone' ),
                    'selector' => '{{WRAPPER}} .owl-carousel .owl-nav div:hover',
                ]
            ); 
            $this->add_control(
                'carousel_nav_border_radius_hover',
                [
                    'label' => __( 'Border Radius', 'flone' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-carousel .owl-nav div:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],

                ]
            );
           
        $this->end_controls_tab();
    $this->end_controls_tabs();
$this->end_controls_section();



}

protected function _register_controls() {

	$this->flone_content_fields();
	$this->flone_style_fields();
}

protected function render( $instance = [] ) {

    $settings = $this->get_settings_for_display();
    $id = substr( $this->get_id_int(), 0, 3 );

	$show_hide_sign = $settings['show_hide_sign'];

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

    <div class="flone_testimonial owl-carousel nav-style-1 nav-testi-style" data-settings='<?php echo $owl_options; ?>'>

    	<?php
    		foreach (  $settings['testimonial_list'] as $item ) :
    	?>

        <div class="single-testimonial text-center">

            <?php echo wp_get_attachment_image( $item['author_image_arr']['id'], $item['image_size_size'] ); ?>

            <p><?php echo esc_html( $item['author_comment'] ); ?></p>
            <div class="client-info">
            	<?php if( $show_hide_sign == 'true'){ ?>
                <i class="fa fa-map-signs"></i>
            	<?php } ?>
                <h5><?php echo esc_html( $item['author_name'] ); ?></h5>
                <span><?php echo esc_html( $item['author_designation'] ); ?></span>
            </div>
        </div>

    	<?php endforeach; ?>

    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Testimonial() );