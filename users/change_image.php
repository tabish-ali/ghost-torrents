<?php

include $_SERVER['DOCUMENT_ROOT'] . '/images-uploading/image_upload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';

session_start();

$image_file = $_FILES['image'];
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];

$notification = null;

if ($image_file['size'] != 0 && $image_file['error'] == 0) {

    // unlink old file

    if ($_SESSION['image'] != "/static/user-images/default-user.svg")
        unlink($_SERVER['DOCUMENT_ROOT'] . $_SESSION['image']);

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/static/user-images/';

    $newFileName = uniqid($username, true)
        . '.' . strtolower(pathinfo($image_file['name'], PATHINFO_EXTENSION));

    $notification = SaveImages::uploadImage($image_file, $newFileName, $target_dir);

    $target_file = '/static/user-images/' . $newFileName;

    UserDatabase::saveImagePath($user_id, $target_file);

    $_SESSION['image'] = $target_file;

    echo $target_file;

} else {

    $notification = "Error uploading image";
}
