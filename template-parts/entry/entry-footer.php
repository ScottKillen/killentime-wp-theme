<footer class="entry-meta">
  <?php
  if (isset($args['components'])) {
    if (is_array($args['components'])) {
      $components = $args['components'];
    } else {
      $components[] = $args['components'];
    }
  } else {
    $components = array();
  }

  $border_start = !isset($args['border-none']) ? 'border_start ' : '';

  if (!empty($components)) : ?>
    <div class="entry-meta container-fluid text-center">
      <div class="<?php echo $border_start; ?>row row-cols-auto blog-post-meta text-secondary font-accent">
        <?php
        foreach ($components as $component) {
          switch ($component) {
            case 'post_date':
              $padding = !isset($args['border-none']) ? 'ps-0 ' : '';
              kt_the_post_date(
                '<div class="' . $padding . 'col border-end" title="Published"><svg class="bi me-2"><use xlink:href="#fa-calendar" /></svg>',
                '</div>'
              );
              break;
            case 'post_tag':
              kt_the_tags(
                '<div class="col border-end" title="Tags"><svg class="bi me-2"><use xlink:href="#fa-tags" /></svg>',
                '</div>'
              );
              break;
          }
        }
        ?>
        <?php if (comments_open() || ('0' != get_comments_number() && !comments_open())) : ?>
          <div class="col border-end">
            <span class="comments-link"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></span>
          </div>
        <?php endif;

        edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
      </div>
    </div><!-- .entry-meta -->
  <?php endif; ?>
</footer><!-- #entry-meta -->
