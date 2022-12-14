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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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

<body>
    <!-- Body starts here -->

    <!-- Get Navbar -->
    <?php get_template_part('template-parts/navbar'); ?>
    
    <!-- Site container closed in footer -->
    <div class="container flex-container">
