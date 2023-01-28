<?php if (comments_open() || '0' != get_comments_number() && wp_count_comments($get_id)) { ?>


  <div class="upqode-blog--single__comments-button-wrap">
    <div class="upqode-blog--single__comments-button"><?php esc_html_e('Read Comments', 'upqode'); ?></div>
  </div>

  <div class="upqode-blog--single__comments">
    <?php comments_template('', true); ?>
  </div>
<?php } ?>