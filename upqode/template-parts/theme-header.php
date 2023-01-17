<div class="upqode-preloader"></div>

<div class="upqode-main-wrapper">
    <header class="upqode-header--wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- HEADER -->
                    <div class="upqode-header">

                        <!-- NAVIGATION -->
                        <nav id="topmenu" class="upqode-header--topmenu">

                            <div class="upqode-header--logo-wrap">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="upqode-header--logo">
                                    <span><?php echo get_option( 'blogname' ); ?></span>
                                </a>
                            </div>

                            <div class="upqode-header--menu-wrapper">
								<?php if ( has_nav_menu( 'primary-menu' ) ) {

									$args                   = array( 'container' => '' );
									$args['theme_location'] = 'primary-menu';
									wp_nav_menu( $args );

								} else {

									echo '<span class="no-menu primary-no-menu">' . esc_html__( 'Please register Top Navigation from', 'upqode' ) . ' <a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Appearance &gt; Menus', 'upqode' ) . '</a></span>';

								} ?>

                            </div>

                            <!-- MOB MENU ICON -->
                            <div class="upqode-header--mob-nav">
                                <a href="#" class="upqode-header--mob-nav__hamburger">
                                    <span></span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>