<?php
defined('ABSPATH') || exit;

$search_query = get_search_query();
$categories_title = esc_html__('Most Used Categories', 'killentime');
?>

<article id="post-0" class="post no-results not-found pb-5">
	<header class="entry-header">
		<img alt="Sad looking guy" class="d-block my-2 mx-auto rounded-circle border border-secondary" height="384" widget="384" src="https://imagedelivery.net/0XfRl_9i2twIzyWa9HYA4g/f5f4e5eb-53cb-4f46-7f89-47f82372e900/400x">
		<h1 class="fst-italic entry-title p-entry-title text-center"><?php echo esc_html('Oops! We couldn&rsquo;t find "' . $search_query . '".'); ?></h1>
	</header><!-- .page-header -->

	<div class="entry-content e-entry-content">
		<p class="text-info text-center"><?php echo esc_html('Try the links on this page to get your bearings.'); ?></p>

		<?php get_search_form(); ?>

		<div class="d-flex gap-3">
			<?php
			the_widget(
				'KT_Widget_Recent_Posts',
				array(),
				array(
					'before_widget' => '<div class="widget %s my-4 col-6">',
				)
			);
			?>

			<?php
			$archive_content = '<p>' . sprintf('Try looking in the monthly archives. %1$s', convert_smilies(':)')) . '</p>';
			the_widget(
				'WP_Widget_Archives',
				'dropdown=1',
				array(
					'after_title' => '</h2>' . $archive_content,
					'before_widget' => '<div class="widget %s my-4 col-6">',
				)
			);
			?>
		</div>

		<div class="d-flex gap-3 widget-area" role="complementary">
			<div class="widget widget_categories my-4 col-6">
				<p class="h2 fst-italic widget-title">Most Used Categories</p>
				<div class="list-group">
					<?php
					wp_list_categories(
						array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						)
					);
					?>
				</div>
			</div><!-- .widget -->

			<div class="widget widget_categories my-4 col-6">
				<p class="h2 fst-italic widget-title">Tags</p>
				<?php wp_tag_cloud(); ?>
			</div>
		</div>
	</div>
</article>
