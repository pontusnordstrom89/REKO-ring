$(document).ready(function () {

    /**
     * If we have a new comment
     */
    const haveNewComment = window.location;
    if (haveNewComment.hash.startsWith('#comment')) {
        $('#order-form').show();
        $(`${haveNewComment.hash}`).css('background-color', 'rgba(19, 109, 49, 0.25)')

        for (var i = 0; i < 3; i++) {
            $(`${haveNewComment.hash}`).animate({
                opacity: ".5"
            }, 1000, 'swing').animate({
                opacity: "1"
            }, 1000, 'swing')
        };

    }


    // Hide loader
    $('#commentFormLoader').hide();

    /**
     * Are the user returning from replying to a comment?
     */
    try {
        // Try get stored value in session storage
        const returningCommentor = sessionStorage.getItem('navigateBack');

        // If returning show comments
        if (returningCommentor) {
            $('#order-form').show();

            // Remove saved data from sessionStorage
            sessionStorage.removeItem("navigateBack");
        }
    } catch (error) {
        console.error(error);
        // expected output: ReferenceError: nonExistentFunction is not defined
        // Note - error messages will vary depending on browser
    }

    /**
     * See if this is currently a reply
     */

    // Get url
    const urlParams = new URLSearchParams(window.location.search);

    // Check for parameter (replytocom) and its get value = comment id
    const commentID = urlParams.get('replytocom');

    if (!commentID) {
        /**
         * Not a reply
         */

        // If text was changed, replace with normal text
        $('#orderCommentTitleText').text('Beställningar')

        // Hide link to return to comments
        $('#navigateBackComments').hide();
    } else {
        /**
         * This is a reply
         */

        // Create returnpath to comments
        const currentURL = window.location;

        // Get Origin and pathname and create a url
        const returnPath = currentURL.origin + currentURL.pathname;

        // Display link to return to comments
        $('#navigateBackComments').show();

        // Get a element and set attribute href to returnpath
        $('#navigateBackComments').attr('href', returnPath)

        // Add eventlistener to navigateBackComments link
        $('#navigateBackComments').click(function () {

            // Display loader
            $('#commentFormLoader').show();

            // Save event to session storage
            sessionStorage.setItem("navigateBack", true);
        });


        // Show order form
        $('#order-form').show();

        // Hide all comments
        $('.comment-list').children().hide();

        //Display comment user is replying to
        $(`#comment-${commentID}`).show();

        $('#orderCommentTitleText').text('Svarar på beställning')


        // Add eventlistener to form submit button to show comments on return
        $('#submit').click(function () {

            // Display loader
            $('#commentFormLoader').show();

            // Save event to session storage
            sessionStorage.setItem("navigateBack", true);
        });

    }

});