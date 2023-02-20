<?php

// Reading Time Post
if (!function_exists('upqode_reading_time')) {
	function upqode_reading_time()
	{
		$post_id   = get_the_ID();
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
		$html .= '<li><a href="' . esc_url($facebook_url) . '" target="_blank">facebook</a></li>';

		// twitter
		$twitter_url = 'https://twitter.com/share?' . esc_url(get_permalink()) . '&amp;text=' . get_the_title();
		$html .= '<li><a href="' . esc_url($twitter_url) . '" target="_blank">twitter</a></li>';

		// linkedin
		$linkedin_url = 'http://www.linkedin.com/shareArticle?url=' . esc_url(get_permalink()) . '&amp;title=' . get_the_title();
		$html .= '<li><a href="' . esc_url($linkedin_url) . '" target="_blank">linkedin</a></li>';

		// pinterest
		$pinterest_url = 'https://pinterest.com/pin/create/bookmarklet/?url=' . esc_url(get_permalink()) . '&amp;description=' . get_the_title() . '&amp;media=' . esc_url(wp_get_attachment_url(get_post_thumbnail_id($post->ID)));
		$html .= '<li><a href="' . esc_url($pinterest_url) . '" target="_blank">pinterest</a></li>';

		// tumblr
		$tumblr_url = 'http://www.tumblr.com/share/link?url=' . urlencode(esc_url(get_permalink())) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt());
		$html .= '<li><a href="' . esc_url($tumblr_url) . '" target="_blank">tumblr</a></li>';

		// reddit
		$reddit_url = 'http://reddit.com/submit?url=' . esc_url(get_permalink()) . '&amp;title=' . get_the_title();
		$html .= '<li><a href="' . esc_url($reddit_url) . '" target="_blank">reddit</a></li>';

		$html .= '</ul>';

		echo wp_kses_post($html);
	}
}

/**
 *  Post Image
 */
if (!function_exists('upqode_get_image_post')) {
	function upqode_get_image_post($class = '', $size = 'full')
	{
		$post_id   = get_the_ID();
		$image_id  = get_post_thumbnail_id($post_id);
		$class_line =  $class ? 'class="' . $class . '"' : '';

		if ($image_id) {
			$image     = wp_get_attachment_image_url($image_id, $size);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

			$image_html = '<img ' . $class_line . ' src="' . esc_url($image) . '" alt="' . esc_attr($image_alt) . '">';

			echo $image_html;
		}
	}
}

/**
 * Blog Pagination 
 */
if (!function_exists('upqode_custom_pagination')) {
	function upqode_custom_pagination($query = null)
	{
		global $wp_query;
		$query = $query ? $query : $wp_query;
		$total_pages = $query->max_num_pages;

		if ($total_pages > 1) {
			$current_page = max(1, get_query_var('paged'));
			$paginate_links = paginate_links(array(
				'base' => add_query_arg('paged', '%#%'),
				'format' => 'page/%#%',
				'current' => $current_page,
				'total' => $total_pages,
				'prev_text' => __('« Prev'),
				'next_text' => __('Next »'),
			));

			if ($paginate_links) {
				echo '<div class="upqode-pagination">';
				echo $paginate_links;
				echo '</div>';
			}
		}
	}
}



/**
 * Print the next and previous posts navigation.
 */
if (!function_exists('upqode_the_posts_navigation')) {
	function upqode_the_posts_navigation()
	{
		$prev_post = get_previous_post();
		$next_post = get_next_post();

		if (!empty($prev_post)) {
			$prev_thumbnail_id = get_post_thumbnail_id($prev_post->ID);
			$prev_post_title         = !empty(get_the_title($prev_post)) ? get_the_title($prev_post) : esc_html__('No title', 'upqode');
			$prev_link               = get_permalink($prev_post);
		}

		if (!empty($next_post)) {
			$next_thumbnail_id       = get_post_thumbnail_id($next_post->ID);
			$next_post_title         = !empty(get_the_title($next_post)) ? get_the_title($next_post) : esc_html__('No title', 'upqode');
			$next_link               = get_permalink($next_post);
		}

		echo '<div>';
		if (!empty($prev_post)) : ?>
			<div class="upqode-single__pagination-prev">
				<a href="<?php echo esc_url($prev_link); ?>">
					<?php echo wp_kses($prev_post_title, 'post'); ?>
				</a>

				<a href="<?php echo esc_url($prev_link); ?>">
					<span><?php esc_html_e('Prev', 'upqode'); ?></span>
				</a>

				<?php if (!empty($prev_thumbnail_id)) { ?>
					<a href="<?php echo esc_url($prev_link); ?>">
						<?php echo wp_get_attachment_image($prev_thumbnail_id, 'medium'); ?>
					</a>
				<?php } ?>
			</div>
		<?php endif;


		if (!empty($next_post)) : ?>
			<div class="upqode-single__pagination-next">
				<a href="<?php echo esc_url($next_link); ?>">
					<?php echo wp_kses($next_post_title, 'post'); ?>
				</a>

				<a href="<?php echo esc_url($next_link); ?>">
					<span><?php esc_html_e('Next', 'upqode'); ?></span>
				</a>

				<?php if (!empty($next_thumbnail_id)) { ?>
					<a href="<?php echo esc_url($next_link); ?>">
						<?php echo wp_get_attachment_image($next_thumbnail_id, 'medium'); ?>
					</a>
				<?php } ?>
			</div>
		<?php endif;

		echo '</div>';
	}
}


/**
 * Prints HTML with meta information about theme author.
 */
if (!function_exists('upqode_posted_by_author')) {
	function upqode_posted_by_author()
	{
		if (!get_the_author_meta('description') && post_type_supports(get_post_type(), 'author')) {
			printf(
				esc_html__('By %s', 'upqode'),
				'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" rel="author">' . esc_html(get_the_author()) . '</a>'
			);
		}
	}
}


/**
 * Prints HTML with meta information for the current post-date/time.
 */
if (!function_exists('upqode_posted_on')) {
	function upqode_posted_on()
	{
		$time_string = '<time datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date())
		);

		printf(
			esc_html__('Published %s', 'upqode'),
			$time_string
		);
	}
}



if (!function_exists('upqode_comments')) {
	function upqode_comments()
	{
		if (comments_open() || '0' != get_comments_number() && wp_count_comments(get_the_ID())) { ?>
			<div class="upqode-single__comments">
				<?php comments_template('', true); ?>
			</div>
		<?php }
	}
}


if (!function_exists('upqode_post_card')) {
	function upqode_post_card()
	{
		$author_id = get_the_author_meta('ID');
		$post_id   = get_the_ID();
		?>

		<div class="upqode-post-card">
			<?php if (!empty(get_the_title())) { ?>
				<div class="upqode-post-card__title">
					<h3>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				</div>
			<?php } ?>

			<div class="upqode-post-card__text"><?php the_excerpt(); ?></div>

			<?php if (has_post_thumbnail()) { ?>
				<div class="upqode-post-card__media">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php } ?>

			<div class="upqode-post-card__categories">
				<?php the_category(' '); ?>
			</div>

			<div class="upqode-post-card__time">
				<?php echo upqode_reading_time(); ?>
			</div>

			<div class="upqode-post-card__author">
				<?php echo get_avatar($author_id, 30); ?>
				<div class="upqode-post-card__author-name">
					<b><?php echo esc_html(get_the_author()); ?></b>
				</div>
			</div>

			<a href="<?php the_permalink(); ?>">
				<?php echo sprintf(esc_html__('%s ago', 'upqode'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?>
			</a>

			<a href="<?php the_permalink(); ?>" class="aheto-link aheto-btn--dark aheto-btn--no-underline"><?php esc_html_e('Continue Reading', 'upqode'); ?></a>
		</div>

<?php
	}
}
