<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Torrents</title>


    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';

    if (!empty($_SESSION))
        $torrents = TorrentsDatabase::getUserTorrents($_SESSION['username']);


    ?>

    <script>
        var torrents = <?php echo json_encode($torrents); ?>;
    </script>


</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    $serial = 0;
    ?>

    <div class="container-fluid mt-4">

        <?php if (!empty($_SESSION)) : ?>

            <div class="p-1 border shadow-sm action-btn-bar">
                <button class="btn btn-sm btn-danger" disabled id="delete-btn">Delete</button>
            </div>

            <div class="table-table-responsive">
                <table class="table border shadow-sm" <thead class="thead-light">
                    <tr>
                        <th scope="col"><input type="checkbox" id="select-all-choicebox"></th>
                        <th class="small" scope="col">Name</th>
                        <th class="small" scope="col">Date</th>
                        <th class="small" scope="col">Time</th>
                        <th class="small" scope="col">Peers Info</th>
                        <th class="small" scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($torrents as $torrent) : ?>

                            <tr>
                                <td width=5% class="small">
                                    <input type="checkbox">
                                </td>

                                <td class="small"><b>
                                        <a href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>"><?php echo $torrent['name'] ?></b></a>

                                    <small class="bg-dark rounded text-white p-1">
                                        <b> <?php echo $torrent['size']; ?></b>
                                    </small>

                                    <br>
                                    <small class="text-muted">
                                        <?php echo strtoupper($torrent['hash']); ?>
                                    </small>
                                </td>



                                <td class="small">

                                    <b class="bg-success text-white p-1 rounded">
                                        <?php
                                        $date_time = explode(" ", $torrent['date']);
                                        $date = $date_time[0];
                                        echo $date;
                                        ?>
                                    </b>
                                </td>

                                <td class="small">
                                    <b class="bg-primary text-white p-1 rounded"><?php echo DateAndTime::time_elapsed_string($torrent['date']); ?></b>
                                </td>

                                <td class="small">
                                    <b class="text-success"><?php echo $torrent['peers_info']['seeders']; ?></b> |
                                    <b class="text-info"><?php echo $torrent['peers_info']['completed']; ?></b> |
                                    <b class="text-danger"><?php echo $torrent['peers_info']['leechers']; ?></b>
                                </td>

                                <td width=5% class="small"><a href="/templates/torrents/edit_torrent.php?id=<?php echo $torrent['id']; ?>" class="p-2 edit-btn" href="#" class="small">Edit</a></td>

                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else : ?>

            <div class="alert alert-primary" style="text-align: center;" role="alert">
                Please login to see your torrents....
            </div>

            <div style="text-align: center;" class="shadow-sm p-1">
                <a href="/templates/auth/login.php" class="btn btn-sm btn-primary">Login</a>
                <a href="/templates/auth/sign_up.php" class="btn btn-sm btn-success">Register</a>
            </div>

        <?php endif ?>

    </div>


</body>

</html>