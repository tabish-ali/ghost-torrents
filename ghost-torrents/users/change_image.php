<?php

include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/images-uploading/image_upload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/user-database.php';

session_start();

$image_file = $_FILES['image'];
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];

$notification = null;

if ($image_file['size'] != 0 && $image_file['error'] == 0) {

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/static/user-images/';

    $newFileName = uniqid($username, true)
        . '.' . strtolower(pathinfo($image_file['name'], PATHINFO_EXTENSION));

    $notification = SaveImages::uploadImage($image_file, $newFileName, $target_dir);

    if (!empty($notification)) {
        echo json_encode((array)$notification);
    } else {
        if ($_SESSION['image'] != "/ghost-torrents/static/user-images/default-user.svg")
            unlink($_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.$_SESSION['image']);
        $target_file = '/ghost-torrents/static/user-images/' . $newFileName;
        UserDatabase::saveImagePath($user_id, $target_file);
        $_SESSION['image'] = $target_file;
        echo json_encode(["type" => "success", "new_image" => $target_file]);
    }
} else {

    echo json_encode(["error" => "error"]);
}
