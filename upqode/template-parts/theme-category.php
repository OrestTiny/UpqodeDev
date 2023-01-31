<?php
//BLOG LIST CATEGORY

global $wp_query;


$upqode_blog_title_text        =  is_archive() || is_category() ? '' : get_the_title(); ?>

<section class="upqode-category">

    <?php if (!empty($upqode_blog_title_text)) { ?>
        <div class="upqode-blog--top-wrap">
            <h1 class="upqode-blog--top-title"><?php echo esc_html($upqode_blog_title_text); ?></h1>
        </div>
    <?php } ?>

    <?php get_template_part('template-parts/theme', 'blog'); ?>
    <?php get_template_part('template-parts/content/sidebar'); ?>
</section>