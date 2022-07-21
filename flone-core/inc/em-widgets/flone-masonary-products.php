<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flone_Masonary_Products extends Widget_Base {

    public function get_name() {
        return 'flone_Masonary_Products';
    }
    
    public function get_title() {
        return __( 'Masonary Products', 'flone' );
    }

    public function get_icon() {
        return 'eicon-gallery-masonry';
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

		$repeater = new Repeater();

		// product_id
		$repeater->add_control(
		    'product_id',
		    [
		        'label' => __( 'Select Product', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'options' => flone_get_products(),
		    ]
		);

		// product_image_type
		$repeater->add_control(
		    'product_image_type',
		    [
		        'label' => __( 'Style', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => 'custom_image',
		        'options' => [
		            'custom_image'   => __( 'Custom Product Image', 'flone' ),
		            'product_image'   => __( 'Main Product Thumbnail', 'flone' ),
		        ],
		    ]
		);

		// product_iamge_arr
		$repeater->add_control(
		    'product_iamge_arr',
		    [
		        'label' => __( 'Custom Product Image', 'flone' ),
		        'type' => Controls_Manager::MEDIA,
		        'condition' => [
		            'product_image_type' => array( 'custom_image' ),
		        ]
		    ]
		);

		// product_image_size
		$repeater->add_group_control(
		    Group_Control_Image_Size::get_type(),
		    [
		        'name' => 'product_image_size',
		        'default' => 'large',
		        'separator' => 'none',
		    ]
		);

		// product_content_position
		$repeater->add_control(
		    'product_content_position',
		    [
		        'label' => __( 'Style', 'flone' ),
		        'type' => Controls_Manager::SELECT,
		        'default' => '1',
		        'options' => [
		            '3'   => __( 'Top', 'flone' ),
		            '2'   => __( 'Left', 'flone' ),
		            '1'   => __( 'Center', 'flone' ),
		        ],
		    ]
		);

		// column_class
		$repeater->add_control(
		    'column_class',
		    [
		        'label'   => __( 'Column Class', 'flone' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => 'col-lg-6 col-md-6',
		    ]
		);


		$this->add_control(
			'products_list',
			[
				'label' => __( 'Products List', 'flone' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ product_id }}}',
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
    ob_start(); ?>

    <div class="product-area flone_masonary_products">
        <div class="container-fluid">
            <div class="row grid">
                <div class="grid-sizer"></div>
				
				<?php
				foreach($settings['products_list'] as $item):
					if( $item['product_id'] ):

						// args
						$args = array(
							'post_type' => 'product',
							'posts_per_page' => 1,
							'p' => $item['product_id']
						);

						$wp_query = new \WP_Query($args);

						while ( $wp_query->have_posts() ):
							$wp_query->the_post();
				?>

		                <div <?php post_class('grid-item '. $item['column_class']); ?>>
		                    <div class="product-wrap-4 mb-20">
		                        <a href="<?php the_permalink() ?>">
		                        	<?php if($item['product_image_type'] == 'custom_image' ): ?>
										<?php echo wp_get_attachment_image( $item['product_iamge_arr']['id'], $item['product_image_size_size'] ); ?>
		                        	<?php else: ?>
		                        		<?php the_post_thumbnail( $item['product_image_size_size'] ); ?>
		                        	<?php endif; ?>
		                        </a>
		                        <div class="product-content-4 position-<?php echo esc_attr($item['product_content_position']) ?>">
		                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
		                            <div class="price-4 price-4-center">
		                                <?php woocommerce_template_loop_price(); ?>
		                            </div>
		                        </div>
		                    </div>
		                </div>

            	<?php
            		endwhile;
            		wp_reset_query();
					wp_reset_postdata();

            		else: 
            			echo '<p class="text-center">'. esc_html__( 'Please Select Product', 'flone' ) . '<p>';
					endif;
				endforeach; ?>
       		</div><!-- row -->

        </div>
    </div><!-- product-area -->


    <?php echo ob_get_clean();
}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Flone_Masonary_Products() );