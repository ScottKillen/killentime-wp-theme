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
		$p->add_class('link-underline');
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

add_filter('syndication_links_display', '__return_false');
