<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flone
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="col-lg-12">
	<div id="comments" class="comments-area">

		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
			<h2 class="comments-title">
				<?php
					printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'flone' ),
						number_format_i18n( get_comments_number() ) );
				?>
			</h2><!-- .comments-title -->

			<ol class="comment-list">
				<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'avatar_size' => 50,
					'short_ping' => true,
				) );
				?>
			</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'flone' ); ?></p>
				<?php
			endif;

		endif; // Check for have_comments().

		comment_form();
		?>

	</div><!-- #comments -->
</div>
