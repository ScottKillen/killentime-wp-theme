<?php ?>
<article <?php kt_post_id(); ?> <?php post_class(); ?><?php semantics('post'); ?> itemref="site-publisher">
	<?php get_template_part('template-parts/entry/entry', 'header'); ?>

	<?php if (is_search()) : // Only display Excerpts for Search
	?>
		<div class="entry-summary p-summary" itemprop="description">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<?php kt_the_post_thumbnail('<div class="entry-media">', '</div>'); ?>
		<div class="entry-content e-content" itemprop="description articleBody">
			<?php the_content('Continue reading <span class="meta-nav">&rarr;</span>'); ?>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . 'Pages:', 'after' => '</div>')); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php get_template_part('template-parts/entry/entry', 'footer'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
