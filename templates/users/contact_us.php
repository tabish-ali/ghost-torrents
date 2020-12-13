<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>
    <script src="/js/contact_us.js"></script>

    <title>Ghost | Contact Us</title>
</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';

    if (isset($_SESSION['id']))
        $user = UserDatabase::getUserById($_SESSION['id']);

    ?>

    <div class="container" style="margin-top: 100px;" id="container">

        <?php if (!isset($_SESSION['id'])) : ?>

            <h3 class="text-light">We love to hear from you!</h3>
            <form method="post" id="contact-form" action="#" class="default-form">
                <div class="form-group">
                    <label class="text-light" for="name"><small>Name</small></label>
                    <input id="name" required type="text" name="name" class="form-control form-contrl-sm" />
                </div>

                <div class="form-group">
                    <label class="text-light" for="name"><small>Email</small></label>
                    <input id="email" required type="email" name="email" class="form-control form-contrl-sm" />
                </div>

                <div class="form-group">
                    <label class="text-light" for="name"><small>Message</small></label>
                    <textarea id="message" required name="message" id="" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-dark" id="send-btn">Message</button>
                <br>
            </form>
        <?php endif; ?>

    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>

</body>

</html>