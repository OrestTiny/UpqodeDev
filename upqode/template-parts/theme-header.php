<?php

$alarm = '<h4">' . esc_html__('Please register Top Navigation from', 'upqode') . ' <a href="' . esc_url(admin_url('nav-menus.php')) . '" target="_blank">' . esc_html__('Appearance &gt; Menus', 'upqode') . '</a></h4>';

?>
<div class="upqode-main">

  <header class="upqode-header">
    <div class="container">
      <div class="upqode-header__wrapper">
        <a class="upqode-header__logo" href="<?php echo esc_url(home_url('/')); ?>">
          <span><?php echo get_option('blogname'); ?></span>
        </a>

        <?php if (has_nav_menu('primary-menu')) {
          $args = array(
            'container_class' => 'upqode-header__menu',
            'container'       => 'nav',
            'menu_class' => 'header-menu',
            'tag' => 'nav',
          );
          $args['theme_location'] = 'primary-menu';
          wp_nav_menu($args);
        } else {
          echo $alarm;
        } ?>

        <button class="upqode-header__burger">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </header>
  <main>