  <div class="upqode-blog">

      <div class="upqode-blog__posts">
          <?php while ($posts->have_posts()) :
                $posts->the_post();

                $post_id   = get_the_ID();
                $image_id  = get_post_thumbnail_id($post_id);
                $author_id = get_the_author_meta('ID'); ?>


              <div class="upqode-blog--post-wrap">
                  <?php if (!empty($image_id)) {
                        $image     = wp_get_attachment_image_url($image_id, 'large');
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); ?>
                      <div class="upqode-blog--post__media">
                          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                      </div>
                  <?php } ?>

                  <div class="upqode-blog--post__info-wrap">
                      <div class="upqode-blog--post-header">
                          <div class="upqode-blog--post__categories">
                              <b><?php the_category(' '); ?></b>
                          </div>

                          <div class="upqode-blog--post__time">
                              <span>
                                  <b>
                                      <i class="ion-clock"></i>
                                      <?php echo upqode_reading_time($post_id); ?>
                                  </b>
                              </span>
                          </div>
                      </div>

                      <?php if (!empty(get_the_title())) { ?>
                          <div class="upqode-blog--post__title-wrap">
                              <h3>
                                  <a href="<?php the_permalink(); ?>" class="upqode-blog--post__title"><?php the_title(); ?></a>
                              </h3>
                          </div>
                      <?php } ?>

                      <div class="upqode-blog--post__author">
                          <div class="upqode-blog--post__author-info">
                              <?php echo get_avatar($author_id, 30); ?>
                              <div class="upqode-blog--post__author-name">
                                  <b><?php echo esc_html(get_the_author()); ?></b>
                              </div>
                          </div>

                          <a href="<?php the_permalink(); ?>">
                              <?php echo sprintf(esc_html__('%s ago', 'upqode'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?>
                          </a>
                      </div>
                      <div class="upqode-blog--post__text"><?php the_excerpt(); ?></div>

                      <div class="upqode-blog--post__footer">
                          <div class="upqode-blog--post__link">
                              <a href="<?php the_permalink(); ?>" class="aheto-link aheto-btn--dark aheto-btn--no-underline"><?php esc_html_e('Continue Reading', 'upqode'); ?></a>
                          </div>
                          <div class="upqode-blog--post__comments">
                              <b>
                                  <i class="ion-ios-chatbubble-outline"></i>
                                  <?php echo get_comments_number($post_id); ?>
                              </b>
                          </div>
                      </div>
                  </div>
              </div>


          <?php endwhile;
            wp_reset_postdata(); ?>

      </div>
      <?php get_template_part('template-parts/content/pagination'); ?>
  </div>