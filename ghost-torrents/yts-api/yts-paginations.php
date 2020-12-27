<?php

if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$yts_data = file_get_contents("https://yts.mx/api/v2/list_movies.json?limit=18&page=" . $page_no . "&with_cast=true&with_images=true&with_rt_ratings=true&order_by=asc");
$yts_data = json_decode($yts_data);



$total_records = $yts_data->data->movie_count;

$total_records_per_page = 12;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;

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