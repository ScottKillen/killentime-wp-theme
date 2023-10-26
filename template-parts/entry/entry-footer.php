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

  if (!empty($components)) : ?>
    <div class="row row-cols-auto blog-post-meta text-secondary font-accent">
      <?php
      foreach ($components as $component) {
        switch ($component) {
          case 'post_date':
            kt_the_post_date(
              '<div class="col border-end" title="Published"><svg class="bi me-2"><use xlink:href="#fa-calendar" /></svg>',
              '</div>'
            );
            break;
          case 'post_date_no_link':
            kt_the_post_date(
              '<div class="col border-end" title="Published"><svg class="bi me-2"><use xlink:href="#fa-calendar" /></svg>',
              '</div>',
              false
            );
            break;
          case 'post_tag':
            kt_the_tags(
              '<div class="col border-end" title="Tags"><svg class="bi me-2"><use xlink:href="#fa-tags" /></svg>',
              '</div>'
            );
            break;
          case 'comment_link':
            kt_comments_popup_link(
              '<div class="col border-end"><span class="comments-link">',
              '</span></div>'
            );
            break;
          case 'edit_link':
            edit_post_link(
              'Edit',
              '<div class="col border-end"><span class="edit-link">',
              '</span></div>'
            );
            break;
        }
      }
      ?>


    </div><!-- .entry-meta -->
  <?php endif; ?>
</footer><!-- #entry-meta -->
