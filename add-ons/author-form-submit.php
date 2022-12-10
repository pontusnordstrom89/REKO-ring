<?php

if (!isset($_POST['update_profile_nonce']) || !wp_verify_nonce($_POST['update_profile_nonce'], 'update_profile_verification')) {
    wp_die();
} else {

    // Get user id
    $user_id = get_current_user_id();

    /**
     * Handle form input
     */


    // First name
    if (!isset($_POST['first_name'])) {
        if (metadata_exists('user', $user_id, 'first_name')) {
            // Delete user meta first name
            delete_user_meta($user_id, 'first_name');
        }
    } elseif (isset($_POST['first_name'])) {

        // Sanitize input
        $first_name_value = sanitize_text_field( $_POST['first_name']);

        if (metadata_exists('user',$user_id, 'first_name')) {
            if ($first_name_value === get_user_meta($user_id, 'first_name', true)) {
                //Do nothing it's the same
            } else {
                update_user_meta($user_id, 'first_name', $first_name_value);
            }
            
        } else {
            add_user_meta($user_id, 'first_name', $first_name_value);
        }
    }

    // Last name
    if (!isset($_POST['last_name'])) {
        if (metadata_exists('user', $user_id, 'last_name')) {
            // Delete user meta last name
            delete_user_meta($user_id, 'last_name', $_POST['last_name']);
        }
    } elseif (isset($_POST['last_name'])) {

        // Sanitize input
        $last_name_value = sanitize_text_field($_POST['last_name']);

        if (metadata_exists('user', $user_id, 'last_name')) {
            if ($last_name_value === get_user_meta($user_id, 'last_name', true)) {
                //Do nothing it's the same
            } else {
                update_user_meta($user_id, 'last_name', $last_name_value);
            }
            
        } else {
            add_user_meta($user_id, 'last_name', $last_name_value);
        }
    }

    // custom_email
    if (!isset($_POST['custom_email'])) {
        if (metadata_exists('user', $user_id, 'custom_email')) {
            // Delete user meta custom_email
            delete_user_meta($user_id, 'custom_email', $_POST['custom_email']);
        }
    } elseif (isset($_POST['custom_email'])) {

        // Sanitize input
        $email_value = sanitize_email($_POST['custom_email']);

        if (metadata_exists('user', $user_id, 'custom_email')) {
            if ($email_value === get_user_meta($user_id, 'custom_email', true)) {
                //Do nothing it's the same
            } else {
                update_user_meta($user_id, 'custom_email', $email_value);
            }
            
        } else {
            add_user_meta($user_id, 'custom_email', $email_value);
        }
    }
    
    // user_url
    if (!isset($_POST['user_url'])) {
        if (get_the_author_meta('user_url')) {
            // Delete user_url = update with empty string
            wp_update_user( array( 'ID' => $user_id, 'user_url' => '' ));
        }
    } elseif (isset($_POST['user_url'])) {

        // Sanitize input
        $url_value = sanitize_url($_POST['user_url']);
        wp_update_user(array('ID' => $user_id, 'user_url' => $url_value));
    }


    // user_description

    if (!isset($_POST['description'])) {
        if (metadata_exists('user', $user_id,'description')) {
            // Delete user description
            delete_user_meta($user_id, 'description');
        }
    } elseif (isset($_POST['description'])) {

        // NO sanitazion, sanitazion removes formatting
        $textarea_value = $_POST['description'];

        if (metadata_exists('user', $user_id,'description')) {
            if ($textarea_value === get_user_meta($user_id, 'description', true)) {
                //Do nothing it's the same
            } else {
                update_user_meta($user_id, 'description', $textarea_value);
            }
            
        } else {
            add_user_meta(
                $user_id,
                'description',
                $textarea_value
            );
        }
    }






    /**
     * Handle file upload
     */
    if ($_FILES["profile_picture_upload"]["error"] == 4) { 
        // No file is uploaded
    } else  {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        // Get file from form
        $uploadedfile = $_FILES['profile_picture_upload'];

        // Set upload overrides https://developer.wordpress.org/reference/functions/_wp_handle_upload/
        $upload_overrides = array(
            'test_form' => false
        );

        // Upload file
        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

        // Trim file path, just store the unique part
        $image_url = ltrim($movefile['url'], home_url() . '/wp-content/uploads/');

        // If upload success
        if ($movefile && !isset($movefile['error'])) {

            //echo __('File is valid, and was successfully uploaded.', 'textdomain');
            //var_dump($movefile);
            //echo $movefile['url'];

            // Check if user has picture
            $has_picture = get_user_meta($user_id, 'profile_picture', true);

            if ($has_picture) {
                // Trim file path, just use the unique part
                $delete_picture = ltrim($has_picture, home_url() . '/wp-content/uploads/');

                // Update filepath
                update_user_meta($user_id, 'profile_picture', $image_url);

                // Delete old file
                wp_delete_file(ABSPATH . 'wp-content/uploads/' . $delete_picture);
                
            } else {
                // If no previous picture, create key value pair and store path
                add_user_meta($user_id, 'profile_picture', $image_url);
            }

        } else {
            /*
            * Error generated by _wp_handle_upload()
            * @see _wp_handle_upload() in wp-admin/includes/file.php
            */
            echo $movefile['error'];
        }

    }

    // redirect the user to the appropriate page
    wp_redirect( home_url() . '/blog/author/' . get_the_author_meta('user_login', $user_id));
    // When finished, die(); is required.
    die();
}
