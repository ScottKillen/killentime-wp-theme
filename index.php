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
<div id="main" class="row">
	<main id="primary" <?php semantic_main_class('site-main col-md-8') ?>>
		<?php
		if (have_posts()) :
			if (is_home() && !is_front_page()) :
				// Display page title for blog posts page.
				echo '<header><h1 class="page-title screen-reader-text">';
				single_post_title();
				echo '</h1></header>';
			endif;

			/* Start the Loop */
			while (have_posts()) : the_post();

				get_template_part('template-parts/content/content', get_post_type());

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
			get_template_part('template-parts/content/content', 'none');

		endif;
		?>
	</main><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- #main -->

<?php get_footer();
