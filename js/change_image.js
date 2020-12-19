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
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (data) {
                $("#msg-div").html("");
                if (data === 'error') {
                    // invalid file format.
                    $("#msg-div").append("<small style='display:none;' class='text-danger' id='msg' > Invalid file.</small>");
                }
                else if (data['type'] === "success") {
                    // view uploaded file.
                    save_image_btn.style = "display:none";
                    document.getElementById("nav-img").src = data['new_image'];
                    $("#image-upload-form")[0].reset();
                    $('#msg-div').append("<small style='display:none;' class='text-success' id='msg' >Profile avatar change successfully.</small>");
                }
                else {
                    for (var key in data) {
                        if (data.hasOwnProperty(key)) {
                            $('#msg-div').append("<small style='display:none;' class='text-danger' id='msg' >" + data[key] + "</small><br>").fadeIn();
                        }
                    }
                }
                $('#msg').fadeIn("slow");

                setTimeout(function () {
                    $('#msg').fadeOut("slow");
                }, 5000);

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