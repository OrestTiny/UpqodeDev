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
