<?php
defined('ABSPATH') || exit;

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
			$classes[] = 'mx-3';
		} else {
			$classes[] = 'mx-auto';
			$classes[] = 'd-block';
		}

		$classes[] = in_array(get_post_format(), array('image', 'gallery')) ? 'u-photo' : 'u-featured';

		if ('image' === get_post_format()) {
			$classes[] = 'figure-img';
			$classes[] = 'img-fluid';
			$classes[] = 'rounded';
		}

		echo $before;
		the_post_thumbnail('post-thumbnail', array('class' => implode(' ', $classes), 'itemprop' => 'image'));
		echo $after;
	}
}

function kt_comments_popup_link($before = '', $after = '')
{
	if (comments_open() || ('0' != get_comments_number() && !comments_open())) {
		echo $before;
		comments_popup_link('Leave a comment', '1 Comment', '% Comments');
		echo $after;
	}
}

function kt_the_post_date($before = '', $after = '', $link = true)
{
	echo $before;

	if ($link) {
		printf(
			'<a href="%1$s" title="%2$s" rel="bookmark" class="url u-url link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><time class="entry-date updated published dt-updated dt-published" datetime="%3$s" itemprop="dateModified datePublished">%4$s</time></a>',
			esc_url(get_permalink()),
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date())
		);
	} else {
		printf(
			'<span title="%1$s"><time class="entry-date updated published dt-updated dt-published" datetime="%2$s" itemprop="dateModified datePublished">%3$s</time></span>',
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date())
		);
	}

	printf(
		'<address class="byline d-none"><span class="author p-author vcard hcard h-card" itemprop="author " itemscope itemtype="http://schema.org/Person">%1$s <a class="url uid u-url u-uid fn p-name" href="%2$s" rel="author" itemprop="url"><span itemprop="name">%3$s</span></a></span></address>',
		get_avatar(get_the_author_meta('ID'), 90),
		esc_url(get_author_posts_url(get_the_author_meta('ID'))),
		esc_html(get_the_author())
	);

	echo $after;
}

function kt_the_post_read_time($before = '', $after = '')
{
	$post = get_post(get_the_ID());

	// Getting the post content and stripping HTML tags
	$content = strip_tags(get_post_field('post_content', $post->ID));
	$content = html_entity_decode($content);

	// Getting the number of words in the content
	$word_count = str_word_count($content);

	// Calculate the estimated reading time, considering 200 words per minute
	$reading_time_minutes = $word_count / 200;

	echo $before;

	// Determine the reading time string
	if ($reading_time_minutes < 1) {
		echo 'under 1 minute';
	} else {
		$reading_time_minutes = ceil($reading_time_minutes);
		if ($reading_time_minutes === 1) {
			echo '1 minute';
		} else {
			echo $reading_time_minutes . ' minutes';
		}
	}

	echo $after;
}

function kt_the_categories($before = '', $after = '')
{
	$categories_list = get_the_category_list(', ');

	if ($categories_list) {

		$p = new WP_HTML_Tag_Processor($categories_list);
		while ($p->next_tag('a')) {
			$p->add_class('link-secondary');
			$p->add_class('link-offset-2');
			$p->add_class('link-underline-opacity-25');
			$p->add_class('link-underline-opacity-100-hover');
		}

		echo $before;
		echo $p->get_updated_html();
		echo $after;
	}
}

function kt_the_tags($before = '', $after = '')
{
	$tag_list = get_the_tag_list('', ', ');

	if ($tag_list) {

		$p = new WP_HTML_Tag_Processor($tag_list);
		while ($p->next_tag('a')) {
			$p->add_class('link-secondary');
			$p->add_class('link-offset-2');
			$p->add_class('link-underline-opacity-25');
			$p->add_class('link-underline-opacity-100-hover');
		}

		echo $before;
		echo $p->get_updated_html();
		echo $after;
	}
}

function kt_content_nav($nav_id)
{
	global $wp_query;

	?>
	<nav id="<?php echo esc_attr($nav_id); ?>" "aria-label=" Post navigation">

		<?php if (is_single()) : // navigation links for single posts
		?>
			<ul class="pagination">
				<?php previous_post_link('<li class="nav-previous page-item">%link</li>', '&larr; %title'); ?>
				<?php next_post_link('<li class="nav-next page-item">%link</li>', '%title &rarr;'); ?>
			</ul>

		<?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home, archive, and search pages
		?>

			<ul class="pagination">
				<?php if (get_next_posts_link()) : ?>
					<div class="nav-previous page-item"><?php next_posts_link('<span class="meta-nav">&larr;</span> Older posts'); ?></div>
				<?php endif; ?>

				<?php if (get_previous_posts_link()) : ?>
					<div class="nav-next page-item"><?php previous_posts_link('Newer posts <span class="meta-nav">&rarr;</span>'); ?></div>
				<?php endif; ?>
			</ul>

		<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
<?php
}
