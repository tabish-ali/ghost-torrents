<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/user-database.php');

session_start();

$user_id = $_SESSION['id'];
$user_image = $_SESSION['image'];

// unlinking image if its not default

if ($user_image !== "/ghost-torrents/static/user-images/default-user.svg")
    unlink($_SERVER['DOCUMENT_ROOT'] .$user_image);

// deleting account
UserDatabase::deleteAccount($user_id);
session_destroy();
session_unset();
echo ["response" => "success"];
