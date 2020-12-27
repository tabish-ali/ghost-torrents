<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/torrents/torrents-database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/config/datetime.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $id = $_GET['id'];
    $slug = $_GET['slug'];

    $json_data = file_get_contents("https://yts.mx/api/v2/movie_details.json?movie_id=" .
        (int)$id . "&with_cast=true&with_images=true&with_rt_ratings=true");
    $movie_data = json_decode($json_data);

    $related = file_get_contents("https://yts.mx/api/v2/movie_suggestions.json?movie_id=" . (int)$id);
    $related_movies = json_decode($related);
    ?>
    <link rel="stylesheet" href="/css/yts_movie_info.css">
    <title>Ghost | YTS | Movies | <?php echo $movie_data->data->movie->title ?></title>

</head>

<body>
    <div class="container" style="margin-top:100px;">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php'; ?>

        <div class="row text-light movie-info">
            <div class="col-sm-3">
                <img class="movie-img shadow-lg" src="<?php echo $movie_data->data->movie->medium_cover_image ?>" alt="Sorry no image">
                <br>
                <button data-toggle="modal" data-target="#torrentDownloadModal" class="btn btn-success btn-block mt-2"><i class="mr-2 fas fa-download"></i>Download</button>
            </div>
            <div class="col-sm-5">
                <h1><?php echo $movie_data->data->movie->title  ?></h1>
                <div class="p-1">
                    <p><?php echo  $movie_data->data->movie->year ?></p>
                    <p class="font-weight-bold">
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
                    <div class="mt-1 font-weight-bold">
                        <a class="primary-label" target="_blank" href="https://www.imdb.com/title/<?php echo $movie_data->data->movie->imdb_code ?>">
                            <img title="IMDB rating" class="mr-2" src="/static/logos/imdb-logo.png" style="width: 40px;" alt="IMDB">
                        </a>
                        <?php echo $movie_data->data->movie->rating; ?>
                    </div>
                    <div class="mt-2 font-weight-bold">
                        <i class="mr-4 text-success fa fa-heart fa-lg" title="Likes" aria-hidden="true"></i>
                        <?php echo $movie_data->data->movie->like_count; ?>
                    </div>
                    <div class="mt-2 font-weight-bold">
                        <i title="Runtime" class="mr-4 fas fa-clock fa-lg" style="color:gray"></i>
                        <?php
                        echo DateAndTime::convertToHoursMins($movie_data->data->movie->runtime, '%02d hr %02d min');
                        ?>
                    </div>
                    <div class="mt-2 font-weight-bold">
                        <img title="PG rating" style="width: 20px;" class="mr-4" src="/static/svgs/pg.svg" alt="PG">
                        <?php echo $movie_data->data->movie->mpa_rating; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 hidden-xs hidden-sm">
                <p class="ml-1">Similar Movies</p>
                <?php if (isset($related_movies->data->movies)) : ?>
                    <?php foreach ($related_movies->data->movies as $related_movie) : ?>
                        <a href="/templates/yts/yts_movie_info?slug=<?php echo $related_movie->slug ?>&id=<?php echo $related_movie->id ?>"> <img class="related-img" src="<?php echo $related_movie->medium_cover_image ?>" alt=""></a>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
        <hr>
        <div class="mt-2 text-center">

        </div>
        <div class=" row mt-2">
            <div class="col-sm-4">
                <iframe class="screen-shot" frameborder="0" src="https://www.youtube.com/embed/<?php echo $movie_data->data->movie->yt_trailer_code  ?>?rel=0&wmode=transparent&border=0&autoplay=0&iv_load_policy=3">
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
            foreach ($movie_data->data->movie->torrents as $torrent) {
                print_r("");
            }

            ?>
        </div>

        <!-- Torren download Modal -->
        <div class="modal fade" id="torrentDownloadModal" tabindex="-1" role="dialog" aria-labelledby="torrentDownloadModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block">
                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title text-success text-center" id="exampleModalLabel">Please select a movie</h5>
                    </div>
                    <div class="modal-body text-center row text-secondary">
                        <?php if (isset($movie_data->data->movie)) : ?>
                            <?php foreach ($movie_data->data->movie->torrents as $torrent) : ?>
                                <div class="col-sm-6 mt-3 border-left">
                                    <?php if ($torrent->quality === "720p") : ?>
                                        <img class="quality-icon" src="/static/svgs/720.svg" alt="720p">
                                    <?php elseif ($torrent->quality === "1080p") : ?>
                                        <img class="quality-icon" src="/static/svgs/1080.svg" alt="1080p">
                                    <?php elseif ($torrent->quality === "3D") : ?>
                                        <img class="quality-icon" src="/static/svgs/3d.svg" alt="3D">
                                    <?php elseif ($torrent->quality === "2160p") : ?>
                                        <img class="quality-icon" src="/static/svgs/4k.svg" alt="4K">
                                    <?php else : ?>
                                        <?php endif; ?>
                                        <div class="mt-2">
                                            File Size
                                            <p class="text-dark font-weight-bold"><?php echo $torrent->size; ?></p>
                                        </div>
                                        <div>
                                            <a href="<?php echo $torrent->url; ?>" class="btn btn-success btn-sm"><i class="mr-2 fas fa-download"></i>Download</a><br>
                                            <a href="<?php echo TorrentsDatabase::getYTSMagnetLink($slug, $torrent->hash) ?>" class="btn btn-default mt-2"><i class="text-danger fa-lg fa fa-magnet"></i></a>
                                        </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>
</body>

</html>