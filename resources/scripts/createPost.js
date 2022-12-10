
// adds a progressbar to modal after submit
let newPostFormSubmit = document.getElementById('submit_my_image_upload')
newPostFormSubmit.addEventListener('click', function (event) {
    
    // Get required form input fields

    let title = document.getElementById('title')
    let text = document.getElementById('my_image_upload')

    // Check valivity
    let x = title.checkValidity()
    let y = text.checkValidity()
    
    // If valid
    if (x && y) {
        document.getElementById('createPostLoader').style.display = 'block';
    }

})