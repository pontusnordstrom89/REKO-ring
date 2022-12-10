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
        <p>REKO-Ring Lund är en köp- och säljplattform utan mellanhänder skapad för att erbjuda en hållbar produktion för producenten, samt erbjuda klimatsmarta och kvalitativa varor till rimliga priser för konsumenten.</p>
        <div class="hero-buttons">
            <button class="hero-cta" onClick="window.location.href='<?php echo get_category_link(1) ?>'">Besök Shoppen</button>
            <button class="hero-secondary" onClick="window.location.href='#';">Mer om oss</button>
        </div>
    </div>
    <div class="hero-image">
        <img src="https://cdn.discordapp.com/attachments/915592769764986881/1031936745031344168/Farmer_2x.png" />
    </div>
</div>

<div class="product">
    <div class="product-content container">
        <?php
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.   
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL   
        $url .= $_SERVER['REQUEST_URI'];

        //echo $url;
        //echo network_site_url();

        if ($url === network_site_url()) { ?>

            <h1 class="hero-color" id="about-reko">Om REKO</h1>
            <p>REKO står för Rejäl Konsumtion och är ett sätt att handla lokalproducerad mat, helt utan mellanhänder. Konsumenter och producenter på en ort går samman och startar en REKO-ring där råvaror och produkter säljs direkt från producent till konsument. Enkelt och genialt!</p>
            <p>REKO är lokal mat blandat med förtroende, glädje och engagemang. REKO är en förkortning av rejäl konsumtion, men REKO betyder också schysst, trevligt och rättvist. I REKO-ringen skapas relationer mellan de som föder upp och odlar vår mat och de som sen tillagar och äter den. Frågor om hur djuren har fötts upp blandas med tips och recept på säsongens råvaror. Köpare och säljare får kontakt med varandra oftast genom Facebookgrupper. I gruppen får köparen veta vilka varor som finns i den lokala REKO-ringen och hur man gör för att beställa. Där finns också all information om var och när de beställda varorna hämtas och hur betalningen går till. Alla affärer görs upp i förväg. Det är inte ett krav att vara medlem i gruppen på Facebook för att handla genom i Reko-ring, huvudsaken är att affären är uppgjord i förväg.</p>
            <h4><a class="hero-color reko-site-link" href="https://hushallningssallskapet.se/forskning-utveckling/reko/">Här kan du läsa mer om vad REKO innebär</a></h4>
        <?php
        } else { ?>


            <h2>Våra producenter</h2>
            <div class="products">
                <?php
                $posts = get_posts(array(
                    'numberposts' => 6,
                    'orderby' => 'rand',
                    'post_status' => 'publish'
                ));

                if (count($posts) > 1) {

                    foreach ($posts as $post) {
                        // Post Content here 
                ?>
                        <div class="post">
                            <?php
                            $images = get_attached_media('image', $post);
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
                                <button class="post-button" onClick="window.location.href='<?php the_permalink() ?>'">Besök producent</button>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p>Inga posts är gjorda ännu</p>
                <?php
                }
                ?>
            </div>
        <?php
        }

        ?>
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
                <div class="collapsible-body"><span>Under utveckling, relevanta frågor och svar kommer inom kort.</span></div>
            </li>
            <li>
                <div class="collapsible-header collapsible-closed">
                    <p>Är allt närodlat?</p>
                    <i class="material-icons white-text">add</i>
                </div>
                <div class="collapsible-body"><span>Under utveckling, relevanta frågor och svar kommer inom kort.</span></div>
            </li>
            <li>
                <div class="collapsible-header collapsible-closed">
                    <p>Var hämtar jag ut mina varor?</p>
                    <i class="material-icons white-text">add</i>
                </div>
                <div class="collapsible-body"><span>Under utveckling, relevanta frågor och svar kommer inom kort.</span></div>
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