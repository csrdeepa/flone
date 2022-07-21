<?php
class Flone_Ajax_Filter{
	public $root_url;
	public $root_dir;

	public function __construct() {
		$this->root_url = plugins_url('', __FILE__);
		$this->root_dir = dirname( __FILE__ );

		// register widgets
		add_action( 'widgets_init', array($this, 'register_widgets'));

		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_script'), 15);
	}

	public function enqueue_script() {
		wp_enqueue_style(
			'flone-ajax-filter',
			$this->root_url . '/ajax-filter.css'
		);
		wp_enqueue_script(
			'flone-ajax-filter',
			$this->root_url . '/ajax-filter.js',
			array('jquery')
		);
	}

	public function register_widgets(){
		require $this->root_dir . '/widgets/class-flone-widget-price-filter.php';
		require $this->root_dir . '/widgets/class-flone-widget-product-categories.php';
		require $this->root_dir . '/widgets/class-flone-widget-product-tag-cloud.php';
		require $this->root_dir . '/widgets/class-flone-widget-layered-nav.php';
		require $this->root_dir . '/widgets/class-flone-widget-rating-filter.php';
		require $this->root_dir . '/widgets/class-flone-widget-reset-filter.php';
		
		register_widget( 'Flone_Widget_Price_Filter' );
		register_widget( 'Flone_Widget_Product_Categories' );
		register_widget( 'Flone_Widget_Product_Tag_Cloud' );
		register_widget( 'Flone_Widget_Layered_Nav' );
		register_widget( 'Flone_Widget_Rating_Filter' );
		register_widget( 'Flone_Widget_Reset_Filters' );
	}
}

new Flone_Ajax_Filter();