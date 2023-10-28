<?php
defined('ABSPATH') || exit;

get_header();
?>
<main id="primary" <?php semantic_main_class('site-main') ?>>
	<?php
	if (have_posts()) :
		if (is_home() && !is_front_page()) :
			// Display page title for blog posts page.
			echo '<header><h1 class="page-title screen-reader-text">';
			single_post_title();
			echo '</h1></header>';
		endif;

		kt_content_nav('nav-above');


		/* Start the Loop */
		while (have_posts()) : the_post();

			get_template_part('template-parts/content/content', get_post_format());

		endwhile;

		kt_content_nav('nav-below');

	else :
		// If no posts found, display a message.
		get_template_part('template-parts/content/content', 'none');

	endif;
	?>
</main><!-- #primary -->

<?php get_footer();
