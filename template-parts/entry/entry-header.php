<?php if (get_the_title()) : ?>
  <header class="entry-header">
    <?php
    if (is_singular()) {
      $title_level = 'h1';
      $title_class = '';
    } else {
      $title_level = 'h2';
      $title_class = ' display-5 mb-1';
    }

    if (isset($args['components'])) {
      if (is_array($args['components'])) {
        $components = $args['components'];
      } else {
        $components[] = $args['components'];
      }
    } else {
      $components = array();
    }
    ?>
    <<?php echo $title_level; ?> class="entry-title p-name<?php echo $title_class; ?>" itemprop="name headline"><a href="<?php the_permalink(); ?>" class="u-url url link-body-emphasis text-decoration-none" title="<?php printf(esc_attr__('Permalink to %s', 'sempress'), the_title_attribute('echo=0')); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></<?php echo $title_level; ?>>
    <?php if ('post' === get_post_type() && !empty($components)) : ?>
      <div class="entry-meta container text-center">
        <div class="border-start row row-cols-auto blog-post-meta text-secondary font-accent">
          <?php
          foreach ($components as $component) {
            switch ($component) {
              case 'post_date':
                kt_the_post_date(
                  '<div class="col border-end" title="Published"><svg class="bi me-2"><use xlink:href="#fa-calendar" /></svg>',
                  '</div>'
                );
                break;
              case 'post_read_time':
                kt_the_post_read_time(
                  '<div class="col border-end" title="Reading time"><svg class="bi me-2"><use xlink:href="#fa-book-open-reader" /></svg>',
                  '</div>'
                );
                break;
              case 'post_category':
                kt_the_categories(
                  '<div class="col border-end" title="Categories"><svg class="bi me-2"><use xlink:href="#fa-folder-tree" /></svg>',
                  '</div>'
                );
                break;
            }
          }
          ?>
        </div>
      </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->
<?php endif; ?>
<?php do_action('sempress_before_entry_content'); ?>
