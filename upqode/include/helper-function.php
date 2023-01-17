<?php

require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Create custom html structure for comments
 */
if ( !function_exists('upqode_comment') ) {
	function upqode_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ):
			case 'pingback':
			case 'trackback': ?>
                <div class="pinback">
                <span class="pin-title"><?php esc_html_e('Pingback: ', 'upqode'); ?></span><?php comment_author_link(); ?>
				<?php edit_comment_link(esc_html__('(Edit)', 'upqode'), '<span class="edit-link">', '</span>'); ?>

				<?php
				break;
			default:
				// generate comments
				?>
            <div <?php comment_class('upqode-blog--single__comments-item'); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="upqode-blog--single__comments-item-wrap">
                    <div class="upqode-blog--single__comments-content">
                        <span class="person-img">
							<?php echo get_avatar($comment, '80', '', '', array('class' => 'img-person')); ?>
                        </span>
                        <div class="comment-content">
                            <div class="author-wrap">
                                <div class="author">
									<?php comment_author(); ?>
                                </div>
								<?php comment_reply_link(
									array_merge($args,
										array(
											'reply_text' => esc_html__('Reply', 'upqode'),
											'after'      => '',
											'depth'      => $depth,
											'max_depth'  => $args['max_depth']
										)
									)
								); ?>
                            </div>
                            <div class="comment-date">
								<?php comment_date(get_option('date_format')); ?>
                            </div>

                            <div class="comment-text">
								<?php comment_text(); ?>
                            </div>

                        </div>
                    </div>
                </div>
				<?php
				break;
		endswitch;
	}
}


/**
 * Filter for excerpt more string
 */

if ( !function_exists('upqode_excerpt_more') ) {
	function upqode_excerpt_more() {
		return ' ...';
	}

	add_filter('excerpt_more', 'upqode_excerpt_more');
}