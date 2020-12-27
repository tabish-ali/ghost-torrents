<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/head-tags.php';
    ?>
    <title>Ghost | About Us</title>

</head>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/navbar.php';
    ?>

    <div class="container" style="margin-top: 100px;" id="container">

        <div class="text-light text-justify">
            <div class="dark-bg p-3 rounded">
                <h3>Getting things done in simpler way.</h3>
                <p>Welcome to Ghost Torrents which provides you simpler features to
                    download torrents. It is developed for <b class="text-success">people</b> who loves internet freedom.
                    I believe that everyone needs something. So it is not neccesary that you pay hefty bills
                    on netflix. There are some people who will provide you these features at no cost.
                    Yes we exist!. Some people see world beyond just money.We live in harsh world where everyone
                    try to take but it is not bad if someone try to give something back.
                    Some people will try to block it.
                    But don't worry we are ghosts, we can't be seen and we will raise again.</p>
            </div>
            <br>
            <div class="dark-bg p-3 rounded">
                <h3>About Site</h3>
                <p>Site is developed by one person so design won't looks good because he does not
                    know about styling much. He's kind of logical programmer who dont have much eye for
                    details.But he makes sure that site is secure and functionality is not
                    compromised. Unfortunately my server does not support outgoing UDP requests
                so currenlty I am unable to retrieve seeds and leeches from torrent.</p>
            </div>
            <br>
            <div class="dark-bg p-3 rounded">
                <h3>Techlogies Used</h3>
                <ul>
                    <li>PHP</li>
                    <li>Javascript</li>
                    <li>JQuery</li>
                    <li>AJAX</li>
                    <li>HTML/CSS/Bootstrap</li>
                    <li>MySQL</li>
                    <li>Torrent Scraper</li>
                    <li>Alot of frustration</li>
                </ul>
            </div>
            <br>
            <div class="dark-bg p-3 rounded">
                <h3>Special Thanks To</h3>
                <ul>
                    <li>GOD</li>
                    <li><a target="_blank" class="primary-label" href="https://github.com/adriengibrat/torrent-rw">Adrien Gibrat (Torrent info scraper)</a></li>
                    <li><a target="_blank" class="primary-label" href="https://www.tiny.cloud/">Tiny MCE (Rich Text Area) </a> </li>
                    <li><a target="_blank" class="primary-label" href="https://www.allphptricks.com/author/javed/">Javed Ur Rehman (For pagination)</a></li>
                    <li><a target="_blank" class="primary-label" href="https://izitoast.marcelodolza.com/">IziToast</a></li>
                    <li><a target="_blank" class="primary-label" href="https://www.stackoverflow.com">StackOverFlow</a></li>
                    <li><a target="_blank" class="primary-label" href="https://www.w3school.com">W3School</a></li>
                    <li><a target="_blank" class="primary-label" href="https://getbootstrap.com/">Bootstrap</a></li>
                </ul>
            </div>
            <br>
            <div class="dark-bg p-3 rounded">
                <h3>About Developer</h3>
                <p>There isn't not to tell about him. He is no body but if you are curious
                    just read about him here</p>
                <a href="/templates/info/my_story.php" class="btn btn-primary">MY STORY</a>
            </div>
        </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/ghost-torrents'.'/templates/base/footer.php' ?>
</body>

</html>