<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

// $torrent_id = $_POST['torrent_id'];
$description = $_POST['description'];
$torrent_file = $_FILES['torrent-file'];

$respones = [
    "torrent_id" => $torrent_id,
    "description" => $description,
    "torrent_file" => $torrent_file,
];

echo json_encode($respones);
