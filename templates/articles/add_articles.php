<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>
    <title>Add New Article</title>

    <link rel="stylesheet" href="/css/add_article_form.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="/js/summernote.min.js"></script> -->
    <script>
        // $(document).ready(function() {
        //     $('#content').summernote({
        //         height: 300,
        //     });
        // });
    </script>

</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    ?>

    <div class="container mb-4">

        <div class="shadow">

            <h3 class="header p-2">Add New Article</h3>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group p-2">
                    <label for="title">Title</label>
                    <input required name="title" type="text" class="form-control form-control-sm" id="title" aria-describedby="title" placeholder="Enter title here...">
                </div>
                <div class="form-group p-2">
                    <label for="content">Content</label><textarea rows="20" name="content" id="content" class="form-control form-control-sm"></textarea>
                </div>

                <div class="form-group p-2">
                    <label for="image-file">Image</label>
                    <input class="ml-2" type="file" name="image-file">
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

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';
    ?>

</body>

</html>