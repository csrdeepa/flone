<?php

/**

 * The template for displaying all single posts

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post

 *

 * @package flone

 */



get_header();

$single_blog_sidebar = flone_get_option('single_blog_sidebar', 'left');



if($single_blog_sidebar == 'none' || !is_active_sidebar( 'sidebar-1' )){

	$blog_col_class = 'col-xl-12';

} else {

	$blog_col_class = 'col-xl-8 col-lg-8 order-1 order-lg-2';

}

?>



<div class="container">

	<div class="row">



		<?php if($single_blog_sidebar == 'left' && is_active_sidebar( 'sidebar-1' )): ?>

		<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-2 order-lg-1">

			<?php get_sidebar(); ?>

		</div>

		<?php endif; ?>



		<div class="<?php echo esc_attr($blog_col_class); ?>">

			<div id="primary" class="content-area">

				<main id="site-main" class="site-main test">

					<div class="row">

						<?php

						while ( have_posts() ) :

							the_post();



							get_template_part( 'template-parts/content', get_post_type() );



							// If comments are open or we have at least one comment, load up the comment template.

							if ( comments_open() || get_comments_number() ) :

								comments_template();

							endif;



						endwhile; // End of the loop.

						?>

					</div>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div>



		<?php if($single_blog_sidebar == 'right'  && is_active_sidebar( 'sidebar-1' )): ?>

		<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 order-3 order-lg-3">

			<?php get_sidebar(); ?>

		</div>

		<?php endif; ?>



	</div>

</div>


