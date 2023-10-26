<?php ?>

<article <?php kt_post_id(); ?> <?php post_class(); ?><?php semantics('page') ?>>
	<?php get_template_part('template-parts/entry/entry', 'header'); ?>

	<?php if (is_search()) : // Display excerpts in search
	?>
		<div class="entry-summary p-summary" itemprop="description">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="clearfix py-3">
			<div class="entry-content e-content" itemprop="description text">
				<?php kt_the_post_thumbnail('<div class="entry-media">', '</div>'); ?>
				<?php the_content(); ?>
			</div>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . 'Pages:',
					'after'  => '</div>',
				)
			);
			?>
		</div>
	<?php endif; ?>

	<?php get_template_part(
		'template-parts/entry/entry',
		'footer',
		array(
			'components' => array(
				'edit_link',
			)
		)
	); ?>

</article><!-- #post-<?php the_ID(); ?> -->
