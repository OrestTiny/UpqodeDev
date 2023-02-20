<?php

/**
 * Single post
 */

get_header();

while (have_posts()) :
	the_post();

	get_template_part('template-parts/theme', 'single');

endwhile;

wp_reset_postdata();

get_footer();
