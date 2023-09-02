<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Scott_Killen
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> data-bs-theme="dark">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/515e1e91da.js" crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site container">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'killentime'); ?></a>

		<?php
		echo KT_the_icons(); ?>
		<div class="container">
			<header id="header">
				<div id="head" class="text-center pt-3 pb-5">
					<?php
					if (is_singular() || is_archive() || is_404()) {
						$logo_tag = "p";
					} else {
						$logo_tag = "h1";
					}
					?>
					<<?php echo $logo_tag ?> id="logo" class="text-center">
						<img class="rounded-circle d-block overflow-hidden border bg-body-tertiary border-secondary mx-auto my-0 shadow-lg" src="<?php echo get_template_directory_uri() . '/images/killentime.png'; ?>" alt="Killentime logo">
						<span class="title"><?php bloginfo('name'); ?></span>
						<span class="tagline text-body-secondary d-block mt-1 mb-2 font-accent fs-6 lh-sm"><?php bloginfo('description'); ?></span>
					</<?php echo $logo_tag ?>><!-- #logo -->
				</div><!-- #head -->
			</header> <!-- #header -->
		</div>
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
							'menu_id' => 'primary-menu',
							'container' => false,
							'theme_location' => 'menu-1',
							'add_li_class' => 'nav-item',
							'add_link_class' => 'nav-link'
						)
					); ?>
					<div class="d-lg-flex col-lg-3 justify-content-end">
						<ul class="navbar-nav flex-row-flex-wrap ms-md-auto">
							<li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
								<div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
								<hr class="d-lg-none my-2 text-white-50">
							</li>
							<li class="nav-item dropdown">
								<button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (auto)">
									<svg class="bi my-1 theme-icon-active">
										<use href="#circle-half"></use>
									</svg>
									<span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
								</button>
								<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
									<li>
										<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
											<svg class="bi me-2 opacity-50 theme-icon">
												<use href="#sun-fill"></use>
											</svg>Light<svg class="bi ms-auto d-none">
												<use href="#check2"></use>
											</svg>
										</button>
									</li>
									<li>
										<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
											<svg class="bi me-2 opacity-50 theme-icon">
												<use href="#moon-stars-fill"></use>
											</svg>Dark<svg class="bi ms-auto d-none">
												<use href="#check2"></use>
											</svg>
										</button>
									</li>
									<li>
										<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
											<svg class="bi me-2 opacity-50 theme-icon">
												<use href="#circle-half"></use>
											</svg>Auto<svg class="bi ms-auto d-none">
												<use href="#check2"></use>
											</svg>
										</button>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div> <!-- #navbar1 -->
			</div>
		</nav><!-- #site-navigation -->
