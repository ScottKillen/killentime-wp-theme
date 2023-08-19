<?php
/**
 * Scott Killen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Scott_Killen
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function scottkillen_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Scott Killen, use a find and replace
	 * to change 'scottkillen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('scottkillen', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'scottkillen'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'scottkillen_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'scottkillen_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function scottkillen_content_width()
{
	$GLOBALS['content_width'] = apply_filters('scottkillen_content_width', 640);
}
add_action('after_setup_theme', 'scottkillen_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function scottkillen_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'scottkillen'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'scottkillen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'scottkillen_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function scottkillen_scripts()
{
	wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'));
	wp_enqueue_style('scottkillen', get_theme_file_uri('/style.css'));

	wp_enqueue_script('color-modes', get_template_directory_uri() . '/js/color-modes.js', array(), '1.0.0', true);

  if ( is_front_page() && is_home() ) {
		wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1');
		wp_enqueue_style('animate');
		wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array(), '1.0.0', false);
	}
}
add_action('wp_enqueue_scripts', 'scottkillen_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom functions
 */

function add_additional_class_on_menu_item($atts, $item, $args)
{
	if (isset($args->add_li_class)) {
		$atts[] = $args->add_li_class;
	}
	return $atts;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_menu_item', 1, 3);

function add_additional_class_on_menu_item_link($atts, $item, $args)
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
add_filter('nav_menu_link_attributes', 'add_additional_class_on_menu_item_link', 10, 3);
