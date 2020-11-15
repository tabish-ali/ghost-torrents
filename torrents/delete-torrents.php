<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

$selected_torrents_ids = json_decode($_POST['selected_torrents_json']);

TorrentsDatabase::deleteTorrents($selected_torrents_ids);
