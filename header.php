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
<html <?php language_attributes(); ?> data-bs-theme="light">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/515e1e91da.js" crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site container">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'scottkillen'); ?></a>

	<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
		<symbol id="check2" viewBox="0 0 16 16">
			<path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
		</symbol>
		<symbol id="circle-half" viewBox="0 0 16 16">
			<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
		</symbol>
		<symbol id="moon-stars-fill" viewBox="0 0 16 16">
			<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
			<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
		</symbol>
		<symbol id="sun-fill" viewBox="0 0 16 16">
			<path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
		</symbol>
		<symbol id="sk-logo" viewBox="0 0 16 16">
			<path d="M16,8C16,12.419 12.419,16 8,16C3.581,16 0,12.419 0,8C0,3.581 3.581,0 8,0C12.419,0 16,3.581 16,8ZM8,1C4.134,1 1,4.134 1,8C1,11.866 4.134,15 8,15C11.866,15 15,11.866 15,8C15,4.134 11.866,1 8,1Z"/>
			<path d="M5.571,12.016C5.12,12.136 4.697,12.195 4.301,12.193C3.904,12.191 3.494,12.113 3.069,11.96L2.674,10.482L3.623,10.229L3.985,11.063C4.14,11.136 4.336,11.175 4.575,11.182C4.813,11.189 5.063,11.157 5.323,11.088C5.547,11.028 5.726,10.947 5.861,10.845C6.138,10.636 6.234,10.374 6.15,10.057C6.11,9.909 6.041,9.788 5.941,9.695C5.745,9.513 5.354,9.411 4.766,9.388C4.231,9.375 3.789,9.325 3.439,9.239C3.076,9.156 2.783,9.017 2.562,8.823C2.34,8.629 2.185,8.365 2.096,8.032C2.008,7.702 2.022,7.385 2.139,7.081C2.254,6.78 2.454,6.514 2.74,6.282C3.025,6.049 3.38,5.874 3.804,5.754C4.273,5.623 4.704,5.568 5.098,5.589C5.492,5.609 5.848,5.69 6.168,5.829L6.535,7.206L5.616,7.452L5.232,6.655C5.108,6.616 4.949,6.596 4.755,6.593C4.561,6.591 4.349,6.621 4.119,6.682C3.924,6.734 3.759,6.81 3.627,6.908C3.491,7.007 3.395,7.125 3.338,7.26C3.281,7.395 3.274,7.542 3.317,7.702C3.353,7.839 3.423,7.948 3.525,8.028C3.716,8.181 4.14,8.276 4.798,8.313C5.523,8.321 6.1,8.432 6.531,8.647C6.962,8.862 7.244,9.219 7.378,9.72C7.471,10.07 7.457,10.395 7.337,10.694C7.217,10.999 7.006,11.265 6.704,11.493C6.402,11.72 6.024,11.895 5.571,12.016Z"/>
			<path d="M10.92,6.782L13.581,8.882L14.21,8.827L14.406,9.561L11.807,10.255L11.611,9.521L12.168,9.318L12.173,9.317L10.329,7.821L9.696,8.935L9.936,9.833L10.591,9.793L10.787,10.528L8.289,11.195L8.093,10.46L8.71,10.161L7.538,5.774L6.854,5.821L6.656,5.082L9.154,4.415L9.352,5.154L8.764,5.446L9.326,7.549L10.85,4.821L10.855,4.806L10.237,4.918L10.04,4.179L12.555,3.507L12.752,4.246L12.207,4.513L10.92,6.782Z"/>
		</symbol>
	</svg>


	<?php if ( is_front_page() && is_home() ) : ?>
		<header id="header">
			<div id="head" class="text-center py-5">
				<h1 id="logo" class="text-center">
					<img class="rounded-circle d-block overflow-hidden border border-secondary mx-auto my-0" src="<?php echo get_template_directory_uri() . '/images/killentime.png'; ?>" alt="Killentime logo" />
					<span class="title fs-1">Killentime</span>
					<span class="tagline text-body-secondary d-block my-2 fs-6">Stuff Scott Killen says...<br /><a class="text-body-tertiary text-decoration-none" href>(for whatever it's worth)</a></span>
				</h1><!-- #logo -->
			</div><!-- #head -->
		</header> <!-- #header -->
	<?php endif; ?>
	<nav class="py-2 mb-4 navbar navbar-expand-lg border-bottom border-top sticky-top shadow-sm" id="site-navigation" class="main-navigation">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse d-lg-flex" id="navbar1">
				<a class="navbar-brand col-lg-3 me-0 invisible" id="brand" hrf="/">Killentime</a>
				<?php
				wp_nav_menu(
					array(
						'menu_class' => 'navbar-nav col-lg-6 justify-content-center nav-pills',
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
								<svg class="bi my-1 theme-icon-active"><use href="#circle-half"></use></svg>
								<span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
							</button>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
								<li>
									<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
										<svg class="bi me-2 opacity-50 theme-icon"><use href="#sun-fill"></use></svg>Light<svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
									</button>
								</li>
								<li>
									<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
										<svg class="bi me-2 opacity-50 theme-icon"><use href="#moon-stars-fill"></use></svg>Dark<svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
									</button>
								</li>
								<li>
									<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
										<svg class="bi me-2 opacity-50 theme-icon"><use href="#circle-half"></use></svg>Auto<svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
									</button>
								</li>
							</ul>
						</li>
					</ul>
			</div>
			<div> <!-- #navbar1 -->
		</div>
	</nav><!-- #site-navigation -->
