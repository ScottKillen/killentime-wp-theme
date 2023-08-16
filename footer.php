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

<div class="container">
	<footer id="colophon" class="site-footer">
		<div class="d-flex flex-column flex-sm-row justify-content-between pt-2 my-4 border-top">
      <p>© <?php echo date('Y'); ?> Scott Killen. All rights reserved.<a href="/" class="mb-3 ms-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
				<svg class="bi link-body-emphasis" width="1.75em" height="1.75em"><use xlink:href="#sk-logo" fill="currentColor"></use></svg>
			</a></p>
			<ul class="list-unstyled d-flex">
				<li class="ms-3"><a class="link-body-emphasis" href="https://ttocs.io/@scott" rel="me"><i class="fa-brands fa-mastodon"></i><a></li>
				<li class="ms-3"><a class="link-body-emphasis" href="https://github.com/ScottKillen" rel="me"><i class="fa-brands fa-github"></i></a></li>
				<li class="ms-3"><a class="link-body-emphasis" href="https://open.spotify.com/user/sdkillen" rel="me"><i class="fa-brands fa-spotify"></i></a></li>
				<li class="ms-3"><a class="link-body-emphasis" href="https://www.flickr.com/photos/scottkillen" rel="me"><i class="fa-brands fa-flickr"></i></a></li>
				<li class="ms-3"><a class="link-body-emphasis" href="https://www.instagram.com/scottdkillen/" rel="me"><i class="fa-brands fa-instagram"></i></a></li>
			</ul>
		</div>
	</footer>
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
