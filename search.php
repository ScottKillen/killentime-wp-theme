<?php

get_header();
?>

<div class="row">
	<section id="primary" class="col-md-8">
		<main id="primary" <?php semantic_main_class('site-main col-md-8') ?>>
			<?php
			if (have_posts()) : ?>

				<header class="page-header">
					<h1 class="page-title border-bottom"><?php printf(__('Search Results for: %s', 'sempress'), '<span>' . get_search_query() . '</span>'); ?></h1>
				</header><!-- .page-header -->

			<?php
				/* Start the Loop */
				while (have_posts()) : the_post();

					get_template_part('template-parts/content/content', get_post_format());

				endwhile;

				the_posts_navigation();

			else :

				get_template_part('template-parts/content/content', 'none');

			endif;
			?>

		</main><!-- #main -->
	</section><!-- #primary -->
	<?php get_sidebar(); ?>
</div>

<?php get_footer();
