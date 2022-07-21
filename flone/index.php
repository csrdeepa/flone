<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flone
 */

get_header();
$blog_sidebar = flone_get_option('blog_sidebar', 'left');

if($blog_sidebar == 'none' || !is_active_sidebar( 'sidebar-1' )){
	$blog_col_class = 'col-xl-12';
} else {
	$blog_col_class = 'col-xl-8 col-lg-8 order-1 order-lg-2';
}
?>

<div class="blog-home">
<div class="container">
	<div class="row">

		<?php if($blog_sidebar == 'left' && is_active_sidebar( 'sidebar-1' )): ?>
		<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-2 order-lg-1 pr-lg-5">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>

		<div class="<?php echo esc_attr($blog_col_class); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main post-main">
					
					<div class="row">
						<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							?>
							<!--<div class="col-lg-12">
								<?php //flone_blog_pagination(); ?>
							</div>-->
							<?php

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
					</div>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>

		<?php if($blog_sidebar == 'right'  && is_active_sidebar( 'sidebar-1' )): ?>
		<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 order-3 order-lg-3">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>

	</div>
</div>
</div>
<?php
get_footer();
