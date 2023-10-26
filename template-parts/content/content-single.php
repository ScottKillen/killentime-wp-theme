<?php
$classes = !is_single() ? 'border-bottom border-secondary-subtle' : '';
?>
<article <?php kt_post_id(); ?> <?php post_class($classes); ?><?php semantics('post'); ?> itemref="site-publisher">
	<?php get_template_part(
		'template-parts/entry/entry',
		'header',
		array(
			'components' => array(
				'post_date',
				'post_read_time',
				'post_category',
			)
		)
	); ?>

	<?php if (is_search()) : // Only display Excerpts for Search
	?>
		<div class="entry-summary p-summary" itemprop="description">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="clearfix py-3">
			<?php kt_the_post_thumbnail('<div class="entry-media">', '</div>'); ?>
			<div class="entry-content e-content" itemprop="description articleBody">
				<?php the_content('Continue reading <span class="meta-nav">&rarr;</span>'); ?>
			</div>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . 'Pages:', 'after' => '</div>')); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<div class="container">
		<?php get_template_part(
			'template-parts/entry/entry',
			'footer',
			array(
				'components' => array(
					'post_tag',
					'edit_link'
				)
			)
		); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
