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

	<div class="row d-flex justify-content-center mb-2">
		<div class="col">

			<?php
			// You can start editing here -- including this comment!
			if (have_comments()) :
			?>
				<div class="card mb-4">

					<div class="card-body p-4">
						<p class="h4 fst-italic text-center mb-2 pb-2">
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
						<?php echo KT_get_the_comments_pagination(); ?>
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
				</div><!--card-->

				<?php
				// If comments are closed and there are comments, let's leave a little note, shall we?
				if (!comments_open()) :
				?>
					<p class="text-info no-comments"><?php esc_html_e('Comments are closed.', 'scottkillen'); ?></p>
			<?php
				endif;
			endif; // Check for have_comments().
			?>
			<?php
			$fields = array(
				'author' => sprintf(
					'<div class="comment-form-author form-floating col-lg-4">%s %s</div>',
					sprintf(
						'<input id="author" name="author" type="text" value="%s" class="form-control" maxlength="245" autocomplete="name" placeholder="Name" required>',
						esc_attr($commenter['comment_author'])
					),
					'<label for="author">Name <span class="text-warning"><svg class="bi"><title>*</title><use xlink:href="#fa-asterisk"/></svg></span></label>'
				),
				'email'  => sprintf(
					'<div class="comment-form-email form-floating col-lg-4">%s %s</div>',
					sprintf(
						'<input id="email" name="email" type="email" placeholder="Email" value="%s" class="form-control" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email" required>',
						esc_attr($commenter['comment_author_email'])
					),
					'<label for="email">Email <span class="text-warning"><svg class="bi"><title>*</title><use xlink:href="#fa-asterisk"/></svg></span></label>'
				),
				'url'    => sprintf(
					'<div class="comment-form-url form-floating col-lg-4">%s %s</div>',
					sprintf(
						'<input id="url" name="url" type="url" value="%s" placeholder="Website" class="form-control" size="30" maxlength="200" autocomplete="url">',
						esc_attr($commenter['comment_author_url'])
					),
					'<label for="url">Website</label>'
				),
			);

			if (has_action('set_comment_cookies', 'wp_set_comment_cookies') && get_option('show_comments_cookies_opt_in')) {
				$consent = empty($commenter['comment_author_email']) ? '' : 'checked';

				$fields['cookies'] = sprintf(
					'<div class="mx-3 comment-form-cookies-consent form-check mb-3 col-12">%s %s</div>',
					sprintf(
						'<input id="wp-comment-cookies-consent" class="form-check-input" name="wp-comment-cookies-consent" type="checkbox" value="%s">',
						$consent
					),
					'<label class="form-check-label" for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label>'
				);
			}

			comment_form(
				array(
					'fields' => $fields,
					'title_reply_before' => '<p id="reply-title" class="h4 fst-italic">',
					'title_reply_after' => '</p>',
					'comment_notes_before' => '<p class="comment-notes text-info"><span class="email-notes">Your email address will not be published.</span> Required fields are marked <span class="text-warning"><svg class="bi"><title>*</title><use xlink:href="#fa-asterisk"/></svg></span>.</p>',
					'comment_field' => sprintf(
						'<div class="comment-form-comment form-floating col-12">%s %s</div>',
						'<textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment" maxlength="65525" required></textarea>',
						'<label for="comment">Comment <span class="text-warning"><svg class="bi"><title>*</title><use xlink:href="#fa-asterisk"/></svg></span></label>'
					),
					'submit_field' => '<div class="form-submit mx-3 col-12 ">%1$s %2$s</div>',
					'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary">%4$s</button>',
					'class_form' => 'comment-form row g-3',
				)
			);
			?>
		</div><!--col-->
	</div>
</div><!-- #comments -->
