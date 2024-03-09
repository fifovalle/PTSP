<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>PTSP BMKG Provinsi Bengkulu</title>
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <main id="main">
        <div id="carouselCover" class="carousel slide carousel-fade mt-3">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselCover" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselCover" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselCover" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/img/Cover1.png" class=" d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/Cover2.png" class=" d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/Cover3.png" class=" d-block w-100" alt="...">
                </div>
            </div>
        </div>
        <div id="carouselProduct" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/img/Product1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../assets/img/Product2.png" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
        <div class="container-fluid text-center" id="button-content">
            <button class="btn" id="btnProduct" type="button">SELENGKAPNYA
                <span class="position-absolute top-0 start-0 w-100 h-100"></span>
            </button>
        </div>
    </main>
    <div class="button-container">
        <button class="z-3 btn-maintutorial">
            <box-icon name='question-mark' class="svgIcon" color='rgba(255,255,255,0.9)'></box-icon>
        </button>
    </div>
    <?php
    include('../partials/footer.php');
    ?>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/navbar.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>