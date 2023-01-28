<?php
$footer_text = esc_html__(' &copy;', 'upqode') . date('Y') . ' ' . get_bloginfo('name');
?>

</main>

<footer class="upqode-footer">
    <div class="container">
        <div class="upqode-footer--copyright"><?php echo wp_kses($footer_text, 'upqode'); ?></div>
    </div>
</footer>


</div>