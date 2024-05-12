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
    <title>Data PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../assets/our/css/index.css">
    <link rel="stylesheet" href="../assets/our/css/data.css">
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
                        <h1 class="breadcrumb">Kumpulan Data</h1>
                    </div>
                    <div class="row">
                        <div id="menuDataForDrive" class="col-12">
                            <div class="row">
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll active">Admin</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Pengguna</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Informasi</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Jasa</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Pengajuan</p>
                                </div>
                                <div class="menu col-2 creation">
                                    <p class="fw-semibold dataAll">Pembayaran</p>
                                </div>
                                <div class="menu col-2 creation">
                                    <p class="fw-semibold dataAll">Pembuatan</p>
                                </div>
                                <div class="menu col-2 historyMenuData">
                                    <p class="fw-semibold dataAll">Riwayat Transaksi</p>
                                </div>
                                <div class="menu col-2 historyMenuDataIKM">
                                    <p class="fw-semibold dataAll">Riwayat IKM</p>
                                </div>
                            </div>
                        </div>
                        <hr class="hrData">
                        <div id="filterDataForDrive" class="row" style="position: relative;">
                            <div class="col-1">
                                <i class="bx bx-filter iconFilter"></i>
                            </div>
                            <div class="col-10 mb-3">
                                <input id="filterInput" class="filterInput" type="text" placeholder="Filter Nama Pengguna" onkeydown="handleInput(event)">
                                <div id="valuesContainer"></div>
                            </div>
                            <!-- UNTUK MAINTENANCE -->
                            <!-- <div id="dropdownFilter" class="dropdownContentFilter row">
                                <div class="col listDropdownFilter">
                                    <span>Nama Pengguna</span>
                                </div>
                                <div class="col listDropdownFilter">
                                    <span>Email</span>
                                </div>
                            </div> -->
                        </div>
                        <hr class="hrData">
                        <div class="row mx-auto">
                            <div class="col">
                                <!-- ALL TABLE START -->
                                <?php include "../partials/utils/admin-table.php" ?>
                                <?php include "../partials/utils/user-table.php" ?>
                                <?php include "../partials/utils/informations-table.php" ?>
                                <?php include "../partials/utils/sevices-table.php" ?>
                                <?php include "../partials/utils/applyment-table.php" ?>
                                <?php include "../partials/utils/creation-table.php" ?>
                                <?php include "../partials/utils/payment-table.php" ?>
                                <?php include "../partials/utils/payment-table-history.php" ?>
                                <?php include "../partials/utils/history-ikm-table.php" ?>
                                <!-- ALL TABLE END -->
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
    include "../partials/utils/modal-edit-admin.php";
    ?>
    <?php
    include "../partials/utils/modal-edit-user.php";
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
    <?php
    include "../partials/utils/modal-aprove-payment.php";
    ?>
    <?php
    include "../partials/utils/modal-aprove.php";
    ?>
    <?php
    include "../partials/utils/modal-see-applyment.php";
    ?>
    <?php
    include "../partials/utils/modal-see-transactions.php";
    ?>
    <?php
    include "../partials/utils/modal-aprove-applyment.php";
    ?>
    <?php
    include "../partials/utils/isAdmin.php";
    ?>
    <!-- ALL MODAL END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- CDN DRIVE.JS -->
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <!-- OUR JS -->
    <script src="../assets/our/js/data.js"></script>
    <script src="../assets/our/js/index.js"></script>
    <script src="../assets/our/js/filter-data.js"></script>
    <script src="../assets/our/js/delete-admin.js"></script>
    <script src="../assets/our/js/delete-user.js"></script>
    <script src="../assets/our/js/delete-information.js"></script>
    <script src="../assets/our/js/delete-services.js"></script>
    <script src="../assets/our/js/delete-transaction.js"></script>
    <script src="../assets/our/js/delete-history-transaction.js"></script>
    <script src="../assets/our/js/delete-applyment.js"></script>
    <script src="../assets/our/js/value-admin.js"></script>
    <script src="../assets/our/js/value-services.js"></script>
    <script src="../assets/our/js/value-applyment.js"></script>
    <script src="../assets/our/js/value-see-applyment.js"></script>
    <script src="../assets/our/js/value-see-payment.js"></script>
    <script src="../assets/our/js/value-transactions.js"></script>
    <script src="../assets/our/js/value-user.js"></script>
    <script src="../assets/our/js/value-information.js"></script>
    <script src="../assets/our/js/value-payment.js"></script>
    <script src="../assets/our/js/value-creation.js"></script>
    <script src="../assets/our/js/filter.js"></script>
    <script src="../assets/our/js/drive-all.js"></script>
    <script src="../assets/our/js/search-alldata.js"></script>
    <script src="../assets/our/js/view-image.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- ALERT -->
    <?php include '../partials/utils/alert.php' ?>

</body>

</html>