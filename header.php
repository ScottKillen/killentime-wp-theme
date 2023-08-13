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
	<style>.logo{height: 3.75rem}.site-title {display: none}.main-navigation{margin-top:auto}.bi{width:1em;height:1em;vertical-align:-.125em;fill:currentcolor}</style>
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
		<path d="M.019-.111c0-.008.002-.016.008-.023a.095.095 0 0 1 .019-.021.157.157 0 0 1 .021-.017l.014-.01c.003.03.015.053.034.068.02.016.044.025.073.03.03.004.063.003.099-.002A.685.685 0 0 0 .502-.15a.577.577 0 0 0 .087-.047.24.24 0 0 0 .054-.048C.654-.26.656-.273.648-.284L.14-.486a.122.122 0 0 1-.024-.011.12.12 0 0 1-.027-.016.088.088 0 0 1-.022-.021.04.04 0 0 1-.008-.023c0-.03.011-.058.033-.084a.335.335 0 0 1 .087-.067.7.7 0 0 1 .117-.053 1.437 1.437 0 0 1 .236-.06C.565-.826.59-.83.606-.831a.1.1 0 0 1 .066.003.05.05 0 0 1 .022.018c.005.007.005.016.001.027-.004.01-.014.018-.032.026a.407.407 0 0 1-.065.022c-.026.006-.054.013-.086.019l-.095.019a1.07 1.07 0 0 0-.171.047.15.15 0 0 0-.052.033C.183-.604.178-.59.182-.573l.071.024c.032.01.067.023.107.037l.122.046a2.025 2.025 0 0 1 .211.095.168.168 0 0 1 .05.038.1.1 0 0 1 .018.068.127.127 0 0 1-.028.063.294.294 0 0 1-.063.057.778.778 0 0 1-.184.091 1.374 1.374 0 0 1-.182.05.305.305 0 0 1-.062.005.272.272 0 0 1-.082-.008.491.491 0 0 1-.051-.015.394.394 0 0 1-.046-.023.16.16 0 0 1-.033-.03.053.053 0 0 1-.011-.036Z" transform="rotate(-19.307 39.439 -4.13) scale(7.46666)"/>
		<path d="M.02-.028a.31.31 0 0 0 .007-.054C.028-.107.03-.138.03-.174l.002-.118.001-.132A5.639 5.639 0 0 1 .04-.673a.908.908 0 0 1 .009-.09.135.135 0 0 1 .017-.05.028.028 0 0 1 .015-.017.131.131 0 0 1 .051-.011h.017l-.001.07-.002.094-.002.095-.002.075c.035-.018.069-.039.103-.062A1.9 1.9 0 0 0 .343-.64l.089-.071c.028-.024.055-.044.08-.063a.525.525 0 0 1 .07-.044.123.123 0 0 1 .056-.017.03.03 0 0 1 .022.01.031.031 0 0 1 .009.022c0 .017-.013.038-.039.061a.912.912 0 0 1-.098.076 3.52 3.52 0 0 1-.127.084L.278-.5c-.039.026-.071.05-.097.072-.026.022-.039.039-.039.053a.582.582 0 0 0 .072.036 13.488 13.488 0 0 1 .245.112c.045.022.086.043.124.065a.569.569 0 0 1 .091.063c.024.021.036.04.035.058 0 .006-.002.012-.005.015a.028.028 0 0 1-.011.008.033.033 0 0 1-.013.004l-.011.001a.314.314 0 0 1-.083-.039A2.347 2.347 0 0 0 .32-.196a1.211 1.211 0 0 0-.188-.068v.244c-.002.004-.01.007-.023.011a.175.175 0 0 1-.041.008.113.113 0 0 1-.038-.003C.019-.008.016-.016.02-.028Z" fill="currentColor" transform="rotate(-19.307 36.52 -21.28) scale(7.46666)"/>
		<path d="M256 .75c2.88 0 5.25 2.37 5.25 5.25s-2.37 5.25-5.25 5.25-5.25-2.37-5.25-5.25S253.12.75 256 .75ZM256 12c3.292 0 6-2.708 6-6s-2.708-6-6-6-6 2.708-6 6 2.708 6 6 6Z" style="fill-rule:nonzero;opacity:0.7" fill="currentColor" transform="translate(-306.674 .617) scale(1.22866)"/>
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
