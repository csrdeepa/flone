<?php
require get_template_directory() . '/inc/flone-code-base.php';

/**

 * flone functions and definitions

 *

 * @link https://developer.wordpress.org/themes/basics/theme-functions/

 *

 * @package flone

 */
if (!function_exists('flone_setup')) :

    /**

     * Sets up theme defaults and registers support for various WordPress features.

     *

     * Note that this function is hooked into the after_setup_theme hook, which

     * runs before the init hook. The init hook is too late for some features, such

     * as indicating support for post thumbnails.

     */
    function flone_setup() {

        /*

         * Make theme available for translation.

         * Translations can be filed in the /languages/ directory.

         * If you're building a theme based on flone, use a find and replace

         * to change 'flone' to the name of your theme in all the template files.

         */

        load_theme_textdomain('flone', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.

        add_theme_support('automatic-feed-links');

        /*

         * Let WordPress manage the document title.

         * By adding theme support, we declare that this theme does not use a

         * hard-coded <title> tag in the document head, and expect WordPress to

         * provide it for us.

         */

        add_theme_support('title-tag');

        /*

         * Enable support for Post Thumbnails on posts and pages.

         *

         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/

         */

        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.

        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'flone'),
            'extra-header-menu' => esc_html__('Extra header menu, It will show under user icon.', 'flone'),
        ));

        /*

         * Switch default core markup for search form, comment form, and comments

         * to output valid HTML5.

         */

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.

        add_theme_support('custom-background', apply_filters('flone_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.

        add_theme_support('customize-selective-refresh-widgets');

        /**

         * Add support for core custom logo.

         *

         * @link https://codex.wordpress.org/Theme_Logo

         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

        // Add support for Block Styles.

        add_theme_support('wp-block-styles');

        // Add support for editor styles.

        add_theme_support('editor-styles');

        // Enqueue editor styles.

        add_editor_style(array('editor-style.css', flone_google_fonts_url()));

        // image sizes

        add_image_size('flone-270x345', 270, 345, true);

        add_image_size('flone-331x443', 331, 443, true);

        add_image_size('flone-370x443', 331, 443, true);

        add_image_size('flone-455x455', 455, 455, true);
    }

endif;

add_action('after_setup_theme', 'flone_setup');

/**

 * Set the content width in pixels, based on the theme's design and stylesheet.

 *

 * Priority 0 to make it available to lower priority callbacks.

 *

 * @global int $content_width

 */
function flone_content_width() {

    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

    $GLOBALS['content_width'] = apply_filters('flone_content_width', 840);
}

add_action('after_setup_theme', 'flone_content_width', 0);


 add_action( 'woocommerce_share', 'misha_after_add_to_cart_btn' );
 
function misha_after_add_to_cart_btn(){
    echo do_shortcode( '[pvc_stats postid="" increase="1" show_views_today="1"]' );

}

/**

 * Register widget area.

 *

 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar

 */
function flone_widgets_init() {

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'flone'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'flone'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Shop Sidebar ', 'flone'),
        'id' => 'sidebar-shop',
        'description' => esc_html__('Add widgets here.', 'flone'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    // footer widgets

    $footer_columns = flone_get_option('footer_columns', '4');

    for ($i = 1; $i <= $footer_columns; $i++) {

        register_sidebar(array(
            'name' => esc_html__('Footer Widget ' . $i, 'flone'),
            'id' => 'footer-' . $i,
            'description' => esc_html__('Add widgets here.', 'flone'),
            'before_widget' => '<div id="%1$s" class="footer-widget mb-30 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="footer-title"><h2 class="widget-title">',
            'after_title' => '</h2></div>',
        ));
    }
}

add_action('widgets_init', 'flone_widgets_init');

/**

 * Register google fonts.

 */
function flone_google_fonts_url() {

    $font_url = '';

    /*

      Translators: If there are characters in your language that are not supported

      by chosen font(s), translate this to 'off'. Do not translate into your own language.

     */

    if ('off' !== _x('on', 'Google font: on or off', 'flone')) {

        $font_url = add_query_arg('family', urlencode('Poppins:300,400,500,600,700,800,900|Cormorant Garamond:300i,400,400i,500,500i,600,600i,700&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
    }

    return $font_url;
}

/**

 * Enqueue scripts and styles.

 */
function flone_scripts() {



    // Load Google fonts

    wp_enqueue_style('flone-google-fonts', flone_google_fonts_url());

    // Load Bootstrap file

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true);

    // load pixeden icons

    wp_enqueue_style('pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array(), null);

    // load fontawesome icons

    $elementor_version = get_option('elementor_version');

    if (version_compare($elementor_version, '2.6.0', '<')) {

        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesomee.min.css', array(), '4.5.0');
    } else {

        wp_enqueue_style('elementor-icons-shared-0');

        wp_enqueue_style('elementor-icons-fa-solid');

        wp_enqueue_style('elementor-icons-fa-regular');

        wp_enqueue_style('elementor-icons-fa-brands');
    }



    // Load Meanenu files

    wp_enqueue_script('meanmenu', get_template_directory_uri() . '/assets/js/meanmenu.js', array('jquery'), '2.0.8', true);

    // load jquery js

    wp_enqueue_script('jquery');

    // load jquery ui files

    wp_enqueue_script('jquery-ui-slider');

    wp_enqueue_script('jquery-ui-widget');

    wp_enqueue_script('jquery-ui-button');

    // Jquery & style package

    wp_enqueue_script('jquery-package', get_template_directory_uri() . '/assets/js/jquery-package.js', array('jquery'), '1.0.0', true);

    wp_enqueue_style('style-package', get_template_directory_uri() . '/assets/css/style-package.css', array(), '4.0.0');

    // Load Owl Carousel files

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.2.1');

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.2.1', false);

    // Load theme main css

    wp_enqueue_style('flone-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');

    // Load gutenberg blocks css
    wp_enqueue_style('flone-blocks', get_template_directory_uri() . '/assets/css/blocks.css', array(), '1.0.0');

    // Load responsive css
    wp_enqueue_style('flone-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0.0');

    // Load theme style
    wp_enqueue_style('flone-style', get_stylesheet_uri());

    // Load back to top js
    if (flone_get_option('enable_backto_top', '1') == '1') {

        wp_enqueue_script('jquery-scrollUp', get_template_directory_uri() . '/assets/js/jquery.scrollUp.min.js', array('jquery'), '2.4.1', true);
    }


    // Load images loaded js
    wp_enqueue_script('imagesloaded');

    // Load theme main js
    wp_enqueue_script('flone-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    // Load nagivation js
    wp_enqueue_script('flone-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }


    // localization of this theme
    $flone_localize_vars = array();
    $flone_localize_vars['ajaxurl'] = esc_url(admin_url('admin-ajax.php'));
    wp_localize_script("flone-main", "flone_localize_vars", $flone_localize_vars);
}

add_action('wp_enqueue_scripts', 'flone_scripts');

/**

 * Enqueue styles for the block-based editor.

 */
function flone_block_editor_styles() {

    // Block styles.

    wp_enqueue_style('flone-block-editor-style', get_template_directory_uri() . '/assets/css/editor-blocks.css', array(), '1.0.0');

    // Add custom fonts.

    wp_enqueue_style('flone-fonts', flone_google_fonts_url());
}

add_action('enqueue_block_editor_assets', 'flone_block_editor_styles');

/**

 * Enqueue admin scripts and styles.

 */
function flone_admin_scripts() {

    wp_enqueue_media();

    wp_enqueue_script('flone-admin', get_template_directory_uri() . '/assets/js/flone-admin.js', array('jquery'), '', true);

    wp_enqueue_style('flone-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0.0');

    wp_enqueue_script('site-logo-uploader', get_template_directory_uri() . '/assets/js/site-logo-uploader.js', false, '', true);
}

add_action('admin_enqueue_scripts', 'flone_admin_scripts');


/**

 * load  helper functions

 */
require get_template_directory() . '/inc/helper-functions.php';

/**

 * Implement the Custom Header feature.

 */
require get_template_directory() . '/inc/custom-header.php';

/**

 * Custom template tags for this theme.

 */
require get_template_directory() . '/inc/template-tags.php';

/**

 * Functions which enhance the theme by hooking into WordPress.

 */
require get_template_directory() . '/inc/template-functions.php';

/**

 * Customizer additions.

 */
require get_template_directory() . '/inc/customizer.php';

/**

 * Load Jetpack compatibility file.

 */
if (defined('JETPACK__VERSION')) {

    require get_template_directory() . '/inc/jetpack.php';
}



/**

 * Load WooCommerce compatibility file.

 */
if (class_exists('WooCommerce')) {

    require get_template_directory() . '/inc/woocommerce.php';
}



/**

 * Load TGM plugins

 */
require get_template_directory() . '/inc/libs/tgm-plugin/init.php';

/**

 * Load theme options

 */
if (class_exists('ReduxFrameworkPlugin')) {

    require get_template_directory() . '/inc/theme-option-init.php';
}



/**

 * Load demo importer

 */
require get_template_directory() . '/inc/demo-importer.php';

/**

 * Dynamic Style

 */
function flone_inline_css() {

    $custom_css = array();

    $primary_color = flone_get_option('primary_color');

    $secondary_color = flone_get_option('secondary_color');

    $menu_default_color = flone_get_option('menu_default_color');

    $sticky_menu_default_color = flone_get_option('sticky_menu_default_color');

    $link_color = flone_get_option('link_color');

    $link_hover_color = flone_get_option('link_hover_color');

    $site_padding = flone_get_option('site_padding');

    $site_content_pt = flone_get_option('site_content_pt');

    $site_content_pb = flone_get_option('site_content_pb');

    $footer_icon_color = flone_get_option('footer_icon_color');

    $footer_icon_hover_color = flone_get_option('footer_icon_hover_color');

    // custom header bg

    if (function_exists('get_header_image') && get_header_image()) {

        $header_image = get_header_image();

        $custom_css[] = ".breadcrumb-area{

			background-image:url($header_image);

			background-size:cover;

			background-position:center center;

		}";
    }





    if ($primary_color) {

        $custom_css[] = "

		   #scrollUp,

		   .product-wrap .product-img .product-action > div,

		   .main-menu nav ul li ul.sub-menu li a::before,

		   .main-menu nav ul li ul.mega-menu > li ul li:hover a::before,

		   .header-right-wrap .same-style.header-search .search-content form .button-search,

		   .woocommerce span.onsale,

		   .btn-hover a::after,

		   .single_add_to_cart_button::after,

		   .entry-content a.readmore,

		   .widget-area .tagcloud a:hover,

		   .woocommerce nav.woocommerce-pagination ul.page-numbers li .page-numbers.current,

		   .pagination ul.page-numbers li .page-numbers.current,

		   .entry-content .page-links .post-page-numbers.current,

		   .woocommerce nav.woocommerce-pagination ul.page-numbers li a:hover,

		   .pagination ul.page-numbers li a:hover,

		   .entry-content .page-links .post-page-numbers:hover,

		   .comment-form .form-submit input[type=\"submit\"],

		   .woocommerce nav.woocommerce-pagination ul.page-numbers li a.prev:hover,

		   .woocommerce nav.woocommerce-pagination ul.page-numbers li a.next:hover,

		   .btn-hover a::after,

		   .single_add_to_cart_button::after,

		   .btn--1:hover,

		   .woocommerce a.button:hover,

		   .contact-form .contact-form-style .btn--1:hover,

		   .has-post-thumbnail .post_category a:hover,

		   .post-password-form input[type=\"submit\"]:hover,

		   .cart-shiping-update-wrapper .cart-shiping-update>a:hover,

		   .woocommerce .cart .actions .button:hover,

		   .cart-shiping-update-wrapper .cart-clear>button:hover,

		   .cart-shiping-update-wrapper .cart-clear>a:hover,

		   .woocommerce #respond input#submit:hover,

		   .woocommerce a.button:hover,

		   .woocommerce button.button:hover,

		   .woocommerce input.button:hover,

		   .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,

		   .woocommerce a.button.alt:hover,

		   .shop-list-wrap .shop-list-content .shop-list-btn a.wc-forward:hover,

		   .order-button-payment input,

		   .woocommerce #payment #place_order,

		   .woocommerce-page #payment #place_order,

		   .widget_calendar tbody td#today,

		   .entry-content .wp-block-file .wp-block-file__button:hover,

		   .blog-wrap .blog-img span.purple,.blog-wrap .blog-img span.pink,

		   .woo-variation-swatches-stylesheet-enabled.woo-variation-swatches-style-squared .variable-items-wrapper .variable-item.button-variable-item:hover,

		   .woocommerce-noreviews,

		   p.no-comments,

		   .woocommerce #review_form #respond .form-submit input:hover,

		   .elementor-inner ul.woocommerce-widget-layered-nav-list li:hover span,

		   .woocommerce-widget-layered-nav ul li:hover span,

		   .flone-preloader span,

		   .slinky-theme-default .back::before,

		   .sidebar-menu nav ul li ul.sub-menu li a::before,

		   .product-wrap-2 .product-img .product-action-2 a,

		   .main-menu nav ul li ul.mega-menu>li ul li a::before,

		   .sidebar-menu nav ul li ul.mega-menu>li ul li a::before,

		   .nav-style-2.owl-carousel>.owl-nav div:hover,

		   .product-wrap-3 .product-content-3-wrap .product-content-3 .product-action-3 a,

		   .nav-style-3.owl-carousel>.owl-nav div:hover,

		   .product-wrap-5 .product-action-4,.reply a,.subscribe-style-3 .subscribe-form-3 .clear-2 input:hover,.btn-hover a::after, .single_add_to_cart_button::after,.entry-content .wp-block-button .wp-block-button__link:hover{

		            background-color: {$primary_color};

		    }";

        // primary color for text

        $custom_css[] = "

	        .main-menu nav ul li:hover a,

	        .entry-title a:hover,

	        article .post-meta .post-author::before,

	        .main-menu nav ul li ul.sub-menu li a:hover,

	        .main-menu nav ul li ul.mega-menu > li ul li a:hover,

	        .header-right-wrap .same-style:hover > a,

	        .header-right-wrap .same-style .account-dropdown ul li a:hover,

	        article .post-meta a:hover,

	        article .post-meta .posted-on::before,

	        article .post-meta .post-category:before,

	        .widget-area a:hover,

	        .entry-content a:hover,

	        .comment-content a,

	        .woocommerce-message::before,

	        .woocommerce nav.woocommerce-pagination ul.page-numbers li a,

	        .pagination ul.page-numbers li a,

	        .entry-content .page-links .post-page-numbers,

	        .entry-footer a:hover,

	        .comment-form .logged-in-as a:hover,

	        .woocommerce nav.woocommerce-pagination ul.page-numbers li a.prev,

	        .woocommerce nav.woocommerce-pagination ul.page-numbers li a.next,

	        .shop-list-wrap .shop-list-content h3 a:hover,

	        .breadcrumb-content ul li a:hover,

	        .woocommerce .cart-table-content table tbody>tr td.product-name a:hover,

	        .pro-sidebar-search-form button:hover,

	        .woocommerce-info::before,

	        .woocommerce .your-order-table table tr.order-total td span,

	        .header-right-wrap .same-style.cart-wrap:hover > button,

	        .woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,

	        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,

	        .product .entry-summary .pro-details-social ul li a:hover,

	        .product .entry-summary .product_meta a:hover,

	        .modal-dialog .modal-header .close:hover,

	        .header-right-wrap .same-style.cart-wrap .shopping-cart-content ul li .shopping-cart-delete a,

	        .footer_style_2 .footer-widget.widget_nav_menu ul li a:hover,

	        .footer-widget .subscribe-form input[type=\"submit\"]:hover,

	        .nav-style-1.owl-carousel .owl-nav div:hover,

	        p.stars:hover a::before,

	        .sidebar-menu nav ul li:hover a,

	        .clickable-mainmenu .clickable-menu-style ul li a:hover,

	        .clickable-menu a:hover,

	        .sidebar-menu nav ul li ul.sub-menu li a:hover,

	        .single-banner .banner-content a:hover,

	        .sidebar-menu nav ul li ul.mega-menu>li ul li a:hover,

	        .header-hm-7.stick .clickable-menu a:hover,

	        .clickable-mainmenu .clickable-mainmenu-icon button:hover,

			.main-menu nav ul li ul.mega-menu>li ul li a::after,.main-menu nav ul li ul.sub-menu li a::after,

			#primary-menu .menu-item-has-children:hover::after,

			.mean-container .mean-nav ul li a:hover,

	        .widget-area li.current-cat a,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button span.count-style,.header_style_4 .main-menu.menu-white nav ul li:hover>a,.flone_header_4 #primary-menu .menu-item-has-children:hover::after,.header-right-wrap.header-right-wrap-white .same-style>a:hover,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button:hover,.filter-active a:hover,.product .entry-summary a.woocommerce-review-link,p.stars.selected a:not(.active):before,p.stars.selected a.active:before,.product-rating i.yellow,.language-currency-wrap .same-language-currency:hover>a,.language-currency-wrap .same-language-currency .lang-car-dropdown ul li a:hover,.entry-content a,.language-currency-wrap .same-language-currency:hover a i, .comment-content a,.comment-list .comment-metadata a,.comment-list .comment-metadata a:hover,.comment-list .comment-metadata a.comment-edit-link:hover,.header-right-wrap .same-style.cart-wrap .shopping-cart-content ul li .shopping-cart-title h4 a:hover,.product-wrap-2 .product-content-2 .title-price-wrap-2 h3 a:hover,.product-wrap-2 .product-content-2 .pro-wishlist-2 a:hover,.product-wrap .product-content a:hover h2,.collection-product .collection-content h4 a:hover, .collection-product .collection-content a h2:hover,.product-wrap-5 .product-content-5 h3 a:hover,.copyright p a:hover{

	                color: {$primary_color};

	        }";

        // primary color for border

        $custom_css[] = "

	        .btn-hover a:hover,

	        .single_add_to_cart_button:hover,

	        blockquote,

	        .shop-list-wrap .shop-list-content .shop-list-btn a:hover,

	        .woocommerce-info,

	        .woocommerce-message,

	        .wp-block-quote:not(.is-large):not(.is-style-large),

	        .footer-widget .subscribe-form input[type=\"submit\"]:hover,

	        .widget-area .tagcloud a:hover,

	        .slider-content-2 .slider-btn a:hover,

	        .single-banner .banner-content a:hover,

	        .slider-content-3 .slider-btn a:hover,

	        .slider-content-7 .slider-btn-9 a:hover,

	        .lds-ripple div:nth-child(1), .lds-ripple div:nth-child(2),

	        .single-slider .slider-content .slider-btn a:hover,body.woo-variation-swatches-stylesheet-enabled .variable-items-wrapper .variable-item:not(.radio-variable-item).selected, .woo-variation-swatches-stylesheet-enabled .variable-items-wrapper .variable-item:not(.radio-variable-item).selected:hover,.funfact-content .funfact-btn a:hover,.view-more a:hover{

	                border-color: {$primary_color};

	        }";
    }





    if ($secondary_color) {

        // bg color

        $custom_css[] = "

	        .blog-wrap .blog-img span.pink,

	        .woocommerce span.onsale.pink,

	        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,

	        .product-wrap-2 .product-img .product-action-2 a:hover,

	        .product-wrap-3 .product-content-3-wrap .product-content-3 .product-action-3 a:hover,

	        .product-wrap .product-img .product-action>div:hover,.quickview .single_add_to_cart_button::after,

	        .product-wrap-5 .product-action-4 .pro-same-action a:hover{

	                background-color: {$secondary_color};

	        }";

        // color

        $custom_css[] = "

	        .shop-top-bar .shop-tab li a.active,

	        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a::before,

	        .product-wrap-5 .yith-wcwl-wishlistexistsbrowse.show a i{

	            color: {$secondary_color};

	        }";

        // border color

        $custom_css[] = "

         .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.shop-list-wrap .shop-list-content .shop-list-btn a:hover{

             border-color: {$secondary_color};

         }";
    }



    //Menu Color

    if ($menu_default_color) {

        // color

        $custom_css[] = "

	        .main-menu nav ul li>a, #primary-menu .menu-item-has-children::after,.sidebar-menu nav ul li a,.home-sidebar-left .sidebar-copyright p,.header-right-wrap .same-style>a,.header-right-wrap .same-style.cart-wrap button,.flone_header_4 .main-menu.menu-white nav > ul > li>a, .flone_header_4 #primary-menu .menu-item-has-children::after,.header-right-wrap.header-right-wrap-white .same-style>a,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button{

	            color: {$menu_default_color};

	        }";

        // border color

        $custom_css[] = "

         .mean-container a.meanmenu-reveal{

             border-color: {$menu_default_color};

         }";

        // bg color

        $custom_css[] = "

	        .mean-container a.meanmenu-reveal span,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button span.count-style{

	                background: {$menu_default_color};

	        }";
    }



    //Sticky Menu Color

    if ($sticky_menu_default_color) {

        // color

        $custom_css[] = "

	        .stick .main-menu nav ul li>a, .stick #primary-menu .menu-item-has-children::after,.stick .header-right-wrap .same-style>a,.stick .header-right-wrap .same-style.cart-wrap button,.stick .mean-container a.meanmenu-reveal{

	            color: {$sticky_menu_default_color};

	        }";

        // border color

        $custom_css[] = "

         .stick .mean-container a.meanmenu-reveal{

             border-color: {$sticky_menu_default_color};

         }";

        // bg color

        $custom_css[] = "

	        .stick .mean-container a.meanmenu-reveal span{

	                background: {$sticky_menu_default_color};

	        }";
    }



    // link color

    if ($link_color) {

        $custom_css[] = "

	        .product .entry-summary .variations_form.cart .reset_variations{

	            color: {$link_color};

	        }";
    }



    // link hover color

    if ($link_hover_color) {

        $custom_css[] = "

	        .product .entry-summary .pro-details-social ul li a:hover,

	        .product .entry-summary .product_meta a:hover{

	           color: {$link_hover_color};

	        }";
    }



    // site padding

    if ($site_padding) {

        $custom_css[] = ".site{padding: {$site_padding }px}";
    }



    // site content padding

    if ($site_content_pt && $site_content_pt['padding-top']) {

        $custom_css[] = ".site-content{padding-top: {$site_content_pt['padding-top']}}";
    }

    if ($site_content_pb && $site_content_pb['padding-bottom']) {

        $custom_css[] = ".site-content{padding-bottom: {$site_content_pb['padding-bottom']}}";
    }



    // disable product image zoom

    if (!flone_get_option('enable_image_zoom', '1')) {

        $custom_css[] = ".single-product .zoomContainer{display:none}";
    }



    // footer icon color

    if ($footer_icon_color) {

        $custom_css[] = ".footer-top .footer-social ul li::before{background-color:$footer_icon_color}";

        $custom_css[] = ".footer-top .footer-social ul li a, .footer-top .footer-social ul li a i{color:$footer_icon_color}";
    }



    // footer icon color

    if ($footer_icon_hover_color) {

        $custom_css[] = ".footer-top .footer-social ul li a:hover i{color:$footer_icon_hover_color}";
    }



    wp_add_inline_style('flone-style', implode('', $custom_css));
}

add_action('wp_enqueue_scripts', 'flone_inline_css');

class FloneWooCommerce {

    public $plugin_file = __FILE__;
    public $responseObj;
    public $licenseMessage;
    public $showMessage = false;
    public $slug = "flone";

    function __construct() {

        // main admin menu

        add_action('admin_menu', [$this, 'main_admin_menu']);

        add_action('admin_print_styles', [$this, 'SetAdminStyle']);

        $licenseKey = get_option("FloneWooCommerce_lic_Key", "");

        $liceEmail = get_option("FloneWooCommerce_lic_email", "");

        if (FloneWooCommerceBase::CheckWPPlugin($licenseKey, $liceEmail, $this->licenseMessage, $this->responseObj, dirname(__FILE__) . "/style.css")) {

            add_action('admin_menu', [$this, 'ActiveAdminMenu']);

            add_action('admin_post_FloneWooCommerce_el_deactivate_license', [$this, 'action_deactivate_license']);

            //$this->licenselMessage=$this->mess;
        } else {

            if (!empty($licenseKey) && !empty($this->licenseMessage)) {

                $this->showMessage = true;
            }

            update_option("FloneWooCommerce_lic_Key", "") || add_option("FloneWooCommerce_lic_Key", "");

            add_action('admin_post_FloneWooCommerce_el_activate_license', [$this, 'action_activate_license']);

            add_action('admin_menu', [$this, 'InactiveMenu']);

            add_action('admin_head', array($this, 'dismiss'));

            add_action('switch_theme', array($this, 'update_dismiss'));

            add_action('admin_notices', [$this, 'flone_license_notice']);

            add_filter('admin_body_class', [$this, 'modify_admin_body_class']);
        }
    }

    public function dismiss() {

        if (isset($_GET['flone-dismiss']) && check_admin_referer('flone-dismiss-' . get_current_user_id())) {

            update_user_meta(get_current_user_id(), 'flone_dismissed_notice_id', 1);
        }
    }

    public function update_dismiss() {

        delete_metadata('user', null, 'flone_dismissed_notice_id', null, true);
    }

    function flone_license_notice() {

        if (get_user_meta(get_current_user_id(), 'flone_dismissed_notice_id', true)) {

            return;
        }



        $button = sprintf('<a href="%1s" class="button button-primary">%2s</a>',
                admin_url('admin.php?page=' . $this->slug),
                __('Activate License', 'flone')
        );
        ?>

        <div class="notice flone-notice notice-warning">

            <strong><?php echo esc_html__('Welcome to Flone!', 'flone'); ?></strong>

            <p><?php echo esc_html__('Please activate your license/purchase code to get automatic theme updates.', 'flone'); ?></p>

            <div><?php echo wp_kses_post($button); ?></div>

            <a href="<?php echo esc_url(wp_nonce_url(add_query_arg('flone-dismiss', 'dismiss_admin_notices'), 'flone-dismiss-' . get_current_user_id())); ?>">

                <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>

            </a>

        </div>
        <?php
    }

    function main_admin_menu() {

        add_menu_page(esc_html__("Flone WooCommerce", "flone"), esc_html__("Flone WP", 'flone'), 'activate_plugins', $this->slug, [$this, "option_page"], " dashicons-admin-generic ", 85);
    }

    function option_page() {

        return '';
    }

    function SetAdminStyle() {

        wp_register_style("FloneWooCommerceLic", get_theme_file_uri("lic_style.css"), 10);

        wp_enqueue_style("FloneWooCommerceLic");
    }

    function ActiveAdminMenu() {

        add_submenu_page("flone", esc_html__("FloneWooCommerce", "flone"), esc_html__("Flone License", 'flone'), 'activate_plugins', $this->slug, [$this, "Activated"]);
    }

    function InactiveMenu() {

        add_submenu_page("flone", esc_html__("FloneWooCommerce", "flone"), esc_html__("Flone License", 'flone'), 'activate_plugins', $this->slug, [$this, "LicenseForm"]);
    }

    function action_activate_license() {

        check_admin_referer('el-license');

        $licenseKey = !empty($_POST['el_license_key']) ? $_POST['el_license_key'] : "";

        $licenseEmail = !empty($_POST['el_license_email']) ? $_POST['el_license_email'] : "";

        update_option("FloneWooCommerce_lic_Key", $licenseKey) || add_option("FloneWooCommerce_lic_Key", $licenseKey);

        update_option("FloneWooCommerce_lic_email", $licenseEmail) || add_option("FloneWooCommerce_lic_email", $licenseEmail);

        wp_safe_redirect(admin_url('admin.php?page=' . $this->slug));
    }

    function action_deactivate_license() {

        check_admin_referer('el-license');

        if (FloneWooCommerceBase::RemoveLicenseKey(__FILE__, $message)) {

            update_option("FloneWooCommerce_lic_Key", "") || add_option("FloneWooCommerce_lic_Key", "");
        }

        wp_safe_redirect(admin_url('admin.php?page=' . $this->slug));
    }

    function Activated() {
        ?>

        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">

            <input type="hidden" name="action" value="FloneWooCommerce_el_deactivate_license"/>

            <div class="el-license-container">

                <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php echo esc_html__("Flone WooCommerce Theme License Info", "flone"); ?></h3>

                <hr>

                <ul class="el-license-info">

                    <li>

                        <div>

                            <span class="el-license-info-title"><?php echo esc_html__("Status", "flone"); ?></span>



                            <?php if ($this->responseObj->is_valid) : ?>

                                <span class="el-license-valid"><?php echo esc_html__("Valid", "flone"); ?></span>

                            <?php else : ?>

                                <span class="el-license-valid"><?php echo esc_html__("Invalid", "flone"); ?></span>

                            <?php endif; ?>

                        </div>

                    </li>



                    <li>

                        <div>

                            <span class="el-license-info-title"><?php echo esc_html__("License Type", "flone"); ?></span>

                            <?php echo $this->responseObj->license_title; ?>

                        </div>

                    </li>



                    <li>

                        <div>

                            <span class="el-license-info-title"><?php echo esc_html__("License Expired on", "flone"); ?></span>

                            <?php echo $this->responseObj->expire_date; ?>

                        </div>

                    </li>



                    <li>

                        <div>

                            <span class="el-license-info-title"><?php echo esc_html__("Support Expired on", "flone"); ?></span>

                            <?php echo $this->responseObj->support_end; ?>

                        </div>

                    </li>

                    <li>

                        <div>

                            <span class="el-license-info-title"><?php echo esc_html__("Your License Key", "flone"); ?></span>

                            <span class="el-license-key"><?php echo esc_attr(substr($this->responseObj->license_key, 0, 9) . "XXXXXXXX-XXXXXXXX" . substr($this->responseObj->license_key, -9)); ?></span>

                        </div>

                    </li>

                </ul>

                <div class="el-license-active-btn">

                    <?php wp_nonce_field('el-license'); ?>

                    <?php submit_button('Deactivate'); ?>

                </div>

            </div>

        </form>

        <?php
    }

    function LicenseForm() {
        ?>

        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">

            <input type="hidden" name="action" value="FloneWooCommerce_el_activate_license"/>

            <div class="el-license-container">

                <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php echo esc_html__("Flone WooCommerce Theme Licensing", "flone"); ?></h3>

                <hr>

                <?php
                if (!empty($this->showMessage) && !empty($this->licenseMessage)) {
                    ?>

                    <div class="notice notice-error is-dismissible">

                        <p><?php echo ($this->licenseMessage); ?></p>

                    </div>

                    <?php
                }
                ?>

                <div class="el-license-field">

                    <label for="el_license_key"><?php echo esc_html__("Purchase Code / License Key", "flone"); ?></label>

                    <input type="text" class="regular-text code" name="el_license_key" size="50" placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx" required="required">

                </div>

                <div class="el-license-field">

                    <label for="el_license_key"><?php echo esc_html__("Email Address", "flone"); ?></label>

                    <?php
                    $purchaseEmail = get_option("FloneWooCommerce_lic_email", get_bloginfo('admin_email'));
                    ?>

                    <input type="text" class="regular-text code" name="el_license_email" size="50" value="<?php echo $purchaseEmail; ?>" placeholder="" required="required">

                    <div><small><?php echo esc_html__("We will send update news of this product by this email address, don't worry, we hate spam", "flone"); ?></small></div>

                </div>

                <div class="el-license-active-btn">

                    <?php wp_nonce_field('el-license'); ?>

                    <?php submit_button('Activate'); ?>

                </div>

            </div>

        </form>

        <?php
    }

    function modify_admin_body_class($classes) {

        $classes .= 'flone_license_deactive';

        return $classes;
    }

}

new FloneWooCommerce();

add_action('wp_head', 'remove_post_list_title_links');

function remove_post_list_title_links() {
    ?>
    <script id="remove-links-in-title" type="text/javascript">
        jQuery(document).ready(function ($) {
            $('.entry-title').each(function () {
                var $title_link = $('a[rel="bookmark"]', $(this)),
                        $title_text = $title_link.text();
                $title_link.remove();
                $(this).prepend($title_text);
            });
        });
    </script>
    <?php
}

//footer widget
//Footer widget

add_filter('woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text');

function wcc_change_breadcrumb_home_text($defaults) {
    // Change the breadcrumb home text from 'Home' to 'Apartment'
    $defaults['home'] = '';
    return $defaults;
}

add_filter('woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text', 10, 2);

function woo_custom_cart_button_text($button_text, $product) {
    global $woocommerce;
    $symbol = get_woocommerce_currency_symbol();
    return 'Add to Bag  ' . $symbol . ' ' . $product->get_price();
}

// add_action ('woocommerce_before_main_content' , 'promotional_banner',99);
// function promotional_banner() {
//   echo  '
//   <div class="col-lg-12">
// 	<div class="bg-yellow beauty-sec mb-60">
// 		<div class="row">
// 			<div class="col-lg-9 align-self-center">
// 				<div class="p-30"><h2 class="elementor-heading-title elementor-size-default">Beauty inspired by real life.</h2><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod<br>tincidunt ut laoreet dolore magna aliquam erat volutpat.</p></div>
// 			</div>
// 			<div class="col-lg-3 text-right align-self-center">
// 				<div class="p-20"><img src="'.site_url().'/wp-content/uploads/2020/07/Group-13.png" title="Group 13" alt="Group 13"></div>
// 			</div>
// 		</div>
// 	</div>
//   </div>';
// }


add_action('woocommerce_after_single_product', 'productdetailspage_faq');

function productdetailspage_faq() {
    global $product;
    $product_id = $product->get_id();

    $faq_count = get_post_meta($product_id, 'faq_qus', true);
$html='';
    if ($faq_count > 0) {
        $html = '<div class="pt-60">
				<div class="faq-sec">
					<div class="related-product text-center">
						<img src="' . site_url() . '/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
						<h2 class="mb-40">FAQs</h2>
					</div>
					<div clas="">
						<div class="accordion" id="accordionExample">';

        for ($i = 0; $i < $faq_count; $i++) {

            $questions = get_post_meta($product_id, 'faq_qus_' . $i . '_questions', true);
            $answer = get_post_meta($product_id, 'faq_qus_' . $i . '_answer', true);

            $html .= '<div class="card">
					<div class="card-head" id="headingOne' . $i . '">
						<h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne' . $i . '" aria-expanded="true" aria-controls="collapseOne' . $i . '">' . $questions . '
						</h2>
					</div>

					<div id="collapseOne' . $i . '" class="collapse" aria-labelledby="headingOne' . $i . '" data-parent="#accordionExample">
						<div class="card-body">
							<p>' . $answer . '</p>
						</div>
					</div>
				</div>';
        }
    }

    // echo $html;

    echo '<div class="delivery-details pt-30 pb-30 ship-sec text-center position-relative mt-80">
			<div class="row">
				<!--<div class="col-lg-3">
					<img src="' . site_url() . '/wp-content/uploads/2020/07/shopping-cart-1.svg" alt="">
					<h5><span style="font-weight: normal;">Free Shipping</span></h5>
					<p>On Order Above Rs. 399</p>
				</div>
				<div class="col-lg-3">
					<img src="' . site_url() . '/wp-content/uploads/2020/07/money.svg" alt="">
					<h5><span style="font-weight: normal;">COD Available</span></h5>
					<p>@ Rs. 40 On Per Order</p>
				</div>-->
				<div class="col-lg-6">
					<img src="' . site_url() . '/wp-content/uploads/2022/06/gmail-1.png" alt="">
					<h5><span style="font-weight: normal;">admin@lakshmikrishnanaturals.com</span></h5>
					<p>Have query? Mail us.</p>
				</div>
				<div class="col-lg-6">
					<img src="' . site_url() . '/wp-content/uploads/2022/06/whatsapp-1.png" alt="">
					<h5><span style="font-weight: normal;">+91 79046 97609 (whatsapp only)</span></h5>
					<p>24/7 available</p>
				</div>
			</div>
		</div>
';
}

add_action ('woocommerce_after_single_product_summary' , 'productdetailspage_tab_after');
function productdetailspage_tab_after()
{
$html='';
	global $product;
	$productid = $product->get_id();

	// direction of use
	$videolink = get_post_meta($productid,'direction_of_us',true);
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $productid), 'single-post-thumbnail' );

	$stepscount = get_post_meta($productid,'direction_of_usage_steps',true);
	// direction_of_usage_steps
	// $img = $image[0];
	// direction of use


		$image1 = wp_get_attachment_image_src( get_post_meta($productid,'ingredients_image',true), 'single-post-thumbnail' );
		
		$image2 = wp_get_attachment_image_src( get_post_meta($productid,'ingredients_image_1',true), 'single-post-thumbnail' );

		$image3 = wp_get_attachment_image_src( get_post_meta($productid,'ingredients_image_2',true), 'single-post-thumbnail' );
		$image4 = wp_get_attachment_image_src( get_post_meta($productid,'ingredients_image_3',true), 'single-post-thumbnail' );

		$details1 = get_post_meta($productid,'ingredients_details',true);
		$details2 = get_post_meta($productid,'ingredients_details_1',true);
		$details3 = get_post_meta($productid,'ingredients_details_2',true);
		$details4 = get_post_meta($productid,'ingredients_details_3',true);


		$_ingredients_ = get_post_meta($productid,'_ingredients_',true);

		if($_ingredients_ >0)
		{
			for ($i=0; $i < $_ingredients_ ; $i++) { 
				
				$ingredients = get_post_meta($productid,'_ingredients__'.$i.'_details',true);
				$_ingredients[] = $ingredients;
			}
			
		}
		else
			$ingredients =array();


		$_keyingredients = get_post_meta($productid,'_keyingredients',true);

		if($_keyingredients >0)
		{
			for ($i=0; $i < $_keyingredients ; $i++) { 
				// $_keyingredients_img = get_post_meta($products->ID,'_keyingredients_'.$i.'_ingredients_image',true);
				// _keyingredients_0__ingredients_image
$img = wp_get_attachment_image_src(get_post_meta($productid,'_keyingredients_'.$i.'__ingredients_image',true), 'full');
			$_keyingredients_['image'] =$img[0];
			$_keyingredients_['details'] = get_post_meta($productid,'_keyingredients_'.$i.'__ingredients_details',true);
			$_keyingredient[] = $_keyingredients_;
			}
		}
		else
			$_keyingredient =array();
			$benifits = get_post_meta($productid,'benifits',true);
 
		if($benifits >0)
		{
			for ($i=0; $i < $benifits ; $i++) { 
				
				$benifit = get_post_meta($productid,'benifits_'.$i.'_lists',true);
				$benifit_title = get_post_meta($productid,'benifits_'.$i.'_title_benefits',true);
				$benifit_image = wp_get_attachment_image_src(get_post_meta($productid,'benifits_'.$i.'_benefits_image',true), 'full');
				$_benifits[$i]['list'] = $benifit;
				$_benifits[$i]['title'] = $benifit_title;
				$_benifits[$i]['image'] = $benifit_image[0];
				
			}
		}
		else
			$_benifits =array();

	$html .=
	       
		 '<div class="pink-lipstick pt-80 pb-80">
			<div class="related-product ">
				<img src="'.site_url().'/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
				<h2 class="mb-40">Benefits Of '.ucfirst(strtolower(get_the_title($productid))).'</h2>
			</div>
			
			<div class="container mb-5">
			    <div class="row  ">';
			    
			        foreach ($_benifits as $_benifitskey => $_benifitsvalue) 
				    {
    			       $html.=' <div class="col-lg-4 mb-4">
                              <div class="col-lg-12 text-center border p-3 hr-border h-100" style=" background-color:#f4f4f4;">
                                
    			                <h5 class="mb-3" style="text-transform: capitalize;">'.$_benifitsvalue['title'].'</h5>
    			                <img src="'.$_benifitsvalue['image'].'" class="mb-3 rounded-circle" style="height: 120px;width: 120px;object-fit: cover;">
    			                <hr style="width: 92px;border: none;border-top: 1px solid #a1a1a1 !important;">
    			                <p class="mb-3">'.$_benifitsvalue['list'].'</p>
                              </div>
                        </div>';
				    }
			   $html .='</div>
		    </div>
			
			
		</div>';

		// $others['skin_type'] =  get_post_meta($products->ID,'skin_type',true);
		$html .='
		<div class="skin-type pt-80 pb-80">
			<div class="related-product text-center">
				<img src="'.site_url().'/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
				<h2 class="mb-40">Skin Type / Hair Type</h2>
			</div>
			<div class="row text-center">
				<div class="col-lg-8 offset-lg-2">
					<div class="">
						'.get_post_meta($productid,'skin_type',true).'
					</div>
				</div>
			</div>
		</div>';

			// $others['disclaimer'] =  get_post_meta($products->ID,'disc',true);

		// $html .='
		// <div class="skin-type1 pt-80 pb-80">
		// 	<div class="related-product text-center">
		// 		<img src="'.site_url().'/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
		// 		<h2 class="mb-40">Disclaimer</h2>
		// 	</div>
		// 	<div class="row text-center">
		// 		<div class="col-lg-8 offset-lg-2">
		// 			<div class="">
		// 				'.get_post_meta($productid,'disc',true).'
		// 			</div>
		// 		</div>
		// 	</div>
		// </div>';


		$html .='		
		
		<div class="key-ingredients pt-80 pb-80">
			<div class="related-product ">
				<img src="'.site_url().'/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
				<h2 class="mb-40">Key Ingredients</h2>
			</div>';

			$html .='<div class="row">';
			
			// echo '<pre>';
			// print_r($_keyingredient);
			// echo '</pre>';

			foreach ($_keyingredient as $_keyingredientkey => $_keyingredientsValue) 
			{
			    
			    $html .=
			            '<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
			                <div class="row align-items-center">
			                        <div class="col-3">
			                            <img src="'.$_keyingredientsValue['image'].'" class="image-fluid rounded-circle">
			                        </div>
			                        <div class="col-9">
			                                <p>'.$_keyingredientsValue['details'].'</p>
			                        </div>
			                </div>
			            </div>';
			}

			$html .='</div></div>';



		$html .='
		<div class="bg-yellow direction-sec pt-80 pb-80 position-relative">
			<div class="related-product text-center">
				<img src="'.site_url().'/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
				<h2 class="mb-40">Directions of usage</h2>
			</div>
			<div class="row">
				<div class="col-lg-6 pr-lg-4 demo-video">
					<div class="">';


			if($videolink !='')
				$html .='
						<p class="mb-2"><b>See the demo video</b></p>
						<iframe class="w-100" height="316" src="'.$videolink.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			else
				$html .='
						<p class="mb-2"><b>No demo video</b></p>';



			$html .='			
					</div>
				</div>
				<div class="col-lg-6 direction-sec-steps align-self-center">';
				for ($i=0; $i < $stepscount; $i++) { 
					$step = get_post_meta($productid,'direction_of_usage_steps_'.$i.'_step',true);

					$j=$i +1;

					$html .='<p><b>Step '.$j.' : </b>'.$step.'</p>';
				}
				
				$html .='
				</div>
			</div>
		</div>
		';

		$html .='
		<div class="bg-gray direction-sec pt-80 pb-80 position-relative">
			<div class="related-product text-center">
				<img src="'.site_url().'/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
				<h2 class="mb-40">Ingredients</h2>
			</div>
			<div class="row">
				
				<div class="col-lg-12 direction-sec-steps align-self-center  text-center"><p>';
				foreach ($_ingredients as $_ingredientskey => $_ingredientsvalue) 
				{
					$html .=''.$_ingredientsvalue.', ';
				}
				$html .='</p>
				</div>
			</div>
		</div>
		';

		$html .='
		<div class="skin-type pt-80 pb-80">
			<div class="related-product text-center">
				<img src="'.site_url().'/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
				<h2 class="mb-40">Disclaimer</h2>
			</div>
			<div class="row text-center">
				<div class="col-lg-8 offset-lg-2">
					<div class="">
						'.get_post_meta($productid,'disc',true).'
					</div>
				</div>
			</div>
		</div>';
		
		global $product;
    $product_id = $product->get_id();

    $faq_count = get_post_meta($product_id, 'faq_qus', true);
    if ($faq_count > 0) {
        $html .= '<div class="pt-60">
				<div class="faq-sec">
					<div class="related-product text-center">
						<img src="' . site_url() . '/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2">
						<h2 class="mb-40">FAQs</h2>
					</div>
					<div clas="">
						<div class="accordion" id="accordionExample">';

        for ($i = 0; $i < $faq_count; $i++) {

            $questions = get_post_meta($product_id, 'faq_qus_' . $i . '_questions', true);
            $answer = get_post_meta($product_id, 'faq_qus_' . $i . '_answer', true);

            $html .= '<div class="card">
					<div class="card-head" id="headingOne' . $i . '">
						<h2 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne' . $i . '" aria-expanded="true" aria-controls="collapseOne' . $i . '">' . $questions . '
						</h2>
					</div>

					<div id="collapseOne' . $i . '" class="collapse" aria-labelledby="headingOne' . $i . '" data-parent="#accordionExample">
						<div class="card-body">
							<p>' . $answer . '</p>
						</div>
					</div>
				</div>';
        }
    }




	echo $html ;
}

// add_action ('woocommerce_single_product_summary' , 'productdetailspage_star_rating');
// function productdetailspage_star_rating()
// {
// 	echo 'star rating ';
// 	global $woocommerce, $product;
//     $average = $product->get_average_rating();
//     echo '<div class="star-rating"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
// }
// add_action ('woocommerce_before_add_to_cart_form' , 'productdetailspage_comba');
// function productdetailspage_comba()
// {
// 	echo '<div class="combo-sec">
// 		<div class="">
// 			<h5>Combo *</h5>
// 			<div class="mb-30">
// 				<ul class="list-unstyle list-inline">
// 					<li class="list-inline-item active"><a>Day Beauty Cream</a></li>
// 					<li class="list-inline-item"><a>Day Beauty Cream + Dead sea mud soap</a></li>
// 					<li class="list-inline-item"><a>Day Beauty Cream + Dead sea mud soap + Goat milk Facewash</a></li>
// 				</ul>
// 			</div>
// 		</div>
// 	</div>';
// }


add_action('woocommerce_after_add_to_cart_button', 'productdetailspage_wishlists');

function productdetailspage_wishlists() {

    echo do_shortcode('[yith_wcwl_add_to_wishlist]');
}

// add_action ('woocommerce_before_add_to_cart_form' , 'productdetailspage_check_availablity');
// function productdetailspage_check_availablity()
// {
// 	echo '<div class="chk-avlbity">
// 		<form class="form-inline">
// 			<div class="form-group mr-3">
// 				<input type="text" class="form-control" placeholder="Enter pin code">
// 			</div>
// 			<button type="submit" class="lkn-btn border-0">CHECK AVAILABILITY</button>
// 		</form>
// 		<small class="d-block mt-2">Shipping to this pincode is available</small>
// 		<div class="chk-amt mt-40">
// 			<h3>Only <span>₹349.00</span></h3>
// 			<h5>Avail 10% OFF combo pack using Referral Code</h5>
// 		</div>
// 	</div>';
// }
// woocomerce productdetails

add_filter('woocommerce_product_tabs', 'woo_custom_product_tabs');

function woo_custom_product_tabs($tabs) {

    // 1) Removing tabs
    // unset( $tabs['description'] );              // Remove the description tab
    // unset( $tabs['reviews'] );               // Remove the reviews tab
    unset($tabs['additional_information']);   // Remove the additional information tab
    // 2 Adding new tabs and set the right order
    //Attribute Description tab
    // $tabs['attrib_desc_tab'] = array(
    //     'title'     => __( 'Desc', 'woocommerce' ),
    //     'priority'  => 100,
    //     'callback'  => 'woo_attrib_desc_tab_content'
    // );
    // Adds the qty pricing  tab
    // $tabs['qty_pricing_tab'] = array(
    //     'title'     => __( 'Quantity Pricing', 'woocommerce' ),
    //     'priority'  => 110,
    //     'callback'  => 'woo_qty_pricing_tab_content'
    // );
    // Adds the other products tab
    $tabs['other_products_tab'] = array(
        'title' => __('Before After', 'woocommerce'),
        'priority' => 120,
        'callback' => 'woo_other_products_tab_content'
    );

    return $tabs;
}

// New Tab contents
// function woo_attrib_desc_tab_content() {
//     // The attribute description tab content
//     echo '<h2>Description</h2>';
//     echo '<p>Custom description tab.</p>';
// }
// function woo_qty_pricing_tab_content() {
//     // The qty pricing tab content
//     echo '<h2>Quantity Pricing</h2>';
//     echo '<p>Here\'s your quantity pricing tab.</p>';
// }
function woo_other_products_tab_content() {
    // The other products tab content
    global $product;
    $productid = $product->get_id();

    $beforeafter_count = get_post_meta($productid, 'before_after_', true);

    echo '
	<link rel="stylesheet" href="' . home_url('/custom-style/css/magnific-popup.css') . '">
	<div class="row">';
    for ($i = 0; $i < $beforeafter_count; $i++) {

        $beforeafter_image = get_post_meta($productid, 'before_after__' . $i . '_image', true);
        $img = wp_get_attachment_image_src($beforeafter_image, 'single-post-thumbnail');
        echo '
			
				<div class="col-lg-4 mb-30">
<a href="' . $img[0] . '" class="work-gallery mfp-image">
									<img src="' . $img[0] . '">
								</a>
				</div>
		';
    }
    echo '</div>';
    ?>

    <script src="<?php echo home_url('/custom-style/js/jquery.magnific-popup.min.js'); ?>"></script>
    <script>
        (function ($) {
            $(window).on("load", function () {

                /*	Popup	*/
                var popUp = $(".work-gallery");
                var popUpPlayer = $(".popup-player");
                popUp.magnificPopup({
                    tLoading: "",
                    gallery: {enabled: !0},
                    mainClass: "mfp-fade",
                    type: "inline"
                });
                popUpPlayer.magnificPopup({
                    type: "iframe",
                    mainClass: "mfp-fade",
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false,
                    iframe: {
                        markup: '<div class="mfp-iframe-scaler">' +
                                '<div class="mfp-close"></div>' +
                                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                                '</div>',

                        srcAction: "iframe_src",
                    }
                });
            });

        })(jQuery);
    </script>
    <?php
}

// Remove the product rating display on product loops
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

function woocommerce_shop_order_search_order_total($search_fields) {

    $search_fields[] = '_order_total';

    return $search_fields;
}

add_filter('woocommerce_shop_order_search_fields', 'woocommerce_shop_order_search_order_total');

add_filter('woocommerce_show_variation_price', function () {
    return TRUE;
});

function home_shop_conceive_grid_layout() {
    global $wpdb;
    $table_category = $wpdb->prefix . 'conceive_category';
    $table_sub_category = $wpdb->prefix . 'conceive_sub_category';
    $conceive_category_rows = $wpdb->get_results("SELECT * from $table_category where 1=1 order by position_order");
    if (count($conceive_category_rows) > 0) {
        $i = 1;
        $j = 1;
        $elementor_tabs_content_wrapper = '';
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div id="elementor-widget-tabs-1" class="elementor-element elementor-widget__width-inherit elementor-tabs-view-horizontal elementor-widget elementor-widget-tabs" data-element_type="widget" data-widget_type="tabs.default">'
                . '<div class="elementor-widget-container">'
                . '<div class="elementor-tabs" role="tablist">'
                . '<div class="elementor-tabs-wrapper">';
        foreach ($conceive_category_rows as $conceive_category) {

            $ele_active_class = '';
            if ($i == 1) {
                $ele_active_class = 'elementor-active';
            }
            $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div id="elementor-tab-title-' . $conceive_category->id . '" class="elementor-tab-title elementor-tab-desktop-title ' . $ele_active_class . '" data-tab="' . $i . '" role="tab" aria-controls="elementor-tab-content-' . $conceive_category->id . '">' . $conceive_category->title . '</div>';
            $i++;
        }

        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div>';
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class="elementor-tabs-content-wrapper">';

        foreach ($conceive_category_rows as $conceive_category) {

            $ele_active_class = '';
            $ele_active_style = 'style="display: none;"';
            if ($j == 1) {
                $ele_active_class = 'elementor-active';
                $ele_active_style = 'style="display: block;"';
            }

            $conceive_sub_category_rows = $wpdb->get_results("SELECT *,(SELECT `id` from `wp_conceive` where `wp_conceive`.`sub_category` =`wp_conceive_sub_category`.`id`) AS shop_conceive from $table_sub_category where category_id = $conceive_category->id");

            $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class="elementor-tab-title elementor-tab-mobile-title ' . $ele_active_class . '" data-tab="' . $j . '" role="tab">' . $conceive_category->title . '</div>'
                    . '<div id="elementor-tab-content-' . $conceive_category->id . '" class="elementor-tab-content elementor-clearfix ' . $ele_active_class . '" data-tab="' . $j . '" role="tabpanel" aria-labelledby="elementor-tab-title-' . $conceive_category->id . '" ' . $ele_active_style . '>';

            if (count($conceive_sub_category_rows) > 0) {

                $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class="row">';
                foreach ($conceive_sub_category_rows as $conceive_sub_category) {

                    $image = wp_get_attachment_image_src($conceive_sub_category->image);
                    $shop_conceive = $conceive_sub_category->shop_conceive;
                    $url = home_url('/') . 'page.php?pid=' . $shop_conceive;
                    if ($shop_conceive != '' || $shop_conceive != null) {
                        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class=" col-lg-2 col-md-3 col-sm-4 col-4">'
                                . '<a href="' . $url . '">'
                                . '<img class="testtest attachment-large size-large wp-post-image" style="border-radius: 50%;" src="' . $image[0] . '">'
                                . '<h4 class="text-center" style="margin: 10px 0px">' . $conceive_sub_category->title . '</h4>'
                                . '</a>'
                                . '</div>';
                    }
                }
                $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div>';
            }
            $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div>';
            $j++;
        }
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . ' </div>';
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div></div></div>
             <script>
		jQuery(document).ready(function () {
            console.log("log");
            jQuery(".cus-owl-carousel").owlCarousel({
                loop: false,
                margin: 10,
                nav: false,
                navigation: false,
                responsive: {
                    0: {items: 1},
                    600: {items: 3},
                    1000: {items: 5}
                }
            });
        });
    </script>       ';
    }
    return $elementor_tabs_content_wrapper;
}

add_shortcode('HOME_SHOP_CONCEIVE_GRID_LAYOUT', 'home_shop_conceive_grid_layout');

function home_shop_conceive_layout() {
    global $wpdb;
    $table_category = $wpdb->prefix . 'conceive_category';
    $table_sub_category = $wpdb->prefix . 'conceive_sub_category';
    $conceive_category_rows = $wpdb->get_results("SELECT * from $table_category ");
    if (count($conceive_category_rows) > 0) {
        $i = 1;
        $j = 1;
        $elementor_tabs_content_wrapper = '';
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div id="elementor-widget-tabs-1" class="elementor-element elementor-widget__width-inherit elementor-tabs-view-horizontal elementor-widget elementor-widget-tabs" data-element_type="widget" data-widget_type="tabs.default">'
                . '<div class="elementor-widget-container">'
                . '<div class="elementor-tabs" role="tablist">'
                . '<div class="elementor-tabs-wrapper">';
        foreach ($conceive_category_rows as $conceive_category) {

            $ele_active_class = '';
            if ($i == 1) {
                $ele_active_class = 'elementor-active';
            }
            $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div id="elementor-tab-title-' . $conceive_category->id . '" class="elementor-tab-title elementor-tab-desktop-title ' . $ele_active_class . '" data-tab="' . $i . '" role="tab" aria-controls="elementor-tab-content-' . $conceive_category->id . '">' . $conceive_category->title . '</div>';
            $i++;
        }

        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div>';
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class="elementor-tabs-content-wrapper">';

        foreach ($conceive_category_rows as $conceive_category) {

            $ele_active_class = '';
            $ele_active_style = 'style="display: none;"';
            if ($j == 1) {
                $ele_active_class = 'elementor-active';
                $ele_active_style = 'style="display: block;"';
            }

            $conceive_sub_category_rows = $wpdb->get_results("SELECT *,(SELECT `id` from `wp_conceive` where `wp_conceive`.`sub_category` =`wp_conceive_sub_category`.`id`) AS shop_conceive from $table_sub_category where category_id = $conceive_category->id");

            $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class="elementor-tab-title elementor-tab-mobile-title ' . $ele_active_class . '" data-tab="' . $j . '" role="tab">' . $conceive_category->title . '</div>'
                    . '<div id="elementor-tab-content-' . $conceive_category->id . '" class="elementor-tab-content elementor-clearfix ' . $ele_active_class . '" data-tab="' . $j . '" role="tabpanel" aria-labelledby="elementor-tab-title-' . $conceive_category->id . '" ' . $ele_active_style . '>';

            if (count($conceive_sub_category_rows) > 0) {

                $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class=" cus-owl-carousel owl-carousel owl-theme">';
                foreach ($conceive_sub_category_rows as $conceive_sub_category) {

                    $image = wp_get_attachment_image_src($conceive_sub_category->image);
                    $shop_conceive = $conceive_sub_category->shop_conceive;
                    $url = home_url('/') . 'page.php?pid=' . $shop_conceive;
                    if ($shop_conceive != '' || $shop_conceive != null) {
                        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '<div class="item">'
                                . '<a href="' . $url . '">'
                                . '<img class="testtest1 attachment-large size-large wp-post-image"  src="' . $image[0] . '">'
                                . '<h2 class="text-center" style="margin: 10px 0px">' . $conceive_sub_category->title . '</h2>'
                                . '</a>'
                                . '</div>';
                    }
                }
                $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div>';
            }
            $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div>';
            $j++;
        }
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . ' </div>';
        $elementor_tabs_content_wrapper = $elementor_tabs_content_wrapper . '</div></div></div>
             <script>
		jQuery(document).ready(function () {
            console.log("log");
            jQuery(".cus-owl-carousel").owlCarousel({
                loop: false,
                margin: 10,
                nav: false,
                navigation: false,
                responsive: {
                    0: {items: 1},
                    600: {items: 3},
                    1000: {items: 5}
                }
            });
        });
    </script>       ';
    }
    return $elementor_tabs_content_wrapper;
}

add_shortcode('HOME_SHOP_CONCEIVE_LAYOUT', 'home_shop_conceive_layout');

add_action('admin_menu', 'my_admin_menu');

function my_admin_menu() {
    add_menu_page('Shop Conceive', 'Shop Conceive', 'lower', 'admin_conceive', 'admin_conceive', 'dashicons-tickets', 6);
    add_submenu_page('admin_conceive', 'All Conceive', 'All Conceive', 'manage_options', 'admin_all_conceive', 'admin_all_conceive');
    add_submenu_page('admin_conceive', 'Add New Conceive', 'Add New Conceive', 'manage_options', 'admin_add_conceive', 'admin_add_conceive');
    add_submenu_page(null, 'Edit Conceive', 'Edit Conceive', 'manage_options', 'admin_edit_conceive', 'admin_edit_conceive');
    add_submenu_page(null, 'Delete Conceive', 'Delete Conceive', 'manage_options', 'admin_delete_conceive', 'admin_delete_conceive');

    add_submenu_page('admin_conceive', 'All Category', 'All Category', 'manage_options', 'admin_conceive_all_category', 'admin_conceive_all_category');
    add_submenu_page('admin_conceive', 'Add New Category', 'Add New Category', 'manage_options', 'admin_conceive_add_category', 'admin_conceive_add_category');
	    add_submenu_page(null, 'Edit Category', 'Edit Category', 'manage_options', 'admin_conceive_edit_category', 'admin_conceive_edit_category');
    add_submenu_page(null, 'Delete Conceive', 'Delete Conceive', 'manage_options', 'admin_conceive_delete_category', 'admin_conceive_delete_category');

    add_submenu_page('admin_conceive', 'All Sub Category', 'All Sub Category', 'manage_options', 'admin_conceive_all_sub_category', 'admin_conceive_all_sub_category');
    add_submenu_page('admin_conceive', 'Add New Sub Category', 'Add New Sub Category', 'manage_options', 'admin_conceive_add_sub_category', 'admin_conceive_add_sub_category');
    add_submenu_page(null, 'Edit Sub Category', 'Edit Sub Category', 'manage_options', 'admin_conceive_edit_sub_category', 'admin_conceive_edit_sub_category');	
    add_submenu_page(null, 'Delete Conceive', 'Delete Conceive', 'manage_options', 'admin_conceive_delete_sub_category', 'admin_conceive_delete_sub_category');
}

//conceive
function admin_all_conceive() {
    ?>
    <style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
        }
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="wrap"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Conceive List</strong>
                    <div id="toolbar" class="card-toolbar">
                        <div class=" btn-group">      
                            <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button"  href="<?php echo admin_url('admin.php?page=admin_add_conceive'); ?>" ><i class="fas fa-plus"></i>Add Conceive</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm" data-toolbar="#toolbar" id="mytable">
                        <thead>
                            <tr>
                                <th data-field="no">No</th>
                                <th data-field="sub_category_name">Sub Category Name</th>
                                <th data-field="title">Title</th>
                                <th data-field="product">Product</th>
								<th data-field="edit">Edit</th>
                                <th data-field="delete">Delete</th>
								
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $wpdb;
                            $table_name = $wpdb->prefix . 'conceive';
                            $conceive_rows = $wpdb->get_results("SELECT *, (SELECT `title` FROM `wp_conceive_sub_category` where `wp_conceive_sub_category`.`id` = `wp_conceive`.`sub_category`) as sub_category_name from $table_name");
                            $i = 1;
                            foreach ($conceive_rows as $conceive) {
                                ?>
                                <tr>
								  
                                    <td><?= $i; ?></td>
                                    <td><?= $conceive->sub_category_name; ?></td>
                                    <td><?= $conceive->title; ?></td>
                                    <td><?= $conceive->product; ?></td>
									<td><a href="<?php echo admin_url('admin.php?page=admin_edit_conceive&id=' . $conceive->id); ?>"> Edit</a></td>
                                    <td><a href="<?php echo admin_url('admin.php?page=admin_delete_conceive&id=' . $conceive->id); ?>"> Delete</a></td>
									
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
					 
					
                </div>
            </div>
        </div>
    </div>
 
    <?php
}

add_shortcode('short_admin_all_conceive', 'admin_all_conceive');

function admin_add_conceive() {
    ?>
    <style>
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
        .img-single-remove{
            display: block;
        }
        .img-single-upload, .img-multiple-upload{
            width: 100%;
            height: 100px;
            overflow: hidden;
            display: block;
            position: relative;
        }
        .wp-img-custom{
            width: 100px;
            display: block;
            position: relative;
            float: left;
			height:100%;
        }
        
        /*imman code*/
        
        .hr-border{
           
        }
    </style>
    <script>
        jQuery(function ($) {
            // on upload single
            $('body').on('click', '.img-single-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: false
                        }).on('select', function () { // it also has "open" and "close" events
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    button.html('<img src="' + attachment.url + '" class="wp-img-custom">').next().show().next().val(attachment.id);
                }).open();
            });

            // on upload multiple
            $('body').on('click', '.img-multiple-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: true
                        }).on('select', function () { // it also has "open" and "close" events

                    var attachment = custom_uploader.state().get('selection').toJSON();
                    var img_html = "";
                    var attachment_ids = "";
                    var attachment_count = attachment.length;

                    console.log(Number(attachment_count) > Number(3));
                    console.log("attachment count : " + attachment.length);
                    console.log("attachment : " + JSON.stringify(attachment));

                    $.each(attachment, function (i, item) {
                        if (i < 3) {
                            img_html = img_html + '<img src="' + item.url + '" class="wp-img-custom">';
                        }
                        if (i === 0) {
                            attachment_ids = item.id;
                        } else {
                            attachment_ids = attachment_ids + ", " + item.id;
                        }
                    });
                    if (attachment_count > 3) {
                        var count_more_img = Number(attachment_count) - Number(3);
                        img_html = img_html + ' +' + count_more_img;
                    }
                    button.html(img_html).next().show().next().val(attachment_ids);
                }).open();
            });

            // on remove button click
            $('body').on('click', '.img-single-remove', function (e) {
                e.preventDefault();

                var button = $(this);
                button.next().val(''); // emptying the hidden field
                button.hide().prev().html('Upload image');
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <strong>Conceive Create </strong>
                <div id="toolbar" class="card-toolbar">
                    <div class=" btn-group">      
                        <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button" href="<?php echo admin_url('admin.php?page=admin_all_conceive'); ?>" ><i class="fas fa-list"></i> Conceive list</a>
                    </div>
                </div>
            </div>
            <form name="frm" action="#" method="post" id="conceive" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category">Sub Category</label>
                                <select class="form-control chosen" id="sub_category" name="sub_category">
                                    <?php
                                    global $wpdb;
                                    $table_name = $wpdb->prefix . 'conceive_sub_category';
                                    $category_rows = $wpdb->get_results("SELECT * from $table_name where `$table_name`.`id` not in (SELECT `sub_category` FROM `wp_conceive`)");
                                    foreach ($category_rows as $category) {
                                        echo'<option value="' . $category->id . '">' . $category->title . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="product">Product</label>
                                <input  type="text" class="form-control" id="product" name="product" placeholder="Product" autocomplete="new-product">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube">Youtube</label>
                                <input  type="text" class="form-control" id="reason_title" name="youtube" placeholder="Youtube" autocomplete="new-youtube">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="new-title">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" autocomplete="new-description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reason_title">Reason Title</label>
                                <input  type="text" class="form-control" id="reason_title" name="reason_title" placeholder="Reason Title" autocomplete="new-reason_title">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="reason_description">Reason Description</label>
                                <textarea class="form-control" id="reason_description" name="reason_description" autocomplete="new-reason_description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cover_image">Cover Image</label>
                                <!--<input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Cover Image">--> 
                                <?php
                                echo '<a href="#" class="img-single-upload">Upload image</a>'
                                . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                . '<input type="hidden" name="cover_image" value="">';
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <!--<input type="file" class="form-control" id="image" name="image" placeholder="Image">-->
                                <?php
                                echo '<a href="#" class="img-single-upload">Upload image</a>'
                                . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                . '<input type="hidden" name="image" value="">';
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube">Feedback</label>
                                <!--<input  type="file" class="form-control" id="feedback" name="feedback[]" multiple placeholder="Feedback" autocomplete="new-feedback">-->
                                <?php
                                echo '<a href="#" class="img-multiple-upload">Upload image</a>'
                                . '<a href="#" class="img-single-remove" style="display:none">Remove images</a>'
                                . '<input type="hidden" name="feedback" value="">';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" value="Insert" name="ins"> Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['ins'])) {
        global $wpdb;
        $sub_category = $_POST['sub_category'];
        $cover_image = $_POST['cover_image'];
        $image = $_POST['image'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $reason_title = $_POST['reason_title'];
        $reason_description = $_POST['reason_description'];
        $youtube = $_POST['youtube'];
        $product = $_POST['product'];
        $feedback = $_POST['feedback'];
        $table_name = $wpdb->prefix . 'conceive';
        $insert = $wpdb->insert(
                $table_name,
                array(
                    'sub_category' => $sub_category,
                    'cover_image' => $cover_image,
                    'image' => $image,
                    'title' => $title,
                    'description' => $description,
                    'reason_title' => $reason_title,
                    'reason_description' => $reason_description,
                    'youtube' => $youtube,
                    'product' => $product,
                    'feedback' => $feedback
                )
        );

        if (!$insert) {
            echo 'insert failed.<br>';
            // echo json_encode($_POST);
            // echo $wpdb->last_query();
            // print_r($wpdb->queries);
            // echo $wpdb->last_result;
            // echo $wpdb->last_error;
            echo $wpdb->show_errors();
            echo $wpdb->print_error();
        } else {
            echo "inserted";
            ?>
            <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_all_conceive'); ?>" />
            <?php
        }
        exit;
    }
}
function admin_edit_conceive() {
// 	    echo "shop conceive page editing...<br>";
// 	echo isset($_GET['id']);
    if (isset($_GET['id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'conceive';
        $i = $_GET['id'];
        $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}conceive WHERE id = {$i}", OBJECT );
    }
   ?>
    <style>
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
        .img-single-remove{
            display: block;
        }
        .img-single-upload, .img-multiple-upload{
            width: 100%;
            height: 100px;
            overflow: hidden;
            display: block;
            position: relative;
        }
        .wp-img-custom{
            width: 100px;
            display: block;
            position: relative;
            float: left;
			height:100%;
        }
    </style>
    <script>
        jQuery(function ($) {
            // on upload single
            $('body').on('click', '.img-single-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: false
                        }).on('select', function () { // it also has "open" and "close" events
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
        button.html('<img src="' + attachment.url + '" class="wp-img-custom">').next().show().next().val(attachment.id);
                }).open();
            });

            // on upload multiple
            $('body').on('click', '.img-multiple-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: true
                        }).on('select', function () { // it also has "open" and "close" events

                    var attachment = custom_uploader.state().get('selection').toJSON();
                    var img_html = "";
                    var attachment_ids = "";
                    var attachment_count = attachment.length;

                    console.log(Number(attachment_count) > Number(3));
                    console.log("attachment count : " + attachment.length);
                    console.log("attachment : " + JSON.stringify(attachment));

                    $.each(attachment, function (i, item) {
                        if (i < 3) {
                            img_html = img_html + '<img src="' + item.url + '" class="wp-img-custom">';
                        }
                        if (i === 0) {
                            attachment_ids = item.id;
                        } else {
                            attachment_ids = attachment_ids + ", " + item.id;
                        }
                    });
                    if (attachment_count > 3) {
                        var count_more_img = Number(attachment_count) - Number(3);
                        img_html = img_html + ' +' + count_more_img;
                    }
                    button.html(img_html).next().show().next().val(attachment_ids);
                }).open();
            });

            // on remove button click
            $('body').on('click', '.img-single-remove', function (e) {
                e.preventDefault();

                var button = $(this);
                button.next().val(''); // emptying the hidden field
                button.hide().prev().html('Upload image');
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <strong>Conceive Edit </strong>
                <div id="toolbar" class="card-toolbar">
                    <div class=" btn-group">      
                        <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button" href="<?php echo admin_url('admin.php?page=admin_all_conceive'); ?>" ><i class="fas fa-list"></i> Conceive list</a>
                    </div>
                </div>
            </div>
			<?php
			foreach ( $results as $conc ) {
			?>
            <form name="frm" action="#" method="post" id="conceive" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category">Sub Category</label>
                                <select class="form-control chosen" id="sub_category" name="sub_category">
                                    <?php
                                    global $wpdb;
                                    $table_name = $wpdb->prefix . 'conceive_sub_category';
                                    $category_rows = $wpdb->get_results("SELECT b.* FROM `wp_conceive` a left join wp_conceive_sub_category b on a.sub_category=b.id where b.id=$conc->sub_category");
                                    foreach ($category_rows as $category) {
                                        echo'<option value="' . $category->id . '">' . $category->title . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="product">Product</label>
								
                                <input  type="text" class="form-control" id="product" name="product" placeholder="Product" autocomplete="new-product"  value="<?php echo $conc->product ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube">Youtube</label>
                                <input  type="text" class="form-control" id="reason_title" name="youtube" placeholder="Youtube" autocomplete="new-youtube" value="<?php echo $conc->youtube ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="new-title" value="<?php echo $conc->title ?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" autocomplete="new-description" rows="3"><?php echo $conc->description ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reason_title">Reason Title</label>
                                <input  type="text" class="form-control" id="reason_title" name="reason_title" placeholder="Reason Title" autocomplete="new-reason_title" value="<?php echo $conc->reason_title ?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="reason_description">Reason Description</label>
                                <textarea class="form-control" id="reason_description" name="reason_description" autocomplete="new-reason_description" rows="3"><?php echo $conc->reason_description ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cover_image">Cover Image</label>
                                <?php

								if ($image = wp_get_attachment_image_src($conc->cover_image)) {
									
                                    echo '<a href="#" class="img-single-upload">'
                                    . '<img src="' . $image[0] . '" class="wp-img-custom"/>'
                                    . '</a>'
                                    . '<a href="#" class="img-single-remove">Remove image</a>'
                                    . '<input type="hidden" name="cover_image" value="'. $conc->cover_image . '">';

                                } else {
                                    echo '<a href="#" class="img-single-upload">Upload image</a>'
                                    . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                    . '<input type="hidden" name="cover_image" value="">';
                                }
				 
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <!--<input type="file" class="form-control" id="image" name="image" placeholder="Image">-->
                                <?php
				if ($image = wp_get_attachment_image_src($conc->image)) {
                                    echo '<a href="#" class="img-single-upload">'
                                    . '<img src="' . $image[0] . '" class="wp-img-custom"/>'
                                    . '</a>'
                                    . '<a href="#" class="img-single-remove">Remove image</a>'
                                    . '<input type="hidden" name="image" value="' . $conc->image . '">';
                                } else {
                                    echo '<a href="#" class="img-single-upload">Upload image</a>'
                                    . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                    . '<input type="hidden" name="image" value="">';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube">Feedback</label>
                                <?php
								if ($image = wp_get_attachment_image_src($conc->feedback)) {
									$imgarray = explode(',', $conc->feedback);
								foreach($imgarray as $img){
									$im.='<img class="wp-img-custom" src="'. wp_get_attachment_image_url($img) .'" >';
								}
								$im.='+1';
									
                                    echo '<a href="#" class="img-multiple-upload">'
                                    . $im
                                    . '</a>'
                                    . '<a href="#" class="img-single-remove">Remove image</a>'
                                    . '<input type="hidden" name="feedback" value="' . $conc->feedback . '">';
                                } else {
                                    echo '<a href="#" class="img-multiple-upload">Upload image</a>'
                                    . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                    . '<input type="hidden" name="feedback" value="">';
                                }
				 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" value="Insert" name="update"> Submit</button>
                </div>
            </form>
			<?php
			}
			?>
        </div>
    </div>
    <?php
    if (isset($_POST['update'])) {
        global $wpdb;
        $sub_category = $_POST['sub_category'];
        $cover_image = $_POST['cover_image'];
        $image = $_POST['image'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $reason_title = $_POST['reason_title'];
        $reason_description = $_POST['reason_description'];
        $youtube = $_POST['youtube'];
        $product = $_POST['product'];
        $feedback = $_POST['feedback'];
        $table_name = $wpdb->prefix . 'conceive';
        $update = $wpdb->update(
                $table_name,
                array(
					
                    'sub_category' => $sub_category,
                    'cover_image' => $cover_image,
                    'image' => $image,
                    'title' => $title,
                    'description' => $description,
                    'reason_title' => $reason_title,
                    'reason_description' => $reason_description,
                    'youtube' => $youtube,
                    'product' => $product,
                    'feedback' => $feedback
                ),
			array( 
					'id' => $i
				)
        );

        if (!$update) {
            echo 'insert failed.<br>';
            // echo json_encode($_POST);
            // echo $wpdb->last_query();
            // print_r($wpdb->queries);
            // echo $wpdb->last_result;
            // echo $wpdb->last_error;
            echo $wpdb->show_errors();
            echo $wpdb->print_error();
        } else {
            echo "updated";
            ?>
            <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_all_conceive'); ?>" />
            <?php
        }
        exit;
    }	
}
function admin_delete_conceive() {
    echo "shop conceive page deleting...<br>";
    if (isset($_GET['id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'conceive';
        $i = $_GET['id'];
        $wpdb->delete(
                $table_name,
                array('id' => $i)
        );
        echo "deleted";
    }
    ?>
    <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_all_conceive'); ?>" />
    <?php
}
function my_enqueue() {
//       wp_register_script( 'ajax-script', get_template_directory_uri() . '/child-script.js', array('jquery') );
// 	 
//       wp_localize_script( 'ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
      	wp_register_script('concivescript',  get_template_directory_uri() . '/child-script.js', array( 'jquery' ));
		wp_enqueue_script( 'concivescript' );
		wp_localize_script( 'concivescript', 'concivescriptAjax', array( 'cajaxurl' => admin_url( 'admin-ajax.php'), 'nonce' => wp_create_nonce('cajaxnonce')));
 }
 add_action( 'admin_enqueue_scripts', 'my_enqueue' );



//conceive category
function admin_conceive_all_category() {
	
    ?>
    <style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
        }
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
		#mytable {
			counter-reset: serial-number;  /* Set the serial number counter to 0 */
		}

		#mytable td:first-child:before {
			counter-increment: serial-number;  /* Increment the serial number counter */
			content: counter(serial-number);  /* Display the counter */
		}
		#mytable tr.ui-sortable-helper.ui-sortable-handle {
			width: 100%;
		}
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
	  jQuery(function() {
		  var itemList =jQuery( "#mytable tbody" );
				itemList.sortable();
	  });
	</script>
 
    <div class="wrap"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Conceive Category List</strong>
                    <div id="toolbar" class="card-toolbar">
                        <div class=" btn-group">      
                            <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button"  href="<?php echo admin_url('admin.php?page=admin_conceive_add_category'); ?>" ><i class="fas fa-plus"></i>Add Conceive Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm" data-toolbar="#toolbar" id="mytable">
                        <thead>
                            <tr>
<!-- 								<th data-field="current">Changed</th> -->
                                <th data-field="no">No</th>
                                <th data-field="title">Title</th>
                                <th data-field="slug">Slug</th>
								<th data-field="edit">Edit</th>
                                <th data-field="delete">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $wpdb;
                            $table_name = $wpdb->prefix . 'conceive_category';
                    $conceive_rows = $wpdb->get_results("SELECT * from $table_name where 1=1 order by position_order");
                            $i = 1;
                            foreach ($conceive_rows as $conceive) {
                                ?>
                             <tr class="update-position" data-updateid="<?= $conceive->id; ?>" id="<?= $conceive->id; ?>">
									<td class="posid"></td>
								 	<!-- <td>< ?= $i; ?></td> -->
                                    <td><?= $conceive->title; ?></td>
                                    <td><?= $conceive->slug; ?></td>
									<td><a href="<?php echo admin_url('admin.php?page=admin_conceive_edit_category&id=' . $conceive->id); ?>"> Edit</a></td>
                                    <td><a href="<?php echo admin_url('admin.php?page=admin_conceive_delete_category&id=' . $conceive->id); ?>"> Delete</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
<!-- <input class="btn btn-sm btn-primary btn_position" style="width:200px;" type="submit" value="Update Position" name="update"> -->
            </div>

        </div>
    </div>
<script>
// 	   jQuery(".btn_position").click(function () {
//            let arr=[];
// 		   jQuery('#mytable tbody tr').each(function(index) {
// 				arr.push({catid: this.id, position: index+1});
// 			  })

// 	    jQuery.ajax({
// 	        type: "POST",
// 	        url: ajaxurl,
// 			dataType:"json",
// 	        data: {
// 	            action: 'update_position',
// 	            updateposition: arr,
// 	        },
// 	        success: function (result) {
// 	           console.log("Output  : ", result);
// 	        }
// 	        });
// 		});
	</script>
<?php
}

add_action('wp_ajax_update_position', 'update_position');
add_action('wp_ajax_nopriv_update_position', 'update_position');

function update_position() {
    $update_position = $_POST['updateposition'];
	$table_name = $wpdb->prefix . 'conceive_category';
	foreach ($update_position as $eachcat => $val){
		$x= $wpdb->prepare( "UPDATE $table_name SET position_order = $val WHERE id = $val" );
		 wp_send_json($files);
		echo  $files; 
	  }
	die();
}

add_action('admin_conceive_all_category', 'admin_conceive_all_category');
add_shortcode('short_admin_conceive_all_category', 'admin_conceive_all_category');

function admin_conceive_add_category() {
    ?>
    <style>
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
        .img-single-remove{
            display: block;
        }
        .img-single-upload, .img-multiple-upload{
            width: 100%;
            height: 100px;
            overflow: hidden;
            display: block;
            position: relative;
        }
        .wp-img-custom{
            width: 100px;
            display: block;
            position: relative;
            float: left;
			height:100%;
        }
    </style>
    <script>
        jQuery(function ($) {
            // on upload single
            $('body').on('click', '.img-single-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: false
                        }).on('select', function () { // it also has "open" and "close" events
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    button.html('<img src="' + attachment.url + '" class="wp-img-custom">').next().show().next().val(attachment.id);
                }).open();
            });

            // on remove button click
            $('body').on('click', '.img-single-remove', function (e) {
                e.preventDefault();

                var button = $(this);
                button.next().val(''); // emptying the hidden field
                button.hide().prev().html('Upload image');
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <strong>Create Conceive Category</strong>
                <div id="toolbar" class="card-toolbar">
                    <div class=" btn-group">      
                        <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button" href="<?php echo admin_url('admin.php?page=admin_conceive_all_category'); ?>" ><i class="fas fa-list"></i> Conceive Category list</a>
                    </div>
                </div>
            </div>
            <form name="frm" action="#" method="post" id="conceive" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="new-title">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input  type="text" class="form-control" id="slug" name="slug" placeholder="Slug" autocomplete="new-slug">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <!--<input type="file" class="form-control" id="image" name="image" placeholder="Image">-->
                                <?php
                                if ($image = wp_get_attachment_image_src($image_id)) {
                                    echo '<a href="#" class="img-single-upload">'
                                    . '<img src="' . $image[0] . '" class="wp-img-custom"/>'
                                    . '</a>'
                                    . '<a href="#" class="img-single-remove">Remove image</a>'
                                    . '<input type="hidden" name="image" value="' . $image_id . '">';
                                } else {
                                    echo '<a href="#" class="img-single-upload">Upload image</a>'
                                    . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                    . '<input type="hidden" name="image" value="">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" value="Insert" name="ins"> Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['ins'])) {
        global $wpdb;
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $image = $_POST['image'];
        $table_name = $wpdb->prefix . 'conceive_category';
        $insert = $wpdb->insert(
                $table_name,
                array(
                    'title' => $title,
                    'slug' => $slug,
                    'image' => $image
                )
        );

        if (!$insert) {
            echo 'didn\'t work';
            echo $wpdb->last_query();
            echo $wpdb->last_error;
            echo $wpdb->show_errors();
            echo $wpdb->print_error();
        } else {
            echo "inserted";
            ?>
            <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_conceive_all_category'); ?>" />
            <?php
        }
        exit;
    }
}
function admin_conceive_edit_category() {
		    if (isset($_GET['id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'conceive_category';
        $i = $_GET['id'];
        $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}conceive_category WHERE id = {$i}", OBJECT );
    }
    ?>
    <style>
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
        .img-single-remove{
            display: block;
        }
        .img-single-upload, .img-multiple-upload{
            width: 100%;
            height: 100px;
            overflow: hidden;
            display: block;
            position: relative;
        }
        .wp-img-custom{
            width: 100px;
            display: block;
            position: relative;
            float: left;
			height:100%;
        }
    </style>
    <script>
        jQuery(function ($) {
            // on upload single
            $('body').on('click', '.img-single-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: false
                        }).on('select', function () { // it also has "open" and "close" events
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    button.html('<img src="' + attachment.url + '" class="wp-img-custom">').next().show().next().val(attachment.id);
                }).open();
            });

            // on remove button click
            $('body').on('click', '.img-single-remove', function (e) {
                e.preventDefault();

                var button = $(this);
                button.next().val(''); // emptying the hidden field
                button.hide().prev().html('Upload image');
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <strong>Create Conceive Category</strong>
                <div id="toolbar" class="card-toolbar">
                    <div class=" btn-group">      
                        <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button" href="<?php echo admin_url('admin.php?page=admin_conceive_all_category'); ?>" ><i class="fas fa-list"></i> Conceive Category list</a>
                    </div>
                </div>
            </div>
			<?php foreach ( $results as $conc ) { ?>
            <form name="frm" action="#" method="post" id="conceive" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="new-title" value="<?php echo $conc->title ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input  type="text" class="form-control" id="slug" name="slug" placeholder="Slug" autocomplete="new-slug" value="<?php echo $conc->slug ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <?php
                               if ($image = wp_get_attachment_image_src($conc->image)) {
                                    echo '<a href="#" class="img-single-upload">'
                                    . '<img src="' . $image[0] . '" class="wp-img-custom"/>'
                                    . '</a>'
                                    . '<a href="#" class="img-single-remove">Remove image</a>'
                                    . '<input type="hidden" name="image" value="' . $conc->image . '">';
                                } else {
                                    echo '<a href="#" class="img-single-upload">Upload image</a>'
                                    . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                    . '<input type="hidden" name="image" value="">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" value="Insert" name="update"> Submit</button>
                </div>
            </form>
			<?php }?>
        </div>
    </div>
    <?php
    if (isset($_POST['update'])) {
        global $wpdb;
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $image = $_POST['image'];
        $table_name = $wpdb->prefix . 'conceive_category';
        $update = $wpdb->update(
                $table_name,
                array(
                    'title' => $title,
                    'slug' => $slug,
                    'image' => $image
                ),
			array( 
					'id' => $i
				)
        );

        if (!$update) {
            echo 'didn\'t work';
            echo $wpdb->last_query();
            echo $wpdb->last_error;
            echo $wpdb->show_errors();
            echo $wpdb->print_error();
        } else {
            echo "Updated";
            ?>
            <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_conceive_all_category'); ?>" />
            <?php
        }
        exit;
    }
}
function admin_conceive_delete_category() {
    echo "shop conceive category deleting...<br>";
    if (isset($_GET['id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'conceive_category';
        $i = $_GET['id'];
        $wpdb->delete(
                $table_name,
                array('id' => $i)
        );
        echo "deleted";
    }
    ?>
    <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_conceive_all_category'); ?>" />
    <?php
}

//conceive sub category
function admin_conceive_all_sub_category() {
    ?>
    <style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
        }
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="wrap"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Conceive Sub Category List</strong>
                    <div id="toolbar" class="card-toolbar">
                        <div class=" btn-group">      
                            <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button"  href="<?php echo admin_url('admin.php?page=admin_conceive_add_sub_category'); ?>" ><i class="fas fa-plus"></i>Add Conceive Sub Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm" data-toolbar="#toolbar" id="mytable">
                        <thead>
                            <tr>
                                <th data-field="no">No</th>
                                <th data-field="category">Category</th>
                                <th data-field="title">Title</th>
                                <th data-field="slug">Slug</th>
								<th data-field="edit">Edit</th>
                                <th data-field="delete">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $wpdb;
                            $table_name = $wpdb->prefix . 'conceive_sub_category';
                            $conceive_rows = $wpdb->get_results("SELECT *,(SELECT `title` FROM `wp_conceive_category` where `wp_conceive_category`.`id` = `wp_conceive_sub_category`.`category_id`) as category_name from $table_name");
                            $i = 1;
                            foreach ($conceive_rows as $conceive) {
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $conceive->category_name; ?></td>
                                    <td><?= $conceive->title; ?></td>
                                    <td><?= $conceive->slug; ?></td>
									<td><a href="<?php echo admin_url('admin.php?page=admin_conceive_edit_sub_category&id=' . $conceive->id); ?>"> Edit</a></td>
                                    <td><a href="<?php echo admin_url('admin.php?page=admin_conceive_delete_sub_category&id=' . $conceive->id); ?>"> Delete</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('short_admin_conceive_all_sub_category', 'admin_conceive_all_sub_category');

function admin_conceive_add_sub_category() {
    ?>
    <style>
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
        .img-single-remove{
            display: block;
        }
        .img-single-upload, .img-multiple-upload{
            width: 100%;
            height: 100px;
            overflow: hidden;
            display: block;
            position: relative;
        }
        .wp-img-custom{
            width: 100px;
            display: block;
            position: relative;
            float: left;
			height:100%;
        }
    </style>
    <script>
        jQuery(function ($) {
            // on upload single
            $('body').on('click', '.img-single-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: false
                        }).on('select', function () { // it also has "open" and "close" events
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    button.html('<img src="' + attachment.url + '" class="wp-img-custom">').next().show().next().val(attachment.id);
                }).open();
            });

            // on remove button click
            $('body').on('click', '.img-single-remove', function (e) {
                e.preventDefault();

                var button = $(this);
                button.next().val(''); // emptying the hidden field
                button.hide().prev().html('Upload image');
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <strong>Create Conceive Sub Category</strong>
                <div id="toolbar" class="card-toolbar">
                    <div class=" btn-group">      
                        <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button" href="<?php echo admin_url('admin.php?page=admin_conceive_all_sub_category'); ?>" ><i class="fas fa-list"></i> Conceive list</a>
                    </div>
                </div>
            </div>
            <form name="frm" action="#" method="post" id="conceive" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control chosen" id="category" name="category">
                                    <?php
                                    global $wpdb;
                                    $table_name = $wpdb->prefix . 'conceive_category';
                                    $category_rows = $wpdb->get_results("SELECT * from $table_name");
                                    foreach ($category_rows as $category) {
                                        echo'<option value="' . $category->id . '">' . $category->title . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="new-title">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input  type="text" class="form-control" id="slug" name="slug" placeholder="Slug" autocomplete="new-slug">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <!--<input type="file" class="form-control" id="image" name="image" placeholder="Image">-->
                                <?php
                                if ($image = wp_get_attachment_image_src($image_id)) {
                                    echo '<a href="#" class="img-single-upload">'
                                    . '<img src="' . $image[0] . '" class="wp-img-custom"/>'
                                    . '</a>'
                                    . '<a href="#" class="img-single-remove">Remove image</a>'
                                    . '<input type="hidden" name="image" value="' . $image_id . '">';
                                } else {
                                    echo '<a href="#" class="img-single-upload">Upload image</a>'
                                    . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                    . '<input type="hidden" name="image" value="">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" value="Insert" name="ins"> Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['ins'])) {
        global $wpdb;
        $category = $_POST['category'];
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $image = $_POST['image'];
        $table_name = $wpdb->prefix . 'conceive_sub_category';
        $insert = $wpdb->insert(
                $table_name,
                array(
                    'category_id' => $category,
                    'title' => $title,
                    'slug' => $slug,
                    'image' => $image
                )
        );

        if (!$insert) {
            echo 'didn\'t work';
            echo $wpdb->last_query();
            echo $wpdb->last_error;
            echo $wpdb->show_errors();
            echo $wpdb->print_error();
        } else {
            echo "inserted";
            ?>
            <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_conceive_all_sub_category'); ?>" />
            <?php
        }
        exit;
    }
}
function admin_conceive_edit_sub_category() {
	    if (isset($_GET['id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'conceive_sub_category';
        $i = $_GET['id'];
        $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}conceive_sub_category WHERE id = {$i}", OBJECT );
    }
    ?>
    <style>
        .card {
            max-width: 100%;
        }
        .card-toolbar{
            float:right;
        }
        .img-single-remove{
            display: block;
        }
        .img-single-upload, .img-multiple-upload{
            width: 100%;
            height: 100px;
            overflow: hidden;
            display: block;
            position: relative;
        }
        .wp-img-custom{
            width: 100px;
            display: block;
            position: relative;
            float: left;
			height:100%;
        }
    </style>
    <script>
        jQuery(function ($) {
            // on upload single
            $('body').on('click', '.img-single-upload', function (e) {
                e.preventDefault();

                var button = $(this),
                        custom_uploader = wp.media({
                            title: 'Insert image',
                            library: {
                                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                                type: 'image'
                            },
                            button: {
                                text: 'Use this image' // button label text
                            },
                            multiple: false
                        }).on('select', function () { // it also has "open" and "close" events
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    button.html('<img src="' + attachment.url + '" class="wp-img-custom">').next().show().next().val(attachment.id);
                }).open();
            });

            // on remove button click
            $('body').on('click', '.img-single-remove', function (e) {
                e.preventDefault();

                var button = $(this);
                button.next().val(''); // emptying the hidden field
                button.hide().prev().html('Upload image');
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <strong>Edit Conceive Sub Category</strong>
                <div id="toolbar" class="card-toolbar">
                    <div class=" btn-group">      
                        <a type="button" class="btn btn-sm btn-outline-primary table-toolbar-button" href="<?php echo admin_url('admin.php?page=admin_conceive_all_sub_category'); ?>" ><i class="fas fa-list"></i> Conceive list</a>
                    </div>
                </div>
            </div>
			<?php foreach ( $results as $conc ) { ?>
            <form name="frm" action="#" method="post" id="conceive" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control chosen" id="category" name="category">
                                    <?php
                                    global $wpdb;
                                    $table_name = $wpdb->prefix . 'conceive_category';
                                    $category_rows = $wpdb->get_results("SELECT * from $table_name");
                                    foreach ($category_rows as $category) {
										$sel="";
										if($category->id==$conc->category_id)
										{
										$sel='selected';	
										}
                                        echo'<option value="' . $category->id . '" '.$sel.'>' . $category->title . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control" id="title" name="title" placeholder="Title" autocomplete="new-title" value="<?php echo $conc->title ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input  type="text" class="form-control" id="slug" name="slug" placeholder="Slug" autocomplete="new-slug" value="<?php echo $conc->slug ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <?php
								if ($image = wp_get_attachment_image_src($conc->image)) {
                                    echo '<a href="#" class="img-single-upload">'
                                    . '<img src="' . $image[0] . '" class="wp-img-custom"/>'
                                    . '</a>'
                                    . '<a href="#" class="img-single-remove">Remove image</a>'
                                    . '<input type="hidden" name="image" value="' . $conc->image . '">';
                                } else {
                                    echo '<a href="#" class="img-single-upload">Upload image</a>'
                                    . '<a href="#" class="img-single-remove" style="display:none">Remove image</a>'
                                    . '<input type="hidden" name="image" value="">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" value="Insert" name="update"> Submit</button>
                </div>
            </form>
			<?php } ?>
        </div>
    </div>
    <?php
  if (isset($_POST['update'])) {
        global $wpdb;
        $category = $_POST['category'];
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $image = $_POST['image'];
	  
        $table_name = $wpdb->prefix . 'conceive_sub_category';
        $update = $wpdb->update(
                $table_name,
                array(
                    'category_id' => $category,
                    'title' => $title,
                    'slug' => $slug,
                    'image' => $image
                ),
			array( 
					'id' => $i
				)
        );

        if (!$update) {
            echo 'insert failed.<br>';
            // echo json_encode($_POST);
            // echo $wpdb->last_query();
            // print_r($wpdb->queries);
            // echo $wpdb->last_result;
            // echo $wpdb->last_error;
            echo $wpdb->show_errors();
            echo $wpdb->print_error();
        } else {
            echo "updated";
            ?>
            <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_conceive_all_sub_category'); ?>" />
            <?php
        }
        exit;
    }	    
}
function admin_conceive_delete_sub_category() {
    echo "shop conceive category deleting...<br>";
    if (isset($_GET['id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'conceive_sub_category';
        $i = $_GET['id'];
        $wpdb->delete(
                $table_name,
                array('id' => $i)
        );
        echo "deleted";
    }
    ?>
    <meta http-equiv="refresh" content="1; url=<?php echo admin_url('admin.php?page=admin_conceive_all_sub_category'); ?>" />
    <?php
}

add_shortcode('catprocar', 'wps_catprocar');

function wps_catprocar($atts) {

    $atts = shortcode_atts(
            array(
                'per_page' => '12',
                'columns' => '4',
                'orderby' => 'date',
                'order' => 'desc',
                'category' => 'baby-care',
                'operator' => 'IN',
            ), $atts, 'catprocar'
    );

    $product_layout_carousel = '';

    $meta_query = WC()->query->get_meta_query();
    $tax_query = WC()->query->get_tax_query();
    $tax_query[] = array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $atts['category'],
    );

    $query_args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => 12,
        'cache_results' => false,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
        'orderby' => 'date',
        'order' => 'desc',
        'meta_query' => $meta_query,
        'tax_query' => $tax_query,
    );
    ?>

    <div class="flone_products_area woocommerce flone_section_1">

        <?php
        $wp_query = new \WP_Query($query_args);

        if ($wp_query->have_posts()) {

            wc_setup_loop(array(
                'columns' => 3,
            ));

            if ($product_layout_carousel == 'carousel') {

                $owl_settings = array();
                $owl_settings['autoplay'] = 'yes';
                $owl_settings['autoplay_timeout'] = 3000;
                $owl_settings['nav'] = "true";
                $owl_settings['loop'] = "true";
                $owl_settings['margin'] = 30;
                $owl_settings['columns_on_desktop'] = 3;
                $owl_settings['columns_on_tablet'] = 2;
                $owl_settings['columns_on_mobile'] = 1;

                $owl_settings = wp_json_encode($owl_settings);

                echo '<div class="flone-middle-nav  product-slider-active owl-carousel products columns-' . esc_attr(wc_get_loop_prop('columns')) . '" data-settings=' . $owl_settings . '>';
            } else {

                echo '<div class="row products columns-' . esc_attr(wc_get_loop_prop('columns')) . '">';
            }

            while ($wp_query->have_posts()) {
                $wp_query->the_post();

                global $product;
                $gallery_ids = $product->get_gallery_image_ids();

                $secondary_img = isset($gallery_ids[0]) ? $gallery_ids[0] : '';

                $crop_size = 'woocommerce_thumbnail';
                $image_size = apply_filters('single_product_archive_thumbnail_size', $crop_size);
                ?>

                <div <?php
                if ($product_layout_carousel == 'carousel') {
                    wc_product_class(' product');
                } else {
                    wc_product_class('col-xl-3 col-md-6 col-lg-4 col-sm-6 product');
                }
                ?>>
                    <div class="flone-product-wrap product-wrap mb-25 scroll-zoom">
                        <div class="flone-product-action product-action <?php
                        if (flone_get_option('quickview_control') == '0') {
                            echo 'quickview_removed';
                        }
                        ?> <?php
                        if (class_exists('YITH_WCWL')) {
                            echo esc_attr('has_wishlist');
                        } else {
                            echo esc_attr('no_wishlist');
                        }
                        ?>">
                                 <?php
                                 echo flone_add_to_wishlist_button();
                                 ?>
                        </div>
                        <div class="product-img">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                echo woocommerce_get_product_thumbnail($image_size);

                                if ($secondary_img) {
                                    echo wp_get_attachment_image($secondary_img, $image_size, false, array('class' => 'hover-img'));
                                }
                                ?>
                            </a>
                            <?php flone_show_product_loop_sale_flash(); ?>
                        </div>
                        <div class="flone-product-content product-content text-center">
                            <a href="<?php the_permalink(); ?>">
                                <h2><?php the_title(); ?></h2>
                            </a>
                            <div class="pro-action">
                                <?php woocommerce_template_loop_price(); ?>
                                <div class="pro-same-action pro-cart" style="float: right;display: contents;">
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            wp_reset_postdata();
        }
        ?>
    </div>
    <?php
}



