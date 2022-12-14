<?php

/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if (post_password_required())
    return;

$getUser = wp_get_current_user();

if (is_user_logged_in() && get_the_author() == $getUser->display_name) {
?>
    <div class="left-align">
        <a id="navigateBackComments" href="#">Tillbaka till kommentarerna</a>
    </div>

    <div class="comment_flex" >
        <h6 class="white-text">Beställningar</h6>
        <i class="material-symbols-outlined orderButton">close</i>
    </div>
    
    <ul class="comment-list white left-align">

        <?php
        wp_list_comments();
        ?>
    </ul>


    <?php
    if (isset($_GET['replytocom'])) {
        $x = $_GET['replytocom'];

        comment_form(array(
            'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="btn waves-effect waves" />Publicera kommentar</button>',
            'comment_field' => '<textarea class="materialize-textarea white" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>',
            'title_reply' => '',
            'title_reply_to' => 'Lämna en kommentar på ' . $getUser->user_login . '´s beställning <br>',
            'comment_notes_after' => ''
        ));
    }
} else {


    ?>




    <div id="comments" class="comments-area">
        <?php


        if ($getUser->user_login) {
            $currentUser = 'Beställ som ' . $getUser->user_login . '<br> Inte du? <a class="white-text" href=' . wp_logout_url() . '>Byt användare</a> ';
        } else {
            $currentUser = '<a href="#">Logga in för att beställa</a>';
        }

        comment_form(array(
            'logged_in_as' => $currentUser,

            'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="btn waves-effect waves" />Beställ</button>',
            'comment_field' => '<textarea class="materialize-textarea white" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>',
            'title_reply' => '',
            'title_reply_to' => 'Svara',
        )); ?>


        <?php if (have_comments()) : ?>


            <ul class="comment-list white">

                <?php

                $args = array(
                    'post_id' => get_the_ID()
                );
                $com = get_comments($args);

                foreach ($com as $author) {
                    if ($getUser->ID!= $author->user_id) {
                        //Do not show comment
                       
                    } else {
                        echo '<li class="commentsBorder" style="padding:10px 10px;"><span style="border-bottom:1px solid grey;"><strong style="margin-right:20px;">' . $author->comment_author . '</strong>' . $author->comment_date_gmt . '</span><br>' . $author->comment_content . '<br></li>';
                    }
                };


                ?>

                
            </ul><!-- .comment-list -->

            <?php
            // Are there comments to navigate through?
            if (get_comment_pages_count() > 1 && get_option('page_comments')) :
            ?>
                <nav class="navigation comment-navigation" role="navigation">
                    <h1 class="screen-reader-text section-heading"><?php _e('Comment navigation', 'twentythirteen'); ?></h1>
                    <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'twentythirteen')); ?></div>
                    <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentythirteen')); ?></div>
                </nav><!-- .comment-navigation -->
            <?php endif; // Check for comment navigation 
            ?>

            <?php if (!comments_open() && get_comments_number()) : ?>
                <p class="no-comments"><?php _e('Comments are closed.', 'twentythirteen'); ?></p>
            <?php endif; ?>

        <?php endif; // have_comments() 
        ?>


    </div><!-- #comments -->

<?php }
