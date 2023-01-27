<?php

/**
 * Upqode functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Upqode
 */

defined('UPQODE_T_URI') or define('UPQODE_T_URI', get_template_directory_uri());
defined('UPQODE_T_PATH') or define('UPQODE_T_PATH', get_template_directory());

require_once ABSPATH . 'wp-admin/includes/plugin.php';

require_once UPQODE_T_PATH . '/include/config-actions.php';
require_once UPQODE_T_PATH . '/include/customizer.php';

require_once UPQODE_T_PATH . '/include/function-helper.php';
require_once UPQODE_T_PATH . '/include/function-action.php';
require_once UPQODE_T_PATH . '/include/optimization-html.php';

if (!function_exists('upqode_setup')) :

	function upqode_setup()
	{

		add_theme_support('customize-selective-refresh-widgets');
		add_theme_support('automatic-feed-links');
		// add_theme_support('title-tag');
		// add_theme_support('post-thumbnails');
		// add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
		// add_theme_support('post-formats', array(
		// 	'aside',
		// 	'gallery',
		// 	'link',
		// 	'image',
		// 	'quote',
		// 	'status',
		// 	'video',
		// 	'audio',
		// 	'chat'
		// ));

		// Set up the WordPress core custom background feature.
		// add_theme_support('custom-background', apply_filters('upqode_custom_background_args', array(
		// 	'default-color' => 'ffffff',
		// 	'default-image' => '',
		// )));

		// Add theme support for selective refresh for widgets.


		// add_theme_support('custom-logo', array(
		// 	'height'      => 250,
		// 	'width'       => 250,
		// 	'flex-width'  => true,
		// 	'flex-height' => true,
		// ));
	}
endif;

add_action('after_setup_theme', 'upqode_setup');







// Disable REST API link tag
