<?php

require_once ABSPATH . 'wp-admin/includes/plugin.php';

add_action('upqode_search', 'upqode_search_popup', 10);
add_filter('the_password_form', 'upqode_password_form');

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



// inline style

// function stylesheet_inline(){
// $style = file_get_contents(UPQODE_T_URI . '/assets/css/style.min.css');
// echo  '<style>' . $style . '</style>';
// }

// add_action( 'wp_head', 'stylesheet_inline', 10);





/**
 * Search popup
 */

if (!function_exists('upqode_search_popup')) {
	function upqode_search_popup()
	{ ?>
				<div class="upqode-header--search" id="search-box-<?php echo esc_attr(rand()); ?>">
					<div class="upqode-header--search__form-container">
						<form role="search" method="get" class="upqode-header--search__form" action="<?php echo esc_url(home_url('/')); ?>">
							<div class="input-group">
								<input type="search" value="<?php echo get_search_query() ?>" name="s" class="search-field" placeholder="<?php esc_attr_e('Search..', 'upqode'); ?>" required>
								<button><i class="ion-ios-search-strong open-search"></i></button>
							</div>
						</form>
					</div>
				</div>
		<?php }
}



/**
 * Password form
 */
if (!function_exists('upqode_password_form')) {
	function upqode_password_form($post_id)
	{
		$form = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post" class="form">
					<h3>' . esc_html__('Enter password below:', 'upqode') . '</h3>
  				  	<input placeholder="' . esc_attr__("Password:", 'upqode') . '" name="post_password" type="password" size="20" maxlength="20" />
  				  	<input type="submit" name="' . esc_attr__('Submit', 'upqode') . '" value="' . esc_attr__('Enter', 'upqode') . '" />
				  </form>';

		return $form;
	}
}
