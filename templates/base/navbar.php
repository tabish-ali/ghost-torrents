<div class="navbar-div mb-5">
    <nav class="navbar navbar-expand-md sticky-top navbar-light bg-light shadow p-3 bg-white rounded">
        <a style="letter-spacing: 2px; font-size: 18px;" class="navbar-brand" href="/">
            <img style="height: 25px; width: 25px;" src="/static/logos/logo.png" alt="">
            <em class="text-primary"><b>G</b></em>host
            <em class="text-danger"><b>T</b></em>orrents
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="/templates/articles/articles_list.php" class="nav-link">Articles</a>
                </li>
                <li class="nav-item">
                    <a href="/templates/torrents/torrents.php" class="nav-link">Torrents</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php

                if (empty($_SESSION)) : ?>

                    <li class="nav-item">
                        <a href="/templates/auth/sign_up.php" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="/templates/auth/login.php" class="nav-link">Login</a>
                    </li>

                <?php else : ?>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="mr-1" id="nav-img" style="height: 30px; width:30px; border-radius: 50px;" src="<?php echo $_SESSION['image']; ?>" alt="">
                            <b id="nav-username"><?php echo $_SESSION['username']; ?></b>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item btn-sm" href="/templates/users/profile.php">
                                <i class="fa fa-user" aria-hidden="true"></i> Profile</a>

                            <a class="dropdown-item btn-sm" href="/templates/articles/user_articles.php">
                                <i class="fas fa-newspaper"></i>
                                My Articles
                            </a>
                            <a href="/templates/articles/add_articles.php" class="dropdown-item btn-sm">
                                <i class="fa fa-plus-circle"></i>
                                Add Articles
                            </a>
                            <a class="dropdown-item btn-sm" href="/templates/torrents/user_torrents.php">
                                <i class="fas fa-rss"></i>
                                My Torrents
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn-sm" href="/users/logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout</a>
                        </div>
                    </li>


                <?php endif ?>


            </ul>

        </div>

    </nav>
</div>