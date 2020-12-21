<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';
    ?>
    <link rel="stylesheet" href="/css/list_users.css">
    <title>Ghost | Users</title>
</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';
    $_GET['type'] = "users";

    ?>
    <div class="container-fluid" style="margin-top: 100px;">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config/pagination.php'; ?>
    </div>
    <div class="container mt-4" id="container">
        <div class="row">
            <?php while ($user = $users->fetch_assoc()) : ?>
                <div class="col-sm-4 p-3 user-div">
                    <a href="/templates/users/user.php?user_id=<?php echo $user['id']; ?>&username=<?php echo $user['username']; ?>">
                        <img class="user-avatar" src="<?php echo $user['image_path'] ?>" alt="">
                    </a>
                    <h5 class="mt-1 text-white">
                        <a class="text-light" href="/templates/users/user.php?user_id=<?php echo $user['id']; ?>&username=<?php echo $user['username']; ?>">
                            <?php echo $user['username']; ?>

                        </a>
                        <span>
                            <?php if (isset($_SESSION['username'])) : ?>
                                <?php if ($_SESSION['username'] === $user['username']) : ?>
                                    <i class="fas fa-user fa-xs" title="It's you"></i>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($user['admin']) : ?>
                                <i class="primary-label fas fa-certificate fa-xs" title="Admin"></i>
                            <?php endif; ?>
                        </span>
                    </h5>
                    <small class="text-light"> Joined: <?php echo DateAndTime::time_elapsed_string($user['created_at']); ?> </small>
                    <div class="stats-div mt-1">
                        <i class="fa fa-rss primary-label" title="Total articles written" aria-hidden="true"></i>
                        <small class="text-muted"><?php echo ArticlesDatabase::getArticlesCount($user['username']); ?></small>
                        <i class="text-danger fa fa-heart ml-2" title="Likes on articles" aria-hidden="true"></i>
                        <small class="text-muted">
                            <?php

                            $interactions = ArticlesDatabase::totalLikesOnArticle($user['username']);

                            if (isset(json_decode($interactions)[0]->status)) {

                                echo sizeof(json_decode($interactions));
                            } else {
                                echo 0;
                            }

                            ?>


                        </small>
                    </div>

                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>

</body>

</html>