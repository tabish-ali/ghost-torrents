<?php

include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/articles/articles-database.php';

$article = ArticlesDatabase::getArticle($_GET['article_id']);
$liked_by = array();

$test = "tabish-liked";

foreach ($article as $val) {

    if (isset($val['interacts'])) {
        foreach ($val['interacts'] as $interact) {

            $liked_by_username = explode("-", $interact);
            array_push($liked_by, $liked_by_username[0]);
        }
    }

}
