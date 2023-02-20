<?php

/**
 *  Categories, Tags Pages
 */

?>

<section class="upqode-blog">
    <div class="upqode-blog__heading">
        <div class="container">
            <h1><?php echo esc_html(single_cat_title()); ?></h1>
        </div>
    </div>

    <div class="upqode-blog__main">
        <div class="container">
            <div class="upqode-blog__main-wrap">
                <?php while (have_posts()) : the_post();

                    upqode_post_card();

                endwhile;
                wp_reset_postdata(); ?>
            </div>
            <?php upqode_custom_pagination(); ?>
        </div>
    </div>
</section>