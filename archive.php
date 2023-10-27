<?php

get_header();
?>

<div class="row">
	<section id="primary" class="col-md-8">
		<main id="content" <?php semantic_main_class() ?>>
			<?php if (have_posts()) : ?>

				<header class="page-header">
					<h1 class="page-title display-4 border-bottom border-secondary-subtle mb-3"><?php the_archive_title(); ?></h1>
					<div class="page-description"><?php the_archive_description(); ?></div>
				</header>

				<?php rewind_posts(); ?>

				<?php kt_content_nav('nav-above'); ?>

				<?php while (have_posts()) : the_post(); ?>

					<?php get_template_part('template-parts/content/content', get_post_type()); ?>

				<?php endwhile; ?>

				<?php kt_content_nav('nav-below'); ?>

			<?php else :

				// If no posts found, display a message.
				get_template_part('template-parts/content/content', 'none');

			endif;
			?>

		</main><!-- #content -->
	</section><!-- #primary -->
	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
