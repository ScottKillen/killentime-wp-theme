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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'killentime_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
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
			'name' => esc_html__('Sidebar', 'killentime'),
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
	wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'));
	wp_enqueue_style('style', get_theme_file_uri('/style.css'));

	wp_enqueue_script('color-modes', get_template_directory_uri() . '/js/color-modes.js', array(), '1.0.0', true);

  if ( is_front_page() && is_home() ) {
		wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1');
		wp_enqueue_style('animate');
		wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array(), '1.0.0', false);
	}
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

function posts_link_attributes() {
  return 'class="page-link"';
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

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

class KT_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'kt_widget_recent_entries',
			'description'                 => __( 'Your site&#8217;s most recent Posts.' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'kt-recent-posts', __( 'Killentime Recent Posts' ), $widget_ops );
		$this->alt_option_name = 'kt_widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( 'Recent Posts' );
		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query(
			/**
			 * Filters the arguments for the Recent Posts widget.
			 *
			 * @since 3.4.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @param array $args     An array of arguments used to retrieve the recent posts.
			 * @param array $instance Array of settings for the current widget.
			 */
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters( 'navigation_widgets_format', $format );

		if ( 'html5' === $format ) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim( strip_tags( $title ) );
			$aria_label = $title ? $title : $default_title;
			echo '<nav aria-label="' . esc_attr( $aria_label ) . '">';
		}
		?>

		<ul class="list-unstyled">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title   = get_the_title( $recent_post->ID );
				$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				$aria_current = '';

				if ( get_queried_object_id() === $recent_post->ID ) {
					$aria_current = ' aria-current="page"';
				}
				?>
				<li>
					<a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
					href="<?php the_permalink( $recent_post->ID ); ?>"<?php echo $aria_current; ?>>
						<svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>
						<div class="col-lg-8">
							<h6 class="mb-0"><?php echo $title; ?></h6>
							<?php if ( $show_date ) : ?>
								<small class="text-body-secondary"><?php echo get_the_date( '', $recent_post->ID ); ?></small>
							<?php endif; ?>
						</div>
          </a>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php
		if ( 'html5' === $format ) {
			echo '</nav>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<?php
	}
}

class KT_Widget_Archives extends WP_Widget {

	/**
	 * Sets up a new Archives widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'kt_widget_archive',
			'description'                 => __( 'A monthly archive of your site&#8217;s Posts.' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'kt-archives', __( 'Killentime Archives' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Archives widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Archives widget instance.
	 */
	public function widget( $args, $instance ) {
		$default_title = __( 'Archives' );
		$title         = ! empty( $instance['title'] ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$count    = ! empty( $instance['count'] ) ? '1' : '0';
		$dropdown = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo '<div class="p-4">';

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters( 'navigation_widgets_format', $format );

		if ( 'html5' === $format ) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim( strip_tags( $title ) );
			$aria_label = $title ? $title : $default_title;
			echo '<nav aria-label="' . esc_attr( $aria_label ) . '">';
		}
		?>

		<ol class="list-unstyled mb-0">
			<?php
			wp_get_archives(
				/**
				 * Filters the arguments for the Archives widget.
				 *
				 * @since 2.8.0
				 * @since 4.9.0 Added the `$instance` parameter.
				 *
				 * @see wp_get_archives()
				 *
				 * @param array $args     An array of Archives option arguments.
				 * @param array $instance Array of settings for the current widget.
				 */
				apply_filters(
					'widget_archives_args',
					array(
						'type'            => 'monthly',
						'show_post_count' => $count,
					),
					$instance
				)
			);
			?>
		</ol>

		<?php
		if ( 'html5' === $format ) {
			echo '</nav>';
		}

		echo $args['after_widget'];
		echo '</div>';
	}

	/**
	 * Handles updating settings for the current Archives widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget_Archives::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$new_instance         = wp_parse_args(
			(array) $new_instance,
			array(
				'title'    => '',
				'count'    => 0,
			)
		);
		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['count']    = $new_instance['count'] ? 1 : 0;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Archives widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'    => '',
				'count'    => 0,
			)
		);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $instance['count'] ); ?> id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show post counts' ); ?></label>
		</p>
		<?php
	}
}


function load_KT_widgets() {
	register_widget('KT_Widget_Recent_Posts');
	register_widget('KT_Widget_Archives');
}
add_action('widgets_init', 'load_KT_widgets');

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

function new_excerpt_more($more) {
	global $post;
	return '<a class="btn btn-secondary"
	href="'. get_permalink($post->ID) . '">'.$more.'</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function add_morelink_class( $link, $text )
{
    return str_replace(
        'more-link',
        'more-link btn btn-outline-secondary',
        $link
    );
}
add_action( 'the_content_more_link', 'add_morelink_class', 10, 2 );
