<?php

/**
 * The footer.
 *
 * This is the template that closes body.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * 
 */
?>

</div> <!-- Opened in header -->

        <footer class="page-footer custom-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Utlämning</h5>
                <p class="white-text text-lighten-1">Fredagar 17:15-18:00</p>
                <p class="white-text text-lighten-1">Fackklubbsvägen 2</p>
                <p class="white-text text-lighten-1">Värpinge gårdsbutik/golfbanas parkering</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Länkar</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="https://www.facebook.com/groups/652752628264300">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Länk 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Länk 3 </a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Länk 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2022 Copyright Text
            </div>
          </div>
        </footer>


<?php
/**
 * wp_footer is a core function that other functions can be hooked into. 
 * In functions.php we use --> add_action('wp_enqueue_scripts', 'theme_add_style_script'); <--
 * wp_enqueue_scripts hooks into wp_head and wp_footer and enques scripts & styles
 * @link https://developer.wordpress.org/reference/hooks/wp_head/
 */
wp_footer();
?>


</body>
    <!-- Body starts here -->

 
</html>