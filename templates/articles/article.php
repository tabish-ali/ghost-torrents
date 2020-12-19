<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="/css/article.css">

    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/articles/show_article.php';
    $article = ArticlesDatabase::getArticle($_GET['article_id']);
    ?>

    <script>
        var article = <?php echo json_encode($article->fetch_assoc()); ?>;
        var username = "<?php if (!empty($_SESSION)) {
                            echo $_SESSION['username'];
                        }
                        ?>";
    </script>

    <script src="/js/like_article.js"></script>
</head>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    ?>
    <div class="container" style="margin-top: 100px;" id="container">
        <div class="row mb-5 dark-bg p-2 m-1">
            <?php foreach ($article as $key) : ?>
                <div class="col-sm-12">
                    <h3 style="background-color: rgb(46, 46, 46);" class="text-light p-2 rounded mt-2"><?php echo $key['title'] ?></h3>
                    <img id="article-img" src="<?php echo $key['image_path']; ?>" alt="">
                    <title><?php echo $key['title'] ?></title>
                    <p class="card-text text-light">
                        <?php echo $key['content']; ?>
                    </p>
                    <hr>
                    <div class="action-div mt-3 rounded">
                        <Button class="btn btn-sm btn-default text-light" id="like-btn"><i class="fa fa-thumbs-up"></i></Button>
                        <strong class="text-light" id="likes-count"> </strong>
                        <Button class="btn btn-sm btn-default ml-2 text-light" id="unlike-btn"><i class="fa fa-thumbs-down"></i></Button>
                        <strong class="text-light" id="unlikes-counter"></strong>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';

?>


</html>