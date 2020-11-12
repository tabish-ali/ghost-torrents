<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';
include $_SERVER['DOCUMENT_ROOT'] . '/images-uploading/image_upload.php';

$image_file = $_FILES['image'];
$article_id = $_POST['article_id'];
$old_image_path = $_POST['old_image_path'];

$notification = null;


if ($image_file['size'] != 0 && $image_file['error'] == 0) {

    //deleting old image first

    if ($old_image_path != "/static/article-images/default.jpg")
        unlink($_SERVER['DOCUMENT_ROOT'] . $old_image_path);

    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/static/article-images/';

    $newFileName = uniqid($article_id, true)
        . '.' . strtolower(pathinfo($image_file['name'], PATHINFO_EXTENSION));

    $notification = SaveImages::uploadImage($image_file, $newFileName, $target_dir);

    $target_file = '/static/article-images/' . $newFileName;

    ArticlesDatabase::updateImage($article_id, $target_file);

    echo $target_file;
} else {
}
