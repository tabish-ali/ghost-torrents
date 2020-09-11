// this file will load all articles into javascript objects and action buttons related to it
$(document).ready(function () {

    var id;
    var command;
    var like_btn = document.getElementById('like-btn');
    var unlike_btn = document.getElementById('unlike-btn');
    var like_icon = like_btn.firstChild;
    var unlike_icon = unlike_btn.firstChild;
    var interact_status;
    var like_status;
    var unlike_status;
    var likes_count = 0;
    var unlikes_count = 0;
    var likes_counter = document.getElementById('likes-count');
    var unlikes_counter = document.getElementById('unlikes-counter');
    var liked_by_str = "";

    id = article.id;

    var interaction_arry = JSON.parse(article.interactions);

    if (interaction_arry.length > 0) {

        interaction_arry.forEach(element => {

            liked_by_str = element.username;

            interact_status = element.status;

            if (interact_status == "liked") {
                if (liked_by_str == username)
                    like_status = true;
                likes_count++;
            }
            else {
                like_status = false;
            }
            if (interact_status == "unliked") {
                if (liked_by_str == username)
                    unlike_status = true;
                unlikes_count++;
            }
            else {
                unlike_status = false;
            }


        });
    }

    if (username != "")
        setStatus();

    setLikesCount();

    setUnlikesCount();

    like_btn.addEventListener("click", function () {

        if (username != "") {
            interact_status = "liked";

            if (unlike_status) {
                unlike_status = false;
                unlikes_count--;
                setUnlikesCount();
                setStatus();
            }

            toggleLikeStatus();

            setStatus();

            likeArticle(id, interact_status, command);
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
        }

    });

    unlike_btn.addEventListener("click", function () {

        if (username != "") {

            interact_status = "unliked";

            if (like_status) {
                like_status = false;
                likes_count--;
                setLikesCount();
                setStatus();
            }

            toggleUnlikeStatus();
            setStatus();
            likeArticle(id, interact_status, command);
        }
        else {
            swal("Currently you are not logged in.\n Please login or register to use this feature");
        }

    });

    function setLikesCount() {
        likes_counter.innerHTML = likes_count;
    }

    function setUnlikesCount() {
        unlikes_counter.innerHTML = unlikes_count;
    }

    function toggleLikeStatus() {

        if (like_status) {
            command = "remove";
            like_status = false;
            likes_count--;
            setLikesCount();
        }
        else {
            command = "enter";
            like_status = true;
            likes_count++;
            setLikesCount();
        }
    }

    function toggleUnlikeStatus() {


        if (unlike_status) {
            command = "remove";
            unlike_status = false;
            unlikes_count--;
            setUnlikesCount();
        }
        else {
            command = "enter";
            unlike_status = true;
            unlikes_count++;
            setUnlikesCount();
        }
    }

    function setStatus() {

        if (like_status) {
            like_icon.style = "color: #0275d8";
        } else {
            like_icon.style = "color: #292b2c ";
        }
        if (unlike_status) {
            unlike_icon.style = "color:#0275d8";
        }
        else {
            unlike_icon.style = "color:#292b2c ";
        }
    }

    function likeArticle(id, status, command) {


        $.ajax({
            type: 'POST',
            data: { article_id: id, status: interact_status, command: command },
            url: '/articles/interaction.php',
            header: 'Content-type:appSMALLcation/json',
            success: function (data) {

            }

        });

    }

});

