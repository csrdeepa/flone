<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Team extends Widget_Base {

    public function get_name() {
        return 'flone_team';
    }
    
    public function get_title() {
        return __( 'Team', 'flone' );
    }

    public function get_icon() {
        return 'eicon-lock-user';
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

		// name
		$this->add_control(
		    'name',
		    [
		        'label'   => __( 'Name', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => __('John Doe','flone'),
		    ]
		);

		// designation
		$this->add_control(
		    'designation',
		    [
		        'label'   => __( 'Designation', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => __('Developer','flone'),
		    ]
		);

		// image_arr
		$this->add_control(
		    'image_arr',
		    [
		        'label' => __('Image','flone'),
		        'type'=>Controls_Manager::MEDIA,
		        'default' => [
		            'url' => Utils::get_placeholder_image_src(),
		        ]
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

		$repeater = new Repeater();

		// icon_name
		$repeater->add_control(
		    'icon_name',
		    [
		        'label'   => __( 'Icon Name', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		    ]
		);

		// icon
		$repeater->add_control(
		    'icon',
		    [
		        'label' => __('Icon','flone'),
		        'type'=> Controls_Manager::ICONS,
		        'default' => [
		        	'value' => 'fas fa-pencil-alt',
		        	'library' => 'solid',
		        ],
		    ]
		);

		$repeater->add_control(
		    'profile_link',
		    [
		    	'label' => __( 'Prfile Link', 'flone' ),
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

		// icon_color
		$repeater->add_control(
		    'icon_color',
		    [
		        'label'     => __( 'Icon Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .team-wrapper .team-img .team-action {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		// icon_bg_color
		$repeater->add_control(
		    'icon_bg_color',
		    [
		        'label'     => __( 'Icon Bg Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .team-wrapper .team-img .team-action {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
		        ],
		    ]
		);

		// icon_hover_color
		$repeater->add_control(
		    'icon_hover_color',
		    [
		        'label'     => __( 'Icon Hover Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .team-wrapper .team-img .team-action {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		// icon_hover_bg_color
		$repeater->add_control(
		    'icon_hover_bg_color',
		    [
		        'label'     => __( 'Icon Bg Color', 'flone' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .team-wrapper .team-img .team-action {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		// social_icon_list
	    $this->add_control(
	        'social_icon_list',
			[
				'label' => __( 'Social Icons List', 'flone' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Facebook', 'flone' ),
						'icon' => 'fas fa-facebook',
					],
					[
						'name' => __( 'Twitter', 'flone' ),
						'icon' => 'fas fa-twitter',
					],
					[
						'name' => __( 'Instagram', 'flone' ),
						'icon' => 'fas fa-instagram',
					],
				],
				'title_field' => '{{{ name }}}',
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


	// name_typography
	$this->add_group_control(
	    Group_Control_Typography::get_type(),
	    [
	        'name' => 'name_typography',
	        'label' => __( 'Name Typography', 'flone' ),
	        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
	        'selector' => '
	        	{{WRAPPER}} .team-wrapper .team-content h4
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
	            '{{WRAPPER}} .team-wrapper .team-content h4' => 'color: {{VALUE}};',
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
	        	{{WRAPPER}} .team-wrapper .team-content span
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
	            '{{WRAPPER}} .team-wrapper .team-content span' => 'color: {{VALUE}};',
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
    ob_start(); ?>

    <div class="team-wrapper">
        <div class="team-img">
            <a href="#">
                 <?php echo wp_get_attachment_image( $settings['image_arr']['id'], $settings['image_size_size'] ); ?>
            </a>
            <div class="team-action">

            	<?php foreach(  $settings['social_icon_list'] as $item ) :

            		// link generate
            		$target = $item['profile_link']['is_external'] ? ' target="_blank"' : '';
            	?>

                <a class="facebook elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" href="<?php echo esc_url($item['profile_link']['url']); ?>" target="<?php echo esc_attr($target); ?>">
                    <i class="<?php echo esc_attr($item['icon']['value']); ?>"></i>
                </a>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="team-content text-center">
            <h4><?php echo esc_html( $settings['name'] ); ?></h4>
            <span><?php echo esc_html( $settings['designation'] ); ?> </span>
        </div>
    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Team() );