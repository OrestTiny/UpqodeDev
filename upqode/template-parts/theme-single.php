<?php
/*
 * Single post
 */

$get_id    = get_the_ID();
$author_id = get_the_author_meta('ID');


?>

<section class="upqode-single">
    <?php if (has_post_thumbnail()) { ?>
        <div class="container">
            <div class="upqode-single__banner">
                <?php $image_url = get_the_post_thumbnail_url($get_id, 'full');
                $image_id        = get_post_thumbnail_id($get_id);
                $image_alt       = get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>

                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
            </div>
        </div>
    <?php } ?>

    <div class="container">
        <div class="upqode-single">
            <div class="upqode-single__categories">
                <?php the_category(' '); ?>
            </div>

            <?php the_title('<h1 class="upqode-single__title">', '</h1>'); ?>

            <div class="upqode-single__footer">

                <div class="upqode-single__author-info">
                    <?php esc_html_e('by ', 'upqode'); ?>
                    <b><?php echo esc_html(get_the_author()); ?></b>
                </div>

                <div class="upqode-single__date">
                    <b><?php echo sprintf(esc_html__('%s ago', 'upqode'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?></b>
                </div>

                <div class="upqode-single__com">
                    <b><i class="ion-ios-chatbubble-outline"></i>
                        <?php echo get_comments_number($get_id); ?>
                    </b>
                </div>
            </div>


            <div class="upqode-single__content-wrapper">
                <div class="upqode-single__content-inner">
                    <?php the_content(); ?>
                </div>
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
    </div>