<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="/css/izi_toast.min.css">
    <link rel="stylesheet" href="/css/show_torrent.css">

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/config/size_conversion.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';


    $torrent = TorrentsDatabase::getTorrent($_GET['torrent_id']);

    $torrent_meta_info_array =
        TorrentsDatabase::getTorrentMetaInfo($_SERVER['DOCUMENT_ROOT'] .  $torrent['file_path']);

    $magnet_link = TorrentsDatabase::getMagnetLink(
        $torrent_meta_info_array['name'],
        $torrent_meta_info_array['hash'],
        $torrent_meta_info_array['trackers'][0],
        $torrent_meta_info_array['trackers']
    );

    $torrent['peers_info'] = json_decode($torrent['peers_info'], true);

    $comments = json_decode(TorrentsDatabase::getComments($_GET['torrent_id']), true);

    $total_comments = 0;

    if (isset($comments))
        for ($i = 0; $i < sizeof($comments); $i++) {

            $comments[$i]['time_lapsed'] = DateAndTime::time_elapsed_string($comments[$i]['date']);
            $comments[$i]['user_image'] = UserDatabase::getUserImage($comments[$i]['username']);
            $total_comments++;
        }

    else
        $comments = [];

    ?>

    <title><?php echo $torrent_meta_info_array['name']; ?></title>



    <script>
        var torrent_meta_info = <?php echo json_encode($torrent_meta_info_array); ?>;
        var torrent_id = "<?php echo $_GET['torrent_id']; ?>";
        var username = "<?php

                        if (!empty($_SESSION))
                            echo $_SESSION['username'];
                        else
                            echo "" ?>";

        var user_image = "<?php

                            if (!empty($_SESSION))
                                echo $_SESSION['image'];
                            else
                                echo "";

                            ?>";

        var torrent_comments_obj = <?php echo json_encode($comments); ?>;

        var total_comments = <?php echo $total_comments; ?>
    </script>

    <script src="/js/izi_toast.min.js"></script>
    <script src="/js/torrent.js"></script>
    <script src="/js/show_torrent.js"></script>


</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';

    ?>

    <div class="container border p-2">


        <div class="row">
            <div class="col-12">
                <h5 style="word-wrap:break-word; letter-spacing: 2px;" ; class="bg-dark p-1 rounded text-white">
                    <?php echo $torrent_meta_info_array['name'] ?>
                </h5>
            </div>
        </div>



        <div class="row">
            <div class="col">
                <a href="<?php echo $magnet_link; ?>" class="btn btn-sm btn-danger">
                    <i class="fa fa-magnet fa-1x"></i>
                    Magnet
                </a>
                <a href="<?php echo $torrent['file_path'] ?>" class="btn btn-sm btn-primary">
                    <i class="fa fa-file fa-1x"></i>
                    Download Torrent
                </a>
            </div>

        </div>

        <div class="row mt-2">

            <div class="col">

                <div class="shadow-sm p-1">
                    <small class="border-bottom">Type:
                        <a href="/templates/torrents/<?php echo $torrent['category'] ?>_torrents.php">
                            <b><?php echo ucfirst($torrent['category']); ?></b>
                        </a>
                    </small><br>

                    <small class="border-bottom">
                        Size:
                        <b> <?php echo $torrent_meta_info_array['size']; ?></b>
                    </small>
                    <br>

                    <small class="border-bottom">
                        Hash:
                        <b><?php echo strtoupper($torrent_meta_info_array['hash']); ?></b>
                    </small>
                    <br>

                    <small class="border-bottom">
                        <b class="text-success" id="seeders">Seeds: <?php echo $torrent['peers_info']['seeders']; ?></b> |
                        <b class="text-info" id="completed">Completed: <?php echo $torrent['peers_info']['completed'];  ?></b> |
                        <b class="text-danger" id="leechers">Leeches: <?php echo $torrent['peers_info']['leechers']; ?></b>
                    </small>

                    <button id="refresh-peers-btn" class="btn btn-sm btn-light">
                        <i id="refresh-icon" class="fa fa-sync fa-xs" aria-hidden="true"></i>
                    </button>
                </div>
            </div>


            <div class="col">
                <div class="shadow-sm p-1">


                    <small class="border-bottom">Date:
                        <b><?php echo $torrent['date']; ?></b>
                    </small><br>
                    <small class="border-bottom">Uploaded By:
                        <b><?php echo $torrent['uploader']; ?></b>
                    </small><br>
                    <small class="border-bottom">Files:
                        <b><?php echo sizeof($torrent_meta_info_array['content']); ?></b>
                    </small><br>
                    <small class="border-bottom">Comments:
                        <b id="comments-count"><?php echo $total_comments; ?></b>
                    </small>

                </div>
            </div>
        </div>

        <div class="description-div border p-2 mt-2">
            <h6 class="text-dark">
                <button id="des-btn" class="btn btn-sm btn-light">
                    <i id="show-icon" class="fas fa-arrow-up"></i>
                </button>
                <b>Description</b> </h6>
            <hr>
            <small id="description-text">
                <?php echo nl2br($torrent['description']); ?>
            </small>
        </div>
        <div class="files-div p-2 border mt-2">
            <h6 class="text-dark">
                <button id="show-files-btn" class="btn btn-sm btn-light">
                    <i id="show-files-icon" class="fas fa-arrow-up"></i>
                </button>
                <b>Files</b> </h6>
            <hr>

            <div id="files-div">


                <?php foreach ($torrent_meta_info_array['content'] as $file_content => $size) : ?>

                    <div style="word-wrap:break-word" ; class="p-1 border-bottom">
                        <small>
                            <?php echo $file_content ?>
                        </small>
                        <br>
                        <small class="bg-dark p-1 rounded">
                            <b class="text-light"><?php echo SizeConversion::humanReadableSize($size) ?></b>
                        </small>
                    </div>

                <?php endforeach; ?>
            </div>

        </div>

        <div class="p-2 border mt-2">
            <h6>
                <button id="show-trackers-btn" class="btn btn-light btn-sm">
                    <i id="show-icon-trackers" class="fas fa-arrow-down"></i>
                </button>
                <b>Trackers</b>
            </h6>
            <hr>

            <div style="display: none;" id="trackers-div">
                <?php foreach ($torrent_meta_info_array['trackers'] as $tracker) : ?>
                    <div class="trackers-div p-1">
                        <small><?php echo $tracker; ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="p-2 border mt-2">
            <div class="form-group" id="comment-form">
                <label for="comments-input">
                    <h6> <b>Comment</b> </h6>
                </label>
                <textarea placeholder="Enter comments here..." class="form-control form-control-sm" name="comments" id="comments-input" cols="30" rows="2"></textarea>
                <button disabled id="comment-btn" class="btn btn-sm btn-dark mt-1">
                    <i id="comment-btn-icon" class="fas fa-comment"></i>
                    Submit
                </button>
            </div>
        </div>

        <div class="p-1 border mt-2">
            <h6>
                <button id="show-comment-btn" class="btn btn-sm btn-light" id="show-comments-btn">
                    <i class="fas fa-arrow-down"></i>
                </button>
                <b>Comments</b>

            </h6>

            <hr>

            <div id="comments-div">


            </div>

        </div>

    </div>

</body>

</html>