<?php

/**
 * Category Template
 */

get_header();

if (have_posts()) :
    get_template_part('template-parts/blog', 'category');
else : ?>
    <div class="upqode-blog__empty">
        <div class="container">
            <h3><?php esc_html_e('Sorry, no posts matched your criteria.', 'upqode'); ?></h3>
        </div>
    </div>
<?php endif;

get_footer();
