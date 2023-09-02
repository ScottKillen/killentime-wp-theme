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
			<?php
			$social_links = array(
				'https://ttocs.io/@scott' => 'fa-mastodon',
				'https://github.com/ScottKillen' => 'fa-github',
				'https://open.spotify.com/user/sdkillen' => 'fa-spotify',
				'https://www.flickr.com/photos/scottkillen' => 'fa-flickr',
				'https://www.instagram.com/scottdkillen/' => 'fa-instagram',
			);

			foreach ($social_links as $link => $icon) :
			?>
				<li class="nav-item">
					<a class="nav-link px-2 text-body-secondary icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?php echo esc_url($link); ?>" rel="me">
						<svg class="bi">
							<use xlink:href="#<?php echo esc_attr($icon); ?>" />
						</svg>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
