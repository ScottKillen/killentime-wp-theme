<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Scott_Killen
 */

if (!is_active_sidebar(2)) {
	return;
}
?>

<aside id="secondary" class="widget-area col-md-4">
	<div class="position-sticky" style="top: 5rem;">
		<?php dynamic_sidebar(2); ?>
	</div>
</aside><!-- #secondary -->
