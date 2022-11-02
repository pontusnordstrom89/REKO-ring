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

    // Get jQuery
    wp_enqueue_script('jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', false);

    // Get materialize js
    wp_enqueue_script('materialize-js', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js', array(), '1.0.0', true);

    // Get script.js
    wp_enqueue_script('script', get_template_directory_uri() . '/script.js', array(), null, true);

    // If author.php is in use import custom css & style
    if (is_author()) {
        wp_enqueue_style('authorCSS', get_template_directory_uri() . '/resources/styles/authorStyle.css');
        wp_enqueue_script('authorJS', get_template_directory_uri() . '/resources/scripts/authorScript.js', array(), null, true);
    }

    if(is_home() || is_search() || is_category()) {
        wp_enqueue_style('authorCSS', get_template_directory_uri() . '/resources/styles/home.css');
        wp_enqueue_script('authorJS', get_template_directory_uri() . '/resources/scripts/home.js', array(), null, true);
    }

    if (is_single()) {
        wp_enqueue_style('singleCSS', get_template_directory_uri() . '/resources/styles/single.css');
        wp_enqueue_script('singleJS', get_template_directory_uri() . '/resources/scripts/single.js', array(), null, true);
    }
}
add_action('wp_enqueue_scripts', 'theme_add_style_script');




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
 * Register extra items to main navigation
 * 
 */
add_filter('wp_nav_menu_items', 'add_extra_item_to_nav_menu',10);
function add_extra_item_to_nav_menu($items)
{
    $items .= '<li><a href="'. home_url() .'/blog/category/uncategorized/">Handla närodlat</a></li>';
    
    if (is_user_logged_in()) {
        $items .= '<li><a href="' . wp_logout_url(home_url()) . '">Logga ut</a></li>';
    } elseif (!is_user_logged_in()) {
        $items .= '<li><a href="'. wp_login_url().'">Logga in / Registrera</a></li>';
    }
    
    return $items;
}


/**
 * 
 * Style wordpress search form
 * 
 */
function custom_search_form($form)
{
    $form = '<form role="search" method="get" id="searchform" class="searchform row col s12 m6 l4 offset-l4 center-align" action="' . home_url('/') . '" >
        
        <input style="font-size:24px; margin-top:10px;" class="col s10 m8 l8 white-text" type="text" placeholder="Sök" value="' . get_search_query() . '" name="s" id="s" />
        <button class="waves-effect waves-light btn" type="submit" id="searchsubmit">Sök</button>
      
      </form>';

    return $form;
}
add_filter('get_search_form', 'custom_search_form', 40);
