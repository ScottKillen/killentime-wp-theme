<?php

class KT_Widget_Recent_Posts extends WP_Widget_Recent_Posts
{
	public function __construct()
	{
		WP_Widget::__construct(
			'kt-recent-posts',
			'Recent Posts',
			array(
				'classname' => 'kt_widget_recent_posts',
				'description' => 'Killentime recent posts widget'
			)
		);
	}

	public function widget($args, $instance)
	{
		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __('Recent Posts');
		$title         = (!empty($instance['title'])) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		$number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
		if (!$number) {
			$number = 5;
		}
		$show_date = isset($instance['show_date']) ? $instance['show_date'] : false;

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

		if (!$r->have_posts()) {
			return;
		}
?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ($title) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$format = current_theme_supports('html5', 'navigation-widgets') ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters('navigation_widgets_format', $format);

		if ('html5' === $format) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim(strip_tags($title));
			$aria_label = $title ? $title : $default_title;
			echo '<nav aria-label="' . esc_attr($aria_label) . '">';
		}
		?>

		<ul>
			<?php foreach ($r->posts as $recent_post) : ?>
				<?php
				$post_title   = get_the_title($recent_post->ID);
				$title        = (!empty($post_title)) ? $post_title : __('(no title)');
				$aria_current = '';

				if (get_queried_object_id() === $recent_post->ID) {
					$aria_current = ' aria-current="page"';
				}
				?>
				<li>
					<a href="<?php the_permalink($recent_post->ID); ?>" <?php echo $aria_current; ?> class="link-underline link-underline-opacity-25 link-underline-opacity-75-hover"><?php echo $title; ?></a>
					<?php if ($show_date) : ?>
						<span class="post-date"><?php echo get_the_date('', $recent_post->ID); ?></span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>

<?php
		if ('html5' === $format) {
			echo '</nav>';
		}

		echo $args['after_widget'];
	}
}

function load_KT_recent_posts_widget()
{
	register_widget('KT_Widget_Recent_Posts');
}
add_action('widgets_init', 'load_KT_recent_posts_widget');
