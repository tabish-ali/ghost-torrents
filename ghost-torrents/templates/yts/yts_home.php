<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    ?>


    <title>Ghost | YTS | Movies</title>
    <link rel="stylesheet" href="/css/yts-movies.css">
    <script src="/js/yts_home.js"></script>
</head>

<body>

    <div class="container-fluid" style="margin-top:100px;">

        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/yts-api/yts-paginations.php';
        ?>
        <div id="result-div" class="row text-light">
            <?php foreach ($yts_data->data->movies as $movie) : ?>
                <div id='movie-col' class='col-sm-2 mt-5'>
                    <a class="primary-label text-light" href="/templates/yts/yts_movie_info?slug=<?php echo $movie->slug ?>&id=<?php echo $movie->id ?>">
                        <div class='img-div'>
                            <img class='movie-img' src="<?php echo $movie->large_cover_image; ?>">
                            <div class='quality-div'>
                                <?php foreach ($movie->torrents as $torrent) : ?>
                                    <small><b><?php echo $torrent->quality;  ?></b></small>
                                <?php endforeach; ?>
                            </div>
                            <div class='genres-div'>
                                <?php $i = 0; ?>
                                <?php foreach ($movie->genres as $genre) : ?>
                                    <?php if ($i < 2) : ?>
                                        <h5 class='text-center'> <b><?php echo $genre; ?></b></h5>
                                        <?php $i++ ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </h5>
                            </div>
                            <div class='rating-div'>
                                <h3><b><?php echo $movie->rating; ?>/10</b></h3>
                            </div>
                        </div>
                        <div class='title-year-div'>
                            <h6 class='title-text'> <?php echo $movie->title; ?> </h6>
                            <small class='text-muted'>Year <?php echo $movie->year; ?></small>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/yts-api/yts-paginations.php' ?>;
 
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>
</body>

</html>