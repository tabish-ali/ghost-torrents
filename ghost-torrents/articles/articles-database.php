<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents' . '/db-config/db-connection.php';

class ArticlesDatabase
{

    public static function saveArticle($title, $content, $author, $image_path)
    {

        $conn = DBConnection::getConnection();

        $date = date_format(DateAndTime::getDate(), "m/d/Y H:i:s");

        $insert_query = $conn->prepare("INSERT INTO articles (title, content, author,
        image_path, date, interactions)
        VALUES(?,?,?,?,?,JSON_ARRAY())");

        $insert_query->bind_param(
            "sssss",
            $title,
            $content,
            $author,
            $image_path,
            $date
        );

        $insert_query->execute();
        $conn->close();
    }

    public static function getArticles()
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM articles";

        $result = $conn->query($select_query);

        return $result;
    }

    public static function setInteraction($article_id, $interaction, $status, $command, $username)
    {
        $pos = ArticlesDatabase::getInteractPos($article_id, $username);

        if ($status === "liked" and $command === "enter") {

            ArticlesDatabase::setLike($article_id, $interaction);
            ArticlesDatabase::unSetInteractions($article_id, $pos);
        }

        if ($status === "unliked" and $command === "enter") {

            ArticlesDatabase::setLike($article_id, $interaction);
            ArticlesDatabase::unSetInteractions($article_id, $pos);
        } else if ($command === "remove") {

            ArticlesDatabase::unSetInteractions($article_id, $pos);
        }
    }

    public static function setLike($article_id, $interactions)
    {
        $conn = DBConnection::getConnection();

        $insert_query = "UPDATE articles SET
        interactions = JSON_ARRAY_APPEND(interactions, '$', CAST('$interactions' AS JSON))
         WHERE id = $article_id";

        $conn->query($insert_query);

        $conn->close();
    }

    public static function getInteractPos($article_id, $username)
    {
        $conn = DBConnection::getConnection();

        $search_query = "SELECT JSON_SEARCH(interactions, 'all', '$username', NULL, '$[*].username')
        as POS from articles WHERE id = $article_id";

        $result = $conn->query($search_query);

        $interact_pos = $result->fetch_assoc()['POS'];

        $interact_pos = str_replace('"', "", $interact_pos);

        return explode(".", $interact_pos)[0];
    }

    public static function unSetInteractions($article_id, $pos)
    {
        $conn = DBConnection::getConnection();

        $delete_query = "UPDATE articles SET interactions = JSON_REMOVE(interactions, '$pos')
        WHERE id = $article_id";

        $conn->query($delete_query);

        $conn->close();
    }

    public static function getInteractionArray($article_id)
    {
        // $conn = DBConnection::getConnection();

        // $filter = array('_id' => $article_id);

        // $cursor = $conn->php->articles;

        // $interaction_arry = $cursor->find($filter);

        // return $interaction_arry;
    }

    public static function getArticle($article_id)
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM articles WHERE id = $article_id";

        $result = $conn->query($select_query);

        return $result;
    }

    public static function getUserArticles($author)
    {

        $conn = DBConnection::getConnection();

        $select_query = "SELECT * FROM articles WHERE author = '$author'";

        $result = $conn->query($select_query);

        return $result;
    }

    public static function deleteArticles($selected_articles)
    {
        $conn = DBConnection::getConnection();
        foreach ($selected_articles as $article) {
            // unlinking images for deleted articles

            $article = (array) $article;

            if ($article['image_path'] != "/ghost-torrents/static/article-images/default.jpg") {
                unlink($_SERVER['DOCUMENT_ROOT']  . $article['image_path']);
            }

            $article_id = $article['id'];
            $delete_query = "DELETE FROM articles WHERE id = $article_id";
            $conn->query($delete_query);
        }
    }

    public static function updateArticle($article_id, $title, $content)
    {
        $conn = DBConnection::getConnection();

        $update_query = $conn->prepare("UPDATE articles SET title = ?, content = ?
        WHERE id = $article_id");

        $update_query->bind_param("ss", $title, $content);

        $update_query->execute();

        $conn->close();
    }

    public static function updateImage($article_id, $image_path)
    {

        $conn = DBConnection::getConnection();

        $update_query = $conn->prepare("UPDATE articles SET image_path = ? WHERE id = $article_id");

        $update_query->bind_param("s", $image_path);

        $update_query->execute();

        $conn->close();
    }

    public static function getArticlesCount($username)
    {
        $conn = DBConnection::getConnection();
        $count_query = "SELECT count(*) as articles_count FROM articles WHERE author = '$username'";
        $result = $conn->query($count_query);
        return $result->fetch_assoc()['articles_count'];
    }
    public static function totalLikesOnArticle($username)
    {
        $conn = DBConnection::getConnection();
        $count_query = "SELECT interactions FROM articles WHERE author = '$username'";
        $result = $conn->query($count_query);

        if (mysqli_num_rows($result) != 0) {
            return $result->fetch_assoc()['interactions'];
        } else {
            return 0;
        }
    }

    // count total articles for pagination
    public static function countArticles()
    {
        $conn = DBConnection::getConnection();
        $count_query = "SELECT count(*) as total_articles FROM articles";
        $result = $conn->query($count_query);
        return $result->fetch_assoc()['total_articles'];
    }

    // get articles by offset for pagination
    public static function getArticlesByOffset($offset, $total_records_per_page)
    {
        $conn = DBConnection::getConnection();
        $count_query = "SELECT * FROM articles LIMIT $offset, $total_records_per_page";
        $result = $conn->query($count_query);
        return $result;
    }
}
