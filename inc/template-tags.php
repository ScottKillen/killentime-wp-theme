<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Scott_Killen
 */

if (!function_exists('killentime_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function killentime_posted_on()
	{
		$time_string = ' <svg class="bi"><title>published</title><use xlink:href="#clock"/></svg> %1$s';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string .= ' <span class="fst-italic post-update-meta text-decoration-underline">(updated %2$s)</span>';
		}

		$time_string = sprintf(
			$time_string,
			esc_html(get_the_date()),
			esc_html(get_the_modified_date())
		);

		echo $time_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('killentime_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function killentime_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'killentime'),
			'<span class="author vcard me-1"><a class="link-secondary text-decoration-none fw-bold link-secondary-emphasis" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('killentime_posted_in')) :
	/**
	 * Prints HTML with meta information for the post's category
	 */
	function killentime_posted_in()
	{
		$categories = get_the_category();
		if (empty($categories)) {
			return;
		}

		if ($categories[0]->name === "Uncategorized") {
			return;
		}

		echo 'in <a class="me-1 link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . "</a>";
	}
endif;

if (!function_exists('killentime_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function killentime_entry_footer()
	{ ?>
		<div class="shadow rounded bg-primary-subtle border p-3 mt-5">
			<?php
			// Hide category and tag text for pages.
			if ('post' === get_post_type()) {

				$before_tag = '<span class="badge text-bg-primary rounded-pill">';
				$after_tag = '</span>';
				$tags_title = '<p class="h5 fst-italic"><svg class="bi"><title>Tags</title><use xlink:href="#hashtag"/></svg> Tags</p>';
				the_tags(
					$tags_title . '<div class="d-flex gap-2">' . $before_tag,
					$after_tag . $before_tag,
					$after_tag . '</div>'
				);
			}
			global $post;
			$orig_post = $post;
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$tag_ids = array();
				foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args = array(
					'tag__in' => $tag_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page' => 3, // Number of related posts that will be shown.
					'ignore_sticky_posts' => 1
				);
				$my_query = new wp_query($args);
				if ($my_query->have_posts()) {
					echo '<div id="relatedposts"><p class= "mt-4 h5 fst-italic"><svg class="bi"><title>Related Posts</title><use xlink:href="#posts"/></svg> Related Posts</p>';
					echo '<div class="row">';
					while ($my_query->have_posts()) {
						$my_query->the_post(); ?>
						<div class="col">
							<div class="relatedcontent">
								<p class="font-title mb-0"><a href="<?php the_permalink() ?>" rel="bookmark" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover link-opacity-75 link-opacity-100-hover" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
								<p class="text-secondary mb-0"><?php the_time('M j, Y') ?> <?php killentime_posted_in() ?></p>
							</div>
						</div>
			<?php }
					echo '</div></div>';
				}
			}
			$post = $orig_post;
			wp_reset_query(); ?>
		</div>
		<?php
	}
endif;

if (!function_exists('killentime_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function killentime_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
		?>

			<div class="post-thumbnail float-end ms-3 mb-3 shadow rounded overflow-hidden">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;
