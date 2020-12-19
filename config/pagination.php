<?php

use function PHPSTORM_META\type;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once $_SERVER['DOCUMENT_ROOT'] . '/db-config/db-connection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/torrents/torrents-database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/users/user-database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/articles/articles-database.php';

$type = $_GET['type'];

$category = "";
$total_records = 0;

switch ($type) {
    case 'torrents':
        $result = torrentPagination();
        $category = $result["category"];
        $total_records = $result["total_records"];
        break;

    case 'users':
        $total_records = usersPagination();
        break;
    case 'articles':
        $total_records = articlesPagination();
        break;
    default:
        break;
}

function usersPagination()
{
    $total_records = UserDatabase::countUsers();
    return $total_records;
}

function torrentPagination()
{
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $total_records = TorrentsDatabase::countTotalTorrents("$category");
        return ["category" => $category, "total_records" => $total_records];
    }
}

function articlesPagination()
{
    $total_records = ArticlesDatabase::countArticles();
    return $total_records;
}

if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;

if ($type === "torrents") {
    if ($category === "all")
        $torrents = TorrentsDatabase::getTorrents($offset, $total_records_per_page);
    else
        $torrents = TorrentsDatabase::getTorrentsByCategory($offset, $total_records_per_page, $category);
} else if ($type === "users") {
    $users = UserDatabase::getUsersByOffset($offset, $total_records_per_page);
} else if ($type === "articles") {
    $articles = ArticlesDatabase::getArticlesByOffset($offset, $total_records_per_page);
}

?>

<div class="text-light mt-4 mb-3">
    <strong class="dark-bg p-2 rounded"><?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
</div>

<ul class="pagination dark-bg">
    <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } 
    ?>
    <li class="page-item" <?php if ($page_no <= 1) {
                                echo "class='disabled'";
                            } ?>>
        <a class="page-link" <?php if ($page_no > 1) {
                                    echo "href='?page_no=$previous_page'";
                                } ?>>Previous</a>
    </li>

    <?php
    if ($total_no_of_pages <= 10) {
        for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
            if ($counter == $page_no) {
                echo "<li class='page-item active'><a class='page-link'>$counter<span class='sr-only'>(current)</span></a></li>";
            } else {
                echo "<li class='page-item' ><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
            }
        }
    } elseif ($total_no_of_pages > 10) {

        if ($page_no <= 4) {
            for ($counter = 1; $counter < 8; $counter++) {
                if ($counter == $page_no) {
                    echo "<li class='page-item active'><a class='page-link'>$counter<span class='sr-only'>(current)</span></a></li>";
                } else {
                    echo "<li class='page-item' ><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }
            }
            echo "<li><a>...</a></li>";
            echo "<li class='page-item' ><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
        } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
            echo "<li class='page-item'><a class='page-link'>...</a></li>";
            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                if ($counter == $page_no) {
                    echo "<li class='page-item active'><a class='page-link' >$counter<span class='sr-only'>(current)</span></a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }
            }
            echo "<li><a>...</a></li>";
            echo "<li class='page-item' ><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
            echo "<li><a>...</a></li>";

            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                if ($counter == $page_no) {
                    echo "<li class='page-item active'><a class='page-link'>$counter<span class='sr-only'>(current)</span></a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }
            }
        }
    }
    ?>
    <li class="page-item" <?php if ($page_no >= $total_no_of_pages) {
                                echo "class='disabled'";
                            } ?>>
        <a class="page-link" <?php if ($page_no < $total_no_of_pages) {
                                    echo "href='?page_no=$next_page'";
                                } ?>>Next</a>
    </li>
    <?php if ($page_no < $total_no_of_pages) {
        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>