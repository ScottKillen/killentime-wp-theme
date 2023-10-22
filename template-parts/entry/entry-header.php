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
    ?>
    <<?php echo $title_level; ?> class="entry-title p-name<?php echo $title_class; ?>" itemprop="name headline"><a href="<?php the_permalink(); ?>" class="u-url url link-body-emphasis text-decoration-none" title="<?php printf(esc_attr__('Permalink to %s', 'sempress'), the_title_attribute('echo=0')); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></<?php echo $title_level; ?>>
    <?php if ('post' === get_post_type()) : ?>
      <div class="entry-meta container text-center">
        <div class="border-start row row-cols-auto blog-post-meta text-secondary font-accent">
          <?php
          killentime_posted_on();
          killentime_reading_time();
          killentime_posted_in(); ?>
        </div>
      </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->
<?php endif; ?>
<?php do_action('sempress_before_entry_content'); ?>
