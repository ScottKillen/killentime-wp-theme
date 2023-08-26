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
function killentime_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Scott Killen, use a find and replace
	 * to change 'killentime' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('killentime', get_template_directory() . '/languages');

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

	add_theme_support('disable-custom-colors');
	add_theme_support('disable-custom-font-sizes');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'killentime'),
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

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'killentime_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function killentime_content_width()
{
	$GLOBALS['content_width'] = apply_filters('killentime_content_width', 640);
}
add_action('after_setup_theme', 'killentime_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function killentime_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Page Sidebar', 'killentime'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'killentime'),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h4 class="fst-italic">',
			'after_title' => '</h4>',
		)
	);
}
add_action('widgets_init', 'killentime_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function killentime_scripts()
{
	wp_enqueue_style('fonts', get_theme_file_uri('/css/fonts.css'));
	wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'));
	wp_enqueue_style('style', get_theme_file_uri('/style.css'));

	wp_enqueue_script('color-modes', get_template_directory_uri() . '/js/color-modes.js', array(), '1.0.0', true);

	wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1');
	wp_enqueue_style('animate');
	wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array(), '1.0.0', false);
}
add_action('wp_enqueue_scripts', 'killentime_scripts');

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

require get_template_directory() . '/inc/icons.php';
require get_template_directory() . '/inc/widget-recent-posts.php';
require get_template_directory() . '/inc/widget-archives.php';
require get_template_directory() . '/inc/widget-about.php';
