<!DOCTYPE html>

<html>

<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    ?>

    <script src="/js/search_torrents.js"></script>
    <link rel="stylesheet" href="/css/index.css">

    <title>Ghost | Home</title>

</head>


<body>

    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';

    ?>

    <div class="index-text mt-5" id="container">

        <div id="main">

            <div class="welcome-div" style="text-align: center;">
                <h4 style="letter-spacing: 5px;" class="welcome-text">Welcome To Ghost!</h4>
            </div>

            <div class="search-bar-div form-group">
                <small class="bg-dark p-1 rounded" style="letter-spacing: 2px;"> <b>LETS FIND TORRENTS!</b> </small> <br>

                <div class="p-2 mt-2">
                    <input id="category-all" checked="checked" type="radio" id="all" name="category" value="all">
                    <label class="text-light" for="all"> <small class="choice-box-text">All</small></label>
                    &nbsp;&nbsp;
                    <input id="category-movies" type="radio" name="category" value="movies">
                    <label class="text-light" for="movies"> <small class="choice-box-text">Movies</small></label>
                    &nbsp;&nbsp;
                    <input id="category-games" type="radio" name="category" value="games">
                    <label class="text-light" for="games"> <small class="choice-box-text">Games</small></label>
                    &nbsp;&nbsp;
                    <input id="category-softwares" type="radio" name="category" value="softwares">
                    <label class="text-light" for="softwares"> <small class="choice-box-text">Softwares</small></label>
                    &nbsp;&nbsp;
                    <input id="category-tv" type="radio" name="category" value="tv">
                    <label class="text-light" for="tv"> <small class="choice-box-text">TV</small></label>
                    &nbsp;&nbsp;
                    <input id="category-books" type="radio" name="category" value="books">
                    <label class="text-light" for="tv"> <small class="choice-box-text">Books</small></label>
                    &nbsp;&nbsp;
                    <input id="category-music" type="radio" name="category" value="music">
                    <label class="text-light" for="tv"> <small class="choice-box-text">Music</small></label>
                    &nbsp;&nbsp;
                    <input id="category-others" type="radio" name="category" value="others">
                    <label class="text-light" for="tv"> <small class="choice-box-text">Others</small></label>

                </div>

                <div style="margin: auto;  min-width: 100px; display: inline;">
                    <input id="search-field" name="search-field" class="search-bar shadow form-control w-70" type="text"><br>
                </div>

                <button id="search-btn" style="border-radius: 50px;" class="shadow btn btn-primary">
                    <i id="search-icon" class="fa fa-search"></i>
                    Search
                </button>

            </div>


            <?php if (empty($_SESSION)) : ?>

                <div class="call-to-action mt-4 p-3">
                    <a href="/templates/auth/login" class="btn btn-dark btn-sm ">Login</a>
                    <a href="/templates/auth/sign_up" class="btn btn-success btn-sm ">Register</a>
                </div>

            <?php endif; ?>

        </div>
        <div id="result-div" style="display: none;">
            <div class="table table-responsive mt-2">
                <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="torrents-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                Torrent</th>
                            <th scope="col">Added</th>
                            <th scope="col">Size</th>
                            <th scope="col">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row m-4">

            <div class="col-sm-4">
                <div class="mb-5 p-3 rounded dark-bg">
                    <a class="btn btn-block btn-primary btn-lg" href="/templates/torrents/torrents?type=torrents?category=all">Torrents</a> <br>
                    <div class="mt-2">
                        <small class="text-light">
                            Browse and download torrents of your desired choice, easy to use and with optimal seeds.
                        </small>
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-5 p-3 rounded dark-bg">
                    <a class="btn btn-block btn-dark btn-lg" href="/templates/articles/articles_list">Articles</a> <br>
                    <div class="mt-2">
                        <small class="text-light">
                            Read latest articles about technologies and movies. There are many other
                            articles about top and best of the everything.
                        </small>
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-5 p-3 rounded dark-bg">
                    <a class="btn btn-block btn-success btn-lg" href="/templates/yts/yts_movies">Search YTS Movies</a> <br>
                    <div class="mt-2">
                        <small class="text-light">
                            Search for movies on yts using ghost torrent provided yts api features.
                        </small>
                    </div>

                </div>
            </div>

        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/torrents/categories' ?>
    </div>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php';
    ?>

</body>

</html>