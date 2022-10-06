<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @link https://developer.wordpress.org/themes/basics/template-files/
 * @link https://developer.wordpress.org/themes/getting-started/your-first-theme/
 * 
 * 
 * 
 */


/**  
 * get_header @link https://developer.wordpress.org/reference/functions/get_header/
 * 
 * Looks for header.php file if no parameter is passed
 */
get_header();


/**
 * Wordpress post loop @link https://codex.wordpress.org/The_Loop
 */ 
if (have_posts()) :
    while (have_posts()) : the_post();
    // Display post content
    endwhile;
endif;

/**  
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 * 
 * Looks for footer.php file if no parameter is passed
 */
get_footer();
