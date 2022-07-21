<?php

/**

 * Template part for displaying header layout 2

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package flone

 */



$header_wrapper_class = array();

$header_wrapper_class[] = 'site-header header-area header-in-container clearfix';



// header style

$header_style = flone_get_option('header_style', '1');



// header width

$header_width = flone_get_option('header_width', '');

if(flone_get_meta_otpion('header_width')){

	$header_width = flone_get_meta_otpion('header_width');

}





// container width

if($header_width == 'full'){

	$header_wrapper_class[] = 'header-padding-1';

	$container_class =  'container-fluid';

} else {

 	$container_class =  'container';

}





// transparent

if(flone_get_option('enable_transparent_header')  == '1'){

	$transparent_class = 'transparent-bar';

	$header_wrapper_class[] = $transparent_class;

} else {

	$transparent_class = '';

}



// sticky

if(flone_get_option('enable_sticky_header')  == '1'){

	$sticky_class = 'sticky-bar';

} else {

	$sticky_class = '';

}



// header icons

$show_header_icons = flone_get_option('show_header_icons', 1);

if($show_header_icons){

	$header_wrapper_class[] = 'has_header_icons';

}



$header_style == '3' ? $header_wrapper_class[] = 'header-hm4-none' : '';

?>



<header id="masthead" class="<?php echo esc_attr(implode(' ', $header_wrapper_class)); ?> header_style_2">

	<?php get_template_part('template-parts/topbar'); ?>



	<div class="header-bottom sticky-bar header-res-padding">

    <div class="<?php echo esc_attr($container_class); ?>">

        <div class="row">

            <div class="col-xl-2 col-lg-2 col-md-6 col-4">

            	<div class="site-branding logo">

            		<?php flone_logo(); ?>

            	</div><!-- .site-branding -->

            </div>





            <div class="col-xl-8 col-lg-8 d-none d-lg-block">

                <div class="main-menu">

                	<?php if(has_nav_menu('menu-1')): ?>

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

                	<?php endif; ?>

                </div>

            </div>

			

			<?php if(flone_header_quick_icons()): ?>

            <div class="col-xl-2 col-lg-2 col-md-6 col-8">

                <?php echo flone_header_quick_icons(); ?>

            </div>

        	<?php endif; ?>



        </div>



        <?php if( has_nav_menu('menu-1') ): ?>

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

    	<?php endif; ?>



    </div>

	</div>

</header>