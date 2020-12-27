$(document).ready(function () {

    const show_trackers_btn = document.getElementById('show-trackers-btn');

    const show_icon_trackers = document.getElementById('show-icon-trackers');

    const des_btn = document.getElementById('des-btn');

    const show_files_btn = document.getElementById('show-files-btn');

    const show_comment_btn = document.getElementById('show-comment-btn');


    var show_trackers = "off";

    var show_descripton = "on";

    var show_files = "on";

    var show_comments = "on";


    show_comment_btn.addEventListener("click", function () {

        if (show_comments == "on") {
            $('#comments-div').fadeOut("slow");
            show_comments = "off";
            show_comment_btn.childNodes[1].className = "fas fa-arrow-down";
        }
        else {
            $('#comments-div').fadeIn("slow");
            show_comments = "on";
            show_comment_btn.childNodes[1].className = "fas fa-arrow-up";

            $('html,body').animate({
                scrollTop: $("#comments-div").offset().top
            },
                'slow');
        }

    });

    show_trackers_btn.addEventListener("click", showTrackers);

    des_btn.addEventListener("click", function () {

        if (show_descripton == "on") {
            $('#description-text').fadeOut("slow");
            show_descripton = "off";
            des_btn.childNodes[1].className = "fas fa-arrow-down";

        } else {
            $('#description-text').fadeIn("slow");
            show_descripton = "on";

            des_btn.childNodes[1].className = "fas fa-arrow-up";

        }
    });

    show_files_btn.addEventListener("click", function () {

        if (show_files == "on") {
            $('#files-div').fadeOut("slow");
            show_files = "off";
            show_files_btn.childNodes[1].className = "fas fa-arrow-down";

        } else {
            $('#files-div').fadeIn("slow");
            show_files = "on";

            show_files_btn.childNodes[1].className = "fas fa-arrow-up";

        }
    });

    function showTrackers() {

        if (show_trackers == "off") {
            $('#trackers-div').fadeIn("slow");
            show_trackers = "on";
            show_icon_trackers.className = "fas fa-arrow-up"

            $('html,body').animate({
                scrollTop: $("#trackers-div").offset().top
            },
                'slow');
        }
        else {
            $('#trackers-div').fadeOut("slow");
            show_trackers = "off";
            show_icon_trackers.className = "fas fa-arrow-down"
        }
    }



});