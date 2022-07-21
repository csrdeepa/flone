<?php
class Flone_Widget_Reset_Filters extends WP_Widget {

	/**
	 * Whether or not the widget has been registered yet.
	 *
	 * @since 4.8.1
	 * @var bool
	 */
	protected $registered = false;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$widget_ops  = array(
			'classname'                   => 'flone_widget_reset_filters',
			'description'                 => __( 'Reset Product Filters' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'flone_widget_reset_filters', __( 'Flone: Reset Product Filters' ), $widget_ops);
	}

	/**
	 * Outputs the content for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		$uri = $_SERVER['REQUEST_URI'];
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$url = preg_replace('/\?.*/', '', $url);
		echo $args['before_widget'];
		?>
			<div class="flone-reset-filters-widget_wrapper">
				<a class="flone-reset-filters-button button" href="<?php echo esc_url($url); ?>">Reset All Filters</a>
			</div>
		<?php
		echo $args['after_widget'];
	}
	
}
