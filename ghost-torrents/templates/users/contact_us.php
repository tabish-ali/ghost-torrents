<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/users/user-database.php';
    if (isset($_SESSION['id']))
        $user = UserDatabase::getUserById($_SESSION['id']);
    ?>
    <script>
        var user = <?php echo json_encode($user); ?>
    </script>

    <script src="/js/contact_us.js"></script>

    <title>Ghost | Contact Us</title>
</head>

<body>


    <div class="container" style="margin-top: 100px;" id="container">
        <h3 class="text-light">We love to hear from you!</h3>
        <small class="mb-4 text-light dark-bg p-1 rounded">You can also request movies, games, softwares and much more!</small>
        <form method="post" id="contact-form" action="#" class="default-form mt-1">
            <?php if (!isset($_SESSION['id'])) : ?>
                <div class="form-group">
                    <label class="text-light" for="name"><small>Name</small></label>
                    <input id="name" required type="text" name="name" class="form-control form-contrl-sm" />
                </div>

                <div class="form-group">
                    <label class="text-light" for="name"><small>Email</small></label>
                    <input id="email" required type="email" name="email" class="form-control form-contrl-sm" />
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="text-light" for="name"><small>Message</small></label>
                <textarea id="message" required name="message" id="" cols="30" rows="10" class="form-control form-control-sm"></textarea>
            </div>
            <div class="form-group" id="code-div">
                <label id="code-label" class="text-light" for="name"><small>Enter Code</small></label>
                <input id="code-input" class="form-control form-control-sm" type="number" />
                <small class="form-text text-muted">To avoid spam</small>
            </div>
            <br>
            <button type="submit" class="btn btn-sm btn-dark" id="send-btn">Message</button>
            <br>
        </form>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>

</body>

</html>