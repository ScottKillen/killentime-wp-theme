<?php defined('ABSPATH') || exit; ?>
<article <?php kt_post_id(); ?> <?php post_class(); ?><?php semantics('post'); ?>>
	<div class="rounded-3 border p-3 reverse-mode">
		<?php if (is_search()) : // Only display Excerpts for search pages
		?>
			<div class="entry-summary p-summary" itemprop="description">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-title p-name entry-content e-content" itemprop="name headline description articleBody">
				<div class="clearfix pb-3">
					<?php kt_the_post_thumbnail('<p>', '</p>'); ?>
					<figure>
						<blockquote class="blockquote">
							<?php the_content('Continue reading'); ?>
						</blockquote>
						<figcaption class="blockquote-footer">
							<cite><?php the_title(); ?></cite>
						</figcaption>
				</div>
				<?php wp_link_pages(array('before' => '<div class="page-link">Pages:', 'after' => '</div>')); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

		<?php get_template_part(
			'template-parts/entry/entry',
			'footer',
			array(
				'components' => array(
					'post_tag',
					'edit_link',
				)
			)
		); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
