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
    get_search_form();
    the_content();

endwhile;

get_footer();
