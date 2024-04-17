<?php
include '../../admin/config/databases.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../assets/css/katalogproduk.css">
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid p-0" id="katalog">
        <div class="container text-center">
            <div class="d-flex row">
                <h1 class="mb-5">KATALOG PRODUK</h1>
                <div class="col-md-12" id="informasi">
                    <h4 class="my-3">INFORMASI
                        <hr>
                    </h4>
                    <div class="row pt-5">
                        <div class="col p-1">
                            <div class="card-product">
                                <div class="picture-box">
                                    <span class="dot">
                                        <box-icon name='landscape' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="content-box">
                                    <h4>INFORMASI METEOROLOGI</h4>
                                    <a href="../partials/produk-informasi-meteorolgi.php" class="buy">Lihat Ini</a>
                                </div>
                            </div>
                        </div>
                        <div class="col p-1">
                            <div class="card-product">
                                <div class="picture-box">
                                    <span class="dot">
                                        <box-icon name='cloud-lightning' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="content-box">
                                    <h4>INFORMASI KLIMATOLOGI</h4>
                                    <a href="../partials/produk-informasi-klimatologi.php" class="buy">Lihat Ini</a>
                                </div>
                            </div>
                        </div>
                        <div class="col p-1">
                            <div class="card-product">
                                <div class="picture-box">
                                    <span class="dot">
                                        <box-icon name='water' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="content-box">
                                    <h4>INFORMASI GEOFISIKA</h4>
                                    <a href="../partials/produk-informasi-geofisika.php" class="buy">Lihat Ini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="jasa">
                    <h4 class="my-3">JASA
                        <hr>
                    </h4>
                    <div class="row pt-5">
                        <div class="col p-1">
                            <div class="card-product">
                                <div class="picture-box">
                                    <span class="dot">
                                        <box-icon name='landscape' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="content-box">
                                    <h4>JASA METEOROLOGI</h4>
                                    <a href="../partials/produk-jasa-meteorologi.php" class="buy">Lihat Ini</a>
                                </div>
                            </div>
                        </div>
                        <div class="col p-1">
                            <div class="card-product">
                                <div class="picture-box">
                                    <span class="dot">
                                        <box-icon name='cloud-lightning' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="content-box">
                                    <h4>JASA KLIMATOLOGI</h4>
                                    <a href="../partials/produk-jasa-klimatologi.php" class="buy">Lihat Ini</a>
                                </div>
                            </div>
                        </div>
                        <div class="col p-1">
                            <div class="card-product">
                                <div class="picture-box">
                                    <span class="dot">
                                        <box-icon name='water' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="content-box">
                                    <h4>JASA GEOFISIKA</h4>
                                    <a href="../partials/produk-jasa-geofisika.php" class="buy">Lihat Ini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('../partials/footer.php');
    ?>
    <script src="../assets/js/navbar.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>