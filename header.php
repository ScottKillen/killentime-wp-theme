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
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<style>.logo{height: 3.75rem}.site-title {display: none}.main-navigation{margin-top:auto}</style>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site container">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'scottkillen' ); ?></a>

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
					'add_link_class' => 'nav-link'
				)
			); ?>
		</nav><!-- #site-navigation -->
	</header>
