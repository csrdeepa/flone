<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package flone
 */

get_header();

$blog_sidebar = flone_get_option('blog_sidebar', 'left');

if($blog_sidebar == 'none' || !is_active_sidebar( 'sidebar-1' )){
	$blog_col_class = 'col-xl-12';
} else {
	$blog_col_class = 'col-xl-9 col-lg-8 order-1 order-lg-2';
}
?>
<div class="container">
	<div class="row">

		<?php if($blog_sidebar == 'left' && is_active_sidebar( 'sidebar-1' )): ?>
		<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 order-2 order-lg-1">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>

		<section id="primary" class="content-area col-xl-9 col-lg-8 order-1 order-lg-2">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

				<h1 class="entry-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'flone' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				
				<div class="row">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content' );

					endwhile;

					?>
					<div class="col-lg-12">
						<?php flone_blog_pagination(); ?>
					</div>
					<?php

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>
			</main><!-- #main -->
		</section><!-- #primary -->

		<?php if($blog_sidebar == 'right'  && is_active_sidebar( 'sidebar-1' )): ?>
		<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 order-3 order-lg-3">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>

	</div>
</div>
<?php
get_footer();
