<?php
/**
 * Template part for displaying header layout 3
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flone
 */

$show_header_icons = flone_get_option('show_header_icons', 1);
?>

<div class="home-sidebar-left">
    <div class="logo">
        <?php flone_logo(); ?>
    </div>
    <?php
    	if($show_header_icons){
    		echo flone_header_quick_icons();
    	}
    ?>
    <div class="sidebar-menu">
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

    <?php if(flone_get_option('copyright_text')): ?>
    <div class="sidebar-copyright">
         <?php echo wp_kses_post(wpautop(flone_get_option('copyright_text'))); ?>
    </div>
	<?php endif; ?>
	
</div><!-- home-sidebar-left -->