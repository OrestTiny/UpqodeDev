<?php if ($posts->max_num_pages > 1) { ?>
  <div class="upqode-blog--pagination">
    <?php echo paginate_links(
      array(
        'prev_text' => __('Previous', 'upqode'),
        'next_text' => __('Next', 'upqode'),
        'total'     => $posts->max_num_pages
      )
    ); ?>
  </div>
<?php } ?>