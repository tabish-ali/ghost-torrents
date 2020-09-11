<?php

include $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';
include $_SERVER['DOCUMENT_ROOT'] . '/images-uploading/image_upload.php';


$notification = null;
$success_message = "";


if (!empty($_POST['title']) and !empty($_POST['content']) and isset($_POST['add-article-btn'])) {

    if (empty($_SESSION)) {
        session_start();
    }

    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username'];
    $user_id = $_SESSION['id'];
    $image_file = $_FILES['image-file'];

    if ($image_file['size'] != 0 && $image_file['error'] == 0) {

        $newFileName = uniqid('article-image-', true)
            . '.' . strtolower(pathinfo($image_file['name'], PATHINFO_EXTENSION));


        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/static/article-images/";

        $notification = SaveImages::UploadImage($image_file, $newFileName, $target_dir);

        $target_file = "/static/article-images/" . $newFileName;

    }
    else{

        $target_file = "/static/article-images/default.jpg";
    }

    if ($notification == null) {

        $data_array = ArticlesDatabase::saveArticle($title, $content, $author, $target_file);
        $success_message = "Article saved successfully";
    }


}
