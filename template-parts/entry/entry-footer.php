<footer class="entry-meta">
  <?php
  $tags_list = get_the_tag_list('', ', ');
  if ($tags_list) :
  ?>
    <div class="shadow rounded bg-secondary-subtle border p-3 mt-5">
      <span class="tag-links" itemprop="keywords">
        <?php printf('Tagged %1$s', $tags_list); ?>
      </span>
    </div>
  <?php endif; // End if $tags_list
  ?>

  <?php if (comments_open() || ('0' != get_comments_number() && !comments_open())) : ?>
    <span class="sep"> | </span>
    <span class="comments-link"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></span>
  <?php endif; ?>

  <?php edit_post_link('Edit', '<span class="sep"> | </span><span class="edit-link">', '</span>'); ?>
</footer><!-- #entry-meta -->
