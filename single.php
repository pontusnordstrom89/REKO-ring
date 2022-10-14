<?php 
    // single.php controls a single post from index.php
?>

<?php get_header(); ?>

<?php
    while(have_posts()) {
        the_post(); ?>
            <h2><?php the_title(); ?></h2>
            <?php the_content();?>
            <?php 
            $images = get_attached_media('image' ); // get attached media
            foreach ($images as $image) {
                $ximage =  wp_get_attachment_image_src($image->ID,'medium');
                echo '<img src="' .$ximage[0] . '" style="width:400px;"/>';
            }
            ?>
        <?php
    }

?>

<?php get_footer(); ?>