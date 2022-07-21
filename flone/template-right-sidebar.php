<?php

/**

 * Template Name: Right Sidebar

 * The template for displaying Right sidebar page

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site may use a

 * different template.

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package flone

 */



get_header();



if( !is_active_sidebar( 'sidebar-1' )){

	$content_col_class = 'col-xl-12';

} else {

	$content_col_class = 'col-xl-9 col-lg-8 order-1 order-lg-2 viiik';

}

?>

<div class="container">

	<div class="row">

		<div class="<?php echo esc_attr($content_col_class); ?>">

			<div id="primary" class="content-area">

				<main id="main" class="site-main page-main">

					<?php

					while ( have_posts() ) :

						the_post();



						get_template_part( 'template-parts/content', 'page' );



						?>

						

						<div class="row">

							<?php

							// If comments are open or we have at least one comment, load up the comment template.

							if ( comments_open() || get_comments_number() ) :

								comments_template();

							endif;

							?>

						</div>



						<?php

					endwhile; // End of the loop.

					?>



				</main>

			</div><!-- #primary -->

		</div>



		<?php if( is_active_sidebar( 'sidebar-1' ) ): ?>

		<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 order-3 order-lg-3">

			<?php get_sidebar(); ?>

		</div>

		<?php endif; ?>

	</div>

</div><!-- .container -->			

<?php

get_footer();

