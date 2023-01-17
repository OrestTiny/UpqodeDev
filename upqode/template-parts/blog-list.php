<?php
//BLOG LIST
$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$term  = get_query_var( 's' );

$args = array(
	'post_type' => 'post',
	'paged'     => $paged,
);

if ( is_search() ) {
	$args['s'] = $term;
}

$posts = new WP_Query( $args );

$active_plugin   = function_exists( 'aheto' ) ? true : false;

$content_size_class = is_active_sidebar( 'upqode-sidebar' ) ? 'col-12 col-lg-8' : 'col-12';
$post_size_class    = is_active_sidebar( 'upqode-sidebar' ) ? 6 : 4;

$count = isset( $posts->found_posts ) && ! empty( $posts->found_posts ) ? $posts->found_posts : '0';
$count_text = $count == '1' ? esc_html__( 'result found', 'upqode' ) : esc_html__( 'results found', 'upqode' );

$upqode_blog_title_text        = is_search() ? esc_html__( 'Showing results for ', 'upqode' ) . '"' . esc_html( $term ) . '"' : esc_html__( 'Blog', 'upqode' ); ?>

<div class="upqode-blog--wrapper">

    <div class="container upqode-blog--top-wrap">
        <div class="row">
            <div class="col-12">
                <h1 class="upqode-blog--top-title"><?php echo esc_html($upqode_blog_title_text); ?></h1>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="upqode-blog--posts <?php echo esc_attr( $content_size_class ); ?>">

                <div class="upqode-blog--isotope row">
					<?php while ( $posts->have_posts() ) :
						$posts->the_post();

						$post_id   = get_the_ID();
						$no_image  = ! has_post_thumbnail() ? ' no-image' : '';
						$image_id  = get_post_thumbnail_id( $post_id );
						$author_id = get_the_author_meta( 'ID' ); ?>

                        <div <?php post_class( 'upqode-blog--post col-12 col-sm-6 col-md-' . $post_size_class ); ?>>
                            <div class="upqode-blog--post-wrap">
								<?php if ( ! empty( $image_id ) ) {
									$image     = wp_get_attachment_image_url( $image_id, 'large' );
									$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>
                                    <div class="upqode-blog--post__media">
                                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
                                    </div>
								<?php } ?>

                                <div class="upqode-blog--post__info-wrap">
                                    <div class="upqode-blog--post-header">
                                        <div class="upqode-blog--post__categories">
                                            <b><?php the_category( ' ' ); ?></b>
                                        </div>

                                        <div class="upqode-blog--post__time">
                                           <span>
                                               <b>
                                                   <i class="ion-clock"></i>
                                                   <?php echo upqode_reading_time( $post_id ); ?>
                                               </b>
                                           </span>
                                        </div>
                                    </div>

									<?php if(!empty(get_the_title())){ ?>
                                        <div class="upqode-blog--post__title-wrap">
                                            <h3>
                                                <a href="<?php the_permalink(); ?>"
                                                   class="upqode-blog--post__title"><?php the_title(); ?></a>
                                            </h3>
                                        </div>
									<?php } ?>

                                    <div class="upqode-blog--post__author">
                                        <div class="upqode-blog--post__author-info">
                                            <?php echo get_avatar( $author_id, 30 ); ?>
                                            <div class="upqode-blog--post__author-name">
                                                <b><?php echo esc_html( get_the_author() ); ?></b>
                                            </div>
                                        </div>

                                        <a href="<?php the_permalink(); ?>">
											<?php echo sprintf( esc_html__( '%s ago', 'upqode' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
                                        </a>
                                    </div>
                                    <div class="upqode-blog--post__text"><?php the_excerpt(); ?></div>

                                    <div class="upqode-blog--post__footer">
                                        <div class="upqode-blog--post__link">
                                            <a href="<?php the_permalink(); ?>"
                                               class="aheto-link aheto-btn--dark aheto-btn--no-underline"><?php esc_html_e( 'Continue Reading', 'upqode' ); ?></a>
                                        </div>
                                        <div class="upqode-blog--post__comments">
                                            <b>
                                                <i class="ion-ios-chatbubble-outline"></i>
                                                <?php echo get_comments_number( $post_id ); ?>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

					<?php endwhile;
					wp_reset_postdata(); ?>

                </div>
				<?php if ( $posts->max_num_pages > 1 ) { ?>
                    <div class="upqode-blog--pagination">
						<?php echo paginate_links(
							array(
								'prev_text' => __( 'Previous', 'upqode' ),
								'next_text' => __( 'Next', 'upqode' ),
								'total'     => $posts->max_num_pages
							)
						); ?>
                    </div>
				<?php } ?>
            </div>

			<?php if ( is_active_sidebar( 'upqode-sidebar' ) ) {

				get_sidebar( 'upqode-sidebar' );

			} ?>
        </div>
    </div>
</div>