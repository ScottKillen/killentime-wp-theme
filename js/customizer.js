/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery(document).ready(function ($) {
  'use strict';

  if (wp && wp.customize) {
    wp.customize('blogname', function (value) {
      value.bind(function (to) {
        $('.site-title a').text(to);
      });
    });

    wp.customize('blogdescription', function (value) {
      value.bind(function (to) {
        $('.site-description').text(to);
      });
    });
  }
});
