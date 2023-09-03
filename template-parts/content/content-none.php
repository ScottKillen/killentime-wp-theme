<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Scott_Killen
 */

$search_query = get_search_query();
$categories_title = esc_html__('Most Used Categories', 'killentime');

// Function to apply custom CSS classes to tag cloud links
function custom_tag_cloud_links($tag_cloud)
{
	return str_replace(
		'"tag-cloud-link',
		'"pe-2 link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover tag-cloud-link',
		$tag_cloud
	);
}
?>

<section class="no-results not-found">
	<header class="page-header">
		<img alt="Sad looking guy" class="d-block my-2 mx-auto rounded-circle border border-secondary" height="384" widget="384" src="<?php echo esc_url(get_theme_file_uri('/images/404.png')); ?>">
		<h1 class="fst-italic page-title text-center"><?php echo esc_html__('Oops! We couldn&rsquo;t find "', 'killentime') . $search_query . '"'; ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<p class="text-info text-center"><?php echo esc_html__('Try the links on this page to get your bearings.', 'killentime'); ?></p>

		<?php get_search_form(); ?>

		<div class="d-flex gap-3">
			<div class="widget widget_categories my-4 col-6">
				<p class="h2 fst-italic widget-title"><?php echo $categories_title; ?></p>
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
				<?php
				ob_start();
				wp_tag_cloud();
				$tag_cloud = ob_get_clean();
				echo custom_tag_cloud_links($tag_cloud);
				?>
			</div>
		</div>
	</div><!-- .page-content -->
</section><!-- .no-results -->
