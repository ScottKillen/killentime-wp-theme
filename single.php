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

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		$categories = get_the_category();
		if (!empty($categories)) {
			if ($categories[0]->name != "Uncategorized") {
				echo '<a class="badge text-bg-primary text-decoration-none" href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . "</a>";
			}
		}

		get_template_part('template-parts/content', get_post_type());

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
