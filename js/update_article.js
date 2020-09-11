$(document).ready(function () {

    var title_input = document.getElementById("title");
    var content_input = document.getElementById("content");

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

});