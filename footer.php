<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Scott_Killen
 */

?>

<footer id="colophon" class="site-footer">
	<div class="d-flex flex-wrap justify-content-between align-items-center pt-2 my-4 border-top">
		<p class="col-md-4 mb-0 text-body-secondary font-accent">© <?php echo date('Y'); ?> Scott Killen. All rights reserved.</p>
		<a href="<?php echo esc_url(home_url('/')) ?>" class="font-title col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none link-body-emphasis">
			<?php bloginfo('name'); ?>
		</a>
		<ul class="nav col-md-4 justify-content-end">
			<?php get_template_part('template-parts/social-icons'); ?>
		</ul>
	</div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
