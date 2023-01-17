<?php

$footer_text = get_bloginfo( 'name' ) . ' ' . esc_html__( ' &copy;', 'upqode' ) . date( 'Y' );

?>

</div><!-- #content -->

<footer id="footer" class="upqode-footer">
    <div class="upqode-footer--copyright"><?php echo wp_kses($footer_text, 'post'); ?></div>
</footer>