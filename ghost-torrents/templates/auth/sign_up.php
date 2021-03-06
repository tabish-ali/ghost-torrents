<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    ?>
    <script src="/js/password_check.js"></script>
    <title>Ghost | Sign Up</title>

</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/register-user.php';
    ?>

    <div class="container" style="margin-top: 100px;" id="container">

        <div id="main">
            <form method="post" action="#" class="default-form center-form mb-5 shadow">

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-dark" id="inputGroup-sizing-sm">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input required name="username" placeholder="username" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>


                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-dark" id="inputGroup-sizing-sm">
                            <i class="fas fa-envelope-square"></i>
                        </span>
                    </div>
                    <input required required name="email" placeholder="Email" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-dark" id="inputGroup-sizing-sm">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input required id="password1" name="password1" placeholder="Password" type="password" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-dark" id="inputGroup-sizing-sm">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input required id="password2" name="password2" placeholder="Confirm Password" type="password" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="form-group">
                    <Button style="width: 100%;" id="reg-btn" disabled name="reg-btn" type="submit" class="btn btn-primary btn-sm">Register</Button>
                </div>
                <hr>

                <div class="form-group">
                    <small><a href="/templates/auth/login">Already have an account?</a></small>
                </div>

                <div style="display: none;" class="alert alert-warning alert-dismissible fade show" id="p-n" role="alert">
                    <small id="password-notification"></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="errors-div">

                    <?php
                    if ($notification != null) : ?>

                        <?php foreach ($notification->getNotification() as $n) : ?>

                            <div class="alert border-dark bg-danger text-light alert-secondary alert-dismissible fade show" role="alert">
                                <small> <?php echo $n ?> </small>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </form>

        </div>
    </div>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>

</body>

</html>