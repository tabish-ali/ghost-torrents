<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';

$title = $_POST['title'];
$content = $_POST['content'];
$article_id = $_POST['article_id'];

ArticlesDatabase::updateArticle($article_id, $title, $content);

echo "Article updated - " . $article_id;
