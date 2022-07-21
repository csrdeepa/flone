<?php
/**
 * Template part for displaying header layout 5
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flone
 */

// header width
$header_width = flone_get_option('header_width', '');
if(flone_get_meta_otpion('header_width')){
	$header_width = flone_get_meta_otpion('header_width');
}

// header container width
if($header_width == 'full'){
	$header_wrapper_class[] = 'header-padding-1';
	$container_class =  'container-fluid';
} else {
 	$container_class =  'container';
}

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
<header class="header-area header-padding-3 header-res-padding clearfix header-hm-7 header_style_5 <?php echo esc_attr($transparent_class); ?>">
	<?php get_template_part('template-parts/topbar'); ?>
	
    <div class="<?php echo esc_attr($container_class); ?> <?php echo esc_attr($sticky_class); ?>">
        <div class="row">
            <div class="col-xl-5 col-lg-4 col-md-4 col-1">
                <div class="clickable-menu clickable-mainmenu-active">
                    <a href="#"><i class="pe-7s-menu"></i></a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-5">
                <div class="logo site-branding text-center logo-hm5">
					<?php 
					$flone_description = get_bloginfo( 'description', 'display' );
					$logo_light = get_theme_mod('custom_logo_light'); 
						if($logo_light){
							?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url($logo_light); ?>" alt="<?php echo esc_attr__('Logo Light', 'flone') ?>"></a> <?php
						} else {
							?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<p class="site-description"><?php echo esc_html( $flone_description ); /* WPCS: xss ok. */ ?></p>
							<?php							
						}
					?>					
                </div>
            </div>

            <?php if(flone_header_quick_icons()): ?>
            <div class="col-xl-5 col-lg-4 col-md-4 col-5">
                <?php echo flone_header_quick_icons(); ?>
            </div>
        	<?php endif; ?>

        </div>
    </div>
</header>