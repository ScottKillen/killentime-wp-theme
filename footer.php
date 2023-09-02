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
		<a href="/" class="font-title col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none link-body-emphasis">Killentime</a>
		<ul class="nav col-md-4 justify-content-end">
			<li class="nav-item">
				<a class="nav-link px-2 text-body-secondary icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="https://ttocs.io/@scott" rel="me">
					<svg class="bi">
						<use xlink:href="#fa-mastodon" />
					</svg>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 text-body-secondary icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="https://github.com/ScottKillen" rel="me">
					<svg class="bi">
						<use xlink:href="#fa-github" />
					</svg>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 text-body-secondary icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="https://open.spotify.com/user/sdkillen" rel="me">
					<svg class="bi">
						<use xlink:href="#fa-spotify" />
					</svg>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 text-body-secondary icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="https://www.flickr.com/photos/scottkillen" rel="me">
					<svg class="bi">
						<use xlink:href="#fa-flickr" />
					</svg>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2 text-body-secondary icon-link icon-link-hover" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="https://www.instagram.com/scottdkillen/" rel="me">
					<svg class="bi">
						<use xlink:href="#fa-instagram" />
					</svg>
				</a>
			</li>
		</ul>
	</div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
