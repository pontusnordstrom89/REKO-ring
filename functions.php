<?php

/**
 * Import styles and scripts
 *
 *  @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function theme_add_style_script()
{
    // Get materialize css
    wp_enqueue_style('materialize-css', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css');

    // Get style.css
    wp_enqueue_style('style-css', get_template_directory_uri() . '/style.css');

    //get navbar style
    wp_enqueue_style('nav-css', get_template_directory_uri() . '/resources/styles/navbar.css');
    
    //get create post style
    wp_enqueue_style('create-post-css', get_template_directory_uri() . '/resources/styles/createPost.css');

     //get create orderView style
     wp_enqueue_style('orderView-css', get_template_directory_uri() . '/resources/styles/orderView.css');

    // Get jQuery
    wp_enqueue_script('jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', false);

    // Get materialize js
    wp_enqueue_script('materialize-js', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js', array(), '1.0.0', true);

    // Get script.js
    wp_enqueue_script('script', get_template_directory_uri() . '/script.js', array(), null, true);

    wp_enqueue_script('navbarJS', get_template_directory_uri() . '/resources/scripts/navbar.js', array(), null, true);

    wp_enqueue_script('orderViewJS', get_template_directory_uri() . '/resources/scripts/orderView.js', array(), null, true);

    wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
    // If author.php is in use import custom css & style
    if (is_author()) {
        wp_enqueue_style('authorCSS', get_template_directory_uri() . '/resources/styles/authorStyle.css');
        wp_enqueue_script('authorJS', get_template_directory_uri() . '/resources/scripts/authorScript.js', array(), null, true);
    }

    wp_enqueue_style('authorCSS', get_template_directory_uri() . '/resources/styles/home.css');
    wp_enqueue_script('authorJS', get_template_directory_uri() . '/resources/scripts/home.js', array(), null, true);

    if (is_single()) {
        wp_enqueue_style('singleCSS', get_template_directory_uri() . '/resources/styles/single.css');
        wp_enqueue_script('singleJS', get_template_directory_uri() . '/resources/scripts/single.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'theme_add_style_script');




/**
 *
 * On Theme setup, create pages and ad templates
 *
 */
function create_pages_if_not_exist() {

    // Limit nested comments to two levels
    add_filter('thread_comments_depth_max', function ($max) {
        return 2;
    });

    // Define table
    global $wpdb;
    $post_table = $wpdb->prefix . "posts";

    // Check if create page exists
    $find_create_page_slug = $wpdb->get_row("SELECT * FROM $post_table WHERE post_name = 'create-post'");

    // Check if order view
    $find_order_view_slug = $wpdb->get_row("SELECT * FROM $post_table WHERE post_name = 'order-view'");

    if ($find_create_page_slug) {
        //Create post exists
    } else {
        // Create new page + template for create post
        $wpdb->insert($post_table, array(
            'post_author' => 1,
            'post_date' => '2022-11-03 00:00:00',
            'post_date_gmt' => '2022-11-03 00:00:00',
            'post_title' => 'Skapa Inlägg',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'post_name' => 'create-post',
            'ping_status' => 'closed',
            'post_modified' => '2022-11-03 00:00:00',
            'post_modified_gmt' => '2022-11-03 00:00:00',
            'post_parent' => 0,
            'post_type' => 'page',
            'comment_count' => 0
        ));

        $post_id = $wpdb->insert_id;

        $post_meta_table = $wpdb->prefix . "postmeta";
        $wpdb->insert($post_meta_table, array(
            'post_id' => $post_id,
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template-parts/createPost.php'
        ));
    }

    if ($find_order_view_slug) {
        // Order view exists
    } else {
        // Create new page + template for order view
        $wpdb->insert($post_table, array(
            'post_author' => 1,
            'post_date' => '2022-11-03 00:00:00',
            'post_date_gmt' => '2022-11-03 00:00:00',
            'post_title' => 'Orderöversikt',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'post_name' => 'order-view',
            'ping_status' => 'closed',
            'post_modified' => '2022-11-03 00:00:00',
            'post_modified_gmt' => '2022-11-03 00:00:00',
            'post_parent' => 0,
            'post_type' => 'page',
            'comment_count' => 0
        ));

        $post_id = $wpdb->insert_id;

        $post_meta_table = $wpdb->prefix . "postmeta";
        $wpdb->insert($post_meta_table, array(
            'post_id' => $post_id,
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template-parts/orderView.php'
        ));
    }
}

add_action('after_setup_theme', 'create_pages_if_not_exist');




/**
 * Add theme support so that logo, headers, menus etc can be changed in admin area
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
 */

// Add support for logo
add_theme_support('custom-logo');
// Add support for thumbnails
add_theme_support('post-thumbnails');
// Add support for menus
add_theme_support('menus');

// Custom header
$args = array(
    'width'         => 980,
    'height'        => 300,
    'default-image' => get_template_directory_uri() . '/img/banner.jpg',
);
add_theme_support('custom-header', $args);

/**
 * Handle author update_profile form
 */
add_action('admin_post_update_profile', 'update_profile_callback');
function update_profile_callback()
{
    require_once(ABSPATH . 'wp-content/themes/REKO-ring/add-ons/author-form-submit.php');
}

/**
 * Handle author clear notifications form
 */
add_action('admin_post_clear_notifications', 'clear_notifications_callback');
function clear_notifications_callback()
{
    delete_user_meta(get_current_user_id(), 'comments');

    // redirect the user to the appropriate page
    wp_redirect(wp_get_referer());
    // When finished, die(); is required.
    die();
}

/**
 * Handle author create post form
 */
add_action('admin_post_create_post', 'create_post_callback');
function create_post_callback()
{
    require_once(ABSPATH . 'wp-content/themes/REKO-ring/add-ons/post-CRUD.php');
}

//Metod för att visa wordpress-dashboard endast för administratörer
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar(){
	if(!current_user_can('administrator') && !is_admin()){
    show_admin_bar(false);
	}
}

/**
 *
 * Register main menu and special submenus
 *
 */
function register_my_menu()
{
    register_nav_menu('main-menu', __('Huvudmeny', 'REKO-ring-main-navigation'));
}
add_action('after_setup_theme', 'register_my_menu');

/**
 *
 * Style wordpress search form
 *
 */
/* function custom_search_form($form)
{
    $form = '<form role="search" method="get" id="searchform" class="searchform row col s12 m6 l4 offset-l4 center-align" action="' . home_url('/') . '" >

        <input style="font-size:24px; margin-top:10px;" class="col s10 m8 l8 white-text" type="text" placeholder="Sök" value="' . get_search_query() . '" name="s" id="s" />
        <button class="waves-effect waves-light btn" type="submit" id="searchsubmit">Sök</button>

      </form>';

    return $form;
}
add_filter('get_search_form', 'custom_search_form', 40);

function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);*/





function comments_count($comment_id)
{
    global $wpdb;
    // Get site prefix
    $site_prefix = $wpdb->prefix;

    // Get comment data
    $comment = get_comment($comment_id);

    // From comment data get user id from comment author
    $author = $comment->user_id;

    // from comment get post id from the post that recieved a comment
    $post_id = $comment->comment_post_ID;

    // Get data about post that recived comment
    $post_that_got_comment = get_post($post_id);

    // Get post author -> comment count will be stored in relation to post author
    $the_post_author = $post_that_got_comment->post_author;

    // Check if we previousley have stored comments in relation to user
    $user_meta_as_string = get_user_meta($the_post_author, 'comments', true);


    /**
     * IF COMMENT AUTHOR === POST AUTHOR mark comments as read = delete post_id => comment_count
     */
    if ($author == $post_that_got_comment->post_author) {
        $user_meta = unserialize($user_meta_as_string);
        unset($user_meta[$site_prefix . $post_id]);

        $user_meta_serialized = serialize($user_meta);
        update_user_meta($the_post_author, 'comments', $user_meta_serialized);

    /**
     * IF someone else makes a comment on a post. save post_id and comment_count in relation to post author in table usermeta
     */
    } else {
        // If we can't find row with metakey "comments" in relation to post_author in usermetatable, create
        if (!$user_meta_as_string) {
            $data = array($site_prefix . $post_id => 1);
            $t = serialize($data);
            add_metadata('user', $the_post_author, 'comments', $t);
        } else {
            // Get row and unserialize
            $user_meta = unserialize($user_meta_as_string);

            // For each key, if one matches +1 on count
            foreach ($user_meta as $key => $value) {

                if ($key == $post_id) {
                    $user_meta[$site_prefix . $post_id] = intval($value) + 1;
                } else {
                    // Else, append new key=>value in array
                    $user_meta[$site_prefix . $post_id] = 1;
                }
            }

            //serialize and update
            $user_meta_serialized = serialize($user_meta);
            update_user_meta($the_post_author, 'comments', $user_meta_serialized);
        }
    }






}
add_action('comment_post', 'comments_count', 10,1);


function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );


function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/resources/styles/style-login.css' );
}

add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

add_action( 'wp_ajax_nopriv_make_post_private', 'make_post_private' );
add_action( 'wp_ajax_make_post_private', 'make_post_private' );

function make_post_private($post) {
    $post_id = $_POST["id"];
    $post = get_post($post_id);
    $post->post_status ='private';
    wp_update_post( $post);
}

add_action( 'wp_ajax_nopriv_make_post_publish', 'make_post_publish' );
add_action( 'wp_ajax_make_post_publish', 'make_post_publish' );
function make_post_publish($post) {
    $post_id = $_POST["id"];
    $post = get_post($post_id);
    $post->post_status ='publish';
    wp_update_post( $post);
}