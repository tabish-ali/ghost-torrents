<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';

$selected_articles = json_decode($_POST['selected_articles_json']);

ArticlesDatabase::deleteArticles($selected_articles);
