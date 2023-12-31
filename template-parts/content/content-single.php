<?php
defined('ABSPATH') || exit;

$classes = !is_single() ? 'border-bottom border-secondary-subtle' : '';
$show_excerpt = is_search() ? true : (is_home() ? get_post_meta(get_the_ID(), 'excerpt_on_home', true) : false);
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

	<?php if (is_search() || $show_excerpt) : // Only display Excerpts for Search
	?>
		<div class="clearfix pb-3">
			<div class="entry-summary p-summary" itemprop="description">
				<?php if (!is_search()) {
					kt_the_post_thumbnail('<div class="entry-media">', '</div>');
				}
				?>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		</div>
	<?php else : ?>
		<?php
		if (is_single()) {
			kt_content_nav('nav_above');
		}
		?>
		<div class="clearfix pb-3">
			<?php kt_the_post_thumbnail('<div class="entry-media">', '</div>'); ?>
			<div class="entry-content e-content" itemprop="description articleBody">
				<?php the_content('Continue reading'); ?>
			</div><!-- .entry-content -->
		</div>

		<?php the_syndication_links(); ?>
		<?php the_share_buttons(); ?>

		<?php
		if (is_single()) {
			kt_content_nav('nav_below');
		}
		?>
	<?php endif; ?>

	<div class="container">
		<?php
		$components[] = 'post_tag';
		if (!is_single()) {
			$components[] = 'comment_link';
		}
		$components[] = 'edit_link';

		get_template_part(
			'template-parts/entry/entry',
			'footer',
			array(
				'components' => $components
			)
		); ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
