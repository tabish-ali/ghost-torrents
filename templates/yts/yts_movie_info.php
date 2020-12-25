<!DOCTYPE html>
<html lang="en">

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $id = $_GET['id'];
    $slug = $_GET['slug'];

    $json_data = file_get_contents("https://yts.mx/api/v2/movie_details.json?movie_id=" . (int)$id . "&with_cast=true&with_images=true");
    $movie_data = json_decode($json_data);

    $related = file_get_contents("https://yts.mx/api/v2/movie_suggestions.json?movie_id=" . (int)$id);
    $related_movies = json_decode($related);

    ?>
    <link rel="stylesheet" href="/css/yts_movie_info.css">
    <title>Ghost | YTS | Movies | </title>
</head>

<body>
    <div class="container" style="margin-top:100px;">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php'; ?>

        <div class="row text-light">
            <div class="col-sm-3">
                <img class="movie-img shadow-lg" src="<?php echo $movie_data->data->movie->medium_cover_image ?>" alt="">
                <br>
                <button class="btn btn-success btn-block mt-2"><i class="mr-2 fas fa-download"></i>Download</button>
            </div>
            <div class="col-sm-5">
                <h1><?php echo $movie_data->data->movie->title  ?></h1>
                <div class="p-1">
                    <p><?php echo  $movie_data->data->movie->year ?></p>
                    <p>
                        <?php
                        foreach ($movie_data->data->movie->genres as $genre) {
                            echo  $genre . " | ";
                        }
                        ?>
                    </p>
                    <p>
                        <?php
                        foreach ($movie_data->data->movie->torrents as $torrent) : ?>
                            <a href="<?php echo $torrent->url; ?>" class="btn btn-sm btn-dark">
                                <?php echo $torrent->quality; ?>
                            </a>
                        <?php endforeach; ?>
                    </p>
                    <p class="font-weight-bold">
                        <img src="/static/logos/imdb-logo.png" style="width: 40px;" alt="IMDB">
                        <?php echo $movie_data->data->movie->rating; ?>
                    </p>
                </div>
            </div>
            <div class="col-sm-4 hidden-xs hidden-sm">
                <p class="ml-1">Similar Movies</p>
                <?php foreach ($related_movies->data->movies as $related_movie) : ?>
                    <a href="/templates/yts/yts_movie_info?slug=<?php echo $related_movie->slug ?>&id=<?php echo $related_movie->id ?>"> <img class="related-img" src="<?php echo $related_movie->medium_cover_image ?>" alt=""></a>

                <?php endforeach; ?>
            </div>

        </div>
        <hr>
        <div class="mt-2 text-center">

        </div>
        <div class=" row mt-2">
            <div class="col-sm-4">
                <iframe class="screen-shot" frameborder="0" src="https://www.youtube.com/embed/<?php echo $movie_data->data->movie->yt_trailer_code  ?>?rel=0&wmode=transparent&border=0&autoplay=1&iv_load_policy=3">
                </iframe>
            </div>
            <div class="col-sm-4">
                <img class="screen-shot" src="<?php echo $movie_data->data->movie->large_screenshot_image2; ?>" alt="">
            </div>
            <div class="col-sm-4">
                <img class="screen-shot" src="<?php echo $movie_data->data->movie->large_screenshot_image3; ?>" alt="">
            </div>
        </div>
        <div class="row" style="margin-top: 50px;">
            <div class="col-sm-8 text-muted">
                <h3 class="text-light">Synopsis</h3>
                <p class="mt-2"><?php echo $movie_data->data->movie->description_full; ?></p>
            </div>
            <div class="col-sm-4 text-light">
                <h4 class="font-weight-bold mb-2">Cast</h4>
                <?php if (isset($movie_data->data->movie->cast)) : ?>
                    <?php foreach ($movie_data->data->movie->cast as $cast) : ?>

                        <div>
                            <?php if (isset($cast->url_small_image)) : ?>
                                <img class="cast-img" src="<?php echo $cast->url_small_image; ?>" alt="">
                            <?php else : ?>
                                <img class="cast-img" src="/static/user-images/default-user.svg" alt="">
                            <?php endif; ?>
                            <small class="ml-2"><b class="text-muted"><?php echo $cast->name; ?></b> as <?php echo $cast->character_name; ?> </small>
                        </div>
                        <hr>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="text-light">
            <?php
            // print_r($movie_data->data->movie->cast);
            ?>
        </div>

    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>
</body>

</html>