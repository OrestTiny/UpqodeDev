<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package upqode
 */

get_header();

$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
$term  = get_query_var('s');

$args = array(
    'post_type' => array('post'),
    'paged'     => $paged,
);

if (is_search()) {
    $args['s'] = $term;
}

$posts = new WP_Query($args);

$posts->have_posts() ? get_template_part('template-parts/theme', 'search') : get_template_part('template-parts/theme', 'none');

get_footer();
