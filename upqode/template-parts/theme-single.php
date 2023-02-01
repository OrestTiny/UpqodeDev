<?php
/*
 * Single post
 */

$get_id    = get_the_ID();
$author_id = get_the_author_meta('ID');

?>

<section class="upqode-single">
    <div class="container">
        <div class="upqode-single__wrap">

            <?php the_title('<h1 class="upqode-single__title">', '</h1>'); ?>

            <?php if (has_post_thumbnail()) { ?>
                <div class="upqode-single__banner">
                    <?php echo upqode_get_image_post(); ?>
                </div>
            <?php } ?>

            <div class="upqode-single__categories">
                <?php the_category(' '); ?>
            </div>

            <div class="upqode-single__author">
                <?php esc_html_e('by ', 'upqode'); ?>
                <b><?php echo esc_html(get_the_author()); ?></b>
            </div>

            <div class="upqode-single__date">
                <b><?php echo sprintf(esc_html__('%s ago', 'upqode'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?></b>
            </div>

            <div class="upqode-single__com">
                <?php echo get_comments_number($get_id); ?>
            </div>

            <div class="upqode-single__content">
                <?php the_content(); ?>
            </div>

            <?php

            wp_link_pages('link_before=<span class="upqode-single__pages">&link_after=</span>&before=<div class="upqode-single__post-nav"> <span>' . esc_html__("Page:", 'upqode') . ' </span> &after=</div>');

            the_tags(
                '<div class="upqode-single__tags">',
                ' ',
                '</div>'
            ); ?>
        </div>
    </div>
</section>