<?php

get_header();
?>

<div class="row">
	<section id="primary" class="col-md-8">
		<main id="content" <?php semantic_main_class('site-main') ?>>
			<?php
			if (have_posts()) : ?>

				<header class="page-header">
					<h1 class="page-title border-bottom"><?php printf('Search Results for: %s', '<span>' . get_search_query() . '</span>'); ?></h1>
				</header><!-- .page-header -->

			<?php
				/* Start the Loop */
				while (have_posts()) : the_post();

					get_template_part('template-parts/content/content', get_post_format());

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

				get_template_part('template-parts/content/content', 'none');

			endif;
			?>

		</main><!-- #main -->
	</section><!-- #primary -->
	<?php get_sidebar(); ?>
</div>

<?php get_footer();
