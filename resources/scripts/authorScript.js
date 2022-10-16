/**
 * Materialize Initialization for modal
 */

$(document).ready(function () {
    $('.modal').modal();

    // Eventlistener for modal close button
    let closeModal = document.getElementById('closeAuthorModal')
    closeModal.addEventListener('click', function () {
        $('.modal').modal('close');
    });

    // adds a progressbar to modal after submit
    let authorFormSubmit = document.getElementById('authorFormSubmit')
    authorFormSubmit.addEventListener('click', function () {
        document.getElementById('authorFormProgressbar').style.display = 'block';
    })
});


/**
 * Displays image on upload in author form on author.php
 * @param {object} event 
 */
function displayImage(event) {

    try {
        if (event.target.id === "profile_picture_upload") {
            
            var output = document.getElementById('display_new_profile_picture');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    } catch (error) {
        console.error(error);
    }
};


//On image upload check filesize. IF > 1MB prevent formsubmission
$('#profile_picture_upload').bind('change', function () {
    // Clear text and enable button
    $('#authorImageUploadInfoText').text('')
    $("#authorFormSubmit").prop("disabled", false);

    // 1000000 byte == 1MB
    if (this.files[0].size > 1000000) {
        // inform user
        $('#authorImageUploadInfoText').css("color", "red").text('Filen är för stor, använd en annan bild eller förminska bilden');
        // Disable submit button
        $("#authorFormSubmit").prop("disabled", true);
    } else {
        // Within limit
        $('#authorImageUploadInfoText').css("color", "green").text('Filen är godkänd');
    }

});
