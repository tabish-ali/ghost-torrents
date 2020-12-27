<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ghost | Software Torrents</title>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/torrents/torrents-database.php';
    include_once  $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/config/datetime.php';

    $_GET['category'] = "Software";
    $_GET['type'] = "torrents";
    ?>

</head>

<body>

    <div class="container-fluid" id="container" style="margin-top: 100px;">

        <?php
        include_once  $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/config/pagination.php';
        ?>
        <div class="table table-responsive mt-2">
            <table class="table table-borderless table-dark shadow-sm dark-bg rounded" id="articles-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <small class="mr-1 bg-info text-white p-1 rounded">Software</small>
                            Torrent</th>
                        <th scope="col">Added</th>
                        <th scope="col">Size</th>
                        <th scope="col">Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($torrents as $torrent) : ?>
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
                                <a href="<?php echo $torrent['magnet']; ?>" class="danger-label p-1">
                                    <i class="fa fa-magnet fa-xs"></i>
                                    Magnet
                                </a>
                                <a href="<?php echo $torrent['path'] ?>" class="text-primary p-1">
                                    <i class="fa fa-file fa-xs"></i>
                                    File
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/torrents/categories.php' ?>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>
</body>

</html>