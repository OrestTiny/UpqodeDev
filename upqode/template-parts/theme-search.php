<?php

/**
 *  Search Pages
 */

$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
$term  = get_query_var('s');

$args = array(
  'post_type' => 'post',
  'paged'     => $paged,
);

if (is_search()) {
  $args['s'] = $term;
}

$posts = new WP_Query($args);

$count = isset($posts->found_posts) && !empty($posts->found_posts) ? $posts->found_posts : '0';
$count_text = $count == '1' ? esc_html__('result found', 'upqode') : esc_html__('results found', 'upqode');

$upqode_blog_title_text        =  esc_html__('Showing results for ', 'upqode') . '"' . esc_html($term) . '"';

?>

<section class="upqode-search">
  <div class="upqode-search__heading">
    <div class="container">
      <h1><?php echo esc_html($upqode_blog_title_text); ?></h1>
      <p><?php echo $count_text . ' ' . $count  ?></p>
    </div>
  </div>

  <div class="upqode-search__main">
    <div class="container">
      <div class="upqode-search__main-wrap">
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