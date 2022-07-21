<?php

/**
 * Get theme option value
 */
function flone_get_option($opt_name = '', $default = ''){

	$options = get_option('flone_opt');

	// check query string
	if(isset($_REQUEST[$opt_name])){

		return sanitize_text_field($_REQUEST[$opt_name]);

	// check theme option
	} elseif(isset($options[$opt_name])){

		return $options[$opt_name];

	} else {

		return $default;

	}
}

/**
 * Get meta option value
 */
function flone_get_meta_otpion($opt_name = '', $default = ''){
	$prefix = '_flone_';
	$meta_opt_name = $prefix . $opt_name;

	// get the id
	if(class_exists('WooCommerce') && is_woocommerce() && !is_single()){
		$id = get_option( 'woocommerce_shop_page_id' ); 
	} elseif(is_home() && !is_front_page()){
		$id = get_option( 'page_for_posts' );
	} else {
		$id = get_the_ID();
	}
	$meta_value = get_post_meta( $id, $meta_opt_name, true );
	if($meta_value !== '' && $meta_value != 'default'){
		return $meta_value;
	} else {
		return flone_get_option($opt_name, $default);
	}
}


/**
 * Add this to any template file by calling flone_breadcrumbs()
 */
if( !function_exists('flone_breadcrumbs') ){
	 function flone_breadcrumbs() {
	 	
	 	/* === Options === */
	 	$text['home'] = esc_html__('Home', 'flone');
	 	$text['blog'] = esc_html__('Blog', 'flone');
	 	$text['category'] = esc_html__('Archive "%s"', 'flone');
	 	$text['search'] = esc_html__('Search results for "%s"', 'flone');
	 	$text['tag'] = esc_html__('Posts with tag "%s"', 'flone');
	 	$text['author'] = esc_html__('%s posts', 'flone');
	 	$text['404'] = esc_html__('Error 404', 'flone');
	 	$text['page'] = esc_html__('Page %s', 'flone');
	 	$text['cpage'] = esc_html__('Comments page %s', 'flone');
	 	
	 	$delimiter = '&nbsp;&nbsp;|&nbsp;&nbsp;';
	 	$delim_before = '';
	 	$delim_after = '';
	 	$show_home_link = 1;
	 	$show_on_home = 0;
	 	$show_title = 1;
	 	$show_current = 1;
	 	$before = '<li>';
	 	$after = '</li>';
	 	/* === End options === */
	 	
	 	global $post;
	 	$home_link = esc_url(home_url('/'));
	 	$link_before = '<li>';
	 	$link_after = '</li>';
	 	$link_attr = '';
	 	$link_in_before = '';
	 	$link_in_after = '';
	 	$link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
	 	$frontpage_id = get_option('page_on_front');
	 	$parent_id = isset($post) ? $post->post_parent : '';
	 	$delimiter = '';
	 	
	 	if (is_front_page() && !is_home()) {

	 		if ($show_on_home == 1) echo '<div class="breadcrumb-content text-center">' . esc_html( $text['home']
	 		 ) . '</div>';

	 	} elseif(is_home() && is_front_page()) {
	 		echo '<div class="breadcrumb-content text-center"><ul><li>'. $text['home'] .'</li><li>'. $text['blog'] .'</li></ul></div>';
	 	} else {

	 		echo '<div class="breadcrumb-content text-center"><ul>';
	 		if ($show_home_link == 1) echo sprintf($link, $home_link, $text['home']);

	 		if ( is_category() ) {
	             $cat = get_category(get_query_var('cat'), false);
	             if ($cat->parent != 0) {
	                 $cats = get_category_parents($cat->parent, TRUE, $delimiter);
	                 $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
	                 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
	                 if ($show_title == 0)
	                     $cats = preg_replace('/ title="(.*?)"/', '', $cats);
	                 if ($show_home_link == 1) echo wp_kses_post($delimiter);
	                     echo wp_kses_post($cats);
	             }
	             if ( get_query_var('paged') ) {
	                 $cat = $cat->cat_ID;
	                 echo wp_kses_post($delimiter . sprintf($link,esc_url( get_category_link($cat) ), get_cat_name($cat)) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after);
	             } else {
	                 if ($show_current == 1) echo wp_kses_post($delimiter . $before . sprintf($text['category'], single_cat_title('', false)) . $after);
	             }

	         } elseif ( is_search() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             echo wp_kses_post($before . sprintf($text['search'], get_search_query()) . $after);

	         } elseif ( is_day() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), get_the_time('Y')) . $delimiter;
	             echo sprintf($link, esc_url(get_month_link(get_the_time('Y')), get_the_time('m')), get_the_time('F')) . $delimiter;
	             echo wp_kses_post($before . get_the_time('d') . $after);

	         } elseif ( is_month() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), get_the_time('Y')) . $delimiter;
	             echo wp_kses_post($before . get_the_time('F') . $after);

	         } elseif ( is_year() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             echo wp_kses_post($before . get_the_time('Y') . $after);

	         } elseif ( is_single() && !is_attachment() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             if ( get_post_type() == 'product'  ) {
	                 $cats = wp_get_object_terms($post->ID, 'product_category');
	                 if ($cats){
	                     $cat_href = '';
	                     foreach( $cats as $cat ){
	                         $cat_href .= '<a href="'.esc_url(get_term_link( $cat )).'"' . $link_attr . '>' . $link_in_before . $cat->name . $link_in_after . '</a>' . ", ";
	                     }
	                 }
	                 echo wp_kses_post($cat_href != '' ? $link_before . substr($cat_href, 0, -2) . $link_after : '');
	                 if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);
	             } else {
	                 $cat = get_the_category();
	                 if(!empty($cat)) {
	 					$cat = $cat[0];
	 					$cats = get_category_parents($cat, TRUE, $delimiter);
	 					if ($show_current == 0 || get_query_var('cpage')) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
	 					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
	 					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
	 					echo wp_kses_post($cats);
	 				} else {
	 					echo esc_html__('No Categories', 'flone');
	 				}
	                 if ( get_query_var('cpage') ) {
	                     echo wp_kses_post($delimiter . sprintf($link, esc_url(get_permalink()), get_the_title()) . $delimiter . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after);
	                 } else {
	                     if ($show_current == 1) echo wp_kses_post($before . get_the_title() . $after);
	                 }
	             }

	         // custom post type
	         } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	             $post_type = get_post_type_object(get_post_type());
	             $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	             if ( get_query_var('paged') ) {
	                 echo wp_kses_post($delimiter . sprintf($link, esc_url(get_post_type_archive_link($post_type->name)), $post_type->label) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after);
	             } else {
	                 if ($show_current == 1 && is_object($term))
	                     echo wp_kses_post($delimiter . $before . $term->name . $after);
	                 else
	                     echo wp_kses_post($delimiter . $before . $post_type->name . $after);
	             }

	         } elseif ( is_attachment() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             $parent = get_post($parent_id);
	             $cat = get_the_category($parent->ID); $cat = $cat[0];
	             if ($cat) {
	                 $cats = get_category_parents($cat, TRUE, $delimiter);
	                 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
	                 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
	                 echo wp_kses_post($cats);
	             }
	             printf($link, esc_url(get_permalink($parent)), $parent->post_title);
	             if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

	         } elseif ( is_page() && !$parent_id ) {

	             if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

	         } elseif ( is_page() && $parent_id ) {

	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             if ($parent_id != $frontpage_id) {
	                 $breadcrumbs = array();
	                 while ($parent_id) {
	                     $page = get_post($parent_id);
	                     if ($parent_id != $frontpage_id) {
	                         $breadcrumbs[] = sprintf($link, esc_url(get_permalink($page->ID)), get_the_title($page->ID));
	                     }
	                     $parent_id = $page->post_parent;
	                 }
	                 $breadcrumbs = array_reverse($breadcrumbs);
	                 for ($i = 0; $i < count($breadcrumbs); $i++) {
	                     echo wp_kses_post($breadcrumbs[$i]);
	                     if ($i != count($breadcrumbs)-1) echo wp_kses_post($delimiter);
	                 }
	             }
	             if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

	         } elseif ( is_tag() ) {
	             if ($show_current == 1) echo wp_kses_post($delimiter . $before . sprintf($text['tag'], single_tag_title('', false)) . $after);

	         } elseif ( is_author() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             global $author;
	             $author = get_userdata($author);
	             echo wp_kses_post($before . sprintf($text['author'], $author->display_name) . $after);

	         } elseif ( is_404() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             echo wp_kses_post($before . $text['404'] . $after);

	         } elseif ( has_post_format() && !is_singular() ) {
	             if ($show_home_link == 1) echo wp_kses_post($delimiter);
	             echo get_post_format_string( get_post_format() );
	         }

	 		echo '</ul></div>';

	  	}
	 	
	 } // end flone_breadcrumbs()
}

// modify readmore
add_filter( 'the_content_more_link', 'flone_modify_read_more_link', null, 2);
function flone_modify_read_more_link(  ) {
	$readmore_text = flone_get_option( 'readmore_text' );

	if( $readmore_text ){
		$readmore_text = esc_html( $readmore_text );
	} else { 
		$readmore_text = esc_html__('Read More','flone');
	};

    if(function_exists('flone_get_social_share_html')){
    	$social_share_html = '<div class="blog-share">';
    	$social_share_html .= '<span>'. esc_html__( 'Share :', 'flone' ) .'</span>';
    	$social_share_html .= flone_get_social_share_html();
    	$social_share_html .= '</div>';
    } else {
    	$social_share_html = '';
    }

    return '<div class="blog-share-comment"><a class="readmore" href="'. get_permalink().' ">'.$readmore_text.'</a>'. $social_share_html .'</div>';
}

/**
 * Add quick icons to any template file by calling flone_header_quick_icons()
 */
if( !function_exists('flone_get_social_networks_html') ){
	function flone_get_social_networks_html(){
		$icons_arr = flone_get_option('social_icons');
		?>

		<ul>
			<?php
			foreach($icons_arr as $key => $value ) {

				if( $value ){
					if($key == 'vimeo'){
			    		echo '<li class="'. $key .'"><a target="_blank" href="'. esc_url($value) .'" title="'. esc_attr(ucwords($key)).'"><i class="fab fa-vimeo-square"></i></a></li>';
				    } elseif($key == 'rss'){
			    		echo '<li class="'. $key .'"><a target="_blank" href="'. esc_url($value) .'" title="'. esc_attr(ucwords($key)).'"><i class="fas fa-'. esc_attr($key) .'"></i></a></li>';
				    } else {
				    	echo '<li class="'. $key .'"><a target="_blank" href="'. esc_url($value) .'" title="'. esc_attr(ucwords($key)) .'"><i class="fab fa-'. esc_attr($key) .'"></i></a></li>';
				    }
				}
			}
			?> 
		</ul>

		<?php
		return ob_get_clean();
	}
}








/**
* Blog Pagination 
*/
if(!function_exists('flone_blog_pagination')){
	function flone_blog_pagination(){
		?>
		<div class="paginations text-center pt-20"> <?php
			the_posts_pagination(array(
				'prev_text'          => '<i class="fa fa-angle-left"></i>',
				'next_text'          => '<i class="fa fa-angle-right"></i>',
				'type'               => 'list'
			)); ?>
		</div>
		<?php
	}
}

/**
* Enable post excerpt
*/
function flone_enable_post_excerpt($content){
	if(is_home() && has_excerpt()){

		$content = wpautop(get_the_excerpt());

	} else {

		$enable_post_excerpt = flone_get_option('enable_post_excerpt');
		$excerpt_length = flone_get_option('excerpt_length');

		if($enable_post_excerpt && is_home() && ( (get_post_type() == 'post' || get_post_type() == 'page') && !is_singular() ) ){
			$content = wpautop( wp_trim_words( get_the_content(), $excerpt_length, '' ) );
			$content .= flone_modify_read_more_link();
		} else {
			return $content;
		}

	}

	return $content;
}
add_filter( 'the_content', 'flone_enable_post_excerpt' );

function flone_modify_default_excerpt( $excerpt, $post ){
	if((get_post_type() == 'post' || get_post_type() == 'page') && !is_singular() ){
		$excerpt .= flone_modify_read_more_link();
	}

	return $excerpt;
}
add_filter( 'get_the_excerpt', 'flone_modify_default_excerpt', 10, 2 );

/**
 * Add quick icons to any template file by calling flone_header_quick_icons()
 */
if( !function_exists('flone_header_quick_icons') ){
	 function flone_header_quick_icons(){
	 	$show_header_icons = flone_get_option('show_header_icons');

	 	if(!$show_header_icons) return;

	 	$header_style = flone_get_option('header_style');
	 	$quick_nav_show_search = flone_get_option('quick_nav_show_search');
	 	$quick_nav_show_user = flone_get_option('quick_nav_show_user');
	 	$quick_nav_show_wishlist = flone_get_option('quick_nav_show_wishlist');
	 	$quick_nav_show_minicart = flone_get_option('quick_nav_show_minicart');

	 	ob_start();
	 	?>
	        <div class="header-right-wrap <?php echo esc_attr(($header_style == '4' || $header_style == '5') ? 'header-right-wrap-white' : ''); ?>">

	        	<?php if($quick_nav_show_search): ?>
	            <div class="same-style header-search">
	                <a class="search-active" href="#"><i class="pe-7s-search"></i></a>
	                <div class="search-content">
						<form class="pro-sidebar-search-form" action="<?php echo esc_url(home_url( '/' )); ?>" method="GET">
							<input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search Product', 'placeholder', 'flone' ); ?>" value="<?php echo get_search_query(); ?>">
							<button class="button-search">
								<i class="pe-7s-search"></i>
							</button>

							<?php if(class_exists('WooCommerce') ): ?>
								<input type="hidden" name="post_type" value="product" />
							<?php endif; ?>
						</form>
	                </div> 
	            </div>
	        	<?php endif; ?>

	            <?php if( has_nav_menu('extra-header-menu') && $quick_nav_show_user): ?>
	            <div class="same-style account-satting">
				
					<?php
						if ( is_user_logged_in() ) {
							?>
							<a class="account-satting-active" href="#"><i class="pe-7s-add-user"></i></a>
							<div class="account-dropdown">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'extra-header-menu',
										'container' => 'false',
									) );
								?>
							</div>
							<?php
						}else{
							if ( class_exists('WooCommerce') ){
								echo '<a href="' .esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )).'"><i class="pe-7s-user"></i></a>';
							}else{
								echo '<a href="' .esc_url(wp_login_url()).'"><i class="pe-7s-user"></i></a>';
							}
						}
					?>

	            </div>
	            <?php endif; ?>
				
				<?php
				    $wishlist_page_url = get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) );
				    if($wishlist_page_url && $quick_nav_show_wishlist):
				?>
	            <div class="same-style header-wishlist">
	                <a href="<?php echo esc_url($wishlist_page_url);?>"><i class="pe-7s-like"></i></a>
	            </div>
	            <?php endif; ?>
	            
	            <?php if($quick_nav_show_minicart): ?>
	            <div class="same-style cart-wrap">
	                <button class="icon-cart">
	                    <i class="pe-7s-shopbag"></i>
	                    <span class="count-style">0</span>
	                </button>
	                <div class="shopping-cart-content">
	                    <div class="widget_shopping_cart_content">
	                        
	                    </div>
	                </div>
	            </div>
	           	<?php endif; ?>
	        </div>
	 	<?php

	 	return ob_get_clean();
	 }
 }


/**
 * Add quick nav to any template file by calling flone_header_quick_contents()
 */
if( !function_exists('flone_header_quick_contents') ){
	function flone_header_quick_contents(){
		$show_topbar_language = flone_get_option('show_topbar_language');
		$show_topbar_currency = flone_get_option('show_topbar_currency');
		$topbar_text_1 = flone_get_option('topbar_text_1');

		if($show_topbar_language || $show_topbar_currency || $topbar_text_1): ?>

			<div class="language-currency-wrap">

				<?php if($show_topbar_language): ?>
			    <div class="same-language-currency language-style">
			        <?php
			        	if(function_exists('flone_language_selector')){
			        		flone_language_selector();
			        	}
			        ?>
			    </div>
				<?php endif; ?>

				<?php if($show_topbar_currency): ?>
			    <div class="same-language-currency use-style">
			    	<?php
			    		if(function_exists('flone_language_selector') && function_exists('flone_currency_dropdown')){
			    			if(flone_get_option('currency_switcher_type') == 'plugin'){
			    				echo do_shortcode('[WCMC style="all"]');
			    			} else {
			    				flone_currency_dropdown();
			    			}
			    		}
			    	?>
			    </div>
			    <?php endif; ?>

			    <?php if($topbar_text_1): ?>
			    <div class="same-language-currency">
			        <p><?php echo wp_kses_post($topbar_text_1); ?></p>
			    </div>
			    <?php endif; ?>

			</div>

	<?php endif;
	}
}

 /**
  * Add logo to any template file by calling flone_logo()
  */
 if( !function_exists('flone_logo') ){
 	 function flone_logo(){
 		$flone_description = get_bloginfo( 'description', 'display' );

 		if(has_custom_logo()){

 			the_custom_logo();
 			
 		} else {
 			?>
 				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
 				<p class="site-description"><?php echo esc_html( $flone_description ); /* WPCS: xss ok. */ ?></p>
 			<?php
 		}
 	 }
 }

 /**
  * Expandable menu
  */
 if( !function_exists('flone_slinky_menu') ){
 	 function flone_slinky_menu(){ ?>
 		<div class="clickable-mainmenu">
 			<div class="clickable-mainmenu-icon">
 			    <button class="clickable-mainmenu-close">
 			        <span class="pe-7s-close"></span>
 			    </button>
 			</div>
 			<div class="side-logo">
 			    <?php flone_logo(); ?>
 			</div>
 			<div id="menu" class="text-left clickable-menu-style">
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
 			</div>

 			<?php if(flone_get_option('enable_social_icons')): ?>
 			<div class="side-social">
 			    <?php echo flone_get_social_networks_html(); ?>
 			</div>
 			<?php endif; ?>
 		</div><!-- .clickable-mainmenu -->
 	 	<?php
 	 }
 }

 /**
  * Expandable menu
  */
function flone_is_wp_version( $operator = '>', $version = '4.0' ) {
	global $wp_version;
	return version_compare( $wp_version, $version, $operator );
}