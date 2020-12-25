$(document).ready(function () {

    var user_comments = [];

    const seeders_tag = document.getElementById('seeders');

    const completed_tag = document.getElementById('completed');

    const leechers_tag = document.getElementById('leechers');

    const comments_input = document.getElementById('comments-input');

    const comment_btn_icon = document.getElementById('comment-btn-icon');

    const comment_btn = document.getElementById('comment-btn');

    const comments_div = document.getElementById('comments-div');

    torrent_comments_obj.forEach(comment => {
        // return true if it was user own comment
        setCommentNode(comment.comment,
            comment.username,
            comment.user_image,
            comment.time_lapsed,
            comment.date,
            comment.comment_id);
    });

    comment_btn.addEventListener("click", function () {

        comment_btn.disabled = true;
        comment_btn_icon.className = "fa fa-spinner fa-spin";

        setTimeout(insertComment, 1000);
    }
    );

    comments_input.addEventListener("input", function (e) {

        if (comments_input.value === "") {

            comment_btn.disabled = true;
        }
        else {
            comment_btn.disabled = false;
        }
    });


    function deleteComment(comment) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this comment!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/torrents/delete-comments.php",
                        data: {
                            torrent_id: torrent_id,
                            comment_id: comment.comment_id,
                        },
                        dataType: "json",
                        type: "post",
                        success: function (data) {

                            var response = data['response'];

                            if (response == "success") {

                                comments_div.removeChild(comment.comment_div);
                                total_comments--;
                                document.getElementById('comments-count').innerHTML = total_comments;

                                console.log(total_comments);
                            }

                            console.log(data);

                        }

                    });

                    swal("Your comment has been deleted!", {
                        icon: "success",
                    });

                } else {

                }
            });


    }

    function insertComment() {
        comments = comments_input.value.replace(/\n/g, "<br>");
        if (username != "") {
            total_comments++;
            document.getElementById('comments-count').innerHTML = total_comments;
            $.ajax({
                url: "/torrents/insert-comments.php",

                data: {
                    comments: comments,
                    torrent_id: torrent_id,
                    username: username,
                    user_image: user_image,
                },

                dataType: "json",
                type: "post",

                success: function (data) {

                    setCommentNode(data['comments'],
                        data['username'],
                        user_image,
                        data['added'],
                        data['date'],
                        data['comment_id']);

                    comment_btn_icon.className = "fas fa-comment";

                    comment_btn.disabled = false;
                }
            });
        }

        else {
            swal("Currently you are not logged in.\n Please loginc or register to use this feature", {
                buttons: {
                    login: "Login",
                    register: "Register",
                },
            })
                .then((value) => {
                    switch (value) {

                        case "login":
                            window.location.href = '/templates/auth/login.php';
                            break;

                        case "register":
                            window.location.href = '/templates/auth/sign_up.php';
                            break;

                    }
                });

            comment_btn_icon.className = "fas fa-comment";

            comment_btn.disabled = false;
        }
    }

    function setCommentNode(comments,
        commented_username,
        user_image,
        added,
        date,
        comment_id) {

        comments = comments.replace(/\n/g, "<br>");

        ///////////////////////////////////////////////////////////////////

        var user_avatar = document.createElement('img');

        user_avatar.src = user_image;

        user_avatar.style = "height:25px; width:25px; border-radius:50px";

        var username_text = document.createElement("small");

        username_text.className = 'ml-2';

        username_text.appendChild(document.createTextNode(commented_username));

        var add_text = document.createElement("small");

        add_text.appendChild(document.createTextNode(added));

        add_text.className = "ml-1 text-muted";

        var username_div = document.createElement("username-div");
        
        username_div.appendChild(user_avatar);

        username_div.appendChild(username_text);

        username_div.appendChild(add_text);

        ///////////////////////////////////////////////////////////////////

        var comment_text_div = document.createElement('div');

        comment_text_div.className = "mt-2";

        comment_text_div.style = "padding: 5px 30px 5px 30px";

        var comment_text = document.createElement("small");

        comment_text.innerHTML = comments;

        comment_text_div.appendChild(comment_text);

        /////////////////////////////////////////////////////////////////

        var comment_div = document.createElement('div');

        comment_div.appendChild(username_div);

        comment_div.appendChild(comment_text_div);

        comments_div.appendChild(comment_div);

        comment_div.className = "p-2 rounded mt-1 shadow";

        comment_div.style = "border: 1px solid #2f2f2f";

        if (commented_username == username) {

            var delete_btn = document.createElement('button');

            delete_btn.className = "delete-btn ml-2";

            var delete_icon = document.createElement('i');

            delete_icon.className = "fas fa-trash fa-xs";

            delete_btn.appendChild(delete_icon);

            username_div.appendChild(delete_btn);

            user_comment = {
                'delete_btn': delete_btn,
                'date': date,
                'comment': comments,
                'comment_div': comment_div,
                'comment_id': comment_id,
            };

            user_comments.push(user_comment);

            user_comments.forEach(comment => {

                comment.delete_btn.addEventListener("click", function () {

                    deleteComment(comment);

                    user_comments.pop(comment);

                    torrent_comments_obj.pop(comment);
                });
            });
        }
    }
    $('#copy-hash-btn').click(copyHash);
    function copyHash() {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($('#hash').text()).select();
            document.execCommand("copy");
            $temp.remove();
            iziToast.info({
                title: 'Hash copied',
                message: 'Torrent hash has been copied to your clipboard.',
            });
          
    }

});