<?php
class KT_Widget_About extends WP_Widget
{

	/**
	 * Sets up a new Archives widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct()
	{
		$widget_ops = array(
			'classname'                   => 'kt_widget_about',
			'description'                 => __('An about block.'),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct('kt-about', __('Killentime About'), $widget_ops);
	}

	/**
	 * Outputs the content for the current About widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Archives widget instance.
	 */
	public function widget($args, $instance)
	{
?>
		<div class="p-4 mb-3 bg-body-tertiary rounded">
			<h4 class="fst-italic">About</h4>
			<div class="row">
				<div class="col-3">
					<img class="rounded-circle border-secondary" width="100%" src="<?php echo get_theme_file_uri('/images/scott.jpg') ?>">
				</div>
				<div class="col">
					<p><span class="fw-semibold">Scott Killen</span> is a technophile who serves Jesus. He has been married most
						of his life of the love of his life. Scott has many interests and believes that healthy, respectful debates
						promote the truth.
					</p>
				</div>
			</div>
		</div>
<?php
	}
}

function load_KT_about_widget()
{
	register_widget('KT_Widget_About');
}
add_action('widgets_init', 'load_KT_about_widget');
