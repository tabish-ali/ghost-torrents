<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

$trackers = $_POST['trackers'];
$hash = $_POST['hash'];
$torrent_id = $_POST['torrent_id'];

$peers_info = TorrentsDatabase::getPeersInfo($hash, $trackers);

// update the peers in database also

TorrentsDatabase::updatePeersInfo($torrent_id, json_encode($peers_info[$hash]));

echo json_encode($peers_info[$hash]);
