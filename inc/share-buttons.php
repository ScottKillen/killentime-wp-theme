<?php
defined('ABSPATH') || exit;

function the_share_buttons()
{
  if (!is_single() && !is_page()) {
    return;
  }

  $classes = "btn btn-secondary";
  $title = get_the_title();
  $url = wp_get_shortlink();
  $terms = get_the_terms('', 'post_tag');
  if (!is_wp_error($terms)) {
    $tags = wp_list_pluck($terms, 'name');
  } else {
    $tags = array();
  }
?>
  <div class="mb-5 mt-3">
    <p class="h6 font-accent">Share this:</p>
    <?php the_mastodon_share_button($classes, $title, $url, $tags); ?>
    <?php the_email_share_button($classes, $title, $url, $tags); ?>
    <a title="Click to print" href="javascript:window.print();" class="<?php echo $classes; ?>"><svg class="bi">
        <use xlink:href="#fa-print" />
      </svg> Print</a>
  </div>
<?php
}

function the_mastodon_share_button($classes, $title, $url, $tags)
{
  $url = 'https://tootpick.org/#text=' . $title . ' — ' . urlencode($url);
  if (count($tags))
    $url .= ' #' . implode(' #', $tags);
  $href = 'href="' . esc_url($url) . '"';
?>
  <a title="Click to share on Mastodon" target="_blank" rel="noopener" class="<?php echo $classes; ?>" <?php echo $href; ?>>
    <svg class="bi">
      <use xlink:href="#fa-mastodon" />
    </svg> Mastodon
  </a>
<?php
}

function the_email_share_button($classes, $title, $url, $tags)
{
  $url = 'mailto:?subject=I thought you might like this&body=' . $title . ' — ' . urlencode($url);
  $href = 'href="' . esc_url($url) . '"';
?>
  <a title="Click to email a link to a friend" target="_blank" rel="noopener" class="<?php echo $classes; ?>" <?php echo $href; ?>>
    <svg class="bi">
      <use xlink:href="#fa-envelope" />
    </svg> Email
  </a>
<?php
}
