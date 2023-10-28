<?php
defined('ABSPATH') || exit;

get_header(); ?>
<section id="primary">
	<main id="content" role="main" <?php semantic_main_class(); ?>>

		<?php if (have_posts()) : ?>

			<?php
			/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
			the_post();
			?>

			<header class="clearfix page-header author vcard h-card pb-3 mb-3 border-bottom border-secondary-subtle" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<h1 class="page-title display-4 border-bottom mb-3 border-secondary-subtle"><?php printf(__('Author Archives: %s', 'sempress'), '<a class="url u-url fn p-fn n p-name link-underline link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover" href="' . get_author_posts_url(get_the_author_meta('ID')) . '" title="' . esc_attr(get_the_author()) . '" rel="me author" itemprop="url"><span itemprop="name">' . get_the_author() . '</span></a>'); ?></h1>
				<?php echo get_avatar(get_the_author_meta('ID'), 150); ?>
				<?php if (get_the_author_meta('description')) { ?>
					<div class="author-note note p-note" itemprop="description">
						<p><?php echo get_the_author_meta('description'); ?></p>
					</div>
				<?php } ?>
			</header>

			<?php rewind_posts(); ?>

			<?php kt_content_nav('nav-above'); ?>

			<?php /* Start the Loop */ ?>
			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part('template-parts/content/content', get_post_type()); ?>

			<?php endwhile; ?>

			<?php kt_content_nav('nav-below'); ?>

		<?php else :

			// If no posts found, display a message.
			get_template_part('template-parts/content/content', 'none');

		endif; ?>

	</main><!-- #content -->
</section><!-- #primary -->

<?php
get_footer(); ?>
