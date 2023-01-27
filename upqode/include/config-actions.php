<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Upqode
 */


add_action('widgets_init', 'upqode_widgets_init');
add_action('wp_enqueue_scripts', 'upqode_enqueue_scripts'); // add_action('enqueue_block_editor_assets', 'upqode_add_gutenberg_assets');
add_action('after_setup_theme', 'upqode_register_nav_menu', 0);


/**
 * Register nav menu.
 */

if (!function_exists('upqode_register_nav_menu')) {

	function upqode_register_nav_menu()
	{
		register_nav_menus(array(
			'primary-menu' => __('Primary Menu', 'upqode'),
			'footer-menu'  => __('Footer Menu', 'upqode'),
		));
	}
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

	// wp_enqueue_script('upqode-skip-link-focus-fix', UPQODE_T_URI . '/assets/js/lib/skip-link-focus-fix.js', array(), '', true);
	wp_enqueue_script('upqode-script', UPQODE_T_URI . '/assets/js/script.min.js', array('jquery'), '', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
