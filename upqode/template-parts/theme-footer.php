<?php
$footer_text = esc_html__(' &copy;', 'upqode') . date('Y') . ' ' . get_bloginfo('name') . '. All Rights Reserved.';
?>

</main>

<footer class="upqode-footer">
    <div class="container">
        <div class="upqode-footer__wrap">

            <?php if (has_nav_menu('footer-menu')) {
                $args = array(
                    'container_class' => 'upqode-footer__menu',
                    'container'       => 'nav',
                    'menu_class' => 'footer-menu',
                );
                $args['theme_location'] = 'footer-menu';
                wp_nav_menu($args);
            } ?>

            <div class="upqode-footer__development">
                <a href="https://upqode.com/web-design/" rel="noopener" target="_blank">Web Design</a> and
                <a href="https://upqode.com/wordpress-development/" rel="noopener" target="_blank">Development</a> by
                <a href="https://upqode.com/" rel="noopener" target="_blank">UPQODE</a>
            </div>
            <div class="upqode-footer__copyright"><?php echo wp_kses($footer_text, 'upqode'); ?></div>
        </div>
    </div>
</footer>

</div>