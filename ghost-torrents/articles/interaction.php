<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/articles/articles-database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/config/datetime.php';

session_start();

$article_id = $_POST['article_id'];
$username = $_SESSION['username'];
$status = $_POST['status'];
$command = $_POST['command'];

$date = date_format(DateAndTime::getDate(), "m/d/Y H:i:s");
$interact_id = uniqid(md5($date));

$interaction = array(
    "username" => $username,
    "status" => $status,
    "interact_id" => $interact_id
);

$interaction = json_encode($interaction);

ArticlesDatabase::setInteraction($article_id, $interaction, $status, $command, $username);

// echo $command . "----" . $status;
