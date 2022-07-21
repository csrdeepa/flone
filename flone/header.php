<?php
global $wp_query;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>

        <?php
        wp_body_open();
        ?>
        <?php
        $enable_preloader_whole_site = flone_get_option('enable_preloader_whole_site');

        $enable_preloader_front = flone_get_option('enable_preloader_front');

        $enable_preloader_shop = flone_get_option('enable_preloader_shop');

        if ($enable_preloader_whole_site == '1'):
            ?>
            <div id="flone-preloader">
                <div class="flone-preloader">
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php elseif (is_front_page() && $enable_preloader_front == '1'): ?>
            <div id="flone-preloader">
                <div class="flone-preloader">
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php elseif (function_exists('is_shop') && is_shop() && $enable_preloader_shop == '1'): ?>
            <div id="flone-preloader">
                <div class="flone-preloader">
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $header_wrapper_class = array('site-header header-area header-in-container clearfix');

// header style
        $header_style = flone_get_option('header_style', '1');
// header width
        $header_width = flone_get_option('header_width', '');

        if (flone_get_meta_otpion('header_width')) {
            $header_width = flone_get_meta_otpion('header_width');
        }

// header container width

        if ($header_width == 'full') {
            $header_wrapper_class[] = 'header-padding-1';
            $container_class = 'container-fluid';
        } else {
            $container_class = 'container';
        }

// transparent
        if (flone_get_option('enable_transparent_header') == '1') {
            $transparent_class = 'transparent-bar';
            $header_wrapper_class[] = $transparent_class;
        }

// sticky
        if (flone_get_option('enable_sticky_header') == '1') {
            $sticky_class = 'sticky-bar';
        } else {
            $sticky_class = '';
        }

        $show_header_icons = flone_get_option('show_header_icons', 1);

// add logo class
        get_theme_mod('custom_logo') ? $header_wrapper_class[] = 'has_custom_logo' : '';

        if ($show_header_icons) {
            $header_wrapper_class[] = 'has_header_icons';
        }

        if ($header_style == '3'):
            get_template_part('template-parts/header/layout-3');
        endif;
        ?>

        <div id="page" class="site <?php echo esc_attr($header_style == '3' ? 'home-sidebar-right' : ''); ?>">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'flone'); ?></a>
            <?php
            if ($header_style == '7') {
                get_template_part('template-parts/header/layout-7');
            } elseif ($header_style == '6') {
                get_template_part('template-parts/header/layout-6');
            } elseif ($header_style == '5') {
                get_template_part('template-parts/header/layout-5');
            } elseif ($header_style == '4') {
                get_template_part('template-parts/header/layout-4');
            } elseif ($header_style == '2' || $header_style == '3') {
                get_template_part('template-parts/header/layout-2');
            } else {
                ?>
                <header id="masthead" class="<?php echo esc_attr(implode(' ', $header_wrapper_class)); ?> header_style_1">
                    <?php get_template_part('template-parts/topbar'); ?>
                    <div class="header-bottom header-res-padding <?php echo esc_attr($sticky_class) ?>">
                        <div class="<?php echo esc_attr($container_class); ?>">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-4">
                                    <div class="site-branding logo">
                                        <?php flone_logo(); ?>
                                    </div><!-- .site-branding -->
                                </div>
                                <div class="col-xl-9 col-lg-9 col-md-6 col-8 d-none d-lg-block p-0">
                                    <div class="main-menu">
                                        <?php if (has_nav_menu('menu-1')): ?>
                                            <nav id="site-navigation">
                                                <?php
                                                if (class_exists('flone_Nav_Walker')) {
                                                    wp_nav_menu(array(
                                                        'theme_location' => 'menu-1',
                                                        'menu_id' => 'primary-menu',
                                                        'container' => false,
                                                        'walker' => new flone_Nav_Walker()
                                                    ));
                                                } else {
                                                    wp_nav_menu(array(
                                                        'theme_location' => 'menu-1',
                                                        'menu_id' => 'primary-menu',
                                                        'container' => false,
                                                    ));
                                                }
                                                ?>
                                            </nav>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if (has_nav_menu('menu-1')): ?>
                                <div class="mobile-menu-area">
                                    <div class="mobile-menu">
                                        <nav id="mobile-menu-active">
                                            <?php
                                            wp_nav_menu(array(
                                                'theme_location' => 'menu-1',
                                                'menu_id' => 'primary-menu',
                                                'container' => false,
                                                'menu_class' => 'menu-overflow',
                                            ));
                                            ?>
                                        </nav>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>
                <?php
            }
            get_template_part('template-parts/header/layout-2');
            ?>
            <?php get_template_part('template-parts/breadcrumb') ?>
            <?php
            $site_content_pt = flone_get_option('site_content_pt', '0');

            $site_content_pb = flone_get_option('site_content_pb', '0');
            ?>
            <?php
            if (isset($wp_query) && (bool) $wp_query->is_posts_page) {
                ?>
                <div class="bg-banner bg-banner-blog">
                    <div class="container">
                        <h2 class="p-10 m-0">Blogs</h2>
                    </div>
                </div>
                <?php
            }
            ?>
            <div id="content" class="site-content pt-100 pb-100">