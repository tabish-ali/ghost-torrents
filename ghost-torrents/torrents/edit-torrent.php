<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/torrents/torrents-database.php';

$torrent_id = $_POST['torrent_id'];

$type = $_POST['type'];

//updating torrent info
if ($type == "text") {

    $description = $_POST['description'];
    $category = $_POST['category'];

    $torrent = [
        "torrent_id" => $torrent_id,
        "description" => $description,
        "category" => $category,
    ];

    TorrentsDatabase::updateTorrentInfo($torrent);

    echo json_encode(["response" => "Torrent updated successfully."]);

} else {

    $torrent_file = $_FILES['new_file'];
    $old_torrent_file = $_POST['old_file_path'];

    if ($torrent_file['size'] != 0 && $torrent_file['error'] == 0) {

        //deleting old image first

        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/static/torrent-statics/torrent-files/';

        $newFileName = $torrent_file['name'];

        $notification = TorrentsDatabase::saveTorrentFile($torrent_file, $target_dir);

        $target_file = '/static/torrent-statics/torrent-files/' . $newFileName;

        TorrentsDatabase::updateFile($torrent_id, $target_file);

        echo $target_file;
    } else {
        echo json_encode(["response"=>"error"]);
    }
}
