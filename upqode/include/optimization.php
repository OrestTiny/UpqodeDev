<?php

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
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
	wp_dequeue_style('wp-block-library'); // Wordpress core
	wp_dequeue_style('wp-block-library-theme'); // Wordpress core
	wp_dequeue_style('wc-block-style'); // WooCommerce
	wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
}
add_action('wp_print_styles', 'wps_deregister_styles', 100);



function wps_deregister_script()
{
	wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'wps_deregister_script', 20);
