<?php
defined('ABSPATH') || exit;

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
			'font-accent',
			'fs-6',
			'lh-sm',
		)
	);

	return $atts;
}
add_filter('get_semantics_site-description', 'kt_site_description_classes');

function kt_tag_link_classes($return)
{
	$p = new WP_HTML_Tag_Processor($return);
	while ($p->next_tag('a')) {
		$p->add_class('pe-2');
		$p->add_class('link-underline');
		$p->add_class('link-underline-opacity-25');
		$p->add_class('link-underline-opacity-75-hover');
	}

	return $p->get_updated_html();
}
add_filter('wp_tag_cloud', 'kt_tag_link_classes');

function kt_category_link_classes($return)
{
	$p = new WP_HTML_Tag_Processor($return);
	while ($p->next_tag('a')) {
		$p->add_class('link-underline');
		$p->add_class('link-underline-opacity-25');
		$p->add_class('link-underline-opacity-75-hover');
	}

	return $p->get_updated_html();
}
add_filter('wp_list_categories', 'kt_category_link_classes');
add_filter('get_archives_link', 'kt_category_link_classes');

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
	$classes[] = 'mb-5';
	$classes[] = 'pb-3';

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

function kt_add_next_post_link_atts($output)
{
	$p = new WP_HTML_Tag_Processor($output);
	while ($p->next_tag('a')) {
		$p->add_class('page-link');
		$p->set_attribute('title', 'Next post');
	}

	return $p->get_updated_html();
}
add_filter('next_post_link', 'kt_add_next_post_link_atts');

function kt_previous_next_post_link_atts($output)
{
	$p = new WP_HTML_Tag_Processor($output);
	while ($p->next_tag('a')) {
		$p->add_class('page-link');
		$p->set_attribute('title', 'Previus post');
	}

	return $p->get_updated_html();
}
add_filter('previous_post_link', 'kt_previous_next_post_link_atts');

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

function kt_add_comment_link_classes($link_attributes)
{
	return $link_attributes .= 'class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"';
}
add_filter('comments_popup_link_attributes', 'kt_add_comment_link_classes');

function kt_pre_get_avatar_data($args)
{
	if (is_author()) {
		$classes = array(
			'float-start',
			'me-3',
			'rounded-circle',
			'shadow-lg',
			'bg-body-tertiary',
			'border',
			'border-primary',
		);
	} else {
		$classes = array();
	}

	if (isset($args['class'])) {
		if (is_array($args['class'])) {
			$classes = array_merge($classes, $args['class']);
		} else {
			$classes[] = $args['class'];
		}
	}

	$args['class'] = $classes;

	return $args;
}
add_filter('pre_get_avatar_data', 'kt_pre_get_avatar_data', 99);

function killentime_excerpt_more()
{
	return '&hellip;';
}
add_filter('excerpt_more', 'killentime_excerpt_more');

function killentime_add_morelink_class($link)
{
	$p = new WP_HTML_Tag_Processor($link);
	if ($p->next_tag('a')) {
		$p->add_class('icon-link');
		$p->add_class('gap-1');
		$p->add_class('icon-link-hover');
	}

	return str_replace(
		'</a>',
		'<svg class="bi"><use xlink:href="#fa-chevron-right"/></svg></a>',
		$p->get_updated_html()
	);
}
add_action('the_content_more_link', 'killentime_add_morelink_class', 10);

// add custom class to tag
function add_class_the_tags($html)
{
	$p = new WP_HTML_Tag_Processor($html);
	while ($p->next_tag('a')) {
		$p->add_class('link-secondary');
		$p->add_class('link-offset-2');
		$p->add_class('link-underline-opacity-25');
		$p->add_class('link-underline-opacity-100-hover');
	}
	return $p->get_updated_html();
}
add_filter('the_tags', 'add_class_the_tags');

function replace_comment_author_link($link)
{
	$p = new WP_HTML_Tag_Processor($link);

	while ($p->next_tag(array('tag_name' => 'a', 'class_name' => 'url'))) {
		$p->add_class('link-body-emphasis');
		$p->add_class('link-offset-2');
		$p->add_class('link-underline-opacity-25');
		$p->add_class('link-underline-opacity-75-hover');
	}

	return str_replace(
		'ugc">Scott Killen</a>',
		'ugc">Scott Killen</a> <svg class="bi bi-yellow"><use xlink:href="#fa-star"/></svg>',
		$p->get_updated_html()
	);
}
add_filter('get_comment_author_link', 'replace_comment_author_link');

function replace_reply_link($link)
{
	$p = new WP_HTML_Tag_Processor($link);

	while ($p->next_tag(array('tag_name' => 'a', 'class_name' => 'comment-reply-link'))) {
		$p->add_class('badge');
		$p->add_class('bg-primary-subtle');
		$p->add_class('border');
		$p->add_class('border-primary-subtle');
		$p->add_class('text-primary-emphasis');
		$p->add_class('text-decoration-none');
		$p->add_class('icon-link');
	}

	return str_replace(
		'>Reply<',
		'><svg class="bi"><use xlink:href="#fa-reply"/></svg> Reply<',
		$p->get_updated_html()
	);
}
add_filter('comment_reply_link', 'replace_reply_link');

function replace_comment_edit_link($link)
{
	$p = new WP_HTML_Tag_Processor($link);

	while ($p->next_tag(array('tag_name' => 'a', 'class_name' => 'comment-edit-link'))) {
		$p->add_class('badge');
		$p->add_class('mx-1');
		$p->add_class('bg-secondary-subtle');
		$p->add_class('border');
		$p->add_class('border-secondary-subtle');
		$p->add_class('text-primary-emphasis');
		$p->add_class('text-decoration-none');
		$p->add_class('icon-link');
	}

	return str_replace(
		'>Edit<',
		'><svg class="bi"><use xlink:href="#fa-pen-to-square"/></svg> Edit<',
		$p->get_updated_html()
	);
}
add_filter('edit_comment_link', 'replace_comment_edit_link');

function replace_edit_post_link($link)
{
	$p = new WP_HTML_Tag_Processor($link);

	while ($p->next_tag(array('tag_name' => 'a', 'class_name' => 'post-edit-link'))) {
		$p->add_class('link-secondary');
		$p->add_class('link-offset-2');
		$p->add_class('link-underline-opacity-25');
		$p->add_class('link-underline-opacity-100-hover');
	}

	return str_replace(
		'>Edit <',
		'><svg class="bi"><use xlink:href="#fa-pen-to-square"/></svg> Edit<',
		$p->get_updated_html()
	);
}
add_filter('edit_post_link', 'replace_edit_post_link');

function kt_webmention_comment_form($template_name)
{
	return locate_template('webmention-comment-form.php');
}
add_filter('webmention_comment_form', 'kt_webmention_comment_form');

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
