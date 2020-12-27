<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

$selected_torrents = json_decode($_POST['selected_torrents_json']);
TorrentsDatabase::deleteTorrents($selected_torrents);
// echo json_encode(["response" => "success", "selected_torrents" => $selected_torrents]);
?>