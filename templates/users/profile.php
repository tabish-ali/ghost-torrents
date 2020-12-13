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

    <title>Ghost | User Profile | <?php echo $_SESSION['username']; ?></title>
</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';

    $user = UserDatabase::getUserById($_SESSION['id']);

    ?>

    <div class="container" style="margin-top: 100px;" id="container">

        <?php if (!empty($_SESSION)) : ?>

            <div class="dark-bg p-4 m-4" id="container">

                <div class="row p-2 shadow-sm">

                    <div class="col-sm">
                        <h3 id="username-text" class="text-light font-weight-bold"><?php echo $user['username']; ?></h3>
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

                <hr>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item btn-sm">
                        <a class="flex-sm-fill nav-link active" id="pills-avatar-tab" data-toggle="pill" href="#pills-avatar" role="tab" aria-controls="pills-avatar" aria-selected="true">Avatar</a>
                    </li>
                    <li class="nav-item btn-sm">
                        <a class="flex-sm-fill nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Intro</a>
                    </li>
                    <li class="nav-item btn-sm">
                        <a class="flex-sm-fill nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">username</a>
                    </li>
                    <li class="nav-item btn-sm">
                        <a class="flex-sm-fill nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Password</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-avatar" role="tabpanel" aria-labelledby="pills-avatar-tab">

                        <div class="mt-4 row shadow-sm p-2 profile-header">
                            <div class="col" style="text-align: center;">
                                <form method="post" enctype="multipart/form-data" id="image-upload-form">
                                    <div class="image-upload" id="img-upload-div">
                                        <label class="shadow" for="image-file-input">
                                            <img id="out-image" class="text-light user-img rounded-circle" src="<?php echo $_SESSION['image']; ?>" alt="Change image here" />
                                        </label>
                                        <input name="image" id="image-file-input" type="file" /> <br>
                                        <Button id="save-image-btn" style="display: none;" type="submit" class="btn btn-sm btn-dark mt-2">Save</Button>
                                    </div>
                                </form>
                                <small class="dark-bg p-1 rounded text-muted">Please click on image to change</small>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="col-sm">
                            <textarea id="intro-input" class="form-control form-control-sm" name="intro" id="" cols="15" rows="6"><?php if (isset($user['intro'])) echo nl2br($user['intro']); ?></textarea>
                            <button id="save-intro-btn" class="btn btn-sm btn-success mt-2" style="width: 100px;">Save</button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


                        <div class="form-group col-sm-6">
                            <label class="text-light" for="username"> <small>Username</small></label>
                            <input type="text" class="form-control form-control-sm" id="username-field" value="<?php echo $_SESSION['username'] ?>">
                            <button id="save-username-btn" style="width: 100px;" class="btn btn-sm btn-primary mt-2">Save</button>

                        </div>

                        <div class="form-group col-sm-6">
                            <label class="text-light" for="Email"> <small>Email</small></label>
                            <input type="email" id="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $_SESSION['email'] ?>">
                            <button id="save-email-btn" style="width: 100px;" class="btn btn-sm btn-primary mt-2">Save</button>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">




                        <div class="form-group col-sm-6">
                            <label for="password1" class="text-light"> <small>Old Password</small></label>
                            <input type="password" name="password1" id="password1" class="form-control form-control-sm">
                            <small id="match-text" style="display: none;" class="text-danger"></small>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="password1" class="text-light"> <small>New Password</small></label>
                            <input type="password" name="password2" id="password2" class="form-control form-control-sm">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="password1" class="text-light"> <small>Confirm Password</small></label>
                            <input type="password" name="password3" id="password3" class="form-control form-control-sm">
                            <small id="emailHelp" class="form-text text-muted">Make sure to match last two passwords.</small>

                            <Button id="change-btn" class="btn btn-sm btn-secondary mt-3">Change</Button>
                            <br>
                            <small id="password-match-notification" style="display: none;"></small>
                        </div>



                    </div>
                </div>



            <?php else : ?>
                <div class="alert alert-primary" style="text-align: center;" role="alert">
                    Please login to see your profile...
                </div>
            <?php endif; ?>
            </div>

    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>

</body>

</html>