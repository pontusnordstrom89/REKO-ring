<?php

/**
 * Home.php
 *
 * By default, WordPress sets your site’s home page to display your latest blog posts. 
 * This page is called the blog posts index. You can also set your blog posts to display on a separate static page. 
 * The template file home.php is used to render the blog posts index, whether it is being used as the front page or on separate static page. 
 * If home.php does not exist, WordPress will use index.php.
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
    <h1>Detta är home.php</h1>
    <?php
    // Example blogpost loop with materialize card
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            // Post Content here 
    ?>

            <div class="card col s12 m6 l4">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Gå till annons</a>
                    <div class="card-image waves-effect waves-block waves-light">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php endif; ?>
                    </div>


                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><?php the_title(); ?><i class="material-icons right">more_vert</i></span>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(get_the_author()); ?>"><?php the_author(); ?></a>
                    </div>


                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><?php the_title(); ?><i class="material-icons right">close</i></span>
                        <p><?php the_excerpt(); ?></p>

                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            Läs mer
                        </a>
                    </div>
            </div>
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