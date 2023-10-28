<?php
defined('ABSPATH') || exit;

$social_links = array(
	'mailto:scott@scottkillen.com' => array(
		'icon' => 'fa-at',
		'title' => 'Email'
	),
	'https://ttocs.io/@scott' => array(
		'icon' => 'fa-mastodon',
		'title' => 'Mastodon'
	),
	'https://github.com/ScottKillen' => array(
		'icon' => 'fa-github',
		'title' => 'GitHub'
	),
	'https://open.spotify.com/user/sdkillen' => array(
		'icon' => 'fa-spotify',
		'title' => 'Spotify'
	),
	'https://www.flickr.com/photos/scottkillen' => array(
		'icon' => 'fa-flickr',
		'title' => 'Flickr'
	),
	'https://www.instagram.com/scottdkillen/' => array(
		'icon' => 'fa-instagram',
		'title' => 'Instagram'
	)
);

$social_class[] = 'nav-item';

if (isset($args['social-class'])) {
	if (is_array($args['social-class'])) {
		$social_class = array_merge($social_class, $args['social-class']);
	} else {
		$social_class[] = $args['social-class'];
	}
}

$show_text = isset($args['show-text']) ? $args['show-text'] : false;

foreach ($social_links as $link => $data) :
?>
	<li class="<?php echo implode(' ', $social_class); ?>">
		<a class="nav-link px-2 text-body-secondary icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?php echo esc_url($link); ?>" rel="me" title="<?php echo esc_attr($data['title']); ?>">
			<svg class="bi">
				<use xlink:href="#<?php echo esc_attr($data['icon']); ?>" />
			</svg> <?php echo $show_text ? esc_attr($data['title']) : ''; ?>
		</a>
	</li>
<?php
endforeach;
