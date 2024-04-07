<?php
// DATABASES
include '../config/databases.php';
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
    <title>Analitik PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../assets/our/css/index.css">
    <link rel="stylesheet" href="../assets/our/css/data.css">
    <link rel="stylesheet" href="../assets/our/css/analitic.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- FAVICON -->
    <link rel="icon" href="../assets/image/logo/1.png">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- DRIVE JS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
</head>

<body>
    <!-- NAVBAR START-->
    <?php
    include "../partials/components/navbar.php";
    ?>
    <!-- NAVBAR END-->
    <section class="container-fluid mainWebsite">
        <section class="row">
            <!-- SIDEBAR START -->
            <?php
            include "../partials/components/sidebar.php"
            ?>
            <!-- SIDEBAR END -->
            <div class="container-fluid">
                <!-- MAIN START -->
                <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <h1 class="breadcrumb">Kumpulan Analitik</h1>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <div id="menuAnaliticForDrive" class="row">
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll active">Semua</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Informasi</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Jasa</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">IKM</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Transaksi</p>
                                </div>
                            </div>
                            <div id="menuDropdownAnaliticForDrive" class="row">
                                <div class="menuDropdownAnalitic text-center">
                                    <div class="dropdown">
                                        <p class="dropdown-toggle-analitic" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                                            7 Hari Terakhir <span class="caret"></span>
                                        </p>
                                        <div class="dropdown-menu-analitic" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">28 Hari Terakhir</a>
                                            <a class="dropdown-item" href="#">1 Tahun Terakhir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hrData">
                        <div class="row mx-auto">
                            <div class="col">
                                <!-- ALL ANALITIC START -->
                                <?php include "../partials/utils/all-analitic.php" ?>
                                <?php include "../partials/utils/all-analitic-information.php" ?>
                                <?php include "../partials/utils/all-analitic-sevices.php" ?>
                                <?php include "../partials/utils/all-analitic-IKM.php" ?>
                                <?php include "../partials/utils/all-analitic-transaction.php" ?>
                                <!-- ALL ANALITIC END -->
                            </div>
                        </div>
                        <!-- FOOTER START -->
                        <?php include "../partials/components/footer.php" ?>
                        <!-- FOOTER END -->
                </main>
                <!-- MAIN END -->
            </div>
            <div class="fab-wrapper">
                <input id="fabCheckbox" type="checkbox" class="fab-checkbox" />
                <label class="fab" for="fabCheckbox">
                    <span class="fab-dots fab-dots-1"></span>
                    <span class="fab-dots fab-dots-2"></span>
                    <span class="fab-dots fab-dots-3"></span>
                </label>
                <div class="fab-wheel">
                    <a class="fab-action fab-action-1" id="spanHelp">
                        <i class="fas fa-question"></i>
                    </a>
                    <a class="fab-action fab-action-2" data-bs-toggle="modal" data-bs-target="#sendFeedbackModal">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a class="fab-action fab-action-3">
                    </a>
                    <a class="fab-action fab-action-4">
                    </a>
                </div>
            </div>
        </section>
    </section>

    <!-- ALL MODAL START -->
    <?php
    include "../partials/utils/modal-add-admin.php";
    ?>
    <?php
    include "../partials/utils/modal-add-information.php";
    ?>
    <?php
    include "../partials/utils/modal-add-services.php";
    ?>
    <?php
    include "../partials/utils/modal-edit-information.php";
    ?>
    <?php
    include "../partials/utils/modal-edit-services.php";
    ?>
    <?php
    include "../partials/utils/modal-send-feedback.php";
    ?>
    <!-- ALL MODAL END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- CDN DRIVE.JS -->
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <!-- OUR JS -->
    <script src="../assets/our/js/analitic.js"></script>
    <script src="../assets/our/js/toggle-password.js"></script>
    <script src="../assets/our/js/index.js"></script>
    <script src="../assets/our/js/chart/chart-analytics.js"></script>
    <script src="../assets/our/js/chart/chart-analytics2.js"></script>
    <script src="../assets/our/js/chart/chart-analytics3.js"></script>
    <script src="../assets/our/js/chart/chart-analytics4.js"></script>
    <script src="../assets/our/js/chart/chart-information.js"></script>
    <script src="../assets/our/js/chart/chart-services.js"></script>
    <script src="../assets/our/js/chart/apexcharts.js"></script>
    <script src="../assets/our/js/delete-information.js"></script>
    <script src="../assets/our/js/delete-services.js"></script>
    <script src="../assets/our/js/value-information.js"></script>
    <script src="../assets/our/js/value-services.js"></script>
    <script src="../assets/our/js/drive-all.js"></script>
    <script src="../assets/our/js/search-alldata.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>