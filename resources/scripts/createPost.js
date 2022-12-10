




// adds a progressbar to modal after submit
let newPostFormSubmit = document.getElementById('submit_my_image_upload')
newPostFormSubmit.addEventListener('click', function () {

    document.getElementById('createPostLoader').style.display = 'block';

    var testSleep = function () {
        setTimeout(function () {
            document.getElementById('createPostLoader').style.display = 'none';
        }, 5000);
    }

    testSleep();

})