<?php
defined('ABSPATH') || exit;

$logo_img_url = 'https://imagedelivery.net/0XfRl_9i2twIzyWa9HYA4g/ec98a6d7-bf85-46bb-fea9-779267300300/avatar';
?>
<footer id="colophon" role="contentinfo" class="footer mt-auto py-3 ">
	<div class="container">
		<div class="d-flex flex-wrap justify-content-between align-items-center pt-2 mt-4 border-top">
			<p class="col-md-4 mb-0 text-body-secondary font-accent">© <?php echo date('Y'); ?> Scott Killen. All rights reserved.</p>
			<a href="<?php echo esc_url(home_url('/')) ?>" class="fs-4 font-title col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none link-body-emphasis">
				<?php bloginfo('name'); ?>
			</a>
			<ul class="nav col-md-4 justify-content-end">
				<?php get_template_part('template-parts/social', 'icons'); ?>
			</ul>
		</div>
		<div class="d-flex flex-wrap justify-content-center">
			<img id="footer-image" itemprop="url" class="d-block my-0 img-fluid" src="<?php echo $logo_img_url; ?>" alt="Killentime logo" />
		</div>
	</div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
