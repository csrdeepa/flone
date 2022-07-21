<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Banner extends Widget_Base {

    public function get_name() {
        return 'flone_banner';
    }
    
    public function get_title() {
        return __( 'Banner', 'flone' );
    }

    public function get_icon() {
        return 'eicon-banner';
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

		// style
		$this->add_control(
		    'style',
		    [
		        'label' => __( 'Banner style', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '1',
		        'options' => [
		            '1' => __( 'One', 'flone' ),
		            '2' => __( 'Two', 'flone' ),
		        ]
		    ]
		);

		// title
		$this->add_control(
		    'title',
		    [
		        'label'   => __( 'Title', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => __('Summer Offer','flone'),
		    ]
		);

		// desc
		$this->add_control(
		    'desc',
		    [
		        'label'   => __( 'Description', 'flone' ),
		        'type'    => Controls_Manager::TEXTAREA,
		        'default' => __('Starting at ','flone'),
		    ]
		);

		// iamge_arr
		$this->add_control(
		    'image_arr',
		    [
		        'label' => __( 'Image', 'flone' ),
		        'type' => Controls_Manager::MEDIA,
		    ]
		);

		// image_size
		$this->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
		        'name' => 'image_size',
		        'default' => 'large',
		        'separator' => 'none',
		    ]
		);

		// button_icon
		$this->add_control(
		    'button_icon',
		    [
		        'label' => __( 'Button Icon', 'flone' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		        	'value'	 => 'fas fa-long-arrow-alt-right',
		        	'library' => 'solid',
		        ]
		    ]
		);

		// button_link
		$this->add_control(
			'button_link',
			[
				'label' => __( 'Button Icon Link', 'flone' ),
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

		// banner_link
		$this->add_control(
			'banner_link',
			[
				'label' => __( 'Banner Link', 'flone' ),
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
		    'content_alignment',
		    [
		        'label' => __( 'Content Alignment', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'align_left',
		        'options' => [
		            'align_left' => __( 'Left', 'flone' ),
		            'align_right' => __( 'Right', 'flone' ),
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
	        	{{WRAPPER}} .flone-single-banner .flone-banner-content h3
	        '
	    ]
	);

	// title_color
	$this->add_control(
	   'title_color',
	    [
	        'label' => __( 'Title Color', 'flone' ),
	        'type' => Controls_Manager::COLOR,
	        'selectors' => [
	        	'{{WRAPPER}} .flone-single-banner .flone-banner-content h3' => 'color:{{VALUE}};',
	        ],
	    ]
	);

	// title margin
	$this->add_responsive_control(
	    'title_margin',
	    [
	        'label' => __( 'Title Margin', 'flone' ),
	        'type' => Controls_Manager::DIMENSIONS,
	        'size_units' => [ 'px', '%', 'em' ],
	        'selectors' => [
	            '{{WRAPPER}} .flone-single-banner .flone-banner-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// desc_typography
	$this->add_group_control(
		Group_Control_Typography::get_type(),
	    [
	    	'name' 	=>	'desc_typography',
	        'label' => __( 'Desc Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .flone-single-banner .flone-banner-content h4
	        '
	    ]
	);

	// desc_color
	$this->add_control(
	    'desc_color',
	    [
	        'label' => __( 'Desc Color', 'flone' ),
	        'type' => Controls_Manager::COLOR,
	        'selectors' => [
	        	'{{WRAPPER}} .flone-single-banner .flone-banner-content h4' => 'color:{{VALUE}};',
	        ]
	    ]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
	    [
	    	'name' 	=>	'desc_typography_2',
	        'label' => __( 'Desc Typography 2', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .flone-single-banner .flone-banner-content h4 span
	        '
	    ]
	);

	// desc_color_2
	$this->add_control(
	    'desc_color_2',
	    [
	        'label' => __( 'Desc Color 2', 'flone' ),
	        'type' => Controls_Manager::COLOR,
	        'selectors' => [
	        	'{{WRAPPER}} .flone-single-banner .flone-banner-content h4 span' => 'color:{{VALUE}};',
	        ],
	    ]
	);

	// dec margin
	$this->add_responsive_control(
	    'desc_margin',
	    [
	        'label' => __( 'Desc Margin', 'flone' ),
	        'type' => Controls_Manager::DIMENSIONS,
	        'size_units' => [ 'px', '%', 'em' ],
	        'selectors' => [
	            '{{WRAPPER}} .flone-single-banner .flone-banner-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	        ],
	    ]
	);
	$this->add_responsive_control(
	    'desc_margin_2',
	    [
	        'label' => __( 'Desc Margin 2', 'flone' ),
	        'type' => Controls_Manager::DIMENSIONS,
	        'size_units' => [ 'px', '%', 'em' ],
	        'selectors' => [
	            '{{WRAPPER}} .flone-single-banner .flone-banner-content h4 span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	        ],
	        'separator' => 'after',
	    ]
	);

	// icon_color
	$this->add_control(
	   'icon_color',
	    [
	        'label' => __( 'Icon Color', 'flone' ),
	        'type' => Controls_Manager::COLOR,
	        'selectors' => [
	        	'{{WRAPPER}} .flone-single-banner .flone-banner-content a' => 'color: {{VALUE}};border-color: {{VALUE}};',
	        ]
	    ]
	);

	// icon_hover_color
	$this->add_control(
	    'icon_hover_color',
	    [
	        'label'     => __( 'Icon Hover Color', 'flone' ),
	        'type'      => Controls_Manager::COLOR,
	        'selectors' => [
	            '{{WRAPPER}} .flone-single-banner .flone-banner-content a:hover' => 'color: {{VALUE}};border-color: {{VALUE}}',
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
 	$content_alignment = $settings['content_alignment'];

    // link generate
    $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
    $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
    $link_html =  '<a href="' . esc_url($settings['button_link']['url']) . '"' . $target . $nofollow . '> <i class="'. $settings['button_icon']['value'] .'"></i> </a>';

    ob_start(); ?>

    <div class="flone-single-banner single-banner<?php echo esc_attr($settings['style'] == '2' ? '-2 ' : ' '); echo esc_attr($content_alignment); ?>">

        <a href="<?php echo esc_url( $settings['banner_link']['url'] ) ?>">
        	<?php echo wp_get_attachment_image( $settings['image_arr']['id'], $settings['image_size_size'] ); ?>
        </a>

        <?php if($settings['title'] || $settings['desc']): ?>
        <div class="flone-banner-content banner-content<?php echo esc_attr($settings['style'] == '2' ? '-2' : ''); ?>">
            <h3><?php echo wp_kses_post( $settings['title'] ); ?></h3>
            <h4><?php echo wp_kses_post( $settings['desc'] ); ?></h4>

            <?php
            	if( $settings['button_link']['url'] ){
            		echo wp_kses_post( $link_html );
            	}
            ?>
        </div>
        <?php endif; ?>

    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Banner() );