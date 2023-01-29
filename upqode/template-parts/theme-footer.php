<?php
$footer_text = esc_html__(' &copy;', 'upqode') . date('Y') . ' ' . get_bloginfo('name');
?>

</main>

<footer class="upqode-footer">
    <div class="container">
        <div class="upqode-footer__menu">
            <?php if (has_nav_menu('footer-menu')) {
                $args = array(
                'container' => false,
                'menu_class' => 'footer-menu',
                );
                $args['theme_location'] = 'footer-menu';
                wp_nav_menu($args);
            } ?>
        </div>
        <div class="upqode-footer__copyright"><?php echo wp_kses($footer_text, 'upqode'); ?></div>
    </div>
</footer>


</div>