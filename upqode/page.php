<?php

/**
 * Template used for pages.
 *
 * @package Upqode
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}


get_header();

while (have_posts()) : the_post();

    the_content();
    get_search_form();

endwhile;

get_footer();
