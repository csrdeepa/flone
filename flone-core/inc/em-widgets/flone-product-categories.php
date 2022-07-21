<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Product_Categories extends Widget_Base {

    public function get_name() {
        return 'flone_product_categories';
    }
    
    public function get_title() {
        return __( 'Product Categories', 'flone' );
    }

    public function get_icon() {
        return 'eicon-product-categories';
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

		// style
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

		// select_category
		$this->add_control(
		    'select_category',
		    [
		        'label' => __( 'Select Product Categories', 'flone' ),
		        'type' => Controls_Manager::SELECT2,
		        'label_block' => true,
		        'multiple' => true,
		        'options' => flone_get_taxonomies('product_cat', true),
		    ]
		);

		// image_size
		$this->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
		        'name' => 'image_size',
		        'default' => 'large',
		    ]
		);

		$this->add_control(
		    'shop_now_btn',
		    [
		        'label' => __( 'Shop Now Button Show/Hide', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'yes',
		        'default' => 'no',
		    ]
		);
        $this->add_control(
            'shop_now_btn_text',
            [
                'label' => __( 'Button Text', 'flone' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Shop Now',
                'title' => __( 'Enter Shop Now button text', 'flone' ),
                'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
            ]
        );



		// Carousel Options
		// loop
		$this->add_control(
		    'loop',
		    [
		        'label' => __( 'Enable Loop', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'default' => 'false',
		        'separator' => 'before',
		    ]
		);

		// dots
		$this->add_control(
		    'dots',
		    [
		        'label' => __( 'Enable Dots', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'default' => 'false',
		    ]
		);

		// margin
		$this->add_control(
		    'margin',
		    [
		        'label' => __( 'Margin', 'flone' ),
		        'type' => Controls_Manager::NUMBER,
		        'default' => '30',
		    ]
		);

		// autoplay
		$this->add_control(
		    'autoplay',
		    [
		        'label' => __( 'Enable Auto Play', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'default' => 'false',
		    ]
		);

		// autoplay_timeout
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
	        	{{WRAPPER}} .flone_product_categories h4 a
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
	            '{{WRAPPER}} .flone_product_categories h4 a' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// count_text_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'count_text_typography',
	        'label' => __( 'Count Text Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .flone_product_categories span
	        '
	    ]
	);

	// count_text_color
	$this->add_control(
	    'count_text_color',
	    [
	        'label'     => __( 'Count Text Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .flone_product_categories span' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);
            $this->add_control(
                'slider_button_heading',
                [
                    'label' => __( 'Button', 'flone' ),
                    'type' => Controls_Manager::HEADING,
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'clc_color',
                [
                    'label' => __( 'Button color', 'flone' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default'=>'#666',
                    'selectors' => [
                        '{{WRAPPER}} .collection-product-btn a' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'clc_bg_color',
                [
                    'label' => __( 'Button background color', 'flone' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default'=>'rgba(0,0,0,0.0)',
                    'selectors' => [
                        '{{WRAPPER}} .collection-product-btn a' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'btntypography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                    'selector' => '{{WRAPPER}} .collection-product-btn a',
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'btn_border',
                    'label' => __( 'Button Border', 'flone' ),
                    'selector' => '{{WRAPPER}} .collection-product-btn a',
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'btn_border_radius',
                [
                    'label' => __( 'Border Radius', 'flone' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .collection-product-btn a,
                        {{WRAPPER}} .btn-hover a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]

                ]
            ); 
            $this->add_responsive_control(
                'btn_border_pading',
                [
                    'label' => __( 'Button Padding', 'flone' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .collection-product-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]

                ]
            );
            $this->add_responsive_control(
                'btn_border_margin',
                [
                    'label' => __( 'Button Margin', 'flone' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .collection-product-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]

                ]
            );     
            $this->add_control(
	            'slider_button_heading_hover',
	            [
	                'label' => __( 'Button Hover', 'flone' ),
	                'type' => Controls_Manager::HEADING,
	                'condition' => [
	                    'shop_now_btn' => 'yes',
	                ]
	            ]
            );
            $this->add_control(
	            'clc_color_hover',
	            [
	                'label' => __( 'Button Hover color', 'financoem' ),
	                'type' => Controls_Manager::COLOR,
	                'scheme' => [
	                    'type' => Scheme_Color::get_type(),
	                    'value' => Scheme_Color::COLOR_1,
	                ],
	                'default'=>'#fff',
	                'selectors' => [
	                    '{{WRAPPER}} .collection-product-btn a:hover' => 'color: {{VALUE}};',
	                ],
	                'condition' => [
	                    'shop_now_btn' => 'yes',
	                ]
	            ]
            );

            $this->add_control(
                'clc_bg_color_hover',
                [
                    'label' => __( 'Button background Hover color', 'financoem' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default'=>'#a749ff',
                    'selectors' => [
                        '{{WRAPPER}} .btn-hover a::after' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'btn_border_hover',
                    'label' => __( 'Button Border Hover', 'flone' ),
                    'selector' => '{{WRAPPER}} .collection-product-btn a:hover',
                    'condition' => [
                        'shop_now_btn' => 'yes',
                    ]
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
    $owl_settings = array();
    $owl_settings['autoplay'] = $settings['autoplay'];
    $owl_settings['autoplay_timeout'] = $settings['autoplay_timeout'];
    $owl_settings['loop'] = $settings['loop'];
    $owl_settings['dots'] = $settings['dots'];
    $owl_settings['margin'] = $settings['margin'];
    $owl_settings['columns_on_desktop'] = $settings['columns_on_desktop'];
    $owl_settings['columns_on_tablet'] = $settings['columns_on_tablet'];
    $owl_settings['columns_on_mobile'] = $settings['columns_on_mobile'];

    $owl_settings = wp_json_encode($owl_settings);

    $term_slug_list = $settings['select_category'];
    $shop_now_btn = $settings['shop_now_btn'];
    $shop_now_btn_text = $settings['shop_now_btn_text'];

    ob_start(); ?>
    <div class="collection-wrap flone_product_categories owl-dot-style">
        <div class="owl-carousel" data-settings='<?php echo $owl_settings; ?>'>
			
			<?php foreach( $term_slug_list as $item ):
				$term = get_term_by( 'slug', $item, 'product_cat');

				$attachment_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				$term_link = get_term_link( $term->term_id, 'product_cat' );
			?>
            <div class="collection-product<?php echo esc_attr( $settings['style'] == '2' ? '-2' : '') ?>">
                <div class="collection-img">
                    <a href="<?php echo esc_url( $term_link ); ?>">
                    	<?php
                    		if($attachment_id):

                    			echo wp_get_attachment_image( $attachment_id, $settings['image_size_size']);

                    		else: 
                    	?>
                    		<img src="<?php echo wc_placeholder_img_src(); ?>" alt="<?php echo esc_attr__( 'Category Image', 'flone' ); ?>">
                    	<?php endif; ?>
                    </a>
                </div>
                <div class="collection-content<?php echo esc_attr( $settings['style'] == '2' ? '-2' : '') ?> text-center">
                    <span><?php echo esc_html($term->count) ?> <?php echo esc_html__( 'Products', 'flone' ) ?></span>
                    <h4><a href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $term->name ); ?></a></h4>
					<?php if($shop_now_btn == 'yes' ){ ?>
                    <div class="collection-product-btn btn-hover">
                    	<a href="<?php echo esc_url( $term_link ); ?>">
                    		<?php echo esc_html($shop_now_btn_text); ?>
                    	</a>
                    </div>
                	<?php } ?>
                </div>
            </div>
        	<?php endforeach; ?>

        </div>
    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Product_Categories() );