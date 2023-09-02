<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Scott_Killen
 */

get_header();
?>
<div class="row">
	<main id="primary" class="site-main col-md-8">

		<section class="error-404 not-found">
			<header class="page-header">
				<img alt="Sad looking guy" class="d-block my-2 mx-auto rounded-circle border border-secondary" height="384" widget="384" src="<?php echo get_theme_file_uri('/images/404.png') ?>">
				<h1 class="fst-italic page-title text-center"><?php esc_html_e('Oops! We couldn&rsquo;t find that page.', 'killentime'); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p class="text-info text-center"><?php esc_html_e('Try the links on this page to get your bearings.', 'killentime'); ?></p>

				<?php
				get_search_form();
				?>

				<div class="d-flex gap-3">
					<div class="widget widget_categories my-4 col-6">
						<p class="h2 fst-italic widget-title"><?php esc_html_e('Most Used Categories', 'killentime'); ?></p>
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
						$tag_cloud = ob_get_contents();
						ob_clean();
						$tag_cloud = str_replace('"tag-cloud-link', '"pe-2 link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover tag-cloud-link', $tag_cloud);
						echo $tag_cloud;
						?>
					</div>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
