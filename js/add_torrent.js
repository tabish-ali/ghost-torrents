$(document).ready(function (e) {

    const submit_icon = document.getElementById('submit-icon');

    const notification = document.getElementById('notification');

    $("#torrent-upload-form").on('submit', (function (e) {
        e.preventDefault();

        $.ajax({
            url: '/torrents/add-torrent.php',
            data: new FormData(this),
            type: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,

            // beforeSend: function () {
            //     submit_icon.className = "fa fa-spinner fa-spin";
            // },

            success: function (data) {

                submit_icon.className = "fa fa-save";

                notification.innerHTML = "Torrent added successfully";
        
                notification.style = "display: block";

                notification.className ="text-success";

                console.log(data);

            }
        });

    }));

});