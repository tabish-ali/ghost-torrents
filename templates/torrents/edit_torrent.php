<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>

    <title>Add Torrent</title>

    <script src="/js/edit_torrent.js"></script>

</head>

<body>
    <?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

    $user = UserDatabase::getUserById($_SESSION['id']);

    $torrent = TorrentsDatabase::getTorrent($_GET['torrent_id']);

    ?>

    <?php

    if ($user["admin"]) : ?>

        <div class="container mt-5 mb-5" id="container">

            <div class="dark-bg rounded" id="container">

                <h4 class="text-light bg-dark p-2 rounded">Update Torrent</h4>
                
                <form id="torrent-edit-form" method="post" enctype="multipart/form-data">

                    <div class="torrent-form-div shadow p-3">
                        <div class="form-group p-2">
                            <label for="title" class="text-light">Description</label>
                            <textarea id="description" name="description" id="description" cols="30" rows="5" class="form-control form-control-sm"><?php echo $torrent['description']; ?></textarea>
                        </div>

                        <div class="form-group p-2">

                            <label for="title" class="text-light">File</label><br>
                            <input value="<?php echo $torrent['file_path']; ?>" 
                            name="torrent-file" type="file">

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

                        <hr>

                        <div class="form-group p-2">
                            <button type="submit" id="update-btn" class="btn btn-primary btn-sm">
                                <i id="submit-icon" class="fa fa-save"></i>
                                Update
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    <?php else : ?>

        <center>
            <small class="bg-danger text-white p-1 rounded">
                <b>Only admin can add torrents</b>
            </small>
        </center>


    <?php endif; ?>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';
    ?>

</body>

</html>