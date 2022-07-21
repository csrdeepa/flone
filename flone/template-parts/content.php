<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flone
 */

$blog_columns = flone_get_option('blog_columns', 1);

// columns support
$lg_item    = floor(12 / $blog_columns);

$column_classes = array();
$column_classes[] = 'col-xs-12';
$column_classes[] = 'col-sm-12';
$column_classes[] = 'col-md-12 blog-page';
$column_classes[] = 'col-lg-'. $lg_item;

$column_classes = implode(' ', $column_classes);

if(is_single()){
	$column_classes = 'col-12 bolg-single';
}
?>

<div class="<?php echo esc_attr($column_classes); ?> ">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="blog-wrap-2 mb-30">

			<?php if(is_single()): ?>

			
            <div class="post-meta">
				

				<?php
					if(flone_get_option('single_show_categories', '1')){
	                	flone_posted_in();
	                	//echo '<span class="post-separator">/</span>';
	                }

				?>
				
				<span> By  </span>



	            <?php //if(flone_get_option('single_show_date', '1') ): ?>
					<?php //flone_posted_on(); ?>
	            	<!-- <span class="post-separator">/</span> -->
	            <?php //endif; ?>



            	<?php if(flone_get_option('single_show_author', '1')): ?>
	            	<?php flone_posted_by(); ?>
	            	<span class="post-separator">/</span>
	            <?php endif; ?>
            </div>

            <?php the_title( '<h1 class="entry-title viki"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

        	<?php endif; ?>

			<?php flone_post_thumbnail(); ?>

	        <div class="blog-content-2">


				<?php if( !is_single() ): ?>

				
	            <div class="post-meta">

	            	
					
					
					
					<?php if(flone_get_option('show_date', '1') ): ?>
						<?php flone_posted_on(); ?>
		            	<span class="post-separator">/</span>
	            	<?php endif; ?>

	            	<?php if(flone_get_option('show_categories', '1')){
	                	flone_posted_in();
	                	echo '<span class="post-separator">/</span>';
	                } ?>

	                <?php if(flone_get_option('show_author', '1')): ?>
		            	<?php echo '<span> by </span>';flone_posted_by(); ?>
		            	<span class="post-separator">/</span>
	            	<?php endif; ?>

	                <?php the_title( '<h2 class="entry-title viki"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

	            </div>
	        	<?php endif; ?>
	           

				<div class="entry-content">

	           <?php if(is_search() || is_archive()):

	           		the_content( sprintf(
	           			wp_kses(
	           				/* translators: %s: Name of current post. Only visible to screen readers */
	           				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flone' ),
	           				array(
	           					'span' => array(
	           						'class' => array(),
	           					),
	           				)
	           			),
	           			get_the_title()
	           		) );

	           		wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flone' ),
						'after'  => '</div>',
					) );

	           		else:
	           	?><?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'flone' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flone' ),
						'after'  => '</div>',
					) );
					?>
				<?php endif; ?>

				</div><!-- .entry-content -->

				<?php if( is_single( ) ):
					$has_share = flone_get_option('single_show_social_share', '0');
					$tag_class = ( has_tag() ) ? ' has_tag' : ' no_tag';
					$comment_class = ( comments_open() || get_comments_number() ) ? ' has_comment' : ' no_comment';
					$admin_class = is_user_logged_in() ? ' ' : ' not_logged_in';
				?>
				<div class="entry-footer tag-share <?php echo esc_attr($has_share ? 'has_share' : ''); ?> <?php echo esc_attr( $tag_class . $comment_class . $admin_class ); ?>">
					<div class="entry-footer-left">

						<?php flone_comments_link(); ?>
						
						<?php if(flone_get_option('single_show_tags', '1') && has_tag( )): ?>
							<?php flone_posted_in_tags(); ?>
						<?php endif; ?>

						<?php
							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit <span class="screen-reader-text">%s</span>', 'flone' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</div>
                    <?php
	                    if(function_exists('flone_get_social_share_html') && flone_get_option('single_show_social_share', '0')){
	                    	echo '<div class="blog-share">';
	                    	echo '<span>'. esc_html__( 'Share :', 'flone' ) .'</span>';
	                    	echo flone_get_social_share_html();
	                    	echo '</div>';
	                    }
                    ?>
                </div>
            	<?php endif; ?>

	        </div>
	    </div>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>

 <?php if (is_single() && 'post' == get_post_type() ) { 

 	// echo '-------'.get_the_ID();
 	$p_ids = get_post_meta(get_the_ID(),'product_categories',true);
 	

 	// echo '<pre>';
 	// print_r($p_ids);
 	// echo '</pre>';

 	if(count($p_ids) >1){
 	?>



	<div class="col-lg-12 related-product">
		<section class="related products columns-3">
			<div class="section-title mb-30">
				<img src="http://dev.technotackle.com/lkn/wp-content/uploads/2020/07/Group-39.png" alt="" class="mb-2 d-block">
				<h2 class="mb-1">Related Product</h2>
				<p>At vero eos et accusamus et iusto</p>
		   </div>
			   <div class="row products columns-3 woocommerce">
		   <?php
			   
			   foreach ($p_ids as $key => $product_id ) 
			   {
			   	if($key < 3){
			   		$product = wc_get_product( $product_id );
			   		$gallery = $product->get_gallery_image_ids();

			   		$galleryimg =  wp_get_attachment_image_src( $gallery[0], 'single-post-thumbnail' );

			   		if($galleryimg[0] == "")
			   		{
			   			$galleryimg[0]  =wc_placeholder_img_src( 'single-post-thumbnail');
			   		}
			   		


			   		echo '
			   		
				      <div class="col-md-6 col-sm-6 flone-col-12 col-12 product type-product post-'.$product->get_id().' status-publish first instock product_cat-clothing product_cat-fashion product_cat-hot-sales product_tag-fashion product_tag-jumper product_tag-winter has-post-thumbnail shipping-taxable purchasable product-type-simple add-to-wishlist-after_add_to_cart viki">
				         <div class="product-wrap scroll-zoom">
				            <div class="product-img">
				               <a href="'.get_permalink( $product->get_id() ).'">
				               <img src="'.$galleryimg[0].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" width="300" height="375"><img src="'.$galleryimg[0].'" class="hover-img wp-post-image" alt="" width="300" height="375">	</a>
				               <div class="product-action quickview_removed has_wishlist">
				                  <div class="pro-same-action pro-cart">
				                     <a href="?add-to-cart='.$product->get_id().'" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="'.$product->get_id().'" data-product_sku="" aria-label="Add “Women Jacket” to your cart" rel="nofollow"><i class="pe-7s-cart"></i><span class="cart_text">Add to Bag  ₹ 150</span></a>	    
				                  </div>
				                  <div class="pro-same-action pro-wishlist yith-wcwl-add-to-wishlist add-to-wishlist-'.$product->get_id().'">
				                     <div class="yith-wcwl-add-button show"><a title="Add to wishlist" '.home_url().'/wishlist-2/" data-product-id="'.$product->get_id().'" data-product-type="simple" class="add_to_wishlist viki"><i class="pe-7s-like"></i></a><i class="fa fa-spinner fa-pulse ajax-loading" style="visibility:hidden"></i></div>
				                     <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a title="Wishlist added" class="" '.home_url().'/wishlist-2/"><i class="pe-7s-check"></i></a></div>
				                     <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none"><a title="View Wishlist" '.home_url().'/wishlist-2/" class=""><i class="fa fa-heart"></i></a></div>
				                  </div>
				               </div>
				            </div>
				            <div class="product-content text-center">
				               <a href="'.get_permalink( $product->get_id() ).'" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
				                  <h2 class="woocommerce-loop-product__title">'.$product->get_name().'</h2>
				               </a>
				               <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol().'</span>'.$product->get_price().'</span></span>
				            </div>
				         </div>
				      </div>
				   	';
				   }
			   }

		   ?>
			</div>
		</section>
	</div>
<?php } }?>