<?php
// DATABASES
include '../src/admin/config/databases.php';
// MEMAKSA MASUK
if (!isset($_SESSION['ID'])) {
    setPesanKesalahan("Anda tidak bisa mengakses halaman ini. Silakan login terlebih dahulu.");
    header("Location: $akarUrl" . "src/admin/pages/login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../src/admin/assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../src/admin/assets/our/css/index.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- FAVICON -->
    <link rel="icon" href="../src/admin/assets/image/logo/1.png">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
    <!-- NAVBAR START-->
    <?php
    include "../src/admin/partials/components/navbar.php";
    ?>
    <!-- NAVBAR END-->
    <section class="container-fluid mainWebsite">
        <section class="row">
            <!-- SIDEBAR START -->
            <?php
            include "../src/admin/partials/components/sidebar.php";
            ?>
            <!-- SIDEBAR END -->
            <div class="container-fluid">
                <!-- MAIN START -->
                <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <h1 class="breadcrumb">Beranda</h1>
                        <div class="iconBreadcrumb d-flex justify-content-between align-content-center gap-3">
                            <div class="iconServer" data-toggle="tooltip" title="Instansi A">
                                <i class="fas fa-server"></i>
                            </div>
                            <div class="iconServer" data-toggle="tooltip" title="Instansi B">
                                <i class="fas fa-server"></i>
                            </div>
                            <div class="iconServer" data-toggle="tooltip" title="Instansi C">
                                <i class="fas fa-server"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <h5 class="card-title py-4 mx-auto">Performa Produk Terbaru</h5>
                                <div class="position-relative mx-auto">
                                    <img src="../src/admin/assets/image/uploads/2.png" class="imageCard card-img-top" alt="Performa Produk Terbaru">
                                    <h5 class="card-title titleProduct fw-bold">Nama Produk</h5>
                                </div>
                                <div class="d-flex justify-content-around align-items-center mt-4">
                                    <div class="d-flex justify-content-between gap-3">
                                        <i class="fas fa-users"><span class="ms-2 many">10</span></i>
                                        <i class="fas fa-money-bill"><span class="ms-2 many">Rp.1.000.000</span></i>
                                    </div>
                                    <div>
                                        <i class="fas fa-caret-up caret-icon"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body hidden-content">
                                    <p class="card-text textCardProduct my-3 mb-4">Performa Selama Ini</p>
                                    <div class="row ms-auto">
                                        <div class="col-7 me-4">Pembeli</div>
                                        <div class="col-2">10</div>
                                    </div>
                                    <div class="row ms-auto">
                                        <div class="col-7 me-4">Penghasilan</div>
                                        <div class="col-4">Rp.1.000.000</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Lihat Analitik</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <h5 class="card-title pt-4 mx-auto">IKM Terbaru</h5>
                                <hr>
                                <div class="row mx-2 my-3">
                                    <div class="col-3">
                                        <img src="../src/admin/assets/image/uploads/1.jpg" alt="GambarPengunjung" class="surveyImageCard">
                                    </div>
                                    <div class="col-9">
                                        <h5>Naufal FIFA</h5>
                                        <p class="card-text textCardProduct">Waduh Saya Puas Banget Sih Bang :)..</p>
                                    </div>
                                </div>
                                <div class="card-body btnAnalitic">
                                    <a href="#" class="card-link">Lihat Analitik</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <h5 class="card-title pt-4 mx-auto">Transaksi Terbaru</h5>
                                <hr>
                                <div class="row mx-2 my-3">
                                    <div class="col-3">
                                        <img src="../src/admin/assets/image/uploads/2.png" alt="GambarPengunjung" class="surveyImageCard">
                                    </div>
                                    <div class="col-9">
                                        <h5>Seismon</h5>
                                        <p class="card-text textCardProduct">Naufal FIFA</p>
                                    </div>
                                </div>
                                <div class="card-body btnAnalitic">
                                    <a href="#" class="card-link">Lihat Analitik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FOOTER START -->
                    <?php
                    include "../src/admin/partials/components/footer.php";
                    ?>
                    <!-- FOOTER END -->
                </main>
            </div>
            <!-- MAIN END -->
        </section>
    </section>

    <!-- ALL MODAL START -->
    <?php
    include "../src/admin/partials/utils/modal-add-admin.php";
    ?>
    <?php
    include "../src/admin/partials/utils/modal-add-user.php";
    ?>
    <?php
    include "../src/admin/partials/utils/modal-add-information.php";
    ?>
    <?php
    include "../src/admin/partials/utils/modal-add-services.php";
    ?>
    <?php
    include "../src/admin/partials/utils/modal-send-feedback.php";
    ?>
    <!-- ALL MODAL END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- OUR JS -->
    <script src="../src/admin/assets/our/js/index.js"></script>
    <script src="../src/admin/assets/our/js/toggle-password.js"></script>
    <script src="../src/admin/assets/our/js/caret.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../src/admin/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- ALERT -->
    <?php include '../src/admin/partials/utils/alert.php' ?>
</body>

</html>