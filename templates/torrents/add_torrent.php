<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>

    <title>Add Torrent</title>


    <script src="/js/add_torrent.js"></script>

</head>

<body>
    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';

    ?>

    <div class="container mt-5">
        <form id="torrent-upload-form" method="post" enctype="multipart/form-data">
            <div class="torrent-form-div shadow">

                <h3 class="header p-2">Add Torrent</h3>
                <div class="form-group p-2">
                    <label for="title">Description</label>
                    <textarea id="description" name="description" id="description" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                </div>

                <div class="form-group p-2">
                    <div class="border p-1">
                        <label for="title">File</label>
                        <input name="torrent-file" class="p-1" type="file" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="">Select Category</label>
                    <select name="category" id="category-box" class="custom-select custom-select-sm">
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
    </div>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';
    ?>

</body>

</html>