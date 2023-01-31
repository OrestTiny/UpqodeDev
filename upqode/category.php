<?php

/**
 * Category Template
 */

get_header();

have_posts() ? get_template_part('template-parts/blog', 'category') : get_template_part('template-parts/theme', 'none');

get_footer();
