<?php /* Template Name: OrderView */ ?>
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
?>
<?php
$arr = array(
    'author' => get_current_user_id()
);
$currUserSites = get_blogs_of_user($arr);
?>
<h1>Mina Annonser</h1>
<ul class="collection">
    <?php
    foreach ($currUserSites as $sites) {
        switch_to_blog($sites->userblog_id);
    ?>

        <?php
        $args = array(
            'author' => get_current_user_id(),
            'orderby'       =>  'post_date'
        );
        $current_posts = get_posts($args);
        ?>


        <?php
        foreach ($current_posts as $p) {
        ?>
            <li class="collection-item avatar">
                <?php
                $images = get_attached_media('image', $p);
                foreach ($images as $image) {
                    $ximage =  wp_get_attachment_image_src($image->ID, 'medium');
                    echo '<img src="' . $ximage[0] . '" alt="" class="circle">';
                    break;
                }
                ?>
                <span class="title"><?php echo $p->post_title ?></span>
                <p><?php echo $p->post_date ?><br>
                <?php echo $sites->blogname?></p>
                <a href="<?php the_permalink($p) ?>" class="secondary-content"><i class="waves-effect waves-light btn red lighten-2">Se Annons</i></a>
            </li>

    <?php
        }
        restore_current_blog();
    }
    ?>
</ul>


<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
get_footer(); ?>