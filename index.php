<!DOCTYPE html>

<html>

<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>

    <script src="/js/search_torrents.js"></script>
    <link rel="stylesheet" href="/css/index.css">

</head>


<body>

    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';

    ?>

    <div class="p-3 index-text shadow m-4" style="border-radius: 5px;">

        <div class="welcome-div" style="text-align: center;">
            <h2 style="letter-spacing: 5px;" class="text-dark">Welcome To Ghost!</h2>
        </div>

        <div class="search-bar-div border form-group">
            <small style="color: #DD7596; letter-spacing: 2px;"> <b>LETS FIND TORRENTS!</b> </small> <br>

            <div class="p-2">
                <input id="category-all" checked="checked" type="radio" id="all" name="category" value="all">
                <label class="text-dark" for="all"> <small>All</small></label>
                &nbsp;&nbsp;
                <input id="category-movies" type="radio" name="category" value="movies">
                <label class="text-dark" for="movies"> <small>Movies</small></label>
                &nbsp;&nbsp;
                <input id="category-games" type="radio" name="category" value="games">
                <label class="text-dark" for="games"> <small>Games</small></label>
                &nbsp;&nbsp;
                <input id="category-softwares" type="radio" name="category" value="softwares">
                <label class="text-dark" for="softwares"> <small>Softwares</small></label>
                &nbsp;&nbsp;
                <input id="category-tv" type="radio" name="category" value="tv">
                <label class="text-dark" for="tv"> <small>TV</small></label>
                &nbsp;&nbsp;
                <input id="category-books" type="radio" name="category" value="books">
                <label class="text-dark" for="tv"> <small>Books</small></label>
                &nbsp;&nbsp;
                <input id="category-music" type="radio" name="category" value="music">
                <label class="text-dark" for="tv"> <small>Music</small></label>
                &nbsp;&nbsp;
                <input id="category-others" type="radio" name="category" value="others">
                <label class="text-dark" for="tv"> <small>Others</small></label>

            </div>

            <input id="search-field" name="search-field" class="search-bar shadow form-control w-70" type="text"><br>
            <button id="search-btn" style="border-radius: 50px;" class="shadow btn btn-primary">
                <i id="search-icon" class="fa fa-search"></i>
                Search
            </button>

        </div>


        <?php if (empty($_SESSION)) : ?>

            <div class="call-to-action mt-4 p-3">
                <a href="/templates/auth/login.php" class="btn btn-dark btn-sm ">Login</a>
                <a href="/templates/auth/sign_up.php" class="btn btn-success btn-sm ">Register</a>
            </div>

        <?php endif; ?>

    </div>

    <div id="result-div" class="result-div border shadow-sm p-3">
    </div>

    <div class="p-3 m-4">

        <div class="row mt-3">
            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="templates/torrents/movies_torrents.php">
                    <h6><b>Movies</b></h6>
                </a>
                <hr>
                <a href="templates/torrents/movies_torrents.php"><img class="svgs" src="/static/svgs/movies.svg" alt=""></a>
            </div>
            <div style="width: 10px;">

            </div>
            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="/templates/torrents/games_torrents.php">
                    <h6><b>Games</b></h6>
                </a>
                <hr>
                <a href="/templates/torrents/games_torrents.php"><img class="svgs" src="/static/svgs/gaming.svg" alt=""></a>
            </div>
            <div style="width: 10px;">

            </div>
            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="">
                    <h6><b>Softwares</b></h6>
                </a>
                <hr>
                <a href=""><img class="svgs" src="/static/svgs/softwares.svg" alt=""></a>
            </div>
            <div style="width: 10px;">

            </div>
            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="/templates/torrents/music_torrents.php">
                    <h6><b>Music</b></h6>
                </a>
                <hr>
                <a href="/templates/torrents/music_torrents.php"> <img class="svgs" src="/static/svgs/music.svg" alt=""></a>
            </div>
        </div>

        <div class="row">

            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="">
                    <h6><b>TV Shows</b></h6>
                </a>
                <hr>
                <a href=""><img class="svgs" src="/static/svgs/tv.svg" alt=""></a>
            </div>
            <div style="width: 10px;">

            </div>
            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="">
                    <h6><b>Books</b></h6>
                </a>
                <hr>
                <a href=""><img class="svgs" src="/static/svgs/books.svg" alt=""></a>
            </div>
            <div style="width: 10px;">

            </div>

            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="">
                    <h6><b>Anime</b></h6>
                </a>
                <hr>
                <a href=""><img class="svgs" src="/static/svgs/anime.svg" alt=""></a>
            </div>
            <div style="width: 10px;">

            </div>
            <div class="bg-light col-md border mt-2 p-2 shadow-sm" style="text-align: center;">
                <a href="">
                    <h6><b>Others</b></h6>
                </a>
                <hr>
                <a href=""><img class="svgs" src="/static/svgs/others.svg" alt=""></a>
            </div>
        </div>
    </div>

    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';

    ?>

</body>

</html>