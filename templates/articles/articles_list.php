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


    <title>Articles</title>


    <script type="text/javascript">
        var articles = <?php echo json_encode($articles_array); ?>;

        var username = "<?php if (!empty($_SESSION))
                            echo $_SESSION['username']; ?>";

        console.log(articles);
    </script>
    <link rel="stylesheet" href="/css/articles_list.css">


</head>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    ?>


    <div class="container mb-4">

        <div class="row">

            <?php foreach ($articles_array as $value) : ?>

                <div class="article-div col-sm-4 mt-1">

                    <h6 class="bg-dark text-white p-1 rounded"><?php echo $value['title'] ?></h6>

                    <div class="mb-2 p-1 border-bottom">
                        <small class="p-2 text-muted">Author:
                            <b><?php echo $value['author']; ?></b>
                        </small>
                        <small class="text-muted">
                            Added:
                            <b><?php echo DateAndTime::time_elapsed_string($value['date']); ?></b>
                        </small>
                    </div>

                    <div class="image-div">
                        <a href="/templates/articles/article.php?article_id=<?php echo $value['id']; ?>">
                            <img class="image-thumbnail" src="<?php echo $value['image_path']; ?>" alt="">
                        </a>
                    </div>

                    <div class="mt-4">
                        <small><?php echo substr($value['content'], 0, 300); ?>...
                            <a href="/templates/articles/article.php?article_id=<?php echo $value['id']; ?>">Read More</a>
                        </small>

                    </div>
                    <hr>

                </div>

                <div style="width: 10px;">

                </div>

            <?php endforeach; ?>

            test


        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>
</body>

</html>