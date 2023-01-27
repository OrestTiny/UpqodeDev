<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Upqode
 */

add_action('tgmpa_register', 'upqode_include_required_plugins');
add_action('widgets_init', 'upqode_widgets_init');
add_action('after_setup_theme', 'upqode_content_width', 0);
add_action('wp_enqueue_scripts', 'upqode_enqueue_scripts');
add_action('enqueue_block_editor_assets', 'upqode_add_gutenberg_assets');
add_action('upqode_search', 'upqode_search_popup', 10);

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function upqode_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'upqode-page';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('upqode-enable-sidebar')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter('body_class', 'upqode_body_classes');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function upqode_content_width()
{
	$GLOBALS['content_width'] = apply_filters('upqode_content_width', 1200);
}


/**
 * Register widget area.
 */
function upqode_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'upqode'),
		'id'            => 'upqode-sidebar',
		'description'   => esc_html__('Add widgets here.', 'upqode'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
}


/**
 * Enqueue scripts and styles.
 */
function upqode_enqueue_scripts()
{

	// general settings
	if ((is_admin())) {
		return;
	}

	if (is_page() || is_home()) {
		$post_id = get_queried_object_id();
	} else {
		$post_id = get_the_ID();
	}

	wp_enqueue_style('upqode-general', UPQODE_T_URI . '/assets/css/general.min.css');

	if (is_404()) {
		wp_enqueue_style('upqode-error-page', UPQODE_T_URI . '/assets/css/error-page.min.css');
	}

	if (is_archive() || is_author() || is_category() || is_home() || is_tag() || is_search()) {
		wp_enqueue_style('upqode-blog-list', UPQODE_T_URI . '/assets/css/blog/blog-list.min.css');
	}

	if (is_single() || !(is_archive() || is_author() || is_category() || is_home() || is_tag())) {
		wp_enqueue_style('upqode-blog-single', UPQODE_T_URI . '/assets/css/blog/blog-single.min.css');
	}

	if (is_active_sidebar('upqode-sidebar')) {
		wp_enqueue_style('upqode-sidebar', UPQODE_T_URI . '/assets/css/blog/sidebar.min.css');
	}

	wp_enqueue_style('upqode-main-style', UPQODE_T_URI . '/assets/css/style.min.css');
	wp_enqueue_style('upqode-style', UPQODE_T_URI . '/style.css');

	// add TinyMCE style
	add_editor_style();

	// including jQuery plugins
	wp_localize_script(
		'upqode-script',
		'get',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'siteurl' => get_template_directory_uri(),
		)
	);

	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('upqode-skip-link-focus-fix', UPQODE_T_URI . '/assets/js/lib/skip-link-focus-fix.js', array(), '', true);
	wp_enqueue_script('upqode-script', UPQODE_T_URI . '/assets/js/script.min.js', array('jquery'), '', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
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
add_filter('the_password_form', 'upqode_password_form');


/**
 * Check need minimal requirements (PHP and WordPress version)
 */
if (version_compare($GLOBALS['wp_version'], '4.3', '<') || version_compare(PHP_VERSION, '5.3', '<')) {
	if (!function_exists('upqode_requirements_notice')) {
		function upqode_requirements_notice()
		{
			$message = sprintf(esc_html__('Upqode theme needs minimal WordPress version 4.3 and PHP 5.6<br>You are running version WordPress - %s, PHP - %s.<br>Please upgrade need module and try again.', 'upqode'), $GLOBALS['wp_version'], PHP_VERSION);
			printf('<div class="notice-warning notice"><p><strong>%s</strong></p></div>', $message);
		}
	}
	add_action('admin_notices', 'upqode_requirements_notice');
}
