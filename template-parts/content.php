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
			the_content();
		} else {
			KT_home_excerpt($post);
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
