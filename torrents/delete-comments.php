<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

// deleteing comments on basis of exact date and torrent_id

$comment_id = $_POST['comment_id'];
$torrent_id = $_POST['torrent_id'];


$comment_pos = TorrentsDatabase::getCommentsPos($torrent_id, $comment_id);

TorrentsDatabase::deleteComment($torrent_id, $comment_pos);

echo json_encode(["response" => "success"]);
