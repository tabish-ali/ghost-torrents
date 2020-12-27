<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/config//datetime.php';
    ?>
    <link rel="stylesheet" href="/css/user.css">
</head>

<body>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/user-database.php';

    if (isset($_GET['user_id'])) {
        $user = UserDatabase::getUserById($_GET['user_id']);
    } else {
        $user = UserDatabase::getUserByName($_GET['username']);
    }

    ?>

    <div class="container" style="margin-top: 100px;" id="container">

        <div class="row mt-4" style="margin: 0 auto; width:100%;">
            <div class="user-div p-4 col-sm-12" style="text-align: center;">
                <img class="user-avatar" src="<?php echo $user['image_path']; ?>" alt="">
                <div class="info-div mt-4 px-2">
                    <h3 class="text-light"><?php echo $user['username']; ?></h3>
                    <small class="text-muted"><?php echo $user['intro']; ?></small>
                </div>
            </div>


        </div>

    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>

</body>

</html>