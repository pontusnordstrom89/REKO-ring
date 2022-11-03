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
?>
<div class="row white">
    <h4>Skapa en annons:</h4>
    <form class="col s12" id="featured_upload" method="post" action="<?php echo home_url() . '/wp-admin/admin-post.php'; ?>" enctype="multipart/form-data">

        <!-- Send to function update_profile -->
        <input type="hidden" name="action" value="create_post">


        <div class="row">
            <div class="input-field col s6">
                <input class="validate" type="text" name="title" id="title" required>
                <label for="title">Titel</label>
            </div>

            <div class="input-field col s6">
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
                <div class="btn btn-reko">
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
                $categories = get_categories();
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
            <button class="btn waves-effect waves-light btn-reko" id="submit_my_image_upload" name="submit_my_image_upload" type="submit">Publicera annons</button>
        </div>
    </form>
</div>

<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
get_footer(); ?>