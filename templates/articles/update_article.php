<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';
    $article = ArticlesDatabase::getArticle($_GET['article_id']);

    foreach ($article as $val) {

        $title = $val['title'];
        $content = $val['content'];
        $image_path = $val['image_path'];
    }

    ?>

    <link rel="stylesheet" href="/css/izi_toast.min.css">
    <script src="/js/izi_toast.min.js" type="text/javascript"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->

    <script>
        var article_id = "<?php echo $_GET['article_id']; ?>";

        // $(document).ready(function() {
        //     $('#content').summernote({
        //         height: 250,
        //     });    });

        var html_str = "<?php echo $content; ?>";

        // $('#content').summernote('code', html_str);

        console.log(html_str);
        
    </script>

    <script src="/js/update_article.js"></script>

</head>

<body>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    ?>

    <div class="container mt-4">

        <div id="alert" style="display: none;" class="alert alert-success" role="alert">

        </div>

        <div class="p-3 border">

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" value="<?php echo $title; ?>" type="text" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" id="" class="form-control form-control-sm" cols="30" rows="10"><?php echo $content; ?></textarea>
            </div>
            <hr>
            <button id="update-content-btn" class="btn btn-primary">Update</button>
            <hr>
            <div class="form-group mt-4">
                <label for="article-image">Image</label><br>
                <img id="article-image" name="article-image" style="height: 300px;" class="img-fluid img-thumbnail" src="<?php echo $image_path; ?>" alt="">
            </div>
            <hr>
            <button class="btn btn-primary">Update</button>

        </div>

    </div>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php'; ?>

</body>

</html>