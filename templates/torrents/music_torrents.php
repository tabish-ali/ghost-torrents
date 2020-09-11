<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movies</title>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>


</head>

<body>

    <?php

    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
    include_once  $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

    $torrents = TorrentsDatabase::getDesiredTorrents("music");


    ?>


    <div class="container-fluid">

        <div class="table table-responsive">
            <table class="table border shadow-sm" id="articles-table">
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

                    <?php foreach ($torrents as $torrent) : ?>

                        <tr>
                            <td style="letter-spacing: 0.5px;" class="small">
                                <b>
                                    <a href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>">
                                        <?php echo $torrent['name'] ?>
                                </b>
                                </a>
                            </td>

                            <td class="small">
                                <b class="text-dark">
                                    <?php echo DateAndTime::time_elapsed_string($torrent['date']); ?>
                                </b>
                            </td>

                            <td class="small">
                                <b class="text-dark">
                                    <?php echo $torrent['size']; ?>
                                </b>
                            </td>


                            <td class="small">
                                <b class="text-success">
                                    <?php echo $torrent['peers_info']['seeders']; ?>
                                </b>
                            </td>


                            <td class="small">
                                <b class="text-danger">
                                    <?php echo $torrent['peers_info']['leechers']; ?>
                                </b>
                            </td>

                            <td class="small">
                                <a href="<?php echo $torrent['magnet']; ?>" class="text-danger p-1">
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
</body>

</html>