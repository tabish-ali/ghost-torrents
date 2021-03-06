<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    ?>

    <script src="/js/send_mail.js"></script>

    <title>Ghost | Forgot Password</title>
</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/login-user.php';
    ?>


    <div class="container" style="margin-top: 100px;" id="container">

        <div id="form-div" method="post" class="default-form center-form mb-4 shadow">

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text border-dark" id="inputGroup-sizing-sm">
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
                <input required id="email-input" placeholder="Enter email..." type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>

            <button id="reset-btn" class="btn btn-sm btn-success">
                <i id="reset-btn-icon" class="fas fa-redo"></i>
                Reset Password
            </button><br>
            <small id="msg" style="display: none;"></small>
        </div>
    </div>

</body>

</html>