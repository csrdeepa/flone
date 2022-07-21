<?php
/**
 * Template part for displaying header layout 7
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flone
 */

// sticky
if(flone_get_option('enable_sticky_header')  == '1'){
	$sticky_class = 'sticky-bar';
	$header_2_wrapper_class[] = $sticky_class;
} else {
	$sticky_class = '';
}

// transparent
if(flone_get_option('enable_transparent_header')  == '1'){
	$transparent_class = 'transparent-bar';
	$header_wrapper_class[] = $transparent_class;
	$header_2_wrapper_class[] = $transparent_class;
} else {
	$transparent_class = '';
}
?>

<header class="header-area clearfix header-hm9 header_style_7 <?php echo esc_attr($transparent_class); ?>">
	<?php get_template_part('template-parts/topbar'); ?>
    <div class="container">
        <div class="header-top-area">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-12">
                    <?php flone_header_quick_contents(); ?>
                </div>
                <div class="col-lg-2 d-none d-lg-block">
                    <div class="logo-hm9 site-branding text-center">
                        <?php flone_logo() ?>
                    </div>
                </div>

                <?php if(flone_header_quick_icons()): ?>
                <div class="col-lg-5 col-md-4 col-12">
                    <?php echo flone_header_quick_icons(); ?>
                </div>
            	<?php endif; ?>

            </div>
        </div>
    </div>
    <div class="header-bottom header-res-padding header-padding-2 <?php echo esc_attr($sticky_class); ?>">
        <div class="container">
            <div class="row">
                <div class="col-12 d-block d-lg-none">
                    <div class="logo">
                         <?php flone_logo() ?>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 d-none d-lg-block">
                    <div class="main-menu">
                        <nav>
	                    	<?php
	                    		if(class_exists('flone_Nav_Walker')){
	                    			wp_nav_menu( array(
	                    				'theme_location' => 'menu-1',
	                    				'menu_id'        => 'primary-menu',
	                    				'container'		 => false,
	                    				'walker'         => new flone_Nav_Walker()
	                    			) );
	                    		} else {
	                    			wp_nav_menu( array(
	                    				'theme_location' => 'menu-1',
	                    				'menu_id'        => 'primary-menu',
	                    				'container'		 => false,
	                    			) );
	                    		}
							?>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                    	<?php
                    		wp_nav_menu( array(
                    			'theme_location' => 'menu-1',
                    			'menu_id'        => 'primary-menu',
                    			'container'		 => false,
                    			'menu_class'     => 'menu-overflow',
                    		) );
						?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>