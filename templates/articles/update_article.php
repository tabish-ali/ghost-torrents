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
    <link rel="stylesheet" href="/css/update_article.css">
    <script src="/js/izi_toast.min.js" type="text/javascript"></script>

    <script src="https://cdn.tiny.cloud/1/x0ijlg4e0a2wemrzk658tg7n867slze12uejhcy58nd16soc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        var article_id = <?php echo $_GET['article_id']; ?>;
        var old_image_path = "<?php echo $image_path;?>";
        
        tinymce.init({
            selector: '#content',
            skin: "oxide-dark",
            content_css: "dark",
            init_instance_callback: function(editor) {
                var freeTiny = document.querySelector('.tox .tox-notification--in');
                freeTiny.style.display = 'none';
            }

        });
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

        <div class="dark-bg">

            <h4 class="p-2 rounded text-light bg-dark">Update Article</h4>

            <div class="p-4">

                <div class="form-group">
                    <label for="title" class="text-light">Title</label>
                    <input id="title" value="<?php echo $title; ?>" type="text" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="content" class="text-light">Content</label>
                    <textarea id="content" name="content" class="form-control form-control-sm" cols="30" rows="10"><?php echo $content; ?></textarea>
                </div>
                <hr>
                <button id="update-content-btn" class="btn btn-primary">Update</button>
                <hr>
                <form method="post" enctype="multipart/form-data" id="image-upload-form">
                    <div class="image-upload" id="img-upload-div">
                        <label class="shadow" for="article-img-input">
                            <img id="out-img" name="article-image" style="height: 300px;" class="article-img img-fluid img-thumbnail" src="<?php echo $image_path; ?>" alt="">
                        </label>
                        <input name="image" id="article-img-input" type="file" /> <br>
                        <Button id="save-image-btn" style="display: none;" type="submit" class="btn btn-sm btn-dark mt-2">Save</Button>
                    </div>
                    <small class="shadow-lg p-1 text-muted">Please click on image to change</small>
                    <small id="notification" class="danger-label shadow-lg p-1 text-muted" style="display: none;"></small>
                </form>

                <hr>

            </div>
        </div>
    </div>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php'; ?>

</body>

</html>