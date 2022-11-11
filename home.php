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

<div class="hero">
    <div class="hero-content">
        <h1>En <span class="hero-color">modernare</span> bondens-marknad</h1>
        <p>REKO-Ring Lund är en köp- och säljplattform utan mellanhänder skapad för att erbjuda en hållbar produktion för producenten samt erbjuda klimatsmarta och kvalitativa varor till rimliga priser för konsumenten.</p>
        <div class="hero-buttons">
            <button class="hero-cta" onClick="window.location.href='<?php echo get_category_link(1) ?>">Besök Shoppen</button>
            <button class="hero-secondary" onClick="window.location.href='#';">Mer om oss</button>
        </div>
    </div>
    <div class="hero-image">
        <img src="https://cdn.discordapp.com/attachments/915592769764986881/1031936745031344168/Farmer_2x.png" />
    </div>
</div>

<div class="product">
    <div class="product-content container">
        <h2>Våra producenter</h2>
        <div class="products">
            <?php
            $posts = get_posts(array(
                'numberposts' => 6,
                'orderby' => 'rand'
            ));

            if (count($posts) > 1) {

                foreach ($posts as $post) {
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
                                <p><?php echo get_the_author_meta('first_name', $post->post_author)  ?></p>
                            </div>
                            <div class="post-item">
                                <p class="post-title">Avstånd</p>
                                <p><?php echo get_post_meta(get_the_ID(), "distance_to_delivery")[0] ?> km</p>
                            </div>
                            <button class="post-button" onClick="window.location.href='<?php the_permalink() ?>'">Besök producent</button>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p>Inga posts är gjorna ännu</p>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<div class="faq">
    <div class="faq-content">
        <div class="top">
            <h2>FAQ</h2>
            <p>Vanligt ställda frågor</p>
        </div>
        <ul class="collapsible expandable">
            <li class="active">
                <div class="collapsible-header">
                    <p>Hur betalar jag när jag beställt?</p>
                    <i class="material-icons white-text">remove</i>
                </div>
                <div class="collapsible-body"><span>Fråga Håkan</span></div>
            </li>
            <li>
                <div class="collapsible-header collapsible-closed">
                    <p>Är allt närodlat?</p>
                    <i class="material-icons white-text">add</i>
                </div>
                <div class="collapsible-body"><span>Det hoppas jag!</span></div>
            </li>
            <li>
                <div class="collapsible-header collapsible-closed">
                    <p>Var hämtar jag ut mina varor?</p>
                    <i class="material-icons white-text">add</i>
                </div>
                <div class="collapsible-body"><span>På parkeringen</span></div>
            </li>
        </ul>
    </div>
</div>

<?php
/**
 * get_footer @link https://developer.wordpress.org/reference/functions/get_footer/
 *
 * Looks for footer.php file if no parameter is passed
 */
get_footer(); ?>