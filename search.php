<?php

/**
 * Search.php
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


// Get all categories on site
$all_categories = get_categories();

?>




<div class="product">
    <div class="product-content container">
        <nav id="searchNav" style="margin-top:20px;">
            <div class="nav-wrapper row">
                <?php get_search_form(); ?>
                <div class="col s12 m4 row right-align">


                    <!-- Dropdown Trigger -->
                    <a class='dropdown-trigger btn' href='#' data-target='categoryDropdown'>Välj kategori</a>

                    <!-- Dropdown Structure -->
                    <ul id='categoryDropdown' class='dropdown-content left hide-on-med-and-down'>
                        <?php foreach ($all_categories as $category) {
                            $text_output = $category->name;
                            if ($text_output == 'Uncategorized') {
                                $text_output = 'Visa alla annonser';
                            }
                            echo '<li><a href="' . get_category_link($category) . '">' . $text_output . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>


            </div>
        </nav>
        <h2>Sökresultat för: <span class="green-text"><?php echo get_search_query(); ?></span></h2>
        <div class="products">
            <?php

            if (have_posts()) {
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
                                <p class="post-title">Avstånd till utlämningsställe</p>
                                <p><?php //echo get_post_meta(get_the_ID(), "distance_to_delivery")[0] 
                                    ?> km</p>
                            </div>
                            <div class="post-button center-align">
                                <!-- <button class="post-button">Besök producent</button> -->
                                <a href="<?php the_permalink() ?>" class="post-button-text" ;>Besök producent</a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div>
                    <img style="display:block; margin:auto;" height="100px" src="<?php echo get_template_directory_uri() . '/resources/icon/detective.png' ?>">
                    <p class="center-align">Vi letade vitt och brett men lyckades inte hitta något som matchade: <span class="green-text"><?php echo get_search_query(); ?></span></p>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
get_footer(); ?>