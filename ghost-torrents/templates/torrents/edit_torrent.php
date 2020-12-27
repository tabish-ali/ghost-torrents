<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/user-database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/torrents/torrents-database.php';

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
            },
            height: "450",
            content_style: "body { background: #2d2d2d; color: #fff;}",
        });
    </script>


    <script src="/js/edit_torrent.js"></script>

</head>

<body>
    <div class="container mb-5" style="margin-top: 100px;" id="container">
        <?php if ($user["admin"]) : ?>
            <div class="dark-bg rounded" id="container">

                <h4 class="text-light bg-dark p-2 rounded">Update Torrent</h4>

                <div class="torrent-form-div shadow p-3">
                    <div class="form-group p-2">
                        <label for="title" class="text-light">Description</label>
                        <textarea id="description" name="description" cols="30" rows="10" class="form-control form-control-sm"><?php echo $torrent['description']; ?></textarea>
                    </div>

                    <div class="form-group p-2">
                        <label for="" class="text-light">Select Category</label>
                        <select name="category" id="category-box" class="custom-select custom-select-sm dark-bg">
                            <option value="movies">Movies</option>
                            <option value="games">Games</option>
                            <option value="software">Softwares</option>
                            <option value="tv">TV</option>
                            <option value="music">Music</option>
                        </select>
                    </div>
                    <div class="p-2" id="update-div">
                        <button type="submit" id="update-btn" class="btn btn-dark btn-sm">
                            Update
                        </button>
                        <a class="btn btn-sm btn-primary" href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>&name=<?php echo $torrent['name']; ?>">
                            View
                        </a>
                        <br>
                    </div>
                    <hr>
                    <div class="form-group p-2" id="file-div">
                        <label for="title" class="text-light">File</label><br>
                        <input id="torrent-file" value="<?php echo $torrent['file_path']; ?>" name="torrent-file" type="file">
                        <button class="btn btn-sm btn-dark" id="save-file-btn">Save</button>
                        <br>
                    </div>

                </div>
            </div>

        <?php else : ?>
            <div style="text-align: center;">
                <small class="bg-danger text-white p-1 rounded">
                    <b>Only <em>admin</em> can add | edit torrents</b>
                </small>
            </div>
    </div>

<?php endif; ?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php';
?>

</body>

</html>