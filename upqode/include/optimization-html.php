<?php


remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);


/* WP_HTML_Compression */
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
