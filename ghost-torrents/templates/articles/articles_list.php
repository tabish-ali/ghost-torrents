<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/config/datetime.php';
    $_GET['type'] = "articles";


    ?>
    <title>Ghost | Articles</title>
    <link rel="stylesheet" href="/css/articles_list.css">
</head>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    ?>

    <div class="container-fluid" style="margin-top: 100px;">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/config/pagination.php';
        $articles_array = array();

        while ($value = $articles->fetch_assoc()) {

            array_push($articles_array, $value);
        }

        ?>
        <script type="text/javascript">
            var articles = <?php echo json_encode($articles_array); ?>;

            var username = "<?php if (!empty($_SESSION))
                                echo $_SESSION['username']; ?>";
        </script>
    </div>

    <div class="container" id="container">
        <div id="main">
            <div class="row">
                <?php foreach ($articles_array as $value) : ?>
                    <div class="col-sm-4 mt-2">
                        <center class="p-2 dark-bg">
                            <a id="article-img" href="/templates/articles/article?article_id=<?php echo $value['id']; ?>">
                                <img id="article-img" src="<?php echo $value['image_path']; ?>" alt="">
                            </a>
                            <h5 class="mt-2 card-title text-light"><?php echo $value['title'] ?></h5>

                            <small class="text-muted">Added <?php echo DateAndTime::time_elapsed_string($value['date']); ?></small>

                            <small class="text-muted"> by
                                <a href="/templates/users/user?username=<?php echo $value['author']; ?>">
                                    <b><?php echo $value['author']; ?></b>
                                </a>
                            </small>
                            <a class="mt-2 btn btn-block btn-dark btn-sm" href="/templates/articles/article?article_id=<?php echo $value['id']; ?>">Read More</a>
                        </center>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>
</body>

</html>