<?php
defined('ABSPATH') || exit;

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Scott_Killen
 */

add_filter(
	'get_semantics_site-description',
	function ($atts) {
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
);

add_filter(
	'wp_tag_cloud',
	function ($tag_links) {
		$p = new WP_HTML_Tag_Processor($tag_links);
		while ($p->next_tag('a')) {
			$p->add_class('pe-2');
			$p->add_class('link-underline');
			$p->add_class('link-underline-opacity-25');
			$p->add_class('link-underline-opacity-75-hover');
		}

		return $p->get_updated_html();
	}
);

function kt_link_classes($links)
{
	$p = new WP_HTML_Tag_Processor($links);
	while ($p->next_tag('a')) {
		$p->add_class('link-underline');
		$p->add_class('link-underline-opacity-25');
		$p->add_class('link-underline-opacity-75-hover');
	}

	return $p->get_updated_html();
}
add_filter('wp_list_categories', 'kt_link_classes');
add_filter('get_archives_link', 'kt_link_classes');

add_filter(
	'get_semantics_site-url',
	function ($atts) {
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
);

add_filter(
	'post_class',
	function ($classes = array()) {
		$classes[] = 'mb-5';
		$classes[] = 'pb-3';

		return $classes;
	}
);

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

add_filter(
	'next_post_link',
	function ($output) {
		$p = new WP_HTML_Tag_Processor($output);
		while ($p->next_tag('a')) {
			$p->add_class('page-link');
			$p->set_attribute('title', 'Next post');
		}

		return $p->get_updated_html();
	}
);

add_filter(
	'previous_post_link',
	function ($output) {
		$p = new WP_HTML_Tag_Processor($output);
		while ($p->next_tag('a')) {
			$p->add_class('page-link');
			$p->set_attribute('title', 'Previus post');
		}

		return $p->get_updated_html();
	}
);

add_filter('nav_menu_link_attributes', function ($atts, $menu_item, $args) {
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
}, 10, 3);

add_filter(
	'comments_popup_link_attributes',
	function ($link_attributes) {
		$link_attributes = array($link_attributes);
		$link_attributes[] = 'class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"';
		return join(' ', $link_attributes);
	}
);

add_filter('pre_get_avatar_data', function ($args) {
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
}, 99);

add_filter('excerpt_more', function () {
	return '&hellip;';
});

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
add_filter(
	'the_tags',
	function ($tag_links) {
		$p = new WP_HTML_Tag_Processor($tag_links);
		while ($p->next_tag('a')) {
			$p->add_class('link-secondary');
			$p->add_class('link-offset-2');
			$p->add_class('link-underline-opacity-25');
			$p->add_class('link-underline-opacity-100-hover');
		}
		return $p->get_updated_html();
	}
);

add_filter(
	'get_comment_author_link',
	function ($link) {
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
);

add_filter(
	'comment_reply_link',
	function ($link) {
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
);

add_filter(
	'edit_comment_link',
	function ($link) {
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
);

add_filter(
	'edit_post_link',
	function ($link) {
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
);

add_filter(
	'webmention_comment_form',
	function () {
		return locate_template('webmention-comment-form.php');
	}
);

add_filter('syndication_links_display', '__return_false');

function add_anchors_to_headings($content)
{
	$aa = new KTAutoAnchor($content);
	$content = preg_replace_callback('/(\<h[2-6](.*?))\>(.*)(<\/h[2-6]>)/i', array($aa, 'custom_callback'), $content);
	return $content;
}
add_filter('the_content', 'add_anchors_to_headings');

add_filter('pre_get_avatar_data', function ($args) {
	$classes = array('me-3');

	if (isset($args['class'])) {
		if (is_array($args['class'])) {
			$classes = array_merge($classes, $args['class']);
		} else {
			$classes[] = $args['class'];
		}
	}

	$args['class'] = $classes;

	return $args;
});


add_filter('share_on_mastodon_status', function ($status, $post) {
	//  Create a short preview of the post
	$status = "\"" . get_the_title($post) . "\"\n\n";
	$status .= get_the_excerpt($post);
	//  Remove the … forced by the excerpt and replace with the Unicode symbol
	$status = html_entity_decode($status);
	//  Add a link
	$status .= "\n\nRead more: " . get_permalink($post);
	//  Add tags
	$tags = get_the_tags($post->ID);
	if ($tags) {
		$status .= "\n\n";
		foreach ($tags as $tag) {
			$status .= '#' . preg_replace('/\s/', '', $tag->name) . ' ';
		}
	}
	$status = trim($status);
	return $status;
}, 10, 2);

add_filter('syn_link_mapping', function ($return, $url) {
	$domain = wp_parse_url($url, PHP_URL_HOST);
	$domain = str_replace('www.', '', $domain); // Always remove www
	switch ($domain) {
		case 'ttocs.io':
			return 'mastodon';
	}
	return $return;
}, 10, 2);

add_filter('pre_syn_link_icon', function ($icon, $name) {
	switch ($name) {
		case 'medium':
			return '<svg class="bi"><title>Medium</title><use href="#fa-medium" /></svg>';
		case 'mastodon':
			return '<svg class="bi"><title>Mastodon</title><use href="#fa-mastodon" /></svg>';
		case 'website':
			return '<svg class="bi"><use href="#fa-globe" /></svg>';
	}
	return null;
}, 10, 2);

add_filter('get_comment_text', function ($comment_text, $comment) {
	if ('like' === $comment->comment_type) {
		return '<svg class="bi"><use href="#fa-star" /><title>Like</title></svg>';
	}
	return $comment_text;
}, 10, 2);
