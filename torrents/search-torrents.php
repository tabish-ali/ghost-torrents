<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

$find_array = array();

$search_result = array();

$search_string = $_POST['search_string'];

$category = $_POST['category'];

if ($category == "all")
    $torrents = TorrentsDatabase::getTorrents(0, TorrentsDatabase::countTotalTorrents("all"));

else
    $torrents = TorrentsDatabase::getTorrentsByCategory(0, TorrentsDatabase::countTotalTorrents($category), $category);

foreach ($torrents as $torrent) {

    if (strpos(strtolower($torrent['name']), strtolower($search_string)) !== false) {

        array_push($find_array, $torrent);
    }
}
foreach ($find_array as $torrent => $val) {

    array_push($search_result, $val);
}

echo json_encode($search_result);
