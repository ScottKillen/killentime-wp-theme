<?php

?>
<article <?php kt_post_id(); ?> <?php post_class(); ?><?php semantics('post') ?>>
	<?php get_template_part('template-parts/entry/entry', 'header');

	if (is_singular()) {
		kt_the_post_thumbnail();
		echo '<div class="e-content">';
		the_content();
		echo '</div>';
	} else {
		echo '<div class="p-summary">';
		kt_the_excerpt($post);
		echo '</div>';
	}

	if (is_singular()) : ?>
		<footer class="entry-footer">
			<?php killentime_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php
	endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
