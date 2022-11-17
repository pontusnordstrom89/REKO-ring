<?php
// single.php controls a single post from index.php
?>

<?php get_header();


while (have_posts()) {
    the_post();
?>



    <div class="row">

        <div class="col s12 m4">
            <h4><?php the_title(); ?></h4>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(get_the_author()); ?>"><?php the_author(); ?></a>
            <hr>
            <img src="<?php echo home_url() . '/wp-content/uploads/' . get_user_meta(get_the_author_meta('ID'), 'profile_picture', true); ?>" class="profilePic mt-5 responsive-img" id="display_new_profile_picture">

        </div>
        <div class="col s12 m8 carousel">

            <?php
            $images = get_attached_media('image'); // get attached media
            foreach ($images as $image) {
                $ximage =  wp_get_attachment_image_src($image->ID, 'medium');
                echo '<a class="carousel-item" href="#one!"><img src=' . $ximage[0] . '></a>';
            }
            ?>
        </div>

        <div class="col s12 m12">
            <hr>
            <?php the_content(); ?>
        </div>

        <div class="col s12 m12">
            <hr>
            <h4>Om <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(get_the_author()); ?>"><?php the_author(); ?></a></h4>
            <?php echo get_the_author_meta('description') ?>
        </div>
    </div>

    </div> <!-- Stänger body container eftersom den va så jävla bråkig-->


    <div class="row">
        <div class="col s12 sticky-order-form center-align">

            <?php

            // Access global db object
            global $wpdb;
            // Set table prefix + tablename
            $comments_table = $wpdb->prefix . "comments";
            // Get current Post ID
            $post_id = get_the_ID();
            // Get all comments in relation to this post with no comment parents to count top comments = orders
            $get_comments = $wpdb->get_results("SELECT * FROM $comments_table WHERE comment_post_ID = $post_id AND comment_parent = '0'");



            $getUser = wp_get_current_user();
            if (is_user_logged_in() && get_the_author_meta('ID') == $getUser->ID) {
                // Count items in array $get_comments and display for user as number of orders
                $orderButtonText = 'Du har ' . count($get_comments) . ' beställningar';
            } else {
                $orderButtonText = 'Beställ av ' . get_the_author();
            }
            ?>


            <button class="btn waves-effect waves" style="background-color:#f66565;" type="button" id="orderButton"><?php echo $orderButtonText; ?>
                <i class="material-icons right">shopping_basket</i>
            </button>

            <div id="order-form">
            
                <div class="col s12 m6 offset-m3" style="background-color:#f66565;">
                    <div id="commentFormLoader" class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    <?php

                    if (is_user_logged_in()) {
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    } else { ?>
                        <div>
                            <h3 class="white-text">Logga in för att beställa</h3>
                            <p><a class="white-text" href="<?php echo home_url() . '/wp-login' ?>">Klicka här för att logga in / skapa konto</a></p>
                        </div>
                    <?php }

                    ?>

                </div>
            </div>
        </div>
    </div>
<?php
}

?>

<?php get_footer(); ?>