<nav class="green" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="<?php echo home_url(); ?>" class="brand-logo"><img height="50px" src="<?php echo get_template_directory_uri() . '/resources/icon/farmer.png' ?>"></a>
        <ul class="right hide-on-med-and-down">

            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'm-auto',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                'depth' => 1,
            ));
            ?>
        </ul>

        <ul id="nav-mobile" class="sidenav">
            <div class="col">
                '
                <a id="logo-container" href="<?php echo home_url(); ?>" class="brand-logo"><img height="50px" src="<?php echo get_template_directory_uri() . '/img/text-logo.png' ?>"></a>
            </div>
            <div class="col">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'm-auto',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                    'depth' => 1,
                ));
                ?>
            </div>

        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>