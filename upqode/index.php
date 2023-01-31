<?php

/**
 * Index Page
 *
 * @package upqode
 * @since 1.0
 *
 */

get_header();

have_posts() ? get_template_part('template-parts/theme', 'blog') : get_template_part('template-parts/theme', 'none');

get_footer();
