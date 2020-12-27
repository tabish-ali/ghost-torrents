<nav class="navbar navbar-expand-md navbar-dark fixed-top" id="banner">
    <!-- Brand -->
    <a style="letter-spacing: 2px; font-size: 18px;" class="navbar-brand" href="/">
        <img src="/static/logos/ghost.png" style="height: 35px;" class="rounded-circle" alt="">
        <span>GHOST TORRENTS</span>
    </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a title="yts movies" href="/templates/yts/yts_home" class="nav-link">
                    <img style="height:30px;" src="/static/logos/yts-logo.png" alt="YTS Movies">
                </a>
            </li>
            <li class="nav-item">
                <a href="/templates/torrents/torrents?type=torrents" class="nav-link">Torrents</a>
            </li>
            <li class="nav-item">
                <a href="/templates/articles/articles_list?type=articles" class="nav-link">Articles</a>
            </li>
            <li class="nav-item">
                <a href="/templates/users/list_users?type=users" class="nav-link">Members</a>
            </li>
            <?php

            if (empty($_SESSION['username'])) : ?>

                <li class="nav-item">
                    <a href="/templates/auth/sign_up" class="nav-link">Register</a>
                </li>
                <li class="nav-item">
                    <a href="/templates/auth/login" class="nav-link">Login</a>
                </li>

            <?php else : ?>

                <li class="nav-item dropdown shadow-lg">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="mr-1" id="nav-img" style="height: 30px; width:30px; border-radius: 50px;" src="<?php echo $_SESSION['image']; ?>" alt="">
                        <b id="nav-username"><?php echo $_SESSION['username']; ?></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item btn-sm" href="/templates/users/profile">
                            <i class="fa fa-user" aria-hidden="true"></i> Profile</a>

                        <a class="dropdown-item btn-sm" href="/templates/articles/user_articles">
                            <i class="fas fa-newspaper"></i>
                            My Articles
                        </a>
                        <a href="/templates/articles/add_articles" class="dropdown-item btn-sm">
                            <i class="fa fa-plus-circle"></i>
                            Add Articles
                        </a>
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <a href="/templates/torrents/add_torrent" class="dropdown-item btn-sm">
                                <i class="fa fa-plus-circle"></i>
                                Add Torrents
                            </a>
                            <a class="dropdown-item btn-sm" href="/templates/torrents/torrents_dashboard">
                                <i class="fas fa-rss"></i>
                                My Torrents
                            </a>
                        <?php endif; ?>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item btn-sm" href="/users/logout">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout</a>
                    </div>
                </li>


            <?php endif ?>
        </ul>
    </div>

</nav>