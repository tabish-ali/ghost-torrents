<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

$username = $_POST['username'];
$torrent_id = $_POST['torrent_id'];
$comments = $_POST['comments'];
$date = date_format(DateAndTime::getDate(), "m/d/Y H:i:s");
$added = DateAndTime::time_elapsed_string($date);
$comment_id = uniqid(md5($date));

TorrentsDatabase::insertComment($torrent_id, $username, $comments, $date, $comment_id);

echo json_encode([
    'username' => $username,
    'torrent_id' => $torrent_id,
    'comments' => $comments,
    'date' => $date,
    'added' => $added,
    'comment_id' => $comment_id,
]);
