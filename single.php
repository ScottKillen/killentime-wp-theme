<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Scott_Killen
 */

get_header();
?>

<div class="row">
	<main id="primary" class="site-main col-md-8">

		<?php
		while (have_posts()) :
			the_post();

			$categories = get_the_category();
			if (!empty($categories)) {
				if ($categories[0]->name != "Uncategorized") {
					echo '<a class="badge text-bg-primary text-decoration-none" href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . "</a>";
				}
			}

			get_template_part('template-parts/content', get_post_type()); ?>

			<div class="clearfix">
				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'killentime') . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'killentime') . '</span> <span class="nav-title">%title</span>',
					)
				); ?>
			</div>
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_sidebar("2"); ?>
</div><!-- .row -->
<?php
get_footer();
