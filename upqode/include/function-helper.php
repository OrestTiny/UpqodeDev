<?php

require_once ABSPATH . 'wp-admin/includes/plugin.php';

add_action('upqode_search', 'upqode_search_popup', 10);
add_filter('the_password_form', 'upqode_password_form');
add_action('after_setup_theme', 'upqode_setup');


if (!function_exists('upqode_setup')) :

	function upqode_setup()
	{
		add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
		add_theme_support('post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
		));


		load_theme_textdomain('upqode', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		*  Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support('title-tag');

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Add support for responsive embeds.
		add_theme_support('responsive-embeds');

		// Enqueue editor styles.
		// add_editor_style(array('assets/css/gutenberg.min.css'));

		/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1200, 750, true);
	}
endif;




/**
 * Create custom html structure for comments
 */
if (!function_exists('upqode_comment')) {
	function upqode_comment($comment, $args, $depth)
	{

		$GLOBALS['comment'] = $comment;

		switch ($comment->comment_type):
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
					<div <?php comment_class('upqode-single__comments-item'); ?> id="li-comment-<?php comment_ID(); ?>">
						<div id="comment-<?php comment_ID(); ?>" class="upqode-single__comments-item-wrap">
							<div class="upqode-single__comments-content">
								<span class="person-img">
									<?php echo get_avatar($comment, '80', '', '', array('class' => 'img-person')); ?>
								</span>
								<div class="comment-content">
									<div class="author-wrap">
										<div class="author">
											<?php comment_author(); ?>
										</div>
										<?php comment_reply_link(
											array_merge(
												$args,
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

if (!function_exists('upqode_excerpt_more')) {
	function upqode_excerpt_more()
	{
		return ' ...';
	}

	add_filter('excerpt_more', 'upqode_excerpt_more');
}



if (!function_exists('upqode_mime_types')) {
	function upqode_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	add_filter('upload_mimes', 'upqode_mime_types');
}



if (!function_exists('upqode_add_rel_preload')) {
	function upqode_add_rel_preload($html, $handle, $href, $media)
	{

		if (is_admin()) {
			return $html;
		}
		$html = <<<EOT
		<link rel="preload stylesheet preconnect" as="style" id="$handle" href="$href" type="text/css" media="$media" crossorigin />
		EOT;
		return $html;
	}
}

/**
 * Check need minimal requirements (PHP and WordPress version)
 */
if (version_compare($GLOBALS['wp_version'], '4.3', '<') || version_compare(PHP_VERSION, '5.3', '<')) {
	if (!function_exists('upqode_requirements_notice')) {
		function upqode_requirements_notice()
		{
			$message = sprintf(esc_html__('upqode theme needs minimal WordPress version 4.3 and PHP 5.6<br>You are running version WordPress - %s, PHP - %s.<br>Please upgrade need module and try again.', 'upqode'), $GLOBALS['wp_version'], PHP_VERSION);
			printf('<div class="notice-warning notice"><p><strong>%s</strong></p></div>', $message);
		}
	}
	add_action('admin_notices', 'upqode_requirements_notice');
}


/**
 * Search page content
 */
// function upqode_search_filter($query)
// {
// 	if ($query->is_search && !is_admin()) {
// 		$query->set('post_type', array('post', 'page'));
// 	}
// 	return $query;
// }
// add_filter('pre_get_posts', 'upqode_search_filter');
