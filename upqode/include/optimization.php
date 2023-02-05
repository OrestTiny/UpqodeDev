<?php

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Disable SVG
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);


function HTML_Compression($str)
{
	$str = preg_replace('/<!--.*?-->/', '', $str);
	$str = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $str);
	$str = str_replace(' />', '/>', $str);
	$str = preg_replace("((<pre.*?>|<code>).*?(</pre>|</code>)(*SKIP)(*FAIL)" . "|\r|\n|\t)is", "", $str);
	$str = preg_replace("((<pre.*?>|<code>).*?(</pre>|</code>)(*SKIP)(*FAIL)" . "|\s+)is", " ", $str);
	$str = preg_replace("/>\s+</m", "><", $str);
	return $str;
}
function HTML_Compression_finish($html)
{
	return
		HTML_Compression($html);
}
add_action('get_header', function () {
	if (!is_user_logged_in()) :
		ob_start('HTML_Compression_finish');
	endif;
});



//Disable gutenberg style in Front
function wps_deregister_styles()
{
	wp_dequeue_style('classic-theme-styles-css'); // Wordpress core
	wp_dequeue_style('global-styles');

	if (!is_single() || !is_singular('post')) {
		wp_dequeue_style('wp-block-library-theme'); // Wordpress core
		wp_dequeue_style('wp-block-library'); // Wordpress core
		wp_dequeue_style('wc-blocks-style');
		wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
	}

	// wp_dequeue_style('wc-block-style'); // WooCommerce
}
add_action('wp_print_styles', 'wps_deregister_styles', 100);



function wps_deregister_script()
{
	wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'wps_deregister_script', 20);


/**
 * WordPress automatically loads the file wp-emoji-release.min.js on the front-end of your 
 * WordPress website to help loading emojis that are part of the blogging feature of WordPress.
 * This can slow your WordPress Website. 
 * So it is a good idea to disable wp_emojicons in  your WordPress website installation.
 */

if (!function_exists('disable_emojis')) {
	function disable_emojis()
	{
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	}
	add_action('init', 'disable_emojis');
}
