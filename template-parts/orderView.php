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
     $siteName = get_bloginfo('name' );
$arr = array(
    'author' => get_current_user_id()
);
$currUserSites = get_blogs_of_user($arr);
?>

<h1>Mina Annonser i <?php echo $siteName?></h1>
<div class="ul-container">
    <ul class="ul-styling">
        <?php  
        ?>

            <?php
            $args = array(
                'author' => get_current_user_id(),
                'orderby'       =>  'post_date',
                'post_status' => array('private','publish')
            );
            $current_posts = get_posts($args);
            if(!$current_posts) {
                echo '<h5>Oj, du har inga annonser!</h5>';
                echo '<a href="http://localhost/wordpress/create-post/">Klicka här för att skapa en annons!</a>';
            }
            ?>

            <?php
            foreach ($current_posts as $p) {
            ?>
                <li class="list-container">
                    <div class="item-container">
                        <div class="img-text-container">
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
                                    <?php echo $siteName ?>
                                </p>
                            </div>
                        </div>
                        <div class="btn-container">
                            <?php 
                                if ($p->post_status=='private') {
                            ?>
                            <a href="#edit" class="toggle-btn" onclick="setPublish(<?php echo $p->ID ?>);">Gör publik</a>
                            <?php }?>
                            <?php if ($p->post_status=='publish') {?>
                                <a href="#edit" class="toggle-btn" onclick="setPrivate(<?php echo $p->ID ?>);">Gör privat</a>
                            <?php }?>
                            <a href="<?php echo get_permalink($p) ?>" class="view-btn">Visa Annons</a> 
                        </div>
                    </div>
                    <!-- collapsible -->
                    <button type="button" class="orders-collapsible desktop-styling">Visa beställningar</button>
                    <div class="orders-content">
                        <?php 
                            $args = array(
                                'post_id'     => $p->ID,
                                'order'       => 'DESC',
                                'parent'      => 0
                            );
                            $comments = get_comments($args);
                            $nbr = 1;
                        ?>
                        <!-- On pad/desktop -->
                        <table class="orders-list hide-on-small-and-down">
                            <tr>
                                <th>Nummer</th>
                                <th>Användare</th>
                                <th>Datum</th>
                                <th>Beställning</th>
                            </tr>
                        <?php
                            foreach ($comments as $c) {
                                echo '<tr>';
                                echo '<td>' . $nbr . '</td>';
                                echo '<td>' . $c->comment_author . '</td>';
                                echo '<td>' . $c->comment_date . '</td>';
                                echo '<td>' . $c->comment_content . '</td>';
                                echo '</tr>';
                                $nbr = $nbr+1;
                            };
                        ?>
                        </table>
                        <!-- On mobile -->
                        <div class="orders-list hide-on-med-and-up">
                            <?php 
                                foreach ($comments as $c) {
                            ?>
                            <div type="button" class="orders-collapsible mobile-styling">
                                <p><?php echo $nbr; ?></p>
                                <p><?php echo $c->comment_author; ?></p>
                                <p><?php echo $c->comment_date; ?></p>
                                <p>+</p>
                            </div>

                            <div class="orders-content comment-styling">
                                <?php echo '<p>' . $c->comment_content . '</p>' ?>
                            </div>
                            <?php
                                };
                            ?>
                        </div>
                    </div> 
                </li>                

        <?php
            }        
        ?>
    </ul>
</div>

<script>
    $(document).ajaxStop(function(){
        location.reload();
    })
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
    function setPublish(postID){
     var ajaxurl ="<?php echo admin_url('admin-ajax.php')?>";
     jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'make_post_publish',
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