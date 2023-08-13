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
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Proza+Libre:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<style>.bi{width:1em;height:1em;vertical-align:-.125em;fill:currentcolor}</style>
	<?php wp_head(); ?>
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
			<path d="M5.498,12.204C5.107,12.308 4.716,12.351 4.324,12.333C3.932,12.315 3.54,12.231 3.147,12.081L2.781,10.711L3.455,10.531L3.87,11.501C4.093,11.567 4.324,11.603 4.565,11.608C4.805,11.613 5.055,11.581 5.313,11.512C5.607,11.434 5.844,11.322 6.024,11.178C6.204,11.034 6.327,10.868 6.394,10.681C6.46,10.493 6.465,10.293 6.408,10.082C6.356,9.885 6.263,9.724 6.129,9.6C5.995,9.475 5.804,9.385 5.558,9.33C5.312,9.274 4.991,9.254 4.596,9.268C4.128,9.283 3.719,9.245 3.369,9.154C3.019,9.064 2.732,8.917 2.51,8.714C2.287,8.51 2.133,8.25 2.049,7.933C1.959,7.598 1.968,7.275 2.075,6.963C2.182,6.651 2.374,6.376 2.65,6.139C2.927,5.901 3.277,5.726 3.7,5.613C4.149,5.493 4.564,5.455 4.946,5.5C5.328,5.544 5.656,5.633 5.931,5.768L6.273,7.05L5.599,7.23L5.209,6.352C5.049,6.282 4.861,6.238 4.645,6.22C4.43,6.202 4.176,6.232 3.886,6.309C3.639,6.375 3.433,6.477 3.268,6.614C3.103,6.75 2.989,6.911 2.925,7.095C2.861,7.279 2.857,7.476 2.913,7.688C2.963,7.873 3.053,8.022 3.186,8.134C3.318,8.247 3.506,8.326 3.75,8.373C3.994,8.42 4.308,8.44 4.694,8.435C5.414,8.422 5.992,8.532 6.428,8.767C6.863,9.001 7.145,9.36 7.274,9.841C7.366,10.185 7.355,10.514 7.241,10.83C7.127,11.145 6.921,11.422 6.625,11.662C6.329,11.902 5.953,12.082 5.498,12.204Z"/>
			<path d="M9.502,9.048L8.896,8.634L11.038,4.441L11.05,4.415L10.553,4.481L10.404,3.922L12.461,3.372L12.611,3.932L12.036,4.203L9.502,9.048ZM8.473,11.31L8.325,10.755L9.01,10.44L7.66,5.386L6.909,5.454L6.76,4.895L9.064,4.279L9.214,4.839L8.528,5.154L9.878,10.208L10.629,10.139L10.778,10.694L8.473,11.31ZM12.262,10.298L12.114,9.743L12.626,9.54L12.621,9.536L10.187,7.548L10.49,6.736L13.636,9.218L14.255,9.171L14.404,9.726L12.262,10.298Z"/>
		</symbol>
	</svg>

	<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
		<?php emit_logo(); ?>

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu(
				array(
					'menu_class' => 'nav nav-pills',
					'menu_id' => 'primary-menu',
					'container' => false,
					'theme_location' => 'menu-1',
					'add_li_class' => 'nav-item',
					'add_link_class' => 'nav-link',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li class="nav-item py-2 py-lg-1 col-12 col-lg-auto"><div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div><hr class="d-lg-none my-2 text-white-50"></li><li class="nav-item dropdown"><button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (auto)">
              <svg class="bi my-1 theme-icon-active"><use href="#circle-half"></use></svg><span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span></button><ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text"><li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false"><svg class="bi me-2 opacity-50 theme-icon"><use href="#sun-fill"></use></svg>Light<svg class="bi ms-auto d-none"><use href="#check2"></use></svg></button></li><li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false"><svg class="bi me-2 opacity-50 theme-icon"><use href="#moon-stars-fill"></use></svg>Dark<svg class="bi ms-auto d-none"><use href="#check2"></use></svg></button></li><li><button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true"><svg class="bi me-2 opacity-50 theme-icon"><use href="#circle-half"></use></svg>Auto<svg class="bi ms-auto d-none"><use href="#check2"></use></svg></button></li></ul></li></ul>'
				)
			); ?>
		</nav><!-- #site-navigation -->
	</header>
