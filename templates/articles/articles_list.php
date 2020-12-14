<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

    $articles = ArticlesDatabase::getArticles();

    $articles_array = array();

    while ($value = $articles->fetch_assoc()) {

        array_push($articles_array, $value);
    }

    ?>


    <title>Ghost | Articles</title>


    <script type="text/javascript">
        var articles = <?php echo json_encode($articles_array); ?>;

        var username = "<?php if (!empty($_SESSION))
                            echo $_SESSION['username']; ?>";

    </script>

    <link rel="stylesheet" href="/css/articles_list.css">


</head>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    ?>

    <div class="container" style="margin-top: 100px;" id="container">

        <div id="main">
            <div class="row m-1 mb-5">
                <?php foreach ($articles_array as $value) : ?>
                    <div class="col-sm-12">
                        <div class="card mb-3 dark-bg">
                            <a id="article-img" href="/templates/articles/article.php?article_id=<?php echo $value['id']; ?>">
                                <img class="card-img-top" id="article-img" src="<?php echo $value['image_path']; ?>" alt="">
                            </a>

                            <div class="card-body">
                                <h5 class="card-title text-light"><?php echo $value['title'] ?></h5>

                                <a class="btn btn-dark btn-sm" href="/templates/articles/article.php?article_id=<?php echo $value['id']; ?>">Read More</a>

                                <hr>
                                <p class="card-text text-light">
                                    <small class="text-muted">Added <?php echo DateAndTime::time_elapsed_string($value['date']); ?></small>

                                    <small class="text-muted"> by
                                        <a href="/templates/users/user.php?username=<?php echo $value['author']; ?>">
                                            <b><?php echo $value['author']; ?></b>
                                        </a>
                                    </small>

                                </p>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>
</body>

</html>