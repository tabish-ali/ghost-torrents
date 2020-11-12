<!DOCTYPE html>
<html lang="en">

<head>
    <title>Torrents List</title>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>

</head>

<body>
    <?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
    include_once  $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

    $torrents = TorrentsDatabase::getDesiredTorrents("games");

    ?>

    <div class="container-fluid">

    </div>


</body>

</html>