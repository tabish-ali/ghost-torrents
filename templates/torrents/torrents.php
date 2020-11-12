<!DOCTYPE html>
<html lang="en">

<head>
    <title>Torrents List</title>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>

</head>

<body>
    <?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
    include_once  $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

    $torrents = TorrentsDatabase::getTorrents();

    $movies_torrents = TorrentsDatabase::getDesiredTorrents("movies");

    $music_torrents = TorrentsDatabase::getDesiredTorrents("music");

    $games_torrents = TorrentsDatabase::getDesiredTorrents("games");


    ?>


    <div class="container-fluid mt-4" id="container">
        <div id="main">



            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-movies-tab" data-toggle="pill" href="#pills-movies" role="tab" aria-controls="pills-movies" aria-selected="false">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-music-tab" data-toggle="pill" href="#pills-music" role="tab" aria-controls="pills-music" aria-selected="false">Music</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-games-tab" data-toggle="pill" href="#pills-games" role="tab" aria-controls="pills-games" aria-selected="false">Games</a>
                </li>
            </ul>

            <hr>

            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="table table-responsive">
                        <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="articles-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <small class="mr-1 bg-primary text-white p-1 rounded">All</small>
                                        Torrent</th>
                                    <th scope="col">Added</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Seeds</th>
                                    <th scope="col">Leeches</th>
                                    <th scope="col">Download</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($torrents as $torrent) : ?>

                                    <tr>
                                        <td style="letter-spacing: 0.5px;" class="small">
                                            <b>
                                                <a class="primary-label" href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>&name=<?php echo $torrent['name']; ?>">
                                                    <?php echo $torrent['name'] ?>
                                            </b>
                                            </a>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo DateAndTime::time_elapsed_string($torrent['date']); ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo $torrent['size']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="success-label">
                                                <?php echo $torrent['peers_info']['seeders']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="danger-label">
                                                <?php echo $torrent['peers_info']['leechers']; ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <a href="<?php echo $torrent['magnet']; ?>" class="danger-label p-1">
                                                <i class="fa fa-magnet fa-xs"></i>
                                                Magnet
                                            </a>
                                            <a href="<?php echo $torrent['path'] ?>" class="text-info p-1">
                                                <i class="fa fa-file fa-xs"></i>
                                                File
                                            </a>
                                        </td>

                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-movies" role="tabpanel" aria-labelledby="pills-movies-tab">
                    <div class="table table-responsive">
                        <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="articles-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <small class="mr-1 bg-success text-white p-1 rounded">Movies</small>
                                        Torrent</th>
                                    <th scope="col">Added</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Seeds</th>
                                    <th scope="col">Leeches</th>
                                    <th scope="col">Download</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($movies_torrents as $torrent) : ?>

                                    <tr>
                                        <td style="letter-spacing: 0.5px;" class="small">
                                            <b>
                                                <a class="primary-label" href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>">
                                                    <?php echo $torrent['name'] ?>
                                            </b>
                                            </a>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo DateAndTime::time_elapsed_string($torrent['date']); ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo $torrent['size']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="success-label">
                                                <?php echo $torrent['peers_info']['seeders']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="danger-label">
                                                <?php echo $torrent['peers_info']['leechers']; ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <a href="<?php echo $torrent['magnet']; ?>" class="danger-label p-1">
                                                <i class="fa fa-magnet fa-xs"></i>
                                                Magnet
                                            </a>
                                            <a href="<?php echo $torrent['path'] ?>" class="text-primary p-1">
                                                <i class="fa fa-file fa-xs"></i>
                                                File
                                            </a>
                                        </td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-music" role="tabpanel" aria-labelledby="pills-music-tab">
                    <div class="table table-responsive">
                        <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="articles-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <small class="mr-1 bg-info text-white p-1 rounded">Music</small>
                                        Torrent</th>
                                    <th scope="col">Added</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Seeds</th>
                                    <th scope="col">Leeches</th>
                                    <th scope="col">Download</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($music_torrents as $torrent) : ?>

                                    <tr>
                                        <td style="letter-spacing: 0.5px;" class="small">
                                            <b>
                                                <a href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>">
                                                    <?php echo $torrent['name'] ?>
                                            </b>
                                            </a>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo DateAndTime::time_elapsed_string($torrent['date']); ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo $torrent['size']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="success-label">
                                                <?php echo $torrent['peers_info']['seeders']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="danger-label">
                                                <?php echo $torrent['peers_info']['leechers']; ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <a href="<?php echo $torrent['magnet']; ?>" class="danger-label p-1">
                                                <i class="fa fa-magnet fa-xs"></i>
                                                Magnet
                                            </a>
                                            <a href="<?php echo $torrent['path'] ?>" class="text-primary p-1">
                                                <i class="fa fa-file fa-xs"></i>
                                                File
                                            </a>
                                        </td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-games" role="tabpanel" aria-labelledby="pills-games-tab">
                    <div class="table table-responsive">
                        <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="articles-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        <small class="mr-1 bg-danger text-white p-1 rounded">Games</small>
                                        Torrent</th>
                                    <th scope="col">Added</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Seeds</th>
                                    <th scope="col">Leeches</th>
                                    <th scope="col">Download</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($games_torrents as $torrent) : ?>

                                    <tr>
                                        <td style="letter-spacing: 0.5px;" class="small">
                                            <b>
                                                <a class="primary-label" href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>">
                                                    <?php echo $torrent['name'] ?>
                                            </b>
                                            </a>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo DateAndTime::time_elapsed_string($torrent['date']); ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <b class="text-light">
                                                <?php echo $torrent['size']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="success-label">
                                                <?php echo $torrent['peers_info']['seeders']; ?>
                                            </b>
                                        </td>


                                        <td class="small">
                                            <b class="danger-label">
                                                <?php echo $torrent['peers_info']['leechers']; ?>
                                            </b>
                                        </td>

                                        <td class="small">
                                            <a href="<?php echo $torrent['magnet']; ?>" class="danger-label p-1">
                                                <i class="fa fa-magnet fa-xs"></i>
                                                Magnet
                                            </a>
                                            <a href="<?php echo $torrent['path'] ?>" class="text-primary p-1">
                                                <i class="fa fa-file fa-xs"></i>
                                                File
                                            </a>
                                        </td>



                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>