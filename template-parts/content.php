<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Scott_Killen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php KT_post_class(); ?> >
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title display-5 mb-1"><a class="link-body-emphasis text-decoration-none" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<p class="blog-post-meta text-secondary font-accent">
				<?php
				killentime_posted_by();
				if (!is_singular()) {
					killentime_posted_in();
				}
				killentime_posted_on(); ?>
			</p>
		<?php endif; ?>

	<?php killentime_post_thumbnail(); ?>

		<?php
		if (is_singular()) {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'killentime'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
		} else {
			if (has_excerpt()) {
				echo '<p>'.$post->post_excerpt.'</p>';
				echo '<a href="' . esc_url( get_permalink() ) . '" class="more-link icon-link gap-1 icon-link-hover">Continue reading...<svg class="bi"><use xlink:href="#chevron-right"/></svg></a>';
			} else if (strpos($post->post_content, '<!--more-->')) {
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'killentime'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post(get_the_title())
					)
				);
			} else {
				the_excerpt();
			}
		}

/*		wp_link_pages(
 *			array(
 *				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'killentime' ),
 *				'after'  => '</div>',
 *			)
 *		);
 */
		?>

	<footer class="entry-footer">
		<?php killentime_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
