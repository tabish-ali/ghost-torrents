<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Torrents</title>


    <?php

    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents' . '/templates/base/head-tags.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents' . '/torrents/torrents-database.php';

    if (!empty($_SESSION))
        $torrents = TorrentsDatabase::getTorrents(0, TorrentsDatabase::countTotalTorrents("all"));


    ?>

    <script>
        var torrents = <?php echo json_encode($torrents); ?>;
    </script>

    <script src="/js/delete_torrents.js"></script>
</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents' . '/templates/base/navbar.php';
    $serial = 0;
    ?>

    <div class="container-fluid" style="margin-top: 100px;">

        <?php if (!empty($_SESSION)) : ?>

            <div class="p-1 shadow-sm action-btn-bar">
                <button class="btn btn-sm btn-danger" disabled id="delete-btn">Delete</button>
            </div>

            <div class="table-table-responsive">
                <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="torrents-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><input type="checkbox" id="select-all"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($torrents as $torrent) : ?>

                            <tr>
                                <td width=5% class="small">
                                    <input type="checkbox">
                                </td>

                                <td class="small"><b>
                                        <a class="primary-label" href="/templates/torrents/show_torrent.php?torrent_id=<?php echo $torrent['id']; ?>"><?php echo $torrent['name'] ?></b></a>

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

                                <td width=5%>
                                    <a href="/templates/torrents/edit_torrent.php?torrent_id=<?php echo $torrent['id']; ?>" class="p-2 edit-btn small" href="#">
                                        Edit
                                    </a>
                                </td>

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