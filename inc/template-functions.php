<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Scott_Killen
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function killentime_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter('body_class', 'killentime_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function killentime_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'killentime_pingback_header');

/**
 * Add custom classe to nav menu items
 *
 * @param mixed $classes classes for the menu item
 * @param mixed $item the current menu item object
 * @param mixed $args An object of wp_nav_menu() arguments
 * @param mixed $depth Depth of menu item
 * @return mixed
 */
function killentime_add_class_on_menu_item($classes, $item, $args, $depth)
{
	if (isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'killentime_add_class_on_menu_item', 1, 4);

/**
 * Sets pagination link attribguted
 * @param mixed $attributes
 * @return string
 */
function killentime_set_pagination_link_attributes($attributes)
{
	return 'class="page-link"';
}

add_filter('next_posts_link_attributes', 'killentime_set_pagination_link_attributes');
add_filter('previous_posts_link_attributes', 'killentime_set_pagination_link_attributes');

/**
 * Add classes to menu item link
 * @param mixed $atts      The HTML attributes applied to the menu item's <a> element, empty strings are ignored.
 * @param mixed $menu_item The current menu item object
 * @param mixed $args      An object of wp_nav_menu() arguments
 * @return mixed
 */
function killentime_add_class_on_menu_item_link($atts, $menu_item, $args, $depth)
{
	if (in_array('class', $atts)) {
		$classes = $atts['class'];
	} else {
		$classes = '';
	}

	if (isset($args->add_link_class)) {
		$classes .= ' ' . $args->add_link_class;
	}

	if (!empty($atts['aria-current'])) {
		$classes .= ' active border-primary';
	}

	if (!empty($classes)) {
		$atts['class'] = $classes;
	}

	return $atts;
}
add_filter('nav_menu_link_attributes', 'killentime_add_class_on_menu_item_link', 10, 4);

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
	href="' . get_permalink($post->ID) . '">Continue reading...<svg class="bi"><use xlink:href="#chevron-right"/></svg></a><p class="d-none">';
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

	if ($offset) {
		$end = strpos($more_link_element, '"', $offset);
	}

	if ($end) {
		$more_link_element = substr_replace($more_link_element, '', $offset, $end - $offset);
	}

	$more_link_element = str_replace(
		'more-link',
		'more-link icon-link gap-1 icon-link-hover',
		$more_link_element
	);

	$more_link_element = str_replace(
		'</a>',
		'<svg class="bi"><use xlink:href="#chevron-right"/></svg></a>',
		$more_link_element
	);

	return $more_link_element;
}
add_action('the_content_more_link', 'killentime_add_morelink_class', 10, 2);

// add custom class to tag
function add_class_the_tags($html)
{
	$postid = get_the_ID();
	$html = str_replace('<a', '<a class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover"', $html);
	return $html;
}
add_filter('the_tags', 'add_class_the_tags');

function replace_comment_author_link($link)
{
	$link = str_replace('class="url"', 'class="url link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"', $link);
	$link = str_replace('ugc">Scott Killen</a>', 'ugc">Scott Killen</a> <svg class="bi-yellow"><use xlink:href="#star"/></svg>', $link);
	return $link;
}
add_filter('get_comment_author_link', 'replace_comment_author_link');

function replace_reply_link($link)
{
	$link = str_replace("class='comment-reply-link", "class='badge bg-primary-subtle border border-primary-subtle text-primary-emphasis text-decoration-none comment-reply-link icon-link", $link);
	$link = str_replace('>Reply<', '><svg class="bi"><use xlink:href="#reply"/></svg> Reply<', $link);
	return $link;
}
add_filter('comment_reply_link', 'replace_reply_link');

function replace_comment_edit_link($link)
{
	$link = str_replace('"comment-edit-link"', '"comment-edit-link badge mx-1 bg-secondary-subtle icon-link text-decoration-none border border-seconday-subtle text-secondary-emphasis"', $link);
	$link = str_replace('>Edit<', '><svg class="bi"><use xlink:href="#edit"/></svg> Edit<', $link);
	return $link;
}
add_filter('edit_comment_link', 'replace_comment_edit_link');

function replace_edit_post_link($link)
{
	$link = str_replace('"post-edit-link"', '"post-edit-link btn btn-outline-secondary icon-link text-decoration-none"', $link);
	$link = str_replace('>Edit<', '><svg class="bi"><use xlink:href="#edit"/></svg> Edit<', $link);
	return $link;
}
add_filter('edit_post_link', 'replace_edit_post_link');

function kt_list_categories($html)
{
	$html = str_replace('<li class="cat', '<li class="list-group-item d-flex justify-content-between align-items-start cat', $html);
	$html = preg_replace('/\((\d+)\)/', '<span class="badge bg-primary rounded-pill">$1</span>', $html);
	$html = str_replace('<a hr', '<a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" hr', $html);
	return $html;
}
add_filter('wp_list_categories', 'kt_list_categories');

//
// Replace wordpress versions of functions
//

function KT_navigation_markup($links, $css_class = 'posts-navigation', $screen_reader_text = '', $aria_label = '')
{
	if (empty($screen_reader_text)) {
		$screen_reader_text = /* translators: Hidden accessibility text. */ __('Posts navigation');
	}
	if (empty($aria_label)) {
		$aria_label = $screen_reader_text;
	}

	$template = '
	<nav class="pt-4 mt-4 border-top %1$s" aria-label="%4$s">
		<h2 class="screen-reader-text">%2$s</h2>
		%3$s
	</nav>';

	$template = apply_filters('navigation_markup_template', $template, $css_class);

	return sprintf($template, sanitize_html_class($css_class), esc_html($screen_reader_text), $links, esc_attr($aria_label));
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

function KT_the_posts_navigation($args = array())
{
	echo KT_get_the_posts_navigation($args);
}
function KT_post_class($css_class = '', $post = null)
{
	// Separates classes with a single space, collates classes for post DIV.
	echo 'class="blog-post mb-0 pb-5 ' . esc_attr(implode(' ', get_post_class($css_class, $post))) . '"';
}

function KT_home_excerpt($post)
{
	if (has_excerpt()) {
		echo '<p>' . $post->post_excerpt . '</p>';
		echo '<a href="' . esc_url(get_permalink()) . '" class="more-link icon-link gap-1 icon-link-hover">Continue reading...<svg class="bi"><use xlink:href="#chevron-right"/></svg></a>';
	} else if (strpos($post->post_content, '<!--more-->')) {
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'killentime'),
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

function KT_the_comments_pagination($args = array())
{
	$links = KT_get_the_comments_pagination($args);
	echo $links;
}

function KT_get_the_comments_pagination($args = array())
{
	$navigation = '';

	// Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
	if (!empty($args['screen_reader_text']) && empty($args['aria_label'])) {
		$args['aria_label'] = $args['screen_reader_text'];
	}

	$args         = wp_parse_args(
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
		$navigation = str_replace('&laquo; Previous', '<svg class="bi"><title>Older</title><use xlink:href="#chevrons-left"/></svg>', $navigation);
		$navigation = str_replace('Next &raquo;', '<svg class="bi"><title>Newer</title><use xlink:href="#chevrons-right"/></svg>', $navigation);
	}

	return $navigation;
}
