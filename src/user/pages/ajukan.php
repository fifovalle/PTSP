<?php
include '../../admin/config/databases.php';
if (!isset($_SESSION['ID_Perusahaan']) && !isset($_SESSION['ID_Pengguna'])) {
    setPesanKesalahan("Anda tidak bisa mengakses halaman pesanan. Silakan login terlebih dahulu.");
    header("Location: $akarUrl" . "src/user/pages/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/ajukan.css">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <title>Ajukan PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <main class="container-fluid w-100 mt-5">
        <div class="row" id="option">
            <div class="col-md-12" id="button-option">
                <div class="row">
                    <div class="col-lg-3 pt-lg-2 col-sm-12 pt-sm-2 px-sm-0 text-center" id="ajukan1">
                        <button onclick="showContent('form1')">
                            <span class="translate-middle badge rounded-pill bg-success">
                                GRATIS
                            </span>
                            <span class="box-option selected">
                                Kegiatan Penanggulangan Bencana
                            </span>
                        </button>
                    </div>
                    <div class="col-lg-3 pt-lg-2 col-sm-12 pt-sm-4 px-sm-0 text-center" id="ajukan2">
                        <button onclick="showContent('form2')">
                            <span class="translate-middle badge rounded-pill bg-success">
                                GRATIS
                            </span>
                            <span class="box-option">
                                Kegiatan Sosial
                            </span>
                        </button>
                    </div>
                    <div class="col-lg-3 pt-lg-2 col-sm-12 pt-sm-4 px-sm-0 text-center" id="ajukan3">
                        <button onclick="showContent('form3')">
                            <span class="translate-middle badge rounded-pill bg-success">
                                GRATIS
                            </span>
                            <span class="box-option">
                                Kegiatan Keagamaan
                            </span>
                        </button>
                    </div>
                    <div class="col-lg-3 pt-lg-2 col-sm-12 pt-sm-4 px-sm-0 text-center" id="ajukan4">
                        <button onclick="showContent('form4')">
                            <span class="translate-middle badge rounded-pill bg-success">
                                GRATIS
                            </span>
                            <span class="box-option">
                                Kegiatan Pertahanan dan Keamanan
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-lg-5 mx-lg-5 col-sm-12 mt-sm-0 mx-sm-0 text-center" id="button-option">
                <div class="row">
                    <div class="col-lg-4 pt-lg-2 col-sm-12 pt-sm-0 px-sm-0 text-center" id="ajukan5">
                        <button onclick="showContent('form5')">
                            <span class="translate-middle badge rounded-pill bg-success">
                                GRATIS
                            </span>
                            <span class="box-option">
                                Kegiatan Pendidikan dan Penilitian non Komersil
                            </span>
                        </button>
                    </div>
                    <div class="col-lg-4 pt-lg-2 col-sm-12 pt-sm-4 px-sm-0 text-center" id="ajukan6">
                        <button onclick="showContent('form6')">
                            <span class="translate-middle badge rounded-pill bg-success">
                                GRATIS
                            </span>
                            <span class="box-option">
                                Pemerintah Pusat atau Daerah
                            </span>
                        </button>
                    </div>
                    <div class="col-lg-4 pt-lg-2 col-sm-12 pt-sm-4 px-sm-0 text-center" id="ajukan7">
                        <button onclick="showContent('form7')">
                            <span class=" top-0 start-0 translate-middle badge rounded-pill bg-danger">
                                BERBAYAR
                            </span>
                            <span class="box-option">
                                Pelayanan Informasi dengan Tarif PNBP
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row" id="form-ajukan">
            <div class="form-content" id="form1">
                <?php
                include('../partials/form-ajukan1.php');
                ?>
            </div>
            <div class="form-content" id="form2" style="display: none;">
                <?php
                include('../partials/form-ajukan2.php');
                ?>
            </div>
            <div class="form-content" id="form3" style="display: none;">
                <?php
                include('../partials/form-ajukan3.php');
                ?>
            </div>
            <div class="form-content" id="form4" style="display: none;">
                <?php
                include('../partials/form-ajukan4.php');
                ?>
            </div>
            <div class="form-content" id="form5" style="display: none;">
                <?php
                include('../partials/form-ajukan5.php');
                ?>
            </div>
            <div class="form-content" id="form6" style="display: none;">
                <?php
                include('../partials/form-ajukan6.php');
                ?>
            </div>
            <div class="form-content" id="form7" style="display: none;">
                <?php
                include('../partials/form-ajukan7.php');
                ?>
            </div>
        </div>
        <div class="button-container">
            <button class="z-3 btn-ajukantutorial">
                <box-icon name='question-mark' class="svgIcon" color='rgba(255,255,255,0.9)'></box-icon>
            </button>
        </div>
        <script src="../assets/js/navbar.js"></script>
        <script src="../assets/js/ajukan.js"></script>
        <!-- ALERT -->
        <?php include '../../../src/admin/partials/utils/alert.php' ?>
    </main>
</body>

</html>