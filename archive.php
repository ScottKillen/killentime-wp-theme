<?php

/**
 * The template for displaying archive pages
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
			$archive_title = get_the_archive_title();
			$archive_description = get_the_archive_description();

			// Display archive title and description if available.
			if ($archive_title || $archive_description) :
		?>
				<header class="page-header">
					<?php
					if ($archive_title) {
						echo '<h1 class="page-title border-bottom">' . $archive_title . '</h1>';
					}
					if ($archive_description) {
						echo '<div class="archive-description">' . $archive_description . '</div>';
					}
					?>
				</header><!-- .page-header -->
		<?php
			endif;

			// Start the Loop to display posts.
			while (have_posts()) :
				the_post();

				/*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
				get_template_part('template-parts/content', get_post_type());

			endwhile;

			// Display navigation for paginated archives.
			the_posts_navigation();

		else :

			// If no posts found, display a message.
			get_template_part('template-parts/content', 'none');

		endif;
		?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
