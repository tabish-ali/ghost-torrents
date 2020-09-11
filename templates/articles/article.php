<!DOCTYPE html>
<html lang="en">

<head>

    <title>Document</title>

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

    <div class="container mt-5">
        <?php foreach ($article as $key) : ?>

            <div class=" article-div">
                <h4 class="bg-dark text-white p-1 rounded"><?php echo $key['title'] ?></h4>

                <div class="mb-2">
                    <small class="date-tag bg-primary shadow-sm"><?php echo $key['date'] ?></small>
                    <small class="date-tag bg-primary shadow-sm"><?php echo DateAndTime::time_elapsed_string($key['date']); ?></small>
                </div>
                <hr>

                <div class="image-div mb-2">

                    <img class="img-fluid" src="<?php echo $key['image_path']; ?>" alt="">

                </div>
                <hr>

                <div class="paragraph-div">
                    <?php echo $key['content']; ?>
                </div>



                <div class="action-div mt-3">
                    <Button class="btn btn-sm btn-light" id="like-btn"><i class="fa fa-thumbs-up"></i></Button>
                    <strong id="likes-count"> </strong>
                    <Button class="btn btn-sm btn-light ml-2" id="unlike-btn"><i class="fa fa-thumbs-down"></i></Button>
                    <strong id="unlikes-counter"></strong>
                </div>


            </div>


        <?php endforeach; ?>

    </div>

</body>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';

?>


</html>