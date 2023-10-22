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
	<link rel="profile" href="http://microformats.org/profile/specs" />
	<link rel="profile" href="http://microformats.org/profile/hatom" />
	<link rel="icon" href="/favicon.ico" sizes="any"><!-- 32×32 -->
	<link rel="icon" href="/icon.svg" type="image/svg+xml">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png"><!-- 180×180 -->
	<link rel="manifest" href="/site.webmanifest">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?><?php semantics('body'); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site container">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'killentime'); ?></a>

		<?php get_template_part('template-parts/header/site', 'header'); ?>
