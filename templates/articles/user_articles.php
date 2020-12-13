<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ghost | My Articles</title>


    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

    if (!empty($_SESSION))
        $articles = ArticlesDatabase::getUserArticles($_SESSION['username']);

    $articles_array = array();

    while ($row = $articles->fetch_assoc()) {

        array_push($articles_array, $row);
    }

    ?>

    <link rel="stylesheet" href="/css/user_articles.css">

    <script>
        var articles = <?php echo json_encode($articles_array); ?>;
    </script>

    <script type="text/javascript" src="/js/user_articles.js"></script>

</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    $serial = 0;
    ?>

    <div class="container-fluid" style="margin-top: 100px;" id="container">

        <div id="main">
            <?php if (!empty($_SESSION)) : ?>

                <div class="p-1 shadow-sm action-btn-bar">
                    <button class="btn btn-sm btn-danger" disabled id="delete-btn">Delete</button>
                </div>

                <div class="table-table-responsive">
                    <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="articles-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"><input type="checkbox" id="select-all-choicebox"></th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($articles_array as $article) : ?>

                                <tr>
                                    <td width=5% class="small">
                                        <input class="dark-check-box" type="checkbox">
                                    </td>

                                    <td class="small"><b><a class="primary-label" href="/templates/articles/article.php?title=<?php echo $article['title']; ?>&article_id=<?php echo $article['id']; ?>"><?php echo $article['title'] ?></b></a></td>

                                    <td class="small">

                                        <b class="bg-success text-white p-1 rounded">
                                            <?php
                                            $date_time = explode(" ", $article['date']);
                                            $date = $date_time[0];
                                            echo $date;
                                            ?>
                                        </b>
                                    </td>

                                    <td class="small">
                                        <b class="bg-primary text-white p-1 rounded"><?php echo DateAndTime::time_elapsed_string($article['date']); ?></b>
                                    </td>

                                    <td width=5% class="small"><a href="/templates/articles/update_article.php?title=<?php echo $article['title']; ?>&article_id=<?php echo $article['id']; ?>" class="p-2 edit-btn small" href="#">Edit</a></td>

                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else : ?>

                <div class="alert alert-primary" style="text-align: center;" role="alert">
                    Please login to see your articles...
                </div>

                <div style="text-align: center;" class="shadow-sm p-1">
                    <a href="/templates/auth/login.php" class="btn btn-sm btn-primary">Login</a>
                    <a href="/templates/auth/sign_up.php" class="btn btn-sm btn-success">Register</a>
                </div>

            <?php endif ?>

        </div>

    </div>

</body>

</html>