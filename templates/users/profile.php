<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>

    <script type="text/javascript">
        var user_id = "<?= $_SESSION['id'] ?>";
        var username = "<?= $_SESSION['username'] ?>";
        var email = "<?= $_SESSION['email'] ?>";
    </script>

    <link rel="stylesheet" href="/css/profile.css">
    <script type="text/javascript" src="/js/edit_profile.js"></script>
    <script type="text/javascript" src="/js/change_image.js"></script>
    <script src="/js/change_password.js"></script>
    <link rel="stylesheet" href="/css/izi_toast.min.css">
    <script src="/js/izi_toast.min.js" type="text/javascript"></script>
</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';

    $user = UserDatabase::getUserById($_SESSION['id']);

    ?>

    <div class="container mt-5">
        <?php if (!empty($_SESSION)) : ?>


            <div class="row p-2 bg-light shadow-sm">

                <div class="col-sm">
                    <?php echo $user['username']; ?>
                    <?php if (isset($user['admin'])) : ?>
                        <small class="bg-primary p-1 rounded text-white">
                            <b>Admin</b>
                        </small>
                    <?php else : ?>
                        <small class="bg-info p-1 rounded text-white">
                            <b>User</b>
                        </small>
                    <?php endif; ?>
                </div>

            </div>

            <div class="mt-4 row shadow-sm p-2 profile-header">
                <div class="col-md-6">
                    <form method="post" enctype="multipart/form-data" id="image-upload-form">
                        <div class="image-upload" id="img-upload-div">
                            <label for="image-file-input">
                                <img id="out-image" class="user-img img-thumbnail" 
                                src="<?php echo $_SESSION['image']; ?>" alt="image" />
                            </label>
                            <input name="image" id="image-file-input" type="file" /> <br>
                            <Button id="save-image-btn" style="display: none;" type="submit" class="btn btn-sm btn-dark mt-2">Save</Button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <small class="border-bottom">Torrents uploaded:
                        <b class="bg-dark p-1 rounded text-white">5</b>
                        <br>
                    </small>

                    <small class="border-bottom">Articles uploaded:
                        <b class="bg-info p-1 rounded text-white">5</b>
                        <br>
                    </small>
                    <small class="border-bottom">Torrent Likes:
                        <b class="bg-primary p-1 rounded text-white">5</b>
                        <br>
                    </small>
                    <small class="border-bottom">Articles Likes:
                        <b class="bg-success p-1 rounded text-white">5</b>
                        <br>
                    </small>
                </div>
            </div>

            <div class="row mt-4 p-1 bg-dark text-white rounded">
                <div class="col-sm">
                    Introduction
                </div>
            </div>

            <div class="row mt-2 p-2 shadow-sm">
                <div class="col-sm">
                    <textarea id="intro-input" class="form-control form-control-sm" name="intro" id="" cols="15" rows="6"><?php if (isset($user['intro'])) echo nl2br($user['intro']); ?></textarea>
                    <button id="save-intro-btn" class="btn btn-sm btn-success mt-2">Save</button>
                </div>
            </div>


            <div class="row mt-4 p-1 bg-dark text-white rounded">
                <div class="col-sm">
                    Other Information
                </div>
            </div>

            <div class="row mt-2 p-2 shadow-sm">

                <div class="col-sm">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span style="width: 100px;" class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" id="username-field" value="<?php echo $_SESSION['username'] ?>">
                        <div class="input-group-append">
                            <button id="save-username-btn" style="width: 100px;" class="btn btn-sm btn-primary">Save</button>
                        </div>

                    </div>

                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span style="width: 100px;" class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                        </div>
                        <input type="email" id="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['email'] ?>">
                        <div class="input-group-append">
                            <button id="save-email-btn" style="width: 100px;" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-4 p-1 bg-dark text-white rounded shadow-sm">
                <div class="col-sm">

                    Password

                </div>
            </div>

            <div class="row mt-2 p-2 shadow-sm">

                <div class="col-sm">


                    <div class="form-group">
                        <input placeholder="Old password" type="password" name="password1" id="password1" class="form-control form-control-sm">
                        <small id="match-text" style="display: none;" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <input placeholder="New password" type="password" name="password2" id="password2" class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <input placeholder="Confirm password" type="password" name="password3" id="password3" class="form-control form-control-sm">
                        <small id="emailHelp" class="form-text text-muted">Make sure to match last two passwords.</small>
                        <small id="password-match-notification" style="display: none;"></small>
                    </div>

                    <Button id="change-btn" class="btn btn-sm btn-secondary">Change</Button>

                </div>

            </div>

        <?php else : ?>
            <div class="alert alert-primary" style="text-align: center;" role="alert">
                Please login to see your profile...
            </div>
        <?php endif; ?>
    </div>



</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>

</html>