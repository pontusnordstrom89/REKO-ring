<?php

/**
 * Category.php
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
$all_categories = get_categories();
?>

<div class="row search-container">
    <?php get_search_form(); ?>


    <div class="col s12 m4 l2 category-parent">
        <!-- Dropdown Trigger -->
        <button class='dropdown-trigger category-button' data-target='dropdown1'>Välj kategori
            <i class="material-icons expand_more">expand_more</i></button>




        <!-- Dropdown Structure -->
        <ul id='dropdown1' class='dropdown-content dropdown1'>
            <?php foreach ($all_categories as $category) {
                $text_output = $category->name;
                if ($text_output == 'Shop') {
                    $text_output = 'Visa alla annonser';
                }
                echo '<li><a href="' . get_category_link($category) . '">' . $text_output . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>

</div>

<div class="products container bg-color-white">
    <?php
    while (have_posts()) {
        the_post();
        // Post Content here
    ?>
        <div class="post">
            <?php
            $images = get_attached_media('image');
            foreach ($images as $image) {
                $ximage =  wp_get_attachment_image_src($image->ID, 'medium');
                echo '<img src="' . $ximage[0] . '"/>';
                break;
            }
            ?>
            <div class="post-container">
                <h3><?php echo get_the_title() ?></h3>
                <div class="line"></div>
                <div class="post-item">
                    <p class="post-title">Producent</p>
                    <p><?php echo get_the_author_meta('first_name'); ?></p>
                </div>
                <div class="post-item">
                    <p class="post-title">Avstånd</p>
                    <p><?php //echo get_post_meta(get_the_ID(), "distance_to_delivery")[0] 
                        ?> km</p>
                </div>

                <button class="post-button" onClick="window.location.href='<?php the_permalink() ?>'">Besök producent</button>

            </div>
        </div>
    <?php } ?>
</div>

<!--Open new main container for margin width-->
<div class="container flex-container">
    <?php posts_nav_link(); ?>

    <?php get_footer(); ?>