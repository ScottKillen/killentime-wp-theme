<?php

/**
 * Adds custom classes to the array of body classes.
 */
function semantic_body_classes($classes = array())
{
  $classes[] = 'multi-column';

  // Adds a class of single-author to blogs with only 1 published author
  if (!is_multi_author()) {
    $classes[] = 'single-author';
  }

  if (!is_singular() && !is_404()) {
    $classes[] = 'hfeed';
    $classes[] = 'h-feed';
    $classes[] = 'feed';
  }

  return $classes;
}
add_filter('body_class', 'semantic_body_classes');

/**
 * Adds custom classes to the array of post classes.
 */
function semantic_post_classes($classes = array())
{
  $classes = array_diff($classes, array('hentry'));

  if (!get_the_title()) {
    $classes[] = 'no-title';
  }

  if (!is_singular()) {
    return get_semantic_post_classes($classes);
  } else {
    return $classes;
  }
}
add_filter('post_class', 'semantic_post_classes', 99);

/**
 * Adds custom classes to the array of comment classes.
 */
function sempantic_comment_classes($classes = array())
{
  $classes[] = 'h-entry';
  $classes[] = 'h-cite';
  $classes[] = 'p-comment';
  $classes[] = 'comment';

  return array_unique($classes);
}
add_filter('comment_class', 'sempantic_comment_classes', 99);

function get_semantic_post_classes($classes = array())
{
  if (!$classes) {
    $classes = array();
  }
  // Adds a class for microformats v2
  $classes[] = 'h-entry';

  // add hentry to the same tag as h-entry
  $classes[] = 'hentry';

  return array_unique($classes);
}
/**
 * Adds microformats v2 support to the comment_author_link.
 */
function semantic_author_link_class($link)
{
  // Adds a class for microformats v2
  return preg_replace('/(class\s*=\s*[\"|\'])/i', '${1}u-url ', $link);
}
add_filter('get_comment_author_link', 'semantic_author_link_class');

/**
 * Adds microformats v2 support to the get_avatar() method.
 */
function semantic_pre_get_avatar_data($args, $id_or_email)
{
  if (!isset($args['class'])) {
    $args['class'] = array();
  }

  // Adds a class for microformats v2
  $args['class'] = array_unique(array_merge($args['class'], array('u-photo')));
  $args['extra_attr'] = 'itemprop="image"';

  return $args;
}
add_filter('pre_get_avatar_data', 'semantic_pre_get_avatar_data', 99, 2);

/**
 * add rel-prev attribute to previous_image_link
 */
function semantic_previous_image_link($link)
{
  return preg_replace('/<a/i', '<a rel="prev"', $link);
}
add_filter('previous_image_link', 'semantic_previous_image_link');

/**
 * add rel-next attribute to next_image_link
 */
function sempress_semantic_next_image_link($link)
{
  return preg_replace('/<a/i', '<a rel="next"', $link);
}
add_filter('next_image_link', 'sempress_semantic_next_image_link');

/**
 * add rel-prev attribute to next_posts_link_attributes
 */
function semantic_next_posts_link_attributes($attr)
{
  return $attr . ' rel="prev"';
}
add_filter('next_posts_link_attributes', 'semantic_next_posts_link_attributes');

/**
 * add rel-next attribute to previous_posts_link
 */
function semantic_previous_posts_link_attributes($attr)
{
  return $attr . ' rel="next"';
}
add_filter('previous_posts_link_attributes', 'semantic_previous_posts_link_attributes');

/**
 * add semantics
 */
function get_semantics($id = null)
{
  $atts = array();

  // add default values
  switch ($id) {
    case 'body':
      if (!is_singular()) {
        $atts['itemscope'] = array('');
        $atts['itemtype'] = array('http://schema.org/Blog', 'http://schema.org/WebPage');
      } elseif (is_single()) {
        $atts['itemscope'] = array('');
        $atts['itemtype'] = array('http://schema.org/BlogPosting');
      } elseif (is_page()) {
        $atts['itemscope'] = array('');
        $atts['itemtype'] = array('http://schema.org/WebPage');
      }
      break;
    case 'site-title':
      if (!is_singular()) {
        $atts['itemprop'] = array('name');
        $atts['class'] = array('p-name');
      }
      break;
    case 'site-description':
      if (!is_singular()) {
        $atts['itemprop'] = array('description');
        $atts['class'] = array('p-summary', 'e-content');
      }
      break;
    case 'site-url':
      if (!is_singular()) {
        $atts['itemprop'] = array('url');
        $atts['class'] = array('u-url', 'url');
      }
      break;
    case 'post':
      if (!is_singular()) {
        $atts['itemprop'] = array('blogPost');
        $atts['itemscope'] = array('');
        $atts['itemtype'] = array('http://schema.org/BlogPosting');
      }
      break;
  }

  $atts = apply_filters('get_semantics', $atts, $id);
  $atts = apply_filters("get_semantics_{$id}", $atts, $id);

  return $atts;
}

/**
 * echos the semantic classes added via
 * the "get_semantics" filters
 */
function semantics($id)
{
  $atts = get_semantics($id);

  if (!$atts) {
    return;
  }

  foreach ($atts as $key => $value) {
    echo ' ' . esc_attr($key) . '="' . esc_attr(join(' ', $value)) . '"';
  }
}

/**
 * Add `p-category` to tags links
 */
function semantic_term_links_tag($links)
{
  $new_links = array();
  foreach ($links as $link) {
    $p = new WP_HTML_Tag_Processor($link);
    if ($p->next_tag('a')) {
      $p->add_class('p-category');
    }
    $new_links[] = WP_HTML_Tag_Processor->get_updated_html();
  }

  return $new_links;
}
add_filter('term_links-post_tag', 'semantic_term_links_tag');

function semantic_main_class($class = '')
{
  // Separates class names with a single space, collates class names for body element
  echo ' class="' . join(' ', get_semantic_main_class($class)) . '"';
}

function get_semantic_main_class($class = '')
{
  $classes = array();

  if (is_singular()) {
    $classes = get_semantic_post_classes($classes);
  }

  if (!empty($class)) {
    if (!is_array($class)) {
      $class = preg_split('#\s+#', $class);
    }
    $classes = array_merge($classes, $class);
  } else {
    // Ensure that we always coerce class to being an array.
    $class = array();
  }

  $classes = array_map('esc_attr', $classes);

  /**
   * Filters the list of CSS main class names for the current post or page.
   */
  $classes = apply_filters('semantic_main_class', $classes, $class);

  return array_unique($classes);
}
