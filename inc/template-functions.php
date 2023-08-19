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
function killentime_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'killentime_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function killentime_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'killentime_pingback_header' );

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
function killentime_set_pagination_link_attributes($attributes) {
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
function killentime_excerpt_more($more_string) {
	global $post;
	return '<a class="icon-link gap-1 icon-link-hover"
	href="'. get_permalink($post->ID) . '">'.$more_string.'<svg class="bi"><use xlink:href="#chevron-right"/></svg></a>';
}
add_filter('excerpt_more', 'killentime_excerpt_more');

/**
 * Filters the Read More link text
 * @param mixed $more_link_element Read More link element
 * @param mixed $more_link_text Read More text
 * @return array|string
 */
function killentime_add_morelink_class( $more_link_element, $more_link_text )
{
	$return = str_replace(
        'more-link',
        'more-link icon-link gap-1 icon-link-hover',
        $more_link_element
  );

	$return = str_replace(
        '</a>',
        '<svg class="bi"><use xlink:href="#chevron-right"/></svg></a>',
        $return
  );

  return $return;
}
add_action( 'the_content_more_link', 'killentime_add_morelink_class', 10, 2 );

// Replace wordpress versions of functions

function KT_navigation_markup( $links, $css_class = 'posts-navigation', $screen_reader_text = '', $aria_label = '' ) {
	if ( empty( $screen_reader_text ) ) {
		$screen_reader_text = /* translators: Hidden accessibility text. */ __( 'Posts navigation' );
	}
	if ( empty( $aria_label ) ) {
		$aria_label = $screen_reader_text;
	}

	$template = '
	<nav class="pt-4 mt-4 border-top %1$s" aria-label="%4$s">
		<h2 class="screen-reader-text">%2$s</h2>
		%3$s
	</nav>';

	$template = apply_filters( 'navigation_markup_template', $template, $css_class );

	return sprintf( $template, sanitize_html_class( $css_class ), esc_html( $screen_reader_text ), $links, esc_attr( $aria_label ) );
}


function KT_get_the_posts_navigation( $args = array() ) {
	global $wp_query;

	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages > 1 ) {
		// Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
		if ( ! empty( $args['screen_reader_text'] ) && empty( $args['aria_label'] ) ) {
			$args['aria_label'] = $args['screen_reader_text'];
		}

		$args = wp_parse_args(
			$args,
			array(
				'prev_text'          => __( 'Older posts' ),
				'next_text'          => __( 'Newer posts' ),
				'screen_reader_text' => __( 'Posts navigation' ),
				'aria_label'         => __( 'Posts' ),
				'class'              => 'posts-navigation',
			)
		);

		$next_link = get_previous_posts_link( $args['next_text'] );
		$prev_link = get_next_posts_link( $args['prev_text'] );

		$navigation .= '<ul class="pagination">';

		if ( $prev_link ) {
			$navigation .= '<li class="page-item">' . $prev_link . '</li>';
		}

		if ( $next_link ) {
			$navigation .= '<li class="page-item">' . $next_link . '</li>';
		}
		$navigation .= '</ul>';

		$navigation = KT_navigation_markup( $navigation, $args['class'], $args['screen_reader_text'], $args['aria_label'] );
	}

	return $navigation;
}

function KT_the_posts_navigation( $args = array() ) {
	echo KT_get_the_posts_navigation( $args );
}
function KT_post_class( $css_class = '', $post = null ) {
	// Separates classes with a single space, collates classes for post DIV.
	echo 'class="blog-post ' . esc_attr( implode( ' ', get_post_class( $css_class, $post ) ) ) . '"';
}
