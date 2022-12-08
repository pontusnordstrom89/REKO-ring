<?php /* Template Name: Create Post */ ?>
<?php

/**
 * createPost.php
 *
 * Template used for creating Posts
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @link https://developer.wordpress.org/themes/basics/template-files/
 * @link https://developer.wordpress.org/themes/getting-started/your-first-theme/
 */


/**  
 * get_header @link https://developer.wordpress.org/reference/functions/get_header/
 * 
 * Looks for header.php file if no parameter is passed
 */
get_header();
$user = wp_get_current_user();
?>

<div class="row create-post-container">
    <h2>Skapa en annons</h2>
    <form class="col s12" id="featured_upload" method="post" action="<?php echo home_url() . '/wp-admin/admin-post.php'; ?>" enctype="multipart/form-data">

        <!-- Send to function update_profile -->
        <input type="hidden" name="action" value="create_post">


        <div class="info-container">
            <div class="input-field input-align">
                <input class="validate" type="text" name="title" id="title" required>
                <label for="title">Annonstitel</label>
            </div>

            <div class="input-field input-align">
                <input class="validate" type="text" name="distance" id="distance" required>
                <label for="distance">Distans till utlämning</label>
            </div>
        </div>

        <p>Beskrivning av din annons</p>
        <div class="row">
            <div class="input-field col s12">
                <label for="desc">Beskrivning</label>
                <!--<textarea type="text" name="desc" id="desc" placeholder="Skriv din annons här"></textarea> -->
                <?php wp_editor("", "desc", array(
                    'media_buttons' => FALSE,
                    'quicktags' => FALSE
                )) ?>

            </div>
        </div>


        <div class="row">
            <div class="file-field input-field">
                <p>Välj flera bildfiler. Dessa bilder visas i bildspel på din annons</p>
                <div class="btn cta-button image-btn">
                    <span>Bläddra</span>
                    <input type="file" name="my_image_upload[]" id="my_image_upload" multiple="multiple" required>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>

        <div class="row">
            <fieldset>
                <legend>Välj kategori för din annons (möjligt att välja fler)</legend>
                <?php
                $categories = get_categories(array('hide_empty' => false));
                foreach ($categories as $cat) {
                    if ($cat->term_id == 1) {
                        // Skip, don't show uncategorized
                    } else {
                        echo '
                        <p class="col s6 m4">
                            <label>
                                <input name="' . $cat->term_id . '" value="' . $cat->term_id . '" type="checkbox" class="filled-in" />
                                <span>' . $cat->name . '</span>
                            </label>
                        </p>
                        ';
                    }
                    }
                    
                ?>
            </fieldset>
        </div>

        <div class="row">
            <?php wp_nonce_field('my_image_upload', 'my_image_upload_nonce'); ?>
            <button class="cta-button" id="submit_my_image_upload" name="submit_my_image_upload" type="submit">Publicera annons</button>
        </div>
    </form>
</div>

<div class="product">
    <div class="product-content container">
        <h2 class="product-title">Tidigare annonser</h2>
        <div class="products">
            <?php
            $posts = get_posts(array(
                'numberposts' => 6,
                'orderby' => 'rand',
                'author' => $user->ID
            ));

            if (count($posts) > 1) {

                foreach ($posts as $post) {
                    // Post Content here 
            ?>
                    <div class="post">
                        <?php
                        $images = get_attached_media('image');
                        foreach ($images as $image) {
                            $ximage =  wp_get_attachment_image_src($image->ID, 'medium');
                            echo '<img src="' . $ximage[0] . '"/>';
                            break;
                        }
                        ?>
                        <div class="post-container">
                            <h3><?php echo get_the_title() ?></h3>
                            <div class="line"></div>
                            <div class="post-item">
                                <p class="post-title">Producent</p>
                                <p><?php echo get_the_author_meta('first_name', $post->post_author)  ?></p>
                            </div>
                            <div class="post-item">
                                <p class="post-title">Avstånd</p>
                                <p><?php echo get_post_meta(get_the_ID(), "distance_to_delivery")[0] ?> km</p>
                            </div>
                            <button class="post-button" onClick="window.location.href='<?php the_permalink() ?>'">Visa annons</button>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p>Inga posts är gjorna ännu</p>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
    get_footer(); 
?>