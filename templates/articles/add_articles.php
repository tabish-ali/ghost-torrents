<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>
    <title>Add New Article</title>

    <link rel="stylesheet" href="/css/add_article_form.css">

    <script src="https://cdn.tiny.cloud/1/x0ijlg4e0a2wemrzk658tg7n867slze12uejhcy58nd16soc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#content',
        skin: "oxide-dark",
        content_css: "dark",
        init_instance_callback: function(editor) {
                var freeTiny = document.querySelector('.tox .tox-notification--in');
                freeTiny.style.display = 'none';
            },
            height: "450",
            content_style: "body { background: #2d2d2d; color: #fff;}",
      });
    </script>

    <script src="/js/add_article.js"></script>

    <style>

    
    </style>

</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    ?>

    <div class="container" style="margin-bottom: 30px; margin-top: 100px;" id="container">

        <div class="shadow dark-bg" id="main">

            <h3 class="header p-2 bg-dark">Add New Article</h3>

            <div class="p-4">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group p-2">
                        <label for="title" class="text-light">Title</label>
                        <input required name="title" type="text" class="form-control form-control-sm" id="title" aria-describedby="title" placeholder="Enter title here...">
                    </div>
                    <small class="p-2 text-muted">Please Change the formating before posting. Format > Text color > color</small>
                    <div class="form-group p-2">
                        <label class="text-light" for="content">Content</label><textarea name="content" id="content"></textarea>
                    </div>

                    <div class="form-group p-2">
                        <label class="btn btn-dark text-light">
                            Image File <input name="image-file" id="image-file" type="file" hidden>
                        </label><br>
                        <img class="shadow rounded" src="" id="out-img" alt="">
                    </div>

                    <div class="errors-div">

                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/articles/save-article.php';

                        ?>

                        <?php if ($notification != null) : ?>

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php foreach ($notification->getNotification() as $n) : ?>
                                    <small> <?php echo $n ?> </small><br>
                                <?php endforeach; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>


                        <?php endif; ?>

                        <?php if ($success_message != "") : ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <small> <?php echo $success_message ?> </small><br>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php endif; ?>

                    </div>
                    <hr>
                    <div class="form-group p-2">
                        <button style="width: 100px;" name="add-article-btn" type="submit" class="shadow btn btn-primary mt-2">Submit</button>
                    </div>


                </form>
            </div>
        </div>
    </div>

</body>

</html>