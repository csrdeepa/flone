<?php
class Flone_Ajax_Search_Base{
	public $root_url;
	public $root_dir;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->root_url = plugins_url('', __FILE__);
		$this->root_dir = dirname( __FILE__ );

		// enqueue scripts
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_script' ), 15);

		// ajax callback
		add_action( 'wp_ajax_flone_ajax_search_callback', array($this, 'flone_ajax_search_callback' ));
		add_action( 'wp_ajax_nopriv_flone_ajax_search_callback', array($this, 'flone_ajax_search_callback' ));

		// include files
		require $this->root_dir . '/widgets/widget-product-search-ajax.php';

		// register widget
		add_action( 'widgets_init', array($this, 'register_widget'));
	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue_script() {
		wp_enqueue_style(
			'flone-ajax-search',
			$this->root_url . '/css/ajax-search.css'
		);
		wp_enqueue_script(
			'jquery-nicescroll',
			$this->root_url . '/js/jquery.nicescroll.min.js',
			array('jquery')
		);
		wp_enqueue_script(
			'flone-ajax-search',
			$this->root_url . '/js/ajax-search.js',
			array('jquery')
		);

		// localize
		$params = array(
		  'ajaxurl' => admin_url('admin-ajax.php'),
		  'ajax_nonce' => wp_create_nonce('flone_psa_nonce'),
		);
		wp_localize_script( 'flone-ajax-search', 'flone_psa_localize', $params );
	}

	/**
	 * Register Widget
	 */
	function register_widget(){
		register_widget( 'Flone_Product_Search_Ajax_Widget' );
	}

	/**
	 * Ajax Callback method
	 */
	public function flone_ajax_search_callback(){
		?>
		<div class="flone_psa_inner_wrapper" tabindex="9" style="overflow: hidden; outline: none;">
				<div class="flone_single_psa">                                               
					<a href="http://localhost/flone/product/rechargeable-fan/">

										<div class="flone_psa_image">
							<img width="150" height="150" src="http://localhost/flone/wp-content/uploads/2019/03/34-150x150.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" srcset="http://localhost/flone/wp-content/uploads/2019/03/34-150x150.jpg 150w, http://localhost/flone/wp-content/uploads/2019/03/34-455x455.jpg 455w, http://localhost/flone/wp-content/uploads/2019/03/34-100x100.jpg 100w" sizes="(max-width: 150px) 100vw, 150px">				</div>
						
						<div class="flone_psa_content">
							<h3>Rechargeable Fan</h3>
							<p class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>75.00</span></p>
						</div>
					</a>
				</div>

				
				<div class="flone_single_psa">
					<a href="http://localhost/flone/product/yellow-color-chair/">

										<div class="flone_psa_image">
							<img width="150" height="150" src="http://localhost/flone/wp-content/uploads/2019/03/39-150x150.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" srcset="http://localhost/flone/wp-content/uploads/2019/03/39-150x150.jpg 150w, http://localhost/flone/wp-content/uploads/2019/03/39-455x455.jpg 455w, http://localhost/flone/wp-content/uploads/2019/03/39-100x100.jpg 100w" sizes="(max-width: 150px) 100vw, 150px">				</div>
						
						<div class="flone_psa_content">
							<h3>Yellow Color Chair</h3>
							<p class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>80.00</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>45.00</span></ins></p>
						</div>
					</a>
				</div>

				
				<div class="flone_single_psa">
					<a href="http://localhost/flone/product/yellow-round-chair/">

										<div class="flone_psa_image">
							<img width="150" height="150" src="http://localhost/flone/wp-content/uploads/2019/03/44-150x150.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" srcset="http://localhost/flone/wp-content/uploads/2019/03/44-150x150.jpg 150w, http://localhost/flone/wp-content/uploads/2019/03/44-455x455.jpg 455w, http://localhost/flone/wp-content/uploads/2019/03/44-100x100.jpg 100w" sizes="(max-width: 150px) 100vw, 150px">				</div>
						
						<div class="flone_psa_content">
							<h3>Yellow Round Chair</h3>
							<p class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>455.00</span></p>
						</div>
					</a>
				</div>

				</div>
		<?php
		wp_die();
	}
	public function flone_ajax_search_callbackk(){
		$s = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';
		$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;

		check_ajax_referer('flone_psa_nonce', 'nonce');

		$args = array(
		    'post_type'         => 'product',
		    'posts_per_page'    => $limit,
		    's' => $s,
		);
		$query = new WP_Query($args);

		ob_start();
		echo '<div class="flone_psa_inner_wrapper">';

		if($query->have_posts()):
			while($query->have_posts()): $query->the_post();
				$_product = wc_get_product( get_the_id() );
		?>

		<div class="flone_single_psa">
			<a href="<?php the_permalink(  ); ?>">

				<?php if(has_post_thumbnail( get_the_id() )): ?>
				<div class="flone_psa_image">
					<?php the_post_thumbnail('thumbnail'); ?>
				</div>
				<?php endif; ?>

				<div class="flone_psa_content">
					<h3><?php echo wp_trim_words(get_the_title(), 5); ?></h3>
					<?php woocommerce_template_single_price() ?>
				</div>
			</a>
		</div>

		<?php
		    endwhile; // main loop
		    wp_reset_query(); wp_reset_postdata();
		else:
			echo '<p class="text-center flone_psa_wrapper flone_no_result">'. esc_html__( 'No Results Found', 'flone' ) .'</p>';
		endif; // have posts

		echo '</div>';
		echo ob_get_clean();
		die();
	}
}
new Flone_Ajax_Search_Base();