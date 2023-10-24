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

function kt_the_excerpt($post)
{
	if (has_excerpt()) { ?>
		<p><?php echo esc_html($post->post_excerpt); ?></p>
		<a href="<?php echo esc_url(get_permalink()); ?>" class="u-url more-link icon-link gap-1 icon-link-hover">Continue reading...<svg class="bi">
				<use xlink:href="#fa-chevron-right" />
			</svg></a>
	<?php
	} elseif (strpos($post->post_content, '<!--more-->')) {
		the_content(
			sprintf(
				wp_kses(
					'Continue reading<span class="screen-reader-text"> "%s"</span>',
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);
	} else {
		the_excerpt();
	}
}

function kt_the_post_thumbnail($before = '', $after = '')
{
	if ('' != get_the_post_thumbnail()) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
		$classes = array('img-fluid', 'rounded photo');

		if ($image['1'] < 400) {
			$classes[] = 'float-end';
		} else {
			$classes[] = 'mx-auto';
			$classes[] = 'd-block';
		}

		$classes[] = in_array(get_post_format(), array('image', 'gallery')) ? 'u-photo' : 'u-featured';

		echo $before;
		the_post_thumbnail('post-thumbnail', array('class' => implode(' ', $classes), 'itemprop' => 'image'));
		echo $after;
	}
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

function kt_posted_in($show_border = true)
{
	$categories_list = get_the_category_list(', ');

	if ($categories_list) {

		$classes = 'col';
		if ($show_border) {
			$classes .= ' border-end';
		}
	?>
		<div class="<?php echo $classes; ?>" title="Categories">
			<svg class="bi me-2">
				<use xlink:href="#fa-tag" />
			</svg>
			<?php echo $categories_list; ?>
		</div>
<?php
	}
}
