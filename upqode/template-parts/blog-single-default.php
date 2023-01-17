<?php
/*
 * Single post
 */

$protected = post_password_required() ? 'protected-page' : '';
$get_id    = get_the_ID();
$author_id = get_the_author_meta( 'ID' );
$category_pos = has_post_thumbnail() ? 'to-top' : '';

?>

<div class="upqode-blog--single-wrapper <?php echo esc_attr( $protected ); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="upqode-blog--single__banner">
						<?php $image_url = get_the_post_thumbnail_url( $get_id, 'full' );
						$image_id        = get_post_thumbnail_id( $get_id );
						$image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>

                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
                    </div>
                </div>
            </div>
        </div>
	<?php } ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="upqode-blog--single__post-content">
                    <div class="upqode-blog--single__categories <?php echo esc_attr( $category_pos ); ?>">
                        <?php the_category( ' ' ); ?>
                    </div>

					<?php the_title( '<h1 class="upqode-blog--single__title">', '</h1>' ); ?>

                    <div class="upqode-blog--single__footer">

                        <div class="upqode-blog--single__author-info">
                            <?php esc_html_e( 'by ', 'upqode' ); ?>
                            <b><?php echo esc_html( get_the_author() ); ?></b>
                        </div>

                        <div class="upqode-blog--single__date">
                            <b><?php echo sprintf( esc_html__( '%s ago', 'upqode' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></b>
                        </div>

                        <div class="upqode-blog--single__com">
                            <b><i class="ion-ios-chatbubble-outline"></i>
                                <?php echo get_comments_number( $get_id ); ?>
                            </b>
                        </div>
                    </div>

                    <div class="upqode-blog--single__content-wrapper">
                        <div class="upqode-blog--single__content-inner">
	                        <?php the_content(); ?>
                        </div>
                    </div>

					<?php

					wp_link_pages( 'link_before=<span class="upqode-blog--single__pages">&link_after=</span>&before=<div class="upqode-blog--single__post-nav"> <span>' . esc_html__( "Page:", 'upqode' ) . ' </span> &after=</div>' );

					the_tags(
						'<div class="upqode-blog--single__tags">',
						' ',
						'</div>' ); ?>
                </div>

                <div class="upqode-blog--single__pagination">

					<?php $prev_post = get_previous_post();
					if ( ! empty( $prev_post ) ) : ?>
                        <div class="upqode-blog--single__pagination-prev">
							<?php $prev_thumbnail_id = get_post_thumbnail_id( $prev_post->ID );
							$prev_post_title         = ! empty( get_the_title( $prev_post ) ) ? get_the_title( $prev_post ) : esc_html__( 'No title', 'upqode' );
							$prev_link               = get_permalink( $prev_post ); ?>

                            <span>
                                <span class="upqode-blog--single__pagination-subtitle"><?php esc_html_e( 'Prev post', 'upqode' ); ?></span>
                                <h4>
                                    <a href="<?php echo esc_url( $prev_link ); ?>" class="content">
                                        <?php echo wp_kses( $prev_post_title, 'post' ); ?>
                                    </a>
                                </h4>
                            </span>

							<?php if ( ! empty( $prev_thumbnail_id ) ) { ?>
                                <a href="<?php echo esc_url( $prev_link ); ?>" class="img-wrap">
									<?php echo wp_get_attachment_image( $prev_thumbnail_id, 'upqode-post-large' ); ?>
                                </a>
							<?php } ?>
                        </div>
					<?php endif;

					$next_post = get_next_post(); ?>

					<?php if ( ! empty( $next_post ) ) : ?>
                        <div class="upqode-blog--single__pagination-next">
							<?php $next_thumbnail_id = get_post_thumbnail_id( $next_post->ID );
							$next_post_title         = ! empty( get_the_title( $next_post ) ) ? get_the_title( $next_post ) : esc_html__( 'No title', 'upqode' );
							$next_link               = get_permalink( $next_post ); ?>

							<?php if ( ! empty( $next_thumbnail_id ) ) { ?>
                                <a href="<?php echo esc_url( $next_link ); ?>" class="img-wrap">
									<?php echo wp_get_attachment_image( $next_thumbnail_id, 'upqode-post-large' ); ?>
                                </a>
							<?php } ?>

                            <span>
                                <span class="upqode-blog--single__pagination-subtitle"><?php esc_html_e( 'Next post', 'upqode' ); ?></span>
                                <h4>
                                    <a href="<?php echo esc_url( $next_link ); ?>" class="content">
                                        <?php echo wp_kses( $next_post_title, 'post' ); ?>
                                    </a>
                                </h4>
                            </span>
                        </div>
					<?php endif; ?>

                </div>

				<?php if ( comments_open() || '0' != get_comments_number() && wp_count_comments( $get_id ) ) { ?>


                    <div class="upqode-blog--single__comments-button-wrap">
                        <div class="upqode-blog--single__comments-button"><?php esc_html_e('Read Comments', 'upqode'); ?></div>
                    </div>

                    <div class="upqode-blog--single__comments">
						<?php comments_template( '', true ); ?>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>
</div>