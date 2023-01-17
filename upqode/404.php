<?php
/**
 * 404 Page
 */

get_header(); ?>

    <div class="upqode-error--wrap">

        <div class="upqode-error--big-title"><?php esc_html_e( 'OOPS!', 'upqode' ); ?></div>

        <div class="upqode-error--small-title"><?php esc_html_e( '404', 'upqode' ); ?></div>

        <h1 class="upqode-error--title"><?php esc_html_e( 'Page not found', 'upqode' ); ?></h1>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="upqode-error--button"><?php esc_html_e( 'Go home', 'upqode' ); ?></a>

    </div>

<?php get_footer();
