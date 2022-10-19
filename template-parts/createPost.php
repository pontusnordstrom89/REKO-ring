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

<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
    <label for="title">Titel</label>
    <input required type="text" name="title" id="title" placeholder="Titel"/>

    <label for="distance">Distans till utlämning</label>
    <input required type="text" name="distance" id="distance" placeholder="Distans till utlämning"/>

    <label for="desc">Beskrivning</label>
    <!--<textarea type="text" name="desc" id="desc" placeholder="Skriv din annons här"></textarea> -->
    <?php wp_editor("", "desc", array(
        'media_buttons' => FALSE,
        'quicktags' => FALSE
    )) ?>

    <br><br>

    <input required type="file" name="my_image_upload[]" id="my_image_upload"  multiple="multiple"/>
	<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>

    <br><br>

    <input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Publicera Annons">
</form>

<?php
$post_id = 0;

if(isset($_POST['title'], $_POST['desc'])) {
    $title = $_POST['title'];
    $distance = $_POST['distance'];
    print_r($distance);
    $desc = $_POST['desc'];
    if ( is_user_logged_in() ) {
        $userid = get_current_user_id();
        $args = array(
            'post_title' => $title,
            'post_content' => $desc,
            'post_status' => 'publish',
            'post_author' => $userid,
            'post_type' => 'post',
            'meta_input' => array(
                'distance_to_delivery' => $distance
            )
        );
        print_r($args);
        $post_id = wp_insert_post($args);
    } else {
        echo 'Please log in to use this form!';
    }

}

// Check that the nonce is valid, and the user can edit this post.
if ( 
	isset( $_POST['my_image_upload_nonce'], $post_id ) 
	&& wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
	&& current_user_can( 'edit_post', $post_id )
) {
	// The nonce was valid and the user has the capabilities, it is safe to continue.

	// These files need to be included as dependencies when on the front end.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	
    // Let WordPress handle the upload.
	// Remember, 'my_image_upload' is the name of our file input in our form above.
    $files = $_FILES["my_image_upload"];
    foreach ($files['name'] as $key => $value) {
            if ($files['name'][$key]) { 
                $file = array( 
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key], 
                    'tmp_name' => $files['tmp_name'][$key], 
                    'error' => $files['error'][$key],
                    'size' => $files['size'][$key]
                ); 
                $_FILES = array ("my_image_upload" => $file); 
                foreach ($_FILES as $file => $array) {
                    $newupload = media_handle_upload($file, $post_id); 
                }
            } 
        }
	//$attachment_id = media_handle_upload( 'my_image_upload', $post_id );
	
	if ( is_wp_error( $attachment_id ) ) {
		// There was an error uploading the image.
	} else {
		// The image was uploaded successfully!
	}

} else {
	// The security check failed, maybe show the user an error.
}

/* Showcase image */
$media = get_attached_media('image', $post_id); // Get image attachment(s) to the current Post
//print_r($media);

?>
</div>

<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */ 
get_footer(); ?>