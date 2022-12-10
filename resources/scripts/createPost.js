




// adds a progressbar to modal after submit
let newPostFormSubmit = document.getElementById('submit_my_image_upload')
newPostFormSubmit.addEventListener('click', function () {

    if ($("#featured_upload").valid()) {
        document.getElementById('createPostLoader').style.display = 'block';
    }
    
})