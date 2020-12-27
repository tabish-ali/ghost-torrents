<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>

    <title>Add Torrent</title>


    <script src="https://cdn.tiny.cloud/1/x0ijlg4e0a2wemrzk658tg7n867slze12uejhcy58nd16soc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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

    <script src="/js/add_torrent.js"></script>

</head>

<body>
    <?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';


    $user = UserDatabase::getUserById($_SESSION['id']);

    ?>
    <div class="container" style="margin-top: 100px; margin-bottom: 30px;" id="container">

        <div id="main">
            <?php if ($user["admin"]) : ?>

                <form id="torrent-upload-form" method="post" enctype="multipart/form-data">
                    <div class="torrent-form-div dark-bg p-3 shadow">

                        <h3 class="header p-2 text-light">Add Torrent</h3>
                        <div class="form-group p-2">
                            <label for="title" class="text-light">Description</label>
                            <textarea id="description" name="description" id="description" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="p-1">
                                <label for="title" class="text-light">File</label> <br>
                                <input name="torrent-file" class="p-1 border-dark" type="file" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group p-2">
                            <label class="text-light" for="">Select Category</label>
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
                            <button type="submit" id="add-btn" class="btn btn-primary">
                                <i id="submit-icon" class="fa fa-save"></i>
                                Submit
                            </button>
                        </div>

                    </div>

                </form>

                <small id="notification" style="display: none;"></small>

            <?php else : ?>

                <center>
                    <small class="bg-danger text-white p-1 rounded">
                        <b>Only admin can add torrents</b>
                    </small>
                </center>


            <?php endif; ?>
        </div>
    </div>
</body>

</html>