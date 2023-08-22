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
			the_title( '<h2 class="entry-title display-5 link-body-emphasis mb-1">', '</h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<p class="blog-post-meta text-secondary font-accent">
				<?php killentime_posted_by(); ?>
				<?php killentime_posted_on(); ?>
			</p>
		<?php endif; ?>

	<?php killentime_post_thumbnail(); ?>

		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'killentime' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

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
