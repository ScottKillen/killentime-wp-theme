<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Scott_Killen
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) :
	?>

		<div class="row d-flex justify-content-center">
			<div class="col-md-12 col-lg-10 col-xl-8">
				<div class="card">
					<div class="card-body p-4">
						<p class="h4 fst-italic text-center mb-4 pb-2">
							<?php
							$scottkillen_comment_count = get_comments_number();
							if ('1' === $scottkillen_comment_count) {
								printf(
									/* translators: 1: title. */
									esc_html__('One thought on &ldquo;%1$s&rdquo;', 'scottkillen'),
									'<span>' . wp_kses_post(get_the_title()) . '</span>'
								);
							} else {
								printf(
									/* translators: 1: comment count number, 2: title. */
									esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $scottkillen_comment_count, 'comments title', 'scottkillen')),
									number_format_i18n($scottkillen_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'<span>' . wp_kses_post(get_the_title()) . '</span>'
								);
							}
							?>
						</p>
						<?php KT_the_comments_pagination(); ?>
						<div class="row">
							<div class="col comment-list">
								<?php
								wp_list_comments(
									array(
										'walker' => new KT_Walker_Comment(),
										'style'      => 'div',
										'avatar_size' => 65,
										'short_ping' => true,
									)
								);
								?>
							</div><!-- .comment-list -->
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (!comments_open()) :
		?>
			<p class="text-info no-comments"><?php esc_html_e('Comments are closed.', 'scottkillen'); ?></p>
	<?php
		endif;
	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
