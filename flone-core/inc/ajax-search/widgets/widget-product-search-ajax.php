<?php
class Flone_Product_Search_Ajax_Widget extends WP_Widget {
  /**
   * Constructor
   */
  public function __construct() {
    $widget_options = array( 
    	'classname' => 'flone_widget_psa',
    	'description' => esc_html__('Flone Ajax Product Search Widget', 'flone')
    );
    parent::__construct( 'flone_widget_psa', __('Flone: Product Search Ajax', 'flone'), $widget_options );
  }

  /**
   * Output
   */
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $data_settings = array();
    $data_settings['limit'] = $instance[ 'limit' ];

    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>

    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-settings='<?php echo wp_json_encode($data_settings) ?>'>
    	<input type="search" id="flone-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" placeholder="<?php echo esc_attr__( 'Search products', 'flone' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    	<input type="hidden" name="post_type" value="product" />
    	<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'flone' ); ?>"><i class="fas fa-search"></i></button>
    	<span class="flone_widget_psa_clear_icon"><i class="fas fa-times"></i></span>
    	<span class="flone_widget_psa_loading_icon"><i class="fas fa-circle-notch"></i></span>
    	<div id="flone_psa_results_wrapper"></div>
    </form>

    <?php echo $args['after_widget'];
  }

  
  /**
   * Form
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $limit = ! empty( $instance['limit'] ) ? $instance['limit'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html__( 'Title:', 'flone' ) ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php echo esc_html__( 'Product Limit:', 'flone' ) ?></label>
      <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $limit ); ?>" />
    </p>
    <?php
  }


  /**
   * Update
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    $instance[ 'limit' ] = strip_tags( $new_instance[ 'limit' ] );
    return $instance;
  }

}