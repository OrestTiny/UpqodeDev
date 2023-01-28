<div class="upqode-single__pagination">
  <?php $prev_post = get_previous_post();
  if (!empty($prev_post)) : ?>
    <div class="upqode-single__pagination-prev">
      <?php $prev_thumbnail_id = get_post_thumbnail_id($prev_post->ID);
      $prev_post_title         = !empty(get_the_title($prev_post)) ? get_the_title($prev_post) : esc_html__('No title', 'upqode');
      $prev_link               = get_permalink($prev_post); ?>

      <span>
        <span class="upqode-single__pagination-subtitle"><?php esc_html_e('Prev post', 'upqode'); ?></span>
        <h4>
          <a href="<?php echo esc_url($prev_link); ?>" class="content">
            <?php echo wp_kses($prev_post_title, 'post'); ?>
          </a>
        </h4>
      </span>

      <?php if (!empty($prev_thumbnail_id)) { ?>
        <a href="<?php echo esc_url($prev_link); ?>" class="img-wrap">
          <?php echo wp_get_attachment_image($prev_thumbnail_id, 'upqode-post-large'); ?>
        </a>
      <?php } ?>
    </div>
  <?php endif;

  $next_post = get_next_post(); ?>

  <?php if (!empty($next_post)) : ?>
    <div class="upqode-single__pagination-next">
      <?php $next_thumbnail_id = get_post_thumbnail_id($next_post->ID);
      $next_post_title         = !empty(get_the_title($next_post)) ? get_the_title($next_post) : esc_html__('No title', 'upqode');
      $next_link               = get_permalink($next_post); ?>

      <?php if (!empty($next_thumbnail_id)) { ?>
        <a href="<?php echo esc_url($next_link); ?>" class="img-wrap">
          <?php echo wp_get_attachment_image($next_thumbnail_id, 'upqode-post-large'); ?>
        </a>
      <?php } ?>

      <span>
        <span class="upqode-single__pagination-subtitle"><?php esc_html_e('Next post', 'upqode'); ?></span>
        <h4>
          <a href="<?php echo esc_url($next_link); ?>" class="content">
            <?php echo wp_kses($next_post_title, 'post'); ?>
          </a>
        </h4>
      </span>
    </div>
  <?php endif; ?>

</div>