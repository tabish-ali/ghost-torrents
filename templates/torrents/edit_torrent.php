<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

    $user = UserDatabase::getUserById($_SESSION['id']);

    $torrent = TorrentsDatabase::getTorrent($_GET['torrent_id']);
    ?>

    <title>Add Torrent</title>

    <script src="https://cdn.tiny.cloud/1/x0ijlg4e0a2wemrzk658tg7n867slze12uejhcy58nd16soc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        var torrent = <?php echo json_encode($torrent); ?>
    </script>

    <script>
        tinymce.init({
            selector: '#description',
            skin: "oxide-dark",
            content_css: "dark",
            init_instance_callback: function(editor) {
                var freeTiny = document.querySelector('.tox .tox-notification--in');
                freeTiny.style.display = 'none';
            }
        });
    </script>


    <script src="/js/edit_torrent.js"></script>

</head>

<body>


    <?php

    if ($user["admin"]) : ?>

        <div class="container mt-5 mb-5" id="container">

            <div class="dark-bg rounded" id="container">

                <h4 class="text-light bg-dark p-2 rounded">Update Torrent</h4>

                <div class="torrent-form-div shadow p-3">
                    <div class="form-group p-2">
                        <label for="title" class="text-light">Description</label>
                        <textarea id="description" name="description" cols="30" rows="5" class="form-control form-control-sm"><?php echo $torrent['description']; ?></textarea>
                    </div>

                    <div class="form-group p-2">
                        <label for="" class="text-light">Select Category</label>
                        <select name="category" id="category-box" class="custom-select custom-select-sm dark-bg">
                            <option value="movies" selected>Movies</option>
                            <option value="games">Games</option>
                            <option value="software">Softwares</option>
                            <option value="tv">TV</option>
                            <option value="music">Music</option>
                        </select>
                    </div>
                    <div class="p-2">
                        <button type="submit" id="update-btn" class="btn btn-dark btn-sm">
                            Update
                        </button>
                    </div>
                    <hr>
                    <div class="form-group p-2">

                        <label for="title" class="text-light">File</label><br>
                        <input id="torrent-file" value="<?php echo $torrent['file_path']; ?>" name="torrent-file" type="file">
                        <button class="btn btn-sm btn-dark" id="save-file-btn">Save</button>
                    </div>

                </div>
            </div>
        </div>
    <?php else : ?>

        <small class="bg-danger text-white p-1 rounded">
            <b>Only admin can add torrents</b>
        </small>


    <?php endif; ?>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';
    ?>

</body>

</html>