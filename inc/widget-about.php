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
			<div class="row h-card">
				<div class="col-3">
					<img class="rounded-circle border border-secondary u-photo" alt="Scott Killen" width="65" src="<?php echo get_theme_file_uri('/images/scott.png') ?>">
				</div>
				<div class="col">
					<p>
						I'm <span class="fw-semibold p-name">Scott Killen</span>. Killentime is where I write about things that I find
						interesting. I am a bible scholar and technophile and enjoy learning about all sorts of things.
					</p>
					<p>
						I'm a gospel preacher at
						<a class="p-name p-org u-url link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" href="https://edistochurch.org/">
							Edisto Island Church of Christ
						</a>
						and a <abbr class="link-offset-2 link-underline-secondary" title="Certified Public Accountant">CPA</abbr> at
						<a class="p-name p-org u-url link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" href="https://killencpa.com/">
							Killen & Associates, CPAs, PA.
						</a>
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
