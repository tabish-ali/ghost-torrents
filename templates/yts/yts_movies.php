<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php'; ?>
    <title>Ghost | YTS | Movies</title>
    <link rel="stylesheet" href="/css/yts-movies.css">
    <script src="/js/yts-movies.js"></script>
</head>

<body>
    <div class="container" style="margin-top:100px;">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/navbar.php'; ?>
        <div id="search-div" class="text-light text-center shadow-lg p-3">
            <h3>Search <b style="color: #6AC143;">YTS</b> movies and we will get it for you!</h3>
            <form id="search-form" action="GET">
                <div class="form-group">
                    <input autofocus required id="search-input" class="mt-2 form-control form-control-lg" type="text" placeholder="Search movies here..." />
                </div>
                <div class="form-group">
                    <button id="search-btn" class="btn btn-primary"><i id="search-icon" class="fa fa-search"></i>Search</button>
                    <button id="clear-btn" class="btn btn-danger">Clear</button>
                    <button id="test-btn" class="btn btn-dark">Load TEst</button>
                </div>
            </form>
        </div>
        <div id="result-div" class="row text-light">

        </div>

    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/footer.php' ?>
</body>

</html>