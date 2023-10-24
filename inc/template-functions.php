<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Scott_Killen
 */

function kt_site_description_classes($atts)
{
	if (isset($atts['class'])) {
		if (is_array($atts['class'])) {
			$classes = $atts['class'];
		} else {
			$classes[] = $atts['class'];
		}
	} else {
		$classes = array();
	}

	$atts['class'] = array_merge(
		$classes,
		array(
			'text-body-secondary',
			'd-block',
			'mt-1',
			'font-accent',
			'fs-6',
			'lh-sm',
		)
	);

	return $atts;
}
add_filter('get_semantics_site-description', 'kt_site_description_classes');

function kt_site_url_classes($atts)
{
	if (isset($atts['class'])) {
		if (is_array($atts['class'])) {
			$classes = $atts['class'];
		} else {
			$classes[] = $atts['class'];
		}
	} else {
		$classes = array();
	}

	$atts['class'] = array_merge(
		$classes,
		array(
			'link-body-emphasis',
			'link-offset-2',
			'text-decoration-none',
		)
	);

	return $atts;
}
add_filter('get_semantics_site-url', 'kt_site_url_classes');

function kt_post_class($classes = array())
{
	$classes[] = 'mb-0';
	$classes[] = 'pb-5';

	return $classes;
}
add_filter('post_class', 'kt_post_class');

function kt_add_pingback_link_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'kt_add_pingback_link_header');

function kt_add_menu_li_class($classes, $item, $args)
{
	if (isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'kt_add_menu_li_class', 10, 3);

function kt_set_post_pagination_link_class($attr)
{
	return $attr . ' class="page-link"';
}
add_filter('next_posts_link_attributes', 'kt_set_post_pagination_link_class');
add_filter('previous_posts_link_attributes', 'kt_set_post_pagination_link_class');

function kt_add_class_on_nav_menu_link($atts, $menu_item, $args)
{
	$classes = array();

	if (isset($atts['class'])) {
		$classes[] = $atts['class'];
	}

	if (isset($args->add_link_class)) {
		$classes[] = $args->add_link_class;
	}

	if (!empty($atts['aria-current'])) {
		$classes = array_merge($classes, array('active', 'border-primary'));
	}
	$atts['class'] = implode(' ', array_unique($classes));

	return $atts;
}
add_filter('nav_menu_link_attributes', 'kt_add_class_on_nav_menu_link', 10, 3);

function kt_term_links_category($links)
{
	$new_links = array();
	foreach ($links as $link) {
		$p = new WP_HTML_Tag_Processor($link);
		if ($p->next_tag('a')) {
			$p->add_class('me-1');
			$p->add_class('link-secondary');
			$p->add_class('link-offset-2');
			$p->add_class('link-underline-opacity-25');
			$p->add_class('link-underline-opacity-100-hover');
		}
		$new_links[] = $p->get_updated_html();
	}

	return $new_links;
}
add_filter('term_links-category', 'kt_term_links_category');

function kt_term_links_tag($links)
{
	$new_links = array();
	foreach ($links as $link) {
		$p = new WP_HTML_Tag_Processor($link);
		if ($p->next_tag('a')) {
			$p->add_class('badge');
			$p->add_class('bg-info-subtle');
			$p->add_class('border');
			$p->add_class('border-info-subtle');
			$p->add_class('text-info-emphasis');
			$p->add_class('shadow');
			$p->add_class('rounded-pill');
		}
		$new_links[] = $p->get_updated_html();
	}

	return $new_links;
}
add_filter('term_links-post_tag', 'kt_term_links_tag');










/**
 * Filters the string in the “more” link displayed after a trimmed excerpt.
 * @param mixed $more_string The string shown within the more link.
 * @return string
 */
function killentime_excerpt_more($more_string)
{
	global $post;
	return
		'</p><a class="icon-link gap-1 icon-link-hover"
	href="' . get_permalink($post->ID) . '">Continue reading...<svg class="bi"><use xlink:href="#fa-chevron-right"/></svg></a><p class="d-none">';
}
add_filter('excerpt_more', 'killentime_excerpt_more');

/**
 * Filters the Read More link text
 * @param mixed $more_link_element Read More link element
 * @param mixed $more_link_text Read More text
 * @return array|string
 */
function killentime_add_morelink_class($more_link_element, $more_link_text)
{
	$offset = strpos($more_link_element, '#more-');

	if ($offset !== false) {
		$end = strpos($more_link_element, '"', $offset);
		if ($end !== false) {
			$more_link_element = substr_replace($more_link_element, '', $offset, $end - $offset);
		}

		$more_link_element = str_replace(
			'more-link',
			'more-link icon-link gap-1 icon-link-hover',
			$more_link_element
		);

		$more_link_element = str_replace(
			'</a>',
			'<svg class="bi"><use xlink:href="#fa-chevron-right"/></svg></a>',
			$more_link_element
		);
	}

	return $more_link_element;
}
add_action('the_content_more_link', 'killentime_add_morelink_class', 10, 2);

// add custom class to tag
function add_class_the_tags($html)
{
	$processor = new WP_HTML_Tag_Processor($html);
	while ($processor->next_tag('a')) {
		$processor->add_class('link-info');
		$processor->add_class('link');
		$processor->add_class('link-offset-2');
		$processor->add_class('link-underline-opacity-0');
		$processor->add_class('link-underline-opacity-75-hover');
	}
	return $processor->get_updated_html();
}
add_filter('the_tags', 'add_class_the_tags');

function replace_comment_author_link($link)
{
	$processor = new WP_HTML_Tag_Processor($link);

	while ($processor->next_tag(array('tag_name' => 'a', 'class_name' => 'url'))) {
		$processor->add_class('link-body-emphasis');
		$processor->add_class('link-offset-2');
		$processor->add_class('link-underline-opacity-25');
		$processor->add_class('link-underline-opacity-75-hover');
	}

	return str_replace(
		'ugc">Scott Killen</a>',
		'ugc">Scott Killen</a> <svg class="bi-yellow"><use xlink:href="#fa-star"/></svg>',
		$processor->get_updated_html()
	);
}
add_filter('get_comment_author_link', 'replace_comment_author_link');

function replace_reply_link($link)
{
	$processor = new WP_HTML_Tag_Processor($link);

	while ($processor->next_tag(array('tag_name' => 'a', 'class_name' => 'comment-reply-link'))) {
		$processor->add_class('badge');
		$processor->add_class('bg-primary-subtle');
		$processor->add_class('border');
		$processor->add_class('border-primary-subtle');
		$processor->add_class('text-primary-emphasis');
		$processor->add_class('text-decoration-none');
		$processor->add_class('icon-link');
	}

	return str_replace(
		'>Reply<',
		'><svg class="bi"><use xlink:href="#fa-reply"/></svg> Reply<',
		$processor->get_updated_html()
	);
}
add_filter('comment_reply_link', 'replace_reply_link');

function replace_comment_edit_link($link)
{
	$processor = new WP_HTML_Tag_Processor($link);

	while ($processor->next_tag(array('tag_name' => 'a', 'class_name' => 'comment-edit-link'))) {
		$processor->add_class('badge');
		$processor->add_class('mx-1');
		$processor->add_class('bg-secondary-subtle');
		$processor->add_class('border');
		$processor->add_class('border-secondary-subtle');
		$processor->add_class('text-primary-emphasis');
		$processor->add_class('text-decoration-none');
		$processor->add_class('icon-link');
	}

	return str_replace(
		'>Edit<',
		'><svg class="bi"><use xlink:href="#fa-pen-to-square"/></svg> Edit<',
		$processor->get_updated_html()
	);
}
add_filter('edit_comment_link', 'replace_comment_edit_link');

function replace_edit_post_link($link)
{
	$processor = new WP_HTML_Tag_Processor($link);

	while ($processor->next_tag(array('tag_name' => 'a', 'class_name' => 'post-edit-link'))) {
		$processor->add_class('btn');
		$processor->add_class('btn-outline-secondary');
		$processor->add_class('mt-2');
		$processor->add_class('border');
		$processor->add_class('text-decoration-none');
		$processor->add_class('icon-link');
	}

	return str_replace(
		'>Edit <',
		'><svg class="bi"><use xlink:href="#fa-pen-to-square"/></svg> Edit<',
		$processor->get_updated_html()
	);
}
add_filter('edit_post_link', 'replace_edit_post_link');

function kt_list_categories($html)
{
	$html = str_replace(
		array('<li class="cat', '<a hr'),
		array('<li class="list-group-item d-flex justify-content-between align-items-start cat', '<a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" hr'),
		$html
	);

	$html = preg_replace('/\((\d+)\)/', '<span class="badge bg-primary rounded-pill">$1</span>', $html);

	return $html;
}
add_filter('wp_list_categories', 'kt_list_categories');

function kt_webmention_comment_form($template_name)
{
	return locate_template('webmention-comment-form.php');
}
add_filter('webmention_comment_form', 'kt_webmention_comment_form');

//
// Replace wordpress versions of functions
//

function KT_navigation_markup($links, $css_class = 'posts-navigation', $screen_reader_text = '', $aria_label = '')
{
	// Set default values if empty
	$screen_reader_text = $screen_reader_text ?: __('Posts navigation');
	$aria_label = $aria_label ?: $screen_reader_text;

	$template =
	'
    <nav class="pt-4 mt-4 border-top %1$s" aria-label="%4$s">
        <h2 class="screen-reader-text">%2$s</h2>
        %3$s
    </nav>';

	// Apply filters
	$template = apply_filters('navigation_markup_template', $template, $css_class);

	// Generate and return the formatted markup
	return sprintf(
		$template,
		sanitize_html_class($css_class),
		esc_html($screen_reader_text),
		$links,
		esc_attr($aria_label)
	);
}

function KT_get_the_posts_navigation($args = array())
{
	global $wp_query;

	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ($wp_query->max_num_pages > 1) {
		// Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
		if (!empty($args['screen_reader_text']) && empty($args['aria_label'])) {
			$args['aria_label'] = $args['screen_reader_text'];
		}

		// Define default arguments using wp_parse_args.
		$args = wp_parse_args(
			$args,
			array(
				'prev_text'          => __('Older posts'),
				'next_text'          => __('Newer posts'),
				'screen_reader_text' => __('Posts navigation'),
				'aria_label'         => __('Posts'),
				'class'              => 'posts-navigation',
			)
		);

		$next_link = get_previous_posts_link($args['next_text']);
		$prev_link = get_next_posts_link($args['prev_text']);

		$navigation .= '<ul class="pagination">';

		if ($prev_link) {
			$navigation .= '<li class="page-item">' . $prev_link . '</li>';
		}

		if ($next_link) {
			$navigation .= '<li class="page-item">' . $next_link . '</li>';
		}
		$navigation .= '</ul>';

		$navigation = KT_navigation_markup($navigation, $args['class'], $args['screen_reader_text'], $args['aria_label']);
	}

	return $navigation;
}

function KT_get_the_comments_pagination($args = array())
{
	$navigation = '';

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

	// Make sure we get a string back. Plain is the next best thing.
	if (isset($args['type']) && 'array' === $args['type']) {
		$args['type'] = 'plain';
	}

	$links = paginate_comments_links($args);

	if ($links) {
		$navigation = _navigation_markup($links, $args['class'], $args['screen_reader_text'], $args['aria_label']);
		$navigation = str_replace('<div class="nav-links">', '<ul class="pagination pagination-sm">', $navigation);
		$navigation = str_replace('</div>', '</ul>', $navigation);
		$navigation = str_replace('</a>', '</ali>', $navigation);
		$navigation = str_replace('</ali>', '</a></li>', $navigation);
		$navigation = str_replace('<a cl', '<lia', $navigation);
		$navigation = str_replace('<lia', '<li class="page-item"><a cl', $navigation);
		$navigation = str_replace('page-numbers', 'page-link', $navigation);
		$navigation = str_replace('current', 'active', $navigation);
		$navigation = str_replace('span aria-active="page"', 'li', $navigation);
		$navigation = str_replace('/span', '/li', $navigation);
		$navigation = str_replace('&laquo; Previous', '<svg class="bi"><title>Older</title><use xlink:href="#fa-chevrons-left"/></svg>', $navigation);
		$navigation = str_replace('Next &raquo;', '<svg class="bi"><title>Newer</title><use xlink:href="#fa-chevrons-right"/></svg>', $navigation);
	}

	return $navigation;
}

function KT_wp_list_comments($args = array(), $comments = null)
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
