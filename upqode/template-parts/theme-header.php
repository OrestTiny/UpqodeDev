<div class="upqode-main-wrapper">
    <header class="upqode-header">
        <div class="upqode-header--overlay"></div>
        <div class="container">
            <div class="upqode-header__wrapper">
                <a class="upqode-header__logo" href="<?php echo esc_url(home_url('/')); ?>">
                    <span><?php echo get_option('blogname'); ?></span>
                </a>
                <nav class="upqode-header__menu">
                    <?php if (has_nav_menu('primary-menu')) {
                        $args = array(
                            'container' => '',
                            'menu_class' => 'header-menu',
                        );
                        $args['theme_location'] = 'primary-menu';
                        wp_nav_menu($args);
                    } else {
                        echo '<span class="header--no-menu">' . esc_html__('Please register Top Navigation from', 'upqode') . ' <a href="' . esc_url(admin_url('nav-menus.php')) . '" target="_blank">' . esc_html__('Appearance &gt; Menus', 'upqode') . '</a></span>';
                    } ?>
                </nav>
                <button class="upqode-header__burger">
                    <span></span>
                </button>
            </div>
        </div>
    </header>