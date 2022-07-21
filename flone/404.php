<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package flone
 */

get_header();
$default_not_found_title = esc_html__('Oops! That page can\'t be found.', 'flone');
$default_not_found_content = esc_html__('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'flone');

$not_found_title = flone_get_option('not_found_title', $default_not_found_title);
$not_found_content = flone_get_option('not_found_content', $default_not_found_content);
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div id="primary" class="content-area">
				<main id="main" class="site-main text-center">
					<header class="page-header">
						<h1 class="page-title">
							<?php echo wp_kses_post($not_found_title); ?>
						</h1>
					</header><!-- .page-header -->

					<div class="entry-content content-404">
						<p><?php echo wp_kses_post($not_found_content); ?></p>
						
						<?php
							if(flone_get_option('not_found_show_search', '1')){
								get_search_form();
							}
						?>
					</div><!-- .entry-content -->
				</main>
			</div><!-- #primary -->
		</div>
	</div>
</div>
<?php
get_footer();
