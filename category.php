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


// Get all categories on site
$all_categories = get_categories();

?>



<div class="product bg-color-white">
    <div class="product-content container">


        <nav id="categoryNav" class="hide-on-small-only">
            <div class="search-bar">

                <?php get_search_form(); ?>


                <div class="col s12 m6 l4 row right-align">

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

        <div class="hide-on-med-and-up">
            <?php get_search_form(); ?>
            <div class="col s12 center-align">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>Välj kategori</a>

                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content left'>
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



        <?php
        $term = get_queried_object();

        if ($term->name == 'Uncategorized' || $term->name == 'Okategoriserade') {
            echo '<h2>Alla annonser</h2>';
        } else {
            echo '<h2>Visar annonser i kategorin: <span class="green-text">' . $term->name . '</span></h2>';
        }
        ?>
        <div class="products bg-color-white">
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
                            <p><?php echo get_post_meta(get_the_ID(), "distance_to_delivery")[0] ?> km</p>
                        </div>
                        
                        <button class="post-button" onClick="window.location.href='<?php the_permalink() ?>'">Besök producent</button>
                        
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php posts_nav_link(); ?>
    </div>
</div>
<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
get_footer(); ?>