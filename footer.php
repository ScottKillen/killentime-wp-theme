<?php
defined('ABSPATH') || exit;

$logo_img_url = 'https://imagedelivery.net/0XfRl_9i2twIzyWa9HYA4g/ec98a6d7-bf85-46bb-fea9-779267300300/avatar';
?>
<footer id="colophon" class="footer mt-auto py-3 ">
	<div class="container" id="site-publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Person">
		<div class="d-flex flex-wrap justify-content-between align-items-center pt-2 mt-4 border-top">
			<p class="col-md-4 mb-0 text-body-secondary font-accent"><small>© <?php echo date('Y'); ?>
					<span itemprop="name">Scott Killen</span>. All rights reserved.
				</small></p>
			<a href="<?php echo esc_url(home_url('/')) ?>" class="fs-2 font-title col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none text-body-secondary" itemprop="url"><?php bloginfo('name'); ?></a>
			<img class="d-none" itemprop="image" loading="lazy" src="https://imagedelivery.net/0XfRl_9i2twIzyWa9HYA4g/8d2d2eb3-54e6-40b6-7a67-8941d09c0700/400x" />
			<ul class="nav col-md-4 justify-content-end">
				<?php get_template_part('template-parts/social', 'icons'); ?>
			</ul>
		</div>
		<div class="d-flex flex-wrap justify-content-center">
			<img id="footer-image" loading="lazy" height="256" width="356" class="d-block my-0 img-fluid" src="<?php echo $logo_img_url; ?>" alt="Killentime logo" />
		</div>
	</div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
