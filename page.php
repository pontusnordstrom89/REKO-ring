<?php

/**
 * page.php
 *
 * Template used for displaying pages
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


<div class="row">


    <h1>Nu används page.php </h1>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            // Post Content here
    ?>


            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php endif; ?>

            <h1><?php the_title(); ?></h1>
            <p><?php the_content(); ?></p>




    <?php
            //
        } // end while
    } // end if
    ?>
</div>

<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */ 
get_footer(); ?>