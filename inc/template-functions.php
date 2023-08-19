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
