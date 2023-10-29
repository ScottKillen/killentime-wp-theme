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
		<a href="<?php echo esc_url(get_permalink()); ?>" class="u-url more-link icon-link gap-1 icon-link-hover">Continue reading&hellip;<svg class="bi">
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
				<?php previous_post_link('<li class="nav-previous page-item">%link</li>', '<svg class="bi"><use xlink:href="#fa-chevron-left" /></svg> %title'); ?>
				<?php next_post_link('<li class="nav-next page-item">%link</li>', '%title <svg class="bi"><use xlink:href="#fa-chevron-right" /></svg>'); ?>
			</ul>

		<?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home, archive, and search pages
		?>

			<ul class="pagination">
				<?php if (get_next_posts_link()) : ?>
					<div class="nav-previous page-item"><?php next_posts_link('<svg class="bi"><use xlink:href="#fa-chevron-left" /></svg> Older posts'); ?></div>
				<?php endif; ?>

				<?php if (get_previous_posts_link()) : ?>
					<div class="nav-next page-item"><?php previous_posts_link('Newer posts <svg class="bi"><use xlink:href="#fa-chevron-right" /></svg>'); ?></div>
				<?php endif; ?>
			</ul>

		<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
<?php
}

function kt_get_the_comments_pagination($args = array())
{
	// Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
	if (!empty($args['screen_reader_text']) && empty($args['aria_label'])) {
		$args['aria_label'] = $args['screen_reader_text'];
	}

	$args = wp_parse_args(
		$args,
		array(
			'screen_reader_text' => __('Comments navigation'),
			'aria_label'         => __('Comments'),
			'class'              => 'comments-pagination',
		)
	);
	$args['echo'] = false;
	$args['type'] = 'list';

	$p = new WP_HTML_Tag_Processor(paginate_comments_links($args));

	if ($p->next_tag('ul')) {
		$p->add_class('pagination');
		$p->add_class('pagination-sm');
	}

	$p = new WP_HTML_Tag_Processor($p->get_updated_html());

	while ($p->next_tag('li')) {
		$p->add_class('page-item');
	}

	$p = new WP_HTML_Tag_Processor($p->get_updated_html());

	while ($p->next_tag('a')) {
		$p->add_class('page-link');
	}

	$navigation = str_replace(
		'page-item"><span aria-current="page" class="page-numbers current"',
		'page-item active" aria-current="page"><span class="page-link"',
		$p->get_updated_html()
	);
	$navigation = str_replace('&laquo; Previous', '<svg class="bi"><title>Older</title><use xlink:href="#fa-chevrons-left"/></svg>', $navigation);
	$navigation = str_replace('Next &raquo;', '<svg class="bi"><title>Newer</title><use xlink:href="#fa-chevrons-right"/></svg>', $navigation);
	return $navigation;
}

function kt_list_comments($args = array(), $comments = null)
{
	global $wp_query, $comment_alt, $comment_depth, $comment_thread_alt, $overridden_cpage, $in_comment_loop;

	$in_comment_loop = true;

	$comment_alt        = 0;
	$comment_thread_alt = 0;
	$comment_depth      = 1;

	$defaults = array(
		'max_depth'         => '',
		'style'             => 'ul',
		'callback'          => null,
		'end-callback'      => null,
		'type'              => 'all',
		'page'              => '',
		'per_page'          => '',
		'avatar_size'       => 32,
		'reverse_top_level' => null,
		'reverse_children'  => '',
		'format'            => current_theme_supports('html5', 'comment-list') ? 'html5' : 'xhtml',
		'short_ping'        => false,
		'echo'              => true,
	);

	$parsed_args = wp_parse_args($args, $defaults);

	/**
	 * Filters the arguments used in retrieving the comment list.
	 *
	 * @since 4.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param array $parsed_args An array of arguments for displaying comments.
	 */
	$parsed_args = apply_filters('wp_list_comments_args', $parsed_args);

	// Figure out what comments we'll be looping through ($_comments).
	if (null !== $comments) {
		$comments = (array) $comments;
		if (empty($comments)) {
			return;
		}
		if ('all' !== $parsed_args['type']) {
			$comments_by_type = separate_comments($comments);
			if (empty($comments_by_type[$parsed_args['type']])) {
				return;
			}
			$_comments = $comments_by_type[$parsed_args['type']];
		} else {
			$_comments = $comments;
		}
	} else {
		/*
		 * If 'page' or 'per_page' has been passed, and does not match what's in $wp_query,
		 * perform a separate comment query and allow Walker_Comment to paginate.
		 */
		if ($parsed_args['page'] || $parsed_args['per_page']) {
			$current_cpage = get_query_var('cpage');
			if (!$current_cpage) {
				$current_cpage = 'newest' === get_option('default_comments_page') ? 1 : $wp_query->max_num_comment_pages;
			}

			$current_per_page = get_query_var('comments_per_page');
			if ($parsed_args['page'] != $current_cpage || $parsed_args['per_page'] != $current_per_page) {
				$comment_args = array(
					'post_id' => get_the_ID(),
					'orderby' => 'comment_date_gmt',
					'order'   => 'ASC',
					'status'  => 'approve',
				);

				if (is_user_logged_in()) {
					$comment_args['include_unapproved'] = array(get_current_user_id());
				} else {
					$unapproved_email = wp_get_unapproved_comment_author_email();

					if ($unapproved_email) {
						$comment_args['include_unapproved'] = array($unapproved_email);
					}
				}

				$comments = get_comments($comment_args);

				if ('all' !== $parsed_args['type']) {
					$comments_by_type = separate_comments($comments);
					if (empty($comments_by_type[$parsed_args['type']])) {
						return;
					}

					$_comments = $comments_by_type[$parsed_args['type']];
				} else {
					$_comments = $comments;
				}
			}

			// Otherwise, fall back on the comments from `$wp_query->comments`.
		} else {
			if (empty($wp_query->comments)) {
				return;
			}
			if ('all' !== $parsed_args['type']) {
				if (empty($wp_query->comments_by_type)) {
					$wp_query->comments_by_type = separate_comments($wp_query->comments);
				}
				if (empty($wp_query->comments_by_type[$parsed_args['type']])) {
					return;
				}
				$_comments = $wp_query->comments_by_type[$parsed_args['type']];
			} else {
				$_comments = $wp_query->comments;
			}

			if ($wp_query->max_num_comment_pages) {
				$default_comments_page = get_option('default_comments_page');
				$cpage                 = get_query_var('cpage');
				if ('newest' === $default_comments_page) {
					$parsed_args['cpage'] = $cpage;

					/*
					* When first page shows oldest comments, post permalink is the same as
					* the comment permalink.
					*/
				} elseif (1 == $cpage) {
					$parsed_args['cpage'] = '';
				} else {
					$parsed_args['cpage'] = $cpage;
				}

				$parsed_args['page']     = 0;
				$parsed_args['per_page'] = 0;
			}
		}
	}

	if ('' === $parsed_args['per_page'] && get_option('page_comments')) {
		$parsed_args['per_page'] = get_query_var('comments_per_page');
	}

	if (empty($parsed_args['per_page'])) {
		$parsed_args['per_page'] = 0;
		$parsed_args['page']     = 0;
	}

	if ('' === $parsed_args['max_depth']) {
		if (get_option('thread_comments')) {
			$parsed_args['max_depth'] = get_option('thread_comments_depth');
		} else {
			$parsed_args['max_depth'] = -1;
		}
	}

	if ('' === $parsed_args['page']) {
		if (empty($overridden_cpage)) {
			$parsed_args['page'] = get_query_var('cpage');
		} else {
			$threaded            = (-1 != $parsed_args['max_depth']);
			$parsed_args['page'] = ('newest' === get_option('default_comments_page')) ? get_comment_pages_count($_comments, $parsed_args['per_page'], $threaded) : 1;
			set_query_var('cpage', $parsed_args['page']);
		}
	}
	// Validation check.
	$parsed_args['page'] = (int) $parsed_args['page'];
	if (0 == $parsed_args['page'] && 0 != $parsed_args['per_page']) {
		$parsed_args['page'] = 1;
	}

	if (null === $parsed_args['reverse_top_level']) {
		$parsed_args['reverse_top_level'] = ('desc' === get_option('comment_order'));
	}

	$walker = new KT_Walker_Comment();

	$output = $walker->paged_walk($_comments, $parsed_args['max_depth'], $parsed_args['page'], $parsed_args['per_page'], $parsed_args);

	$in_comment_loop = false;

	if ($parsed_args['echo']) {
		echo $output;
	} else {
		return $output;
	}
}
