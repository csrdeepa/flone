<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Instagram extends Widget_Base {

    public function get_name() {
        return 'flone_instagram';
    }
    
    public function get_title() {
        return __( 'Instagram', 'flone' );
    }

    public function get_icon() {
        return 'htmega-icon fa fa-clone';
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

		// user_id
		$this->add_control(
		    'user_id',
		    [
		        'label'         => __( 'Instagram user ID', 'flone' ),
		        'type'          => Controls_Manager::TEXT,
		        'default'   => __( '6666969077', 'flone' ),
		        'label_block'   =>true,
		        'description'   => wp_kses_post( '(<a href="'.esc_url('https://codeofaninja.com/tools/find-instagram-user-id').'" target="_blank">Lookup your User ID</a>)', 'flone' ),
		    ]
		);

		// access_tocken
		$this->add_control(
		    'access_tocken',
		    [
		        'label'         => __( 'Instagram Access Token', 'flone' ),
		        'type'          => Controls_Manager::TEXT,
		        'default'   => __( '6666969077.1677ed0.d325f406d94c4dfab939137c5c2cc6c2', 'flone' ),
		        'label_block'   =>true,
		        'description'   => wp_kses_post( '(<a href="'.esc_url('http://instagram.pixelunion.net/').'" target="_blank">Lookup your Access Token</a>)', 'flone' ),
		    ]
		);

		$this->add_control(
		    'limit',
		    [
		        'label' => __( 'Item Limit (Max 12)', 'flone' ),
		        'type' => Controls_Manager::NUMBER,
		        'min' => 1,
		        'max' => 20,
		        'step' => 1,
		        'default' => 8
		    ]
		);

		// Carousel Options
		// loop
		$this->add_control(
		    'loop',
		    [
		        'label' => __( 'Loop', 'flone' ),
		        'type' => Controls_Manager::SWITCHER,
		        'return_value' => 'true',
		        'default' => 'false',
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
		        'default' => '5',
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
    $owl_settings['columns_on_desktop'] = $settings['columns_on_desktop'];
    $owl_settings['columns_on_tablet'] = $settings['columns_on_tablet'];
    $owl_settings['columns_on_mobile'] = $settings['columns_on_mobile'];

    $owl_settings = wp_json_encode($owl_settings);


    // instagram api
    $response = wp_remote_get( 'https://api.instagram.com/v1/users/' . esc_attr( $settings['user_id'] ) . '/media/recent/?access_token=' . esc_attr( $settings['access_tocken'] ) . '&count=' . esc_attr( $settings['limit'] ) );
    
    if ( ! is_wp_error( $response ) ) {
    
        $response_body = json_decode( $response['body'] );
        
        if ( empty( $response_body ) ) {
            echo '<p class="text-center">'.esc_html__('Incorrect user ID specified.','flone').'</p>';
            return;
        }
        
        $items_as_objects = $response_body->data;
        $items = array();
        foreach ( $items_as_objects as $item_object ) {
            $item['link']           = $item_object->link;
            $item['imgsrc']         = $item_object->images->low_resolution->url;
            $username               = $item_object->user->username;
            $profile_link           = 'https://www.instagram.com/'.$username;
            $items[]      = $item;
        }
    }
    ob_start(); ?>
    <div class="instagram-active owl-carousel" data-settings='<?php echo $owl_settings; ?>'>

    	<?php
    	    if ( isset( $items ) && !empty($items)):
    	        foreach ( $items as $item ):
    	?>
        <div class="single-instagram">
			<a href="<?php echo esc_url( $item['link'] ); ?>">
				<img src="<?php echo esc_url( $item['imgsrc'] ); ?>" alt="<?php echo esc_html__($username,'flone');?>">
			</a>
        </div>
        <?php
    			endforeach;
    		endif;
    	?>

    </div>

    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Instagram() );