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

<div class="filter-container">
    <!-- Search bar -->
    <?php get_search_form(); ?>

    <!-- Dropdown -->
    <div class="dropdown1">
        <button onClick="dropdown_trigger()" class="dropbtn">Välj kategori<i class="material-symbols-outlined icon-eye-open">expand_more</i></button>
        <div id="category_dropdown" class="dropdown-content1">
            <?php foreach ($all_categories as $category) {
                $text_output = $category->name;
                if ($text_output == 'Shop') {
                    $text_output = 'Visa alla annonser';
                }
                echo '<a href="' . get_category_link($category) . '">' . $text_output . '</a>';
            }
            ?>
        </div>
    </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function dropdown_trigger() {
  document.getElementById("category_dropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<div class="products bg-color-white">
    <?php
    $args = array(
        'orderby'       =>  'post_date',
        'post_status' => 'publish'
    );
    $current_posts = get_posts($args);
    foreach ($current_posts as $p) {
        // Post Content here
    ?>
        <div class="post">
            <?php
            $images = get_attached_media('image', $p);
            foreach ($images as $image) {
                $ximage =  wp_get_attachment_image_src($image->ID, 'medium');
                echo '<img src="' . $ximage[0] . '"/>';
                break;
            }
            ?>
            <div class="post-container">
                <h3><?php echo $p->post_title ?></h3>
                <div class="line"></div>
                    <div class="post-item">
                        <p class="post-title">Producent</p>
                        <p><?php  echo get_the_author_meta('first_name', $p->post_author)  ?></p>
                    </div>
                <div class="post-item">
                    <p class="post-title">Avstånd</p>
                    <p><?php echo get_post_meta(get_the_ID(), "distance_to_delivery")[0] ?> km</p>
                </div>

                <button class="post-button" onClick="window.location.href='<?php echo get_permalink($p) ?>'">Besök producent</button>
            </div>
        </div>
    <?php } ?>
</div>
    <?php posts_nav_link(); ?>
<?php get_footer(); ?>
