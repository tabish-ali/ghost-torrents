<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/config/datetime.php';

    $articles = ArticlesDatabase::getArticles();

    $articles_array = array();

    while ($value = $articles->fetch_assoc()) {

        array_push($articles_array, $value);
    }

    ?>
    <title>Ghost | About Us</title>

</head>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php';
    ?>

    <div class="container" style="margin-top: 100px;" id="container">

    <div class="text-light">
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
        compromised.</p>
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
            <li>PHP Torrent Libararies</li>
        </ul>
    </div>
    <br>
    <div class="dark-bg p-3 rounded">
        <h3>About Developer</h3>
        <p>There isn't not to tell about him. She is no body but if you are curious 
        just read about him here</p>
        <a href="/templates/info/my_story.php" class="btn btn-primary" >MY STORY</a>
    </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>
</body>

</html>