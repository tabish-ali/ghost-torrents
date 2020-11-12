$(document).ready(function () {

    var title_input = document.getElementById("title");
    var content_input = document.getElementById("content");
    var save_image_btn = document.getElementById("save-image-btn");

    console.log(old_image_path);

    document.getElementById("update-content-btn").addEventListener("click", updateArticle);

    function updateArticle() {

        var updated_title = title_input.value;
        var updated_content = content_input.value;

        console.log(updated_content);

        $.ajax({
            data: { article_id: article_id, title: updated_title, content: updated_content },
            type: 'POST',
            url: '/articles/update-article.php',
            header: 'Content-type:appSMALLction/json',

            success: function (data) {

                iziToast.success({
                    title: 'OK',
                    message: 'Article updated successfully!',
                });

            }
        });
    }

    document.getElementById('article-img-input').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById('out-img').src = fr.result;
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

    $("#image-upload-form").on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("article_id", article_id);
        formData.append("old_image_path", old_image_path);

        $.ajax({
            url: "/articles/update-image.php",
            type: "POST",
            data: formData,
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
                    $("#notification").html("Invalid File !").fadeIn();


                }
                else {
                    // view uploaded file.

                    save_image_btn.style = "display:none";
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

});