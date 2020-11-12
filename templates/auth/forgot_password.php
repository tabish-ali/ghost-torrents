<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>


    <script src="/js/send_mail.js"></script>

</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/login-user.php';
    ?>


    <div class="container mt-5">

        <div id="form-div" method="post" class="default-form center-form mb-4 shadow">

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
                <input required id="email-input" placeholder="Enter email..." type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>

            <button id="reset-btn" class="btn btn-sm btn-success">
                <i id="reset-btn-icon" class="fas fa-redo"></i>
                Reset Password
            </button><br>

        </div>

    </div>


    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php';
    ?>

</body>

</html>