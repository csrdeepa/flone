<?php

/**

 * The template for displaying all pages

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

?>

<div class="container">

	<div class="row">



		<div class="col-xl-12">

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

		

	</div>

</div><!-- .container -->			



<?php

get_footer();

