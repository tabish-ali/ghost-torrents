<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/scraper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/Torrent.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/size_conversion.php';

if (empty($_SESSION)) {
    session_start();
    $uploader_name = $_SESSION['username'];
}

$description = $_POST['description'];

$torrent_file = $_FILES['torrent-file'];

$category = $_POST['category'];

// saving torrent info to database

$torrent_dir = "/static/torrent-statics/torrent-files/";

$target_dir = $_SERVER['DOCUMENT_ROOT'] . $torrent_dir;

$torrent_file_path = TorrentsDatabase::saveTorrentFile($torrent_file, $target_dir);

// getting seeds and leeches info and saving them to database

$torrent_info  = TorrentsDatabase::getTorrentMetaInfo($torrent_file_path);

$scraper = new Scrapeer\Scraper();

$peers_info = $scraper->scrape($torrent_info['hash'], $torrent_info['trackers']);

$peers_info = json_encode($peers_info[$torrent_info['hash']]);

$torrent_relative_path = $torrent_dir . $torrent_file['name'];

TorrentsDatabase::saveTorrent($uploader_name, $description, $torrent_relative_path, $peers_info, $category);

echo json_encode($torrent_info);
