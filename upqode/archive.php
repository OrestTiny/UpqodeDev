<?php

/**
 * Archive Template
 */

get_header();

if (have_posts()) :
    get_template_part('template-parts/theme', 'category');
else : ?>

    <div class="upqode-blog--wrapper upqode-blog--search-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="upqode-blog--search-page__title"><?php esc_html_e('Sorry, no posts matched your criteria.', 'upqode'); ?></h3>
                    <div class="upqode-blog--search-page__search-form">
                        <?php get_search_form(true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;

get_footer();
