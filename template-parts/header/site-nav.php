<?php

/**
 * Displays the site navigation.
 *
 */

?>

<nav class="py-2 mb-4 navbar navbar-expand-lg border-bottom border-top sticky-top shadow-sm main-navigation" id="site-navigation">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse d-lg-flex" id="navbar1">
			<a class="navbar-brand col-lg-3 me-0 invisible" id="brand" href="/">Killentime</a>
			<?php
			wp_nav_menu(
				array(
					'menu_class' => 'navbar-nav col-lg-6 justify-content-center nav-underline',
					'container' => false,
					'theme_location' => 'menu-1',
				)
			);
			?>
			<div class="d-lg-flex col-lg-3 justify-content-end">
				<?php get_template_part('template-parts/header/color-mode-switch'); ?>
			</div>
		</div> <!-- #navbar1 -->
	</div>
</nav><!-- #site-navigation -->
