<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Scott_Killen
 */

get_header();
?>

<div class="row">
	<main id="primary" class="site-main col-md-8">
		<?php
		if (have_posts()) :
			if (is_home() && !is_front_page()) :
				// Display page title for blog posts page.
				echo '<header><h1 class="page-title screen-reader-text">';
				single_post_title();
				echo '</h1></header>';
			endif;

			/* Start the Loop */
			while (have_posts()) :
				the_post();

				/*
         * Include the Post-Type-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
         */
				get_template_part('template-parts/content', get_post_type());

			endwhile;

			echo KT_get_the_posts_navigation(
				array(
					'prev_text' => esc_html__('Older', 'scottkillen'),
					'next_text' => esc_html__('Newer', 'scottkillen'),
					'screen_reader_text' => '',
					'aria_label' => esc_attr__('Page navigation', 'scottkillen'),
				)
			);

		else :
			// If no posts found, display a message.
			get_template_part('template-parts/content', 'none');

		endif;
		?>
	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div>

<?php get_footer();
