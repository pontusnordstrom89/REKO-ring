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
<div class="ul-container">
    <ul class="ul-styling">
        <?php
        foreach ($currUserSites as $sites) {
            switch_to_blog($sites->userblog_id);
        ?>

            <?php
            $args = array(
                'author' => get_current_user_id(),
                'orderby'       =>  'post_date',
                'post_status' => array('private','publish')
            );
            $current_posts = get_posts($args);
            ?>

            <?php
            foreach ($current_posts as $p) {
            ?>
                <div>
                    <li class="list-container">
                        <a href="<?php the_permalink($p) ?>" class="list-anchor">
                            <div class="li-content-container">
                                <div class="li-content-info-container">
                                    <?php
                                    $images = get_attached_media('image', $p);
                                    foreach ($images as $image) {
                                        $ximage =  wp_get_attachment_image_src($image->ID, 'medium');
                                        echo '<img src="' . $ximage[0] . '" alt="" class="circle">';
                                        break;
                                    }
                                    ?>
                                    <div class="li-text-content-container">
                                        <h4><?php echo $p->post_title ?></h4>
                                        <p>
                                            <?php echo $p->post_date ?>
                                            <br>
                                            <?php echo $sites->blogname ?>
                                        </p>
                                    </div>
                                </div>
                                <p class="view-btn">Visa Annons</p>
                                <a href="#edit" onclick="setPrivate(<?php echo $p->ID ?>);"><button class="btn">Dölj Annons</button></a>
                            </div>
                        </a>
                    </li>
                    <button type="button" class="orders-collapsible">Visa beställningar</button>
                    <div class="orders-content">
                        <ul class="orders-list">
                            <li class="orders-list-element">
                                <p>Nummer</p>
                                <p>Användare</p>
                                <p>Datum</p>
                                <p>Beställning</p>
                            </li>
                            <?php
                            $comments = get_comments($p);
                            $nbr = 1;
                            foreach ($comments as $c) {
                                echo '<li class="orders-list-element">';
                                echo '<p>' . $nbr . '</p>';
                                echo '<p>' . $c->comment_author . '</p>';
                                echo '<p>' . $c->comment_date . '</p>';
                                echo '<p>' . $c->comment_content . '</p>';
                                echo '</li>';
                            };
                            ?>
                            <ul>
                    </div>
                </div>

        <?php
            }
            restore_current_blog();
        }
        ?>
    </ul>
</div>

<script>
    function setPrivate(postID){
     var ajaxurl ="<?php echo admin_url('admin-ajax.php')?>";
     jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'make_post_private',
            id : postID
        },
     });
    };
    </script>

<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
get_footer(); ?>