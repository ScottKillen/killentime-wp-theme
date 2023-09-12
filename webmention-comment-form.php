<?php

/**
 * Hook to add custom content before the Webmention form added to the comment form.
 */
do_action('webmention_comment_form_template_before');
?>
<form id="webmention-form" action="<?php echo get_webmention_endpoint(); ?>" method="post" class="pt-3 mt-4 border-top row g-3">
	<div class="col-12">
		<label for="webmention-source" class="form-label"><?php echo get_webmention_form_text(get_the_ID()); ?></label>
	</div>
	<div class="form-submit col-12 input-group">
		<span class="input-group-text rounded-start"><?php esc_attr_e('URL/Permalink of your article:', 'webmention'); ?></span>
		<input id="webmention-source" class="form-control" type="url" autocomplete="url" name="source">
	</div>
	<div class="form-submit mx-3 col-12">
		<button class="submit btn btn-secondary" name="Submit" type="submit" id="webmention-submit"><?php esc_attr_e('Ping me!', 'webmention'); ?></button>
		<input id="webmention-format" type="hidden" name="format" value="html" />
		<input id="webmention-target" type="hidden" name="target" value="<?php the_permalink(); ?>" />
	</div>
</form>
<?php
/**
 * Hook to add custom content after the Webmention form added to the comment form.
 */
do_action('webmention_comment_form_template_after');
?>
