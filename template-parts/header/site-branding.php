<?php
defined('ABSPATH') || exit;

$logo_img_url = 'https://imagedelivery.net/0XfRl_9i2twIzyWa9HYA4g/ec98a6d7-bf85-46bb-fea9-779267300300/thumbnail';
?>
<div id="head" class="text-center py-3 site-branding">
	<div class="d-flex justify-content-center align-items-center">
		<div class="u-photo photo logo" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
			<img id="site-image" itemprop="url" class="rounded-circle d-block overflow-hidden border bg-body-tertiary border-secondary mx-auto my-0 shadow-lg img-fluid me-2" src="<?php echo $logo_img_url; ?>" alt="Killentime logo" height="80" width="80" />
			<meta itemprop="width" content="106" />
			<meta itemprop="height" content="106" />
		</div>
		<div>
			<h1 id="site-title" <?php semantics('site-title') ?>><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home" <?php semantics('site-url'); ?>><?php bloginfo('name'); ?></a></h1>
			<h2 id="site-description" <?php semantics('site-description'); ?>><?php bloginfo('description'); ?></h2>
		</div>
	</div>
</div><!-- #head -->
