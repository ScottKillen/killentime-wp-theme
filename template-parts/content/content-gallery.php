<?php defined('ABSPATH') || exit; ?>
<article <?php kt_post_id(); ?> <?php post_class('border-bottom border-secondary-subtle'); ?><?php semantics('post'); ?>>
	<?php get_template_part(
		'template-parts/entry/entry',
		'header',
		array(
			'components' => array(
				'post_date',
				'post_category',
			)
		)
	); ?>

	<?php if (is_search()) : // Only display Excerpts for search pages
	?>
		<div class="entry-summary p-summary" itemprop="description">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="py-3 entry-content e-content" itemprop="description">
			<?php the_content('Continue reading'); ?>
			<?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">Pages:</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php get_template_part(
		'template-parts/entry/entry',
		'footer',
		array(
			'components' => array(
				'post_tag',
				'comment_link',
				'edit_link',
			)
		)
	); ?>
</article><!-- #post-<?php the_ID(); ?> -->
