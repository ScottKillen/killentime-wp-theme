<?php

/**
 * Displays the social icons for the footer
 *
 */

$social_links = array(
	'mailto:scott@scottkillen.com' => 'fa-at',
	'https://ttocs.io/@scott' => 'fa-mastodon',
	'https://github.com/ScottKillen' => 'fa-github',
	'https://open.spotify.com/user/sdkillen' => 'fa-spotify',
	'https://www.flickr.com/photos/scottkillen' => 'fa-flickr',
	'https://www.instagram.com/scottdkillen/' => 'fa-instagram',
);
?>

<ul class="nav col-md-4 justify-content-end">
	<?php
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
