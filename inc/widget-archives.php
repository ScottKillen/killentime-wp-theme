<?php
class KT_Widget_Archives extends WP_Widget
{

	/**
	 * Sets up a new Archives widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct()
	{
		$widget_ops = array(
			'classname'                   => 'kt_widget_archive',
			'description'                 => __('A monthly archive of your site&#8217;s Posts.'),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct('kt-archives', __('Killentime Archives'), $widget_ops);
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
	public function widget($args, $instance)
	{
		$default_title = __('Archives');
		$title         = !empty($instance['title']) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		$count    = !empty($instance['count']) ? '1' : '0';
		$dropdown = !empty($instance['dropdown']) ? '1' : '0';

		echo '<div class="px-4 pt-3 pb-4">';

		echo $args['before_widget'];

		if ($title) {
			$before_title = str_replace('fst-italic"', 'fst-italic border-bottom"', $args['before_title']);
			echo $before_title . $title . $args['after_title'];
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

		<ul class="mb-0">
			<?php
			ob_start();
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
			echo str_replace('<a href', '<a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" href', ob_get_clean());
			?>
		</ul>

		<?php
		if ('html5' === $format) {
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
	public function update($new_instance, $old_instance)
	{
		$instance             = $old_instance;
		$new_instance         = wp_parse_args(
			(array) $new_instance,
			array(
				'title'    => '',
				'count'    => 0,
			)
		);
		$instance['title']    = sanitize_text_field($new_instance['title']);
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
	public function form($instance)
	{
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'    => '',
				'count'    => 0,
			)
		);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['count']); ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" />
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label>
		</p>
<?php
	}
}

function load_KT_archives_widgets()
{
	register_widget('KT_Widget_Archives');
}
add_action('widgets_init', 'load_KT_archives_widgets');
