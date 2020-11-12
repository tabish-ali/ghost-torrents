$(document).ready(function () {

    const update_btn = document.getElementById('update-btn');

    $("#torrent-edit-form").on('submit', (function (e) {
        e.preventDefault();

        console.log($('#torrent-edit-form').serialize());

        $.ajax({

            type: "post",
            data: $('#torrent-edit-form').serialize(),
            url: "/torrents/edit-torrent.php",
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {

                console.log(response);
            }
        });
    }));


});