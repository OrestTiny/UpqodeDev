<?php
$author_id = get_the_author_meta('ID');
$post_id   = get_the_ID();


?>

<div class="upqode-post-card">
  <?php if (!empty(get_the_title())) { ?>
    <div class="upqode-post-card__title">
      <h3>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h3>
    </div>
  <?php } ?>

  <div class="upqode-post-card__text"><?php the_excerpt(); ?></div>

  <div class="upqode-post-card__media">
    <?php echo upqode_get_image_post(); ?>
  </div>

  <div class="upqode-post-card__categories">
    <?php the_category(' '); ?>
  </div>

  <div class="upqode-post-card__time">
    <?php echo upqode_reading_time(); ?>
  </div>

  <div class="upqode-post-card__author">
    <?php echo get_avatar($author_id, 30); ?>
    <div class="upqode-post-card__author-name">
      <b><?php echo esc_html(get_the_author()); ?></b>
    </div>
  </div>

  <a href="<?php the_permalink(); ?>">
    <?php echo sprintf(esc_html__('%s ago', 'upqode'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?>
  </a>

  <a href="<?php the_permalink(); ?>" class="aheto-link aheto-btn--dark aheto-btn--no-underline"><?php esc_html_e('Continue Reading', 'upqode'); ?></a>
</div>