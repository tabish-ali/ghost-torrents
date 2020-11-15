<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php' ?>

</head>

<body>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php' ?>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/users/password-reset.php'; ?>


    <div class="container mt-5" id="container">

        <?php if ($row != "") : ?>
            <?php if ($exp_date <= $curDate) : ?>

                <form class="default-form center-form mb-4 shadow" method="post" action="" name="update">
                    <input class="form-control form-control-sm" type="hidden" name="action" value="update" />


                    <div class="form-group">
                        <label class="text-light"> <small>Enter New Password:</small> </label><br />
                        <input class="form-control form-control-sm" type="password" name="pass1" maxlength="15" required />
                    </div>


                    <div class="form-group">
                        <label class="text-light"> <small>Confirm New Password</small> </label>
                        <input class="form-control form-control-sm" type="password" name="pass2" maxlength="15" required />

                    </div>

                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                    <button class="btn btn-sm btn-success" type="submit">Reset Password</button>
                </form>

            <?php else : ?>

                <p class="text-light">
                    Your link has been expired because it is older than 1 day.
                </p>

            <?php endif; ?>


        <?php else : ?>


            <div style="margin:0 auto; width:50%; text-align: center;" class="rounded dark-bg p-2">
                <p class="danger-label">Link has expired or you have already used that link to reset password.
                    You can generate new link using address below inorder to reset password.
                </p>
            <a href="/templates/auth/forgot_password.php" class="primary-label">Reset Password Link</a>
            </div>

        <?php endif; ?>



    </div>
</body>

</html>