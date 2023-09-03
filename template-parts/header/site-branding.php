<?php

/**
 * Displays header site branding
 *
 */

$blog_info    = get_bloginfo('name');
$description  = get_bloginfo('description', 'display');
$logo_img_url = esc_url(
	get_template_directory_uri() .
		'/images/killentime.png'
);
$logo_tag = (is_singular() || is_archive() || is_404() || is_search())
	? 'p'
	: 'h1';
?>

<div id="head" class="text-center pt-3 pb-5 site-branding">
	<<?php echo $logo_tag ?> id="logo" class="site-logo text-center">
		<img class="rounded-circle d-block overflow-hidden border bg-body-tertiary border-secondary mx-auto my-0 shadow-lg" src="<?php echo $logo_img_url; ?>" alt="Killentime logo" />
		<span class="title site-title"><?php echo $blog_info; ?></span>
		<span class="tagline text-body-secondary d-block mt-1 mb-2 font-accent fs-6 lh-sm"><?php echo $description; ?></span>
	</<?php echo $logo_tag ?>> <!-- #logo -->
</div><!-- #head -->
