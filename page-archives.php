<?php

get_header();
?>
<main id="primary" <?php semantic_main_class('site-main') ?>>
  <?php the_post(); ?>

  <h1 class="entry-title"><?php the_title(); ?></h1>

  <div class="py-2 mb-3">
    <?php get_search_form(); ?>
  </div>

  <div class="row">

    <div class="col-md-6">
      <h2>Archives by Month:</h2>
      <ul>
        <?php wp_get_archives('type=monthly'); ?>
      </ul>
    </div>
    <div class="col-md-6">
      <h2>Archives by Subject:</h2>
      <p class="h3 fst-italic widget-title">Categories</p>
      <?php wp_list_categories(array('title_li' => '')); ?>

      <p class="pt-3 h3 fst-italic widget-title">Tags</p>
      <?php wp_tag_cloud(); ?>
    </div>
  </div><!-- .row -->

</main><!-- #main -->

<?php
get_footer();
