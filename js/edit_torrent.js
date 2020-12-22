$(document).ready(function () {

    const update_btn = document.getElementById('update-btn');

    const category = document.getElementById('category-box');

    const save_file_btn = document.getElementById('save-file-btn');

    update_btn.addEventListener("click", editTorrent);

    save_file_btn.addEventListener('click', saveFile);

    // select choice box based on the category

    $('#category-box').val(torrent.category);

    function editTorrent() {
        $.ajax({
            type: 'POST',
            url: '/torrents/edit-torrent.php',
            header: 'Content-type:appSMALLcation/json',
            dataType: 'json',
            data: {
                torrent_id: torrent.id,
                description: tinyMCE.get('description').getContent(),
                category: category.value,
                type: 'text',
            },
            success: function (data) {
                $("#update-div small:last-child").remove();
                var msg = $("<small class='success-label' style='display:none'> " + data["response"] + "</small > ");
                $('#update-div').append(msg);
                msg.fadeIn("slow");
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log("Error: ", errorMessage);
            }

        });
    }

    function saveFile() {

        var file_data = $("#torrent-file").prop("files")[0];
        var form_data = new FormData();
        form_data.append("new_file", file_data);
        form_data.append("old_file_path", torrent.file_path);
        form_data.append("type", 'file');
        form_data.append("torrent_id", torrent.id);

        $.ajax({

            type: "post",
            data: form_data,
            url: "/torrents/edit-torrent.php",
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,

            success: function (data) {

                if (data["response"] === "error") {
                    $("#file-div small:last-child").remove();
                    var msg = $("<small class='danger-label' style='display:none'>Please add a valid file</small > ");
                    $('#file-div').append(msg);
                    msg.fadeIn("slow");
                }
                else {
                    $("#file-div small:last-child").remove();
                    var msg = $("<small class='success-label' style='display:none'> " + data["response"] + "</small > ");
                    $('#file-div').append(msg);
                    msg.fadeIn("slow");
                }
            }
        });
    }

});



