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

	<?php if (is_search()) : // Only display Excerpts for Search
	?>
		<div class="entry-summary p-summary" itemprop="description">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content e-content" itemprop="articleBody description">
			<div class="clearfix pb-3">
				<?php kt_the_post_thumbnail('<p>', '</p>'); ?>
			</div>
			<?php the_content('Continue reading'); ?>
			<?php wp_link_pages(array('before' => '<div class="page-link">Pages:', 'after' => '</div>')); ?>
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
