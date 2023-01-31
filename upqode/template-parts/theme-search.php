<?php
//BLOG LIST
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

$upqode_blog_title_text  = is_search() ? esc_html__('Showing results for ', 'upqode') . '"' . esc_html($term) . '"' : esc_html__('Blog', 'upqode'); ?>

<section class="upqode-blog">

  <div class="upqode-blog__heading">
    <h1><?php echo esc_html($upqode_blog_title_text); ?></h1>
  </div>

  <?php get_template_part('template-parts/theme', 'blog'); ?>

</section>