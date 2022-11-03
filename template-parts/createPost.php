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
            <?php wp_nonce_field('my_image_upload', 'my_image_upload_nonce'); ?>
            <button class="btn waves-effect waves-light btn-reko" id="submit_my_image_upload" name="submit_my_image_upload" type="submit">Publicera annons</button>
        </div>
    </form>
</div>

<?php
$user = wp_get_current_user();
$usatual = $user->user_login;
$usemail = $user->user_email;
$query_args = array(
    'post_type' => 'post',
    'author' => $user->ID,
);

$query = new WP_Query($query_args);
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post = $query->post;
        $title = $post->post_title;
        $content = $post->post_content;
        $date = $post->post_date;
        $images = get_attached_media('image');
        echo '<div><h5>' . $title . '</h5>';
        echo '<p>' . $date . '</p>';
        echo '<p>' . $content . '</p>';
        echo '<input type="submit" value="Kopiera Annons">';
        /*foreach ($images as $image) {
            $ximage = wp_get_attachment_image_src($image->ID, 'medium');
            echo '<img class="image" src="' . $ximage[0] . '"/>';
            break;
        }*/
        echo '</div>';
        
    }
    wp_reset_postdata();
}
else{
    echo 'Du har inga tidigare annonser.';
}

//Previous posts end here
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
get_footer(); ?>