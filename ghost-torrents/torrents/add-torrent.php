<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents' . '/torrents/torrents-database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents' . '/torrents/Torrent.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents' . '/config/size_conversion.php';

if (empty($_SESSION)) {
    session_start();
    $uploader_name = $_SESSION['username'];
}

$description = $_POST['description'];

$torrent_file = $_FILES['torrent-file'];

$category = $_POST['category'];

// saving torrent info to database

$torrent_dir = "/ghost-torrents/static/torrent-statics/torrent-files/";

$target_dir = $_SERVER['DOCUMENT_ROOT']  . $torrent_dir;

$torrent_file_path = TorrentsDatabase::saveTorrentFile($torrent_file, $target_dir);

// getting seeds and leeches info and saving them to database

$torrent_info  = TorrentsDatabase::getTorrentMetaInfo($torrent_file_path);

$torrent_relative_path = $torrent_dir . $torrent_file['name'];

TorrentsDatabase::saveTorrent($uploader_name, $description, $torrent_relative_path, $category);

echo json_encode($target_dir);
