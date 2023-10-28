<?php
defined('ABSPATH') || exit;

get_header();
?>
<main id="primary" <?php semantic_main_class('site-main') ?>>
	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content/content', get_post_type());

		// If comments are open or we have at least one comment, load up the comment template.
		if (!in_array(get_post_format(), array('status', 'quote')) && (comments_open() || get_comments_number())) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
