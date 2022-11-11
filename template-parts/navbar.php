<?php
$comment_counter = 0;
?>
<div class="nav">
    <div class="container nav-flex">
        <a class="image-a" href="<?php echo home_url(); ?>"><img height="50px" src="<?php echo get_template_directory_uri() . '/resources/img/reko_black.png' ?>"></a>

        <div id="mobile-comment-counter-div" class="hide-on-med-and-up dropdown-trigger" data-target='dropdown3'>
            <i class="material-icons teal-text" style="font-size:48px;">chat</i><span id="comment-counter-badge-phone" class="comment-counter-badge"></span>
            <ul id='dropdown3' class='dropdown-content dropdown3' style="min-width:300px;">
            </ul>
        </div>

        <div class="nav-selections">
            <?php
            $curr_site = get_current_blog_id();
            ?>
            <ul class="nav-ul">
                <li class="nav-li"><a href="<?php echo home_url() ?>">Om oss</a></li>
                <li class="nav-li"><a href="<?php echo home_url() ?>/category/shop/">Handla</a></li>
                <?php
                if (is_user_logged_in() && current_user_can('author')) {
                ?>
                    <li class="nav-li"><a href="<?php echo home_url() ?>/create-post">Skapa annons</a></li>
                <?php
                }
                ?>

                <select class="nav-select" name="select" onchange="location = this.value;">

                    <option disabled selected>
                        <?php echo get_blog_details($curr_site)->blogname ?>
                    </option>
                    <?php
                    $sites = get_sites();

                    foreach ($sites as $site) {
                        $page = get_blog_details($site->blog_id);

                        if ($curr_site != $site->blog_id) {
                    ?>
                            <option value="<?php echo $site->path ?>"><?php echo $page->blogname ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (is_user_logged_in()) { ?>

                    <div id="nav-profile" class="dropdown-trigger" data-target='dropdown2'>

                        <?php


                        if (get_user_meta(get_current_user_id(), 'profile_picture', true)) {

                        ?>
                            <li class="nav-li"><a href="<?php echo esc_url(get_author_posts_url(get_current_user_id())) ?>"><img id="nav-profile-picture" src="<?php echo home_url() . '/wp-content/uploads/' . get_user_meta(get_current_user_id(), 'profile_picture', true); ?>" class="circle"></a></li>

                        <?php
                        } else { ?>

                            <li class="nav-li"><a class="material-icons right" style="font-size:48px;" href="<?php echo esc_url(get_author_posts_url(get_current_user_id())) ?>">account_circle</a></li>
                        <?php }

                        $user_meta = get_user_meta(get_current_user_id(), 'comments', true);
                        $arre = unserialize($user_meta);


                        ?>

                        <ul id='dropdown2' class='dropdown-content dropdown2' style="min-width:300px;">
                            <?php
                            if ($arre) {

                                foreach ($arre as $key => $value) {
                                    $comment_counter = $comment_counter + $value;
                                    $pieces = explode("_", $key);
                                    if (count($pieces) > 2) {
                                        $id = $pieces[2];
                                        $prefix = $pieces[0] . '_' . $pieces[1] . '_';
                                    } else {
                                        $id = $pieces[1];
                                        $prefix = $pieces[0] . '_';
                                    }

                                    global $wpdb;
                                    $post_table = $prefix . "posts";
                                    $options_table = $prefix . "options";

                                    $post_title = $wpdb->get_var("SELECT post_title FROM $post_table WHERE ID = $id");
                                    $blog_title = $wpdb->get_var("SELECT option_value FROM $options_table WHERE option_name = 'blogname'");
                            ?>
                                    <li class="row"><a class="comment-link" href="<?php echo the_permalink($id) ?>"> <?php echo substr($post_title, 0, 20) ?> .... <i class="right"><span class="new badge"><?php echo $value ?></span></i></a>
                                        <span id="dropdown-comment-blogname"><?php echo $blog_title ?></span>
                                    </li>
                                    <li class="divider" tabindex="-1"></li>
                            <?php }
                            } else { ?>
                                <li> Inga nya meddelanden</li>
                            <?php }

                            ?>
                        </ul>
                        <?php if (!$comment_counter) {
                            // Don't show badge
                        } else { ?>
                            <span id="comment-counter-badge-pc" class="comment-counter-badge"><?php echo $comment_counter ?></span>
                        <?php } ?>

                    </div>






                    <button onClick="window.location.href='<?php echo wp_logout_url(home_url()); ?>';" class="nav-cta">Logga ut</button>
                <?php
                } else {
                ?>
                    <button onClick="window.location.href='<?php echo wp_login_url(); ?>';" class="nav-cta">Logga in</button>
                <?php
                }
                ?>


            </ul>
        </div>
        <div class="menu-btn mobile">
            <div class="menu-btn__burger"></div>
        </div>
        <div class="overlay nav-flex">



            <ul class="nav-ul">
                <li class="nav-li"><a href="<?php echo home_url() ?>">Om oss</a></li>
                <li class="nav-li"><a href="<?php echo home_url() ?>/category/shop/">Handla</a></li>
                <?php
                if (is_user_logged_in() && current_user_can('author')) {
                ?>
                    <li class="nav-li"><a href="./create-post">Skapa annons</a></li>
                <?php
                }
                ?>

                <select class="nav-select" name="select" onchange="location = this.value;">

                    <option disabled selected>
                        <?php echo get_blog_details($curr_site)->blogname ?>
                    </option>
                    <?php
                    $sites = get_sites();

                    foreach ($sites as $site) {
                        $page = get_blog_details($site->blog_id);

                        if ($curr_site != $site->blog_id) {
                    ?>
                            <option value="<?php echo $site->path ?>"><?php echo $page->blogname ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <?php
                if (is_user_logged_in()) {
                ?>

                    <button onClick="window.location.href='<?php echo wp_logout_url(home_url()); ?>';" class="nav-cta">Logga ut</button>
                <?php
                } else {
                ?>
                    <button onClick="window.location.href='<?php echo wp_login_url(); ?>';" class="nav-cta">Logga in</button>
                <?php
                }
                ?>

                <?php if (is_user_logged_in()) { ?>

                    <div id="mobile-nav-profile" class="user-view center-align" style="margin:1rem;">

                        <?php if (get_user_meta(get_current_user_id(), 'profile_picture', true)) {

                        ?>

                            <a href="<?php echo esc_url(get_author_posts_url(get_current_user_id())) ?>"><img id="nav-profile-picture" src="<?php echo home_url() . '/wp-content/uploads/' . get_user_meta(get_current_user_id(), 'profile_picture', true); ?>" class="circle"></a>
                            <br>
                            <a href="<?php echo esc_url(get_author_posts_url(get_current_user_id())) ?>"><span class="white-text name"><?php $user = wp_get_current_user();
                                                                                                                                        echo $user->display_name ?></span></a><br>

                        <?php
                        } else { ?>

                            <li class="nav-li"><a class="material-icons right" style="font-size:48px;" href="<?php echo esc_url(get_author_posts_url(get_current_user_id())) ?>">account_circle</a></li>

                        <?php } ?>

                    </div>
                <?php } ?>


            </ul>

        </div>
    </div>
</div>

<!--<nav class="z-depth-0 nav-cont container" style="background: white;" role="navigation">
    <div class="nav-wrapper">
        <a id="logo-container" href="<?php /*echo home_url(); ?>"><img height="50px" src="<?php echo get_template_directory_uri() . '/resources/img/REKO-green.png' ?>"></a>
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
                <a id="logo-container" href="<?php echo home_url(); ?>" class="brand-logo"><img src="<?php echo get_template_directory_uri() . '/img/text-logo.png' ?>"></a>
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
                */
                                        ?>
            </div>

        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons" color="black">menu</i></a>
    </div>
</nav> -->