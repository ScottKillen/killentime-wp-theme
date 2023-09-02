<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Scott_Killen
 */

?>


<article id="post-<?php the_ID(); ?>" <?php KT_post_class(); ?>>
	<?php
	// Display the post title as a link.
	the_title('<h2 class="entry-title display-5 mb-1"><a class="link-body-emphasis text-decoration-none" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

	if ('post' === get_post_type()) :
		// Display post metadata for blog posts.
	?>
		<p class="blog-post-meta text-secondary font-accent">
			<?php
			killentime_posted_by();
			killentime_posted_on();
			?>
		</p>
	<?php endif;

	// Display the post excerpt.
	KT_home_excerpt($post);
	?>
</article><!-- #post-<?php the_ID(); ?> -->
