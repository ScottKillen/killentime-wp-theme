<?php

/**
 * Displays header site branding
 *
 */

$logo_img_url = 'https://imagedelivery.net/0XfRl_9i2twIzyWa9HYA4g/ec98a6d7-bf85-46bb-fea9-779267300300/avatar';
?>
<div id="head" class="text-center pt-3 pb-5 site-branding">
	<div class="u-photo photo logo" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<img id="site-image" itemprop="url" class="rounded-circle d-block overflow-hidden border bg-body-tertiary border-secondary mx-auto my-0 shadow-lg" src="<?php echo $logo_img_url; ?>" alt="Killentime logo" />
		<meta itemprop="width" content="256" />
		<meta itemprop="height" content="256" />
	</div>
	<h1 id="site-title" <?php semantics('site-title') ?>><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home" <?php semantics('site-url'); ?>><?php bloginfo('name'); ?></a></h1>
	<h2 id="site-description" <?php semantics('site-description'); ?>><?php bloginfo('description'); ?></h2>
	</h1> <!-- #site-title -->
</div><!-- #head -->
