<?php

/**
 * Comment API: Walker_Comment class
 *
 * @package WordPress
 * @subpackage Comments
 * @since 4.4.0
 */

/**
 * Core walker class used to create an HTML list of comments.
 *
 * @since 2.7.0
 *
 * @see Walker
 */
class KT_Walker_Comment extends Walker_Comment
{

	/**
	 * Traverses elements to create list from elements.
	 *
	 * This function is designed to enhance Walker::display_element() to
	 * display children of higher nesting levels than selected inline on
	 * the highest depth level displayed. This prevents them being orphaned
	 * at the end of the comment list.
	 *
	 * Example: max_depth = 2, with 5 levels of nested content.
	 *     1
	 *      1.1
	 *        1.1.1
	 *        1.1.1.1
	 *        1.1.1.1.1
	 *        1.1.2
	 *        1.1.2.1
	 *     2
	 *      2.2
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::display_element()
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $element           Comment data object.
	 * @param array      $children_elements List of elements to continue traversing. Passed by reference.
	 * @param int        $max_depth         Max depth to traverse.
	 * @param int        $depth             Depth of the current element.
	 * @param array      $args              An array of arguments.
	 * @param string     $output            Used to append additional content. Passed by reference.
	 */
	public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
	{
		if (!$element) {
			return;
		}

		$id_field = $this->db_fields['id'];
		$id = $element->$id_field;

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

		/*
		 * If at the max depth, and the current element still has children, loop over those
		 * and display them at this level. This is to prevent them being orphaned to the end
		 * of the list.
		 */
		if ($max_depth <= $depth + 1 && isset($children_elements[$id])) {
			foreach ($children_elements[$id] as $child) {
				$this->display_element($child, $children_elements, $max_depth, $depth, $args, $output);
			}

			unset($children_elements[$id]);
		}
	}

	/**
	 * Starts the element output.
	 *
	 * @since 2.7.0
	 * @since 5.9.0 Renamed `$comment` to `$data_object` and `$id` to `$current_object_id`
	 *              to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::start_el()
	 * @see wp_list_comments()
	 * @global int        $comment_depth
	 * @global WP_Comment $comment       Global comment object.
	 *
	 * @param string     $output            Used to append additional content. Passed by reference.
	 * @param WP_Comment $data_object       Comment data object.
	 * @param int        $depth             Optional. Depth of the current comment in reference to parents. Default 0.
	 * @param array      $args              Optional. An array of arguments. Default empty array.
	 * @param int        $current_object_id Optional. ID of the current comment. Default 0.
	 */
	public function start_el(&$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0)
	{
		// Restores the more descriptive, specific name for use within this method.
		$comment = $data_object;

		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;

		$output .= '<div class="d-flex flex-start mt-4">';
		if (!empty($args['callback'])) {
			ob_start();
			call_user_func($args['callback'], $comment, $args, $depth);
			$output .= ob_get_clean();
			return;
		}

		if ('comment' === $comment->comment_type) {
			add_filter('comment_text', array($this, 'filter_comment_text'), 40, 2);
		}

		if (('pingback' === $comment->comment_type || 'trackback' === $comment->comment_type) && $args['short_ping']) {
			ob_start();
			$this->ping($comment, $depth, $args);
			$output .= ob_get_clean();
		} elseif ('html5' === $args['format']) {
			ob_start();
			$this->html5_comment($comment, $depth, $args);
			$output .= ob_get_clean();
		} else {
			ob_start();
			$this->comment($comment, $depth, $args);
			$output .= ob_get_clean();
		}

		if ('comment' === $comment->comment_type) {
			remove_filter('comment_text', array($this, 'filter_comment_text'), 40);
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.7.0
	 * @since 5.9.0 Renamed `$comment` to `$data_object` to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::end_el()
	 * @see wp_list_comments()
	 *
	 * @param string     $output      Used to append additional content. Passed by reference.
	 * @param WP_Comment $data_object Comment data object.
	 * @param int        $depth       Optional. Depth of the current comment. Default 0.
	 * @param array      $args        Optional. An array of arguments. Default empty array.
	 */
	public function end_el(&$output, $data_object, $depth = 0, $args = array())
	{
		$output .= "</div></div></div><!--end_el--><!-- #comment-## -->\n";
	}

	/**
	 * Outputs a pingback comment.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment The comment object.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function ping($comment, $depth, $args)
	{
?>
		<div id="comment-<?php comment_ID(); ?>" <?php comment_class('', $comment); ?>><!--ping-->
			<div class="comment-body">
				<?php _e('Pingback:'); ?> <?php comment_author_link($comment); ?> <?php edit_comment_link(__('Edit'), '<span class="edit-link">', '</span>'); ?>
			</div>
		<?php
	}

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment($comment, $depth, $args)
	{
		$commenter = wp_get_current_commenter();
		$show_pending_links = !empty($commenter['comment_author']);

		if ($commenter['comment_author_email']) {
			$moderation_note = __('Your comment is awaiting moderation.');
		} else {
			$moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
		}
		$comment_classes = array('d-flex', 'flex-start');
		if ($this->has_children) {
			@$comment_classes[] = 'parent';
		}
		?>
			<div id="comment-<?php comment_ID(); ?>" <?php comment_class($comment_classes, $comment); ?>>
				<?php
						$avatar_img = str_replace("class='avatar", "class='rounded-circle border border-primary-subtle shadow-strong me-3 avatar", get_avatar($comment, $args['avatar_size']));
				echo $avatar_img; ?>
				<div class="flex-grow-1 flex-shrink-1">
					<div class="d-flex justify-content-between align-items-center">
						<p class="mb-1">
							<?php
							$comment_author = get_comment_author_link($comment);

							if ('0' == $comment->comment_approved && !$show_pending_links) {
								$comment_author = get_comment_author($comment);
							}
							echo $comment_author . ' ';
							?>
							<span class=small">
								<?php
								printf(
									'<a href="%s" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><time datetime="%s">%s</time></a>',
									esc_url(get_comment_link($comment, $args)),
									get_comment_time('c'),
									sprintf(
										/* translators: 1: Comment date, 2: Comment time. */
										__('%1$s at %2$s'),
										get_comment_date('', $comment),
										get_comment_time()
									)
								);
								?>
							</span><?php edit_comment_link(__('Edit'), ' <span class="edit-link">', '</span>'); ?>
						</p>
						<?php
						if ('1' == $comment->comment_approved || $show_pending_links) {
							comment_reply_link(
								array_merge(
									$args,
									array(
										'add_below' => 'div-comment',
										'depth' => $depth,
										'max_depth' => $args['max_depth'],
										'before' => '<div class="reply">',
										'after' => '</div>',
									)
								)
							);
						}
						?>
					</div>
					<?php if ('0' == $comment->comment_approved) : ?>
						<p class="comment-awaiting-moderation text-info"><?php echo $moderation_note; ?></p>
			<?php endif;
					comment_text();
				}
			}
