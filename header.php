<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * 
 */

?>
<!doctype html>
<html lang="sv-SE">

<head>
    <!--  Get charset from blog setup -->
    <meta charset="<?php bloginfo('charset'); ?>" />
    <!--  Get title dynamically -->
    <title><?php wp_title(); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!--Import Google Icon Font used in materialize css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php

    /**
     * wp_head is a core function that other functions can be hooked into. 
     * In functions.php we use --> add_action('wp_enqueue_scripts', 'theme_add_style_script'); <--
     * wp_enqueue_scripts hooks into wp_head and wp_footer and enques scripts & styles
     * @link https://developer.wordpress.org/reference/hooks/wp_head/
     */
    wp_head()

    ?>


</head>

<body> <!-- Body starts here -->
   
    <!-- Site container closed in footer -->
    <div class="container">
        <?php get_template_part('template-parts/navbar'); ?>
