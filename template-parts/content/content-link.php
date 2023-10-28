<?php defined('ABSPATH') || exit; ?>
<article <?php kt_post_id(); ?> <?php post_class(); ?><?php semantics('post'); ?>>
	<div class="rounded-3 border p-3">
		<?php if (is_search()) : // Only display Excerpts for search pages
		?>
			<div class="entry-summary p-summary entry-title p-name" itemprop="name description">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content e-content p-summary entry-title p-name" itemprop="name headline description articleBody">
				<div class="clearfix">
					<?php kt_the_post_thumbnail('<p>', '</p>'); ?>
					<?php the_content('Continue reading <span class="meta-nav">&rarr;</span>'); ?>
				</div>
				<?php wp_link_pages(array('before' => '<div class="page-link">Pages:', 'after' => '</div>')); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

		<?php get_template_part(
			'template-parts/entry/entry',
			'footer',
			array(
				'components' => array(
					'post_date',
					'post_tag',
					'comment_link',
					'edit_link',
				)
			)
		); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
