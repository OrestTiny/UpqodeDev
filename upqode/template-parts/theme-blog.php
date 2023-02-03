<?php

/**
 * Blog Page
 */

$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;

$args = array(
    'post_type' => 'post',
    'paged'     => $paged,
);

$posts = new WP_Query($args);

?>

<section class="upqode-blog">
    <div class="upqode-blog__heading">
        <div class="container">
            <h1><?php echo esc_html__('Blog', 'upqode'); ?></h1>
        </div>
    </div>

    <div class="upqode-blog__main">
        <div class="container">
            <div class="upqode-blog__main-wrap">
                <?php while ($posts->have_posts()) : $posts->the_post();

                    get_template_part('template-parts/content/post', 'card');

                endwhile;
                wp_reset_postdata(); ?>

            </div>

            <?php if (paginate_links()) {
                upqode_blog_pagination();
            } ?>
        </div>
    </div>
</section>