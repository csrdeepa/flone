<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Service extends Widget_Base {

    public function get_name() {
        return 'flone_service';
    }
    
    public function get_title() {
        return __( 'Service', 'flone' );
    }

    public function get_icon() {
        return 'htmega-icon fa fa-clone';
    }
    public function get_categories() {
        return [ 'flone' ];
    }

	public function flone_content_fields(){
		$this->start_controls_section(
		    'content_section_1',
		    [
		        'label' => __( 'Slider Content', 'flone' ),
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
		            '3'   => __( 'Style Three', 'flone' ),
		        ],
		    ]
		);
		$this->add_control(
            'title',
            [
                'label' => __( 'Title', 'flone' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Free Shipping', 'flone' ),
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
        $this->add_control(
            'icon_type',
            [
                'label' => __('Icon Type','flone'),
                'type' =>Controls_Manager::CHOOSE,
                'options' =>[
                    'img' =>[
                        'title' =>__('Image','flone'),
                        'icon' =>'fa fa-picture-o',
                    ],
                    'icon' =>[
                        'title' =>__('Icon','flone'),
                        'icon' =>'fa fa-info',
                    ]
                ],
                'default' => 'img',
                'condition' => [
                    'style' => array( '1', '2' ),
                ],
            ]
        );

        $this->add_control(
            'image_arr',
            [
                'label' => __('Image','flone'),
                'type'=>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'style' => array( '1', '2' ),
                    'icon_type' => 'img',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_size',
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'style' => array( '1', '2' ),
                    'icon_type' => 'img',
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' =>esc_html__('Icon','flone'),
                'type'=>Controls_Manager::ICONS,
                'default' => [
                	'value' => 'fas fa-pencil-alt',
                	'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
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
	        'label' => __( 'Service Stying Options', 'flone' ),
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
	        	{{WRAPPER}} .support-wrap .support-content h5,
	        	{{WRAPPER}} .support-wrap-2 .support-content-2 h5
	        '
	    ]
	);
	$this->add_control(
	    'title_color',
	    [
	        'label'     => __( 'Title Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .support-wrap .support-content h5' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .support-wrap-2 .support-content-2 h5' => 'color: {{VALUE}};',
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
	        	{{WRAPPER}} .support-wrap .support-content p,
	        	{{WRAPPER}} .support-wrap-2 .support-content-2 p
	        '
	    ]
	);
	$this->add_control(
	    'desc_color',
	    [
	        'label'     => __( 'Description Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .support-wrap .support-content p' => 'color: {{VALUE}};',
	            '{{WRAPPER}} .support-wrap-2 .support-content-2 p' => 'color: {{VALUE}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// icon
	$this->add_control(
        'icon_color',
        [
            'label' => __( 'Color', 'flone' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} i' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'icon!' => '',
            ],
        ]
    );
    $this->add_responsive_control(
        'icon_size',
        [
            'label' => __( 'Icon Size.', 'flone' ),
            'type'  => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 14,
            ],
            'selectors' => [
                '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'icon!' => '',
            ],
        ]
    );

    $this->add_responsive_control(
        'service_icon_margin',
        [
            'label' => __( 'Margin', 'flone' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'icon!' => '',
            ],
        ]
    );

    $this->add_responsive_control(
        'service_icon_padding',
        [
            'label' => __( 'Padding', 'flone' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'icon!' => '',
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
                '{{WRAPPER}} .support-wrap-2.support-shape::before' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'style' => '2',
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

    <?php if( $settings['style'] == '1' ): ?>
    	<div class="support-wrap support-1">
            <div class="support-icon">

            	<?php if( $settings['icon_type'] == 'img' ): ?>
	                <?php echo wp_get_attachment_image( $settings['image_arr']['id'], $settings['image_size_size'], null,  array( 'class' => 'animated') ); ?>
            	<?php else: ?>
            		<i class="<?php echo esc_attr($settings['icon']['value']) ?>"></i>
            	<?php endif; ?>
            	
            </div>
            <div class="support-content">

        		<?php if($settings['title']): ?>
        	    	<h5 class="animated"><?php echo wp_kses_post( $settings['title'] ); ?></h5>
        		<?php endif; ?>

    			<?php if($settings['desc']): ?>
    		    	<p class="animated"><?php echo wp_kses_post( $settings['desc'] ); ?></p>
    			<?php endif; ?>

            </div>
        </div>
	<?php elseif( $settings['style'] == '2' ): ?>
		<div class="support-wrap-2 support-shape text-center">
            <div class="support-content-2">
            	<?php if( $settings['icon_type'] == 'img' ): ?>
	                <?php echo wp_get_attachment_image( $settings['image_arr']['id'], $settings['image_size_size'], null,  array( 'class' => 'animated') ); ?>
            	<?php else: ?>
            		<i class="<?php echo esc_attr($settings['icon']['value']) ?>"></i>
            	<?php endif; ?>

	    		<?php if($settings['title']): ?>
	    	    	<h5 class="animated"><?php echo wp_kses_post( $settings['title'] ); ?></h5>
	    		<?php endif; ?>

				<?php if($settings['desc']): ?>
			    	<p class="animated"><?php echo wp_kses_post( $settings['desc'] ); ?></p>
				<?php endif; ?>
            </div>
        </div>
	<?php elseif( $settings['style'] == '3' ): ?>
		<div class="single-mission">

    		<?php if($settings['title']): ?>
    	    	<h3 class="animated"><?php echo wp_kses_post( $settings['title'] ); ?></h3>
    		<?php endif; ?>

			<?php if($settings['desc']): ?>
		    	<p class="animated"><?php echo wp_kses_post( $settings['desc'] ); ?></p>
			<?php endif; ?>

        </div>
	<?php endif; ?>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Service() );