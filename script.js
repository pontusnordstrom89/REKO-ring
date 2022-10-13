function displayImage(event) {

    

    try {
        if (event.target.id === "profile_picture_upload") {
            console.log('Upload')
            var output = document.getElementById('display_new_profile_picture');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    } catch (error) {
        console.error(error);
        var output = document.getElementById('output2');
        output.src = document.getElementById('product_image_from_gallery_url').value;

    }


};