<?php get_header();
?>

<div class="row footer-spacing">

    <!-- This sets the $curauth variable -->

    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>

    <?php

    if (is_user_logged_in() && is_author(get_current_user_id())) { ?>
        <div class="row valign-wrapper">

            <h5 class="text-capitalize right-align col s6"><?php echo get_the_author_meta('display_name'); ?> <img width="32px" src="<?php echo get_template_directory_uri() . '/resources/icon/farmer.png' ?>" alt=""></h5>
        </div>
        <hr>

        <div class="row">

            <form action="<?php echo home_url() . '/wp-admin/admin-post.php'; ?>" method="post" enctype="multipart/form-data">
                <!-- Send to function update_profile -->
                <input type="hidden" name="action" value="update_profile">
                <!-- Nonce for update_profile -->
                <?php wp_nonce_field('update_profile_verification', 'update_profile_nonce'); ?>
                <div class="col s12 m4">
                    <?php if (get_user_meta(1, 'profile_picture', true)) {
                    ?>
                        <img src="http://reko-ring.dev.com/wp-content/uploads/<?php echo get_user_meta(1, 'profile_picture', true); ?>" class="mt-5 responsive-img" id="display_new_profile_picture">
                    <?php
                    } else { ?>
                        <img src="<?php echo get_template_directory_uri() . '/resources/img/farmer.jpg' ?>" class="mt-5 responsive-img circle" id="display_new_profile_picture">
                    <?php } ?>

                    <!-- File upload for profile image -->
                    <div class="file-field input-field">
                        <div class="btn waves-light">
                            <span>Byt bild</span>
                            <input type="file" name="profile_picture_upload" id="profile_picture_upload" onchange="displayImage(event)">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>

                <div class="col s12 m8">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo get_the_author_meta('first_name'); ?>">
                            <label for="first_name">Förnamn</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo get_the_author_meta('last_name'); ?>">
                            <label for="last_name">Efternamn</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="custom_email" name="custom_email" type="text" class="validate" value="<?php echo get_the_author_meta('custom_email'); ?>">
                            <label for="custom_email">Epost</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="user_url" name="user_url" type="text" class="validate" value="<?php echo get_the_author_meta('user_url'); ?>">
                            <label for="user_url">Hemsida</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="description" name="description" class="materialize-textarea"><?php echo get_the_author_meta('description'); ?></textarea>
                            <label for="description">Beskrivning</label>
                        </div>
                    </div>

                    <div class="right-align">
                        <button class="btn waves-effect waves-light" type="submit" name="submit">Spara ändringar
                            <i class="material-icons right">save</i>
                        </button>
                    </div>

                </div>
            </form>
        </div>




    <?php
    } else { ?>

        <div class="col s6 m4">
            <img class="responsive-img" src="http://reko-ring.dev.com/wp-content/uploads/<?php echo get_user_meta(get_the_author_meta('ID'), 'profile_picture', true); ?>" alt="">

        </div>

        <div class="col s8 m6">

            <h4><?php echo get_the_author_meta('display_name'); ?></h4>
            <hr>
            <h5>Om gården</h5>
            <p><?php echo get_the_author_meta('description'); ?></p>


            <?php if (get_the_author_meta('user_url')) { ?>
                <p><a href="<?php echo get_the_author_meta('user_url') ?>"><i class="material-icons">language</i> Besök odlarens webbplats</a></p>
            <?php } ?>


            <?php if (get_user_meta(get_the_author_meta('ID'), 'custom_email', true)) { ?>
                <p><a href="mailto:<?php echo get_user_meta(get_the_author_meta('ID'), 'custom_email', true) ?>"><i class="material-icons">mail</i> Kontakta odlaren</a></p>
            <?php } ?>
        </div>

        <div class="col s12">
            <h4>Annonser av: <?php echo get_the_author_meta('display_name'); ?>:</h4>

            <ul>
                <!-- The Loop -->

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <li>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                                <?php the_title(); ?></a>,
                            <?php the_time('d M Y'); ?> in <?php the_category('&'); ?>
                        </li>

                    <?php endwhile;
                else : ?>
                    <p><?php _e('No posts by this author.'); ?></p>

                <?php endif; ?>

                <!-- End Loop -->

            </ul>

        </div>




    <?php
    }
    ?>









</div>
<?php get_footer(); ?>