<?php


if (!function_exists('upqode_reading_time')) {
	function upqode_reading_time($post_id)
	{
		$content = get_post_field('post_content', $post_id);

		$word_count       = str_word_count(strip_tags($content));
		$readingtime      = ceil($word_count / 200);
		$totalreadingtime = $readingtime . ' min';

		$countKey = 'post_reading_count';
		$count    = get_post_meta($post_id, $countKey, true);
		if ($count == '') {
			delete_post_meta($post_id, $countKey);
			add_post_meta($post_id, $countKey, $totalreadingtime);
		} else {
			update_post_meta($post_id, $countKey, $totalreadingtime);
		}

		return $totalreadingtime;
	}
}




// Blog post Sharing
if (!function_exists('upqode_sharing_icon_links')) {

	function upqode_sharing_icon_links()
	{

		global $post;

		$html = '<ul>';

		// facebook
		$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink();
		$html .= '<li><a href="' . esc_url($facebook_url) . '" target="_blank"></a></li>';

		// twitter
		$twitter_url = 'https://twitter.com/share?' . esc_url(get_permalink()) . '&amp;text=' . get_the_title();
		$html .= '<li><a href="' . esc_url($twitter_url) . '" target="_blank"></a></li>';

		// linkedin
		$linkedin_url = 'http://www.linkedin.com/shareArticle?url=' . esc_url(get_permalink()) . '&amp;title=' . get_the_title();
		$html .= '<li><a href="' . esc_url($linkedin_url) . '" target="_blank"></a></li>';

		// pinterest
		$pinterest_url = 'https://pinterest.com/pin/create/bookmarklet/?url=' . esc_url(get_permalink()) . '&amp;description=' . get_the_title() . '&amp;media=' . esc_url(wp_get_attachment_url(get_post_thumbnail_id($post->ID)));
		$html .= '<li><a href="' . esc_url($pinterest_url) . '" target="_blank"></a></li>';

		// tumblr
		$tumblr_url = 'http://www.tumblr.com/share/link?url=' . urlencode(esc_url(get_permalink())) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt());
		$html .= '<li><a href="' . esc_url($tumblr_url) . '" target="_blank"></a></li>';

		// reddit
		$reddit_url = 'http://reddit.com/submit?url=' . esc_url(get_permalink()) . '&amp;title=' . get_the_title();
		$html .= '<li><a href="' . esc_url($reddit_url) . '" target="_blank"></a></li>';

		$html .= '</ul>';

		echo wp_kses_post($html);
	}
}
