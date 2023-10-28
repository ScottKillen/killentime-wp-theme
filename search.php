<?php
defined('ABSPATH') || exit;

get_header();
?>
<section id="primary">
	<main id="content" <?php semantic_main_class('site-main') ?>>
		<?php
		if (have_posts()) : ?>

			<header class="page-header">
				<h1 class="page-title border-bottom"><?php printf('Search Results for: %s', '<span>' . get_search_query() . '</span>'); ?></h1>
			</header><!-- .page-header -->

		<?php

			kt_content_nav('nav-above');

			/* Start the Loop */
			while (have_posts()) : the_post();

				get_template_part('template-parts/content/content', get_post_format());

			endwhile;

			kt_content_nav('nav-below');

		else :

			get_template_part('template-parts/content/content', 'none');

		endif;
		?>

	</main><!-- #main -->
</section><!-- #primary -->
<?php get_footer();
