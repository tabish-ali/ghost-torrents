<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>
    <title>Ghost | Login In</title>
</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/login-user.php';
    ?>

    <div class="container" style="margin-top: 100px;" id="container">

        <div id="main">

            <form method="post" action="#" class="default-form center-form mb-4 shadow">

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-dark" id="inputGroup-sizing-sm">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input required name="username-email" placeholder="username/Email" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-dark" id="inputGroup-sizing-sm">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input required id="password" name="password" id="password-field" placeholder="Password" type="password" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="form-group">
                    <Button style="width: 100%;" id="login-btn" name="login-btn" type="submit" class="btn btn-primary btn-sm">Login</Button>

                </div>
                <hr>

                <div class="form-group">
                    <small> <a href="/templates/auth/sign_up.php">Register</a></small>
                </div>

                <div class="form-group">
                    <small><a href="/templates/auth/forgot_password.php" class="">Forgot password?</a></small>
                </div>

                <div class="errors-div">

                    <?php
                    if ($notification != null) {
                        foreach ($notification->getNotification() as $n) {
                            echo '
                        <div class="alert alert-danger alert-dismissible fade show"role="alert">
                        <small>' . $n . '</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
                        }
                    }
                    ?>

                </div>

            </form>

        </div>

    </div>
</body>

</html>