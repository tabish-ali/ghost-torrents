<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/base/head-tags.php';
    ?>


</head>
<div class="container">

    <div class="row">
        <!-- the cols in this div change the number of cards per row depending on screen size and the mb-4 adds space below cards if they spill over into the next row-->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card">
                <img class="card-img-top" src="https://res.cloudinary.com/sepuckett86/image/upload/v1513176680/IMG_5837_xicdt5.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card">
                <img class="card-img-top" src="https://res.cloudinary.com/sepuckett86/image/upload/v1513095416/IMG_7240_q9dadh.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card">
                <img class="card-img-top" src="https://res.cloudinary.com/sepuckett86/image/upload/v1513176676/DSCN2129_copy_cdgcqc.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">This photo is a different size than the first two.</p>
                </div>
            </div>
        </div>
    </div>

</html>