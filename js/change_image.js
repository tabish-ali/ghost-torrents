$(document).ready(function (e) {

    var save_image_btn = document.getElementById('save-image-btn');

    $("#image-upload-form").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "/users/change_image.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                //$("#preview").fadeOut();
                $("#notification1").fadeOut();
            },
            success: function (data) {
                if (data == 'invalid') {
                    // invalid file format.
                    $("#notification1").html("Invalid File !").fadeIn();
                }
                else {
                    // view uploaded file.

                    save_image_btn.style = "display:none";
                    document.getElementById("nav-img").src = data; 
                    $("#image-upload-form")[0].reset();
                    console.log(data);
                  
                    iziToast.success({
                        title: 'OK',
                        message: 'Image changed successfully!',
                    });

                }
            },
        });
    }));


    document.getElementById('image-file-input').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById('out-image').src = fr.result;
            }
            fr.readAsDataURL(files[0]);
            $('#save-image-btn').fadeIn("slow");
        }

        // Not supported
        else {
            // fallback -- perhaps submit the input to an iframe and temporarily store
            // them on the server until the user's session ends.
        }
    }


    // function uploadImage() {

    //     $('#image-upload-form').on('submit', (function (e) {
    //         e.preventDefault();
    //         var formData = new FormData(this);

    //         console.log(formData);

    //         $.ajax({
    //             type: 'POST',
    //             url: '/users/change_image.php',
    //             data: formData,
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             success: function (data) {
    //                 console.log("success");
    //                 console.log(data);
    //             },
    //             notification1or: function (data) {
    //                 console.log("notification1or");
    //                 console.log(data);
    //             }
    //         });
    //     }));
    // }


});