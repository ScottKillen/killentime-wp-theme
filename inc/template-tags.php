<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Scott_Killen
 */


/**
 * Display the id for the post div.
 */
function kt_post_id($post_id = null)
{
	if ($post_id) {
		echo 'id="' . $post_id  . '"';
	} else {
		echo 'id="' . kt_get_post_id()  . '"';
	}
}

/**
 * Retrieve the id for the post div.
 */
function kt_get_post_id()
{
	return 'post-' . get_the_ID();
}





/**
 * Prints HTML with meta information for the current post-date/time.
 */
function killentime_posted_on($show_border = true, $show_update = true)
{

	$border_class = $show_border ? ' border-end' : '';

	echo '<div class="col' . $border_class . '" title="Published"><svg class="bi"><use xlink:href="#fa-calendar" /></svg> ';

	$time_string = '<time class="dt-published dt-updated" datetime="%1s">%2$s</time>';

	$time_string = sprintf(
		$time_string,
		esc_attr(get_the_date(DATE_W3C)),
		esc_html(get_the_date())
	);

	echo $time_string;
	echo '</div>';
}

function killentime_reading_time($show_border = true, $post_id = null)
{
	if ($post_id === null) {
		$post_id = get_the_ID(); // Get the current post ID in the loop
	}

	$post = get_post($post_id);

	// Getting the post content and stripping HTML tags
	$content = strip_tags(get_post_field('post_content', $post->ID));
	$content = html_entity_decode($content);

	// Getting the number of words in the content
	$word_count = str_word_count($content);

	// Calculate the estimated reading time, considering 200 words per minute
	$reading_time_minutes = ceil($word_count / 200);

	// Determine the reading time string
	if ($reading_time_minutes === 1) {
		$reading_time = "1 minute";
	} else {
		$reading_time = $reading_time_minutes . " minutes";
	}

	$border_class = $show_border ? ' border-end' : '';

	// Output the reading time
	echo '<div class="col' . $border_class . '" title="Reading time">'
		. '<svg class="bi"><use xlink:href="#fa-book-open-reader" /></svg> '
		. $reading_time . '</div>';
}

/**
 * Prints HTML with meta information for the post's category
 */
function killentime_posted_in($show_border = true)
{
	$categories = get_the_category();

	if (empty($categories) || $categories[0]->name === "Uncategorized") {
		return;
	}

	// Use sprintf to build the output string for better readability.
	$output = sprintf(
		'<div class="col%s" title="Category">'
			. '<svg class="bi"><use xlink:href="#fa-tag" /></svg> '
			. '<a class="p-category me-1 link-secondary link-offset-2 '
			. 'link-underline-opacity-25 link-underline-opacity-100-hover" '
			. 'href="%s">%s</a></div>',
		$show_border ? ' border-end' : '',
		esc_url(get_category_link($categories[0]->term_id)),
		esc_html($categories[0]->name)
	);

	echo $output;
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function killentime_entry_footer()
{
	if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						__('Edit <span class="screen-reader-text">%s</span>', 'killentime'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php
	endif;

	global $post;
	$orig_post = $post;
	$tags = wp_get_post_tags($post->ID);
	if ($tags) : ?>
		<div class="shadow rounded bg-secondary-subtle border p-3 mt-5">
			<?php
			// Hide category and tag text for pages.
			if ('post' === get_post_type()) {

				$before_tag = '<span class="badge bg-info-subtle border border-info-subtle text-info-emphasis shadow rounded-pill">';
				$after_tag = '</span>';
				$tags_title = '<p class="h5 fst-italic"><svg class="bi"><title>Tags</title><use xlink:href="#fa-hashtag"/></svg> Tags</p>';
				the_tags(
					$tags_title . '<div class="d-flex gap-2">' . $before_tag,
					$after_tag . $before_tag,
					$after_tag . '</div>'
				);
			}

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
				echo '<div id="relatedposts"><p class= "mt-4 h5 fst-italic"><svg class="bi"><title>Related Posts</title><use xlink:href="#fa-newspaper"/></svg> Related Posts</p>';
				echo '<div class="row">';
				while ($my_query->have_posts()) {
					$my_query->the_post(); ?>
					<div class="col">
						<div class="relatedcontent">
							<p class="font-title mb-0"><a href="<?php the_permalink() ?>" rel="bookmark" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover link-opacity-75 link-opacity-100-hover" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
							<div class="text-secondary mb-0">
								<?php
								killentime_posted_on(false, false);
								killentime_reading_time(false);
								killentime_posted_in(false);
								?>
							</div>
						</div>
					</div>
			<?php
				}
				echo '</div></div>';
			}
			$post = $orig_post;
			wp_reset_query(); ?>
		</div>
	<?php
	endif;
}

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
					'alt' => get_the_title(),
				)
			);
			?>
		</a>

<?php
	endif; // End is_singular().
}
