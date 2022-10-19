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

</html>