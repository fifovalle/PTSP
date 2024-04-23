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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <title>Ajukan PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid w-100 mt-5">
        <div class="row" id="option">
            <div class="position-relative col-lg-6 pt-lg-2 col-sm-12 pt-sm-4 px-sm-0 text-center" id="ajukan7">
                <span class="badge rounded-pill bg-danger" id="berbayar">
                    BERBAYAR
                </span>
                <button class="btnopsiAjukan type1 selected" id="button-berbayar">
                    <span class="btn-txt">Layanan Berbayar</span>
                </button>
            </div>
            <div class="position-relative col-lg-6 pt-lg-2 col-sm-12 pt-sm-4 px-sm-0 text-center" id="ajukan7">
                <span class="badge rounded-pill bg-success" id="gratis">
                    GRATIS
                </span>
                <button class="btnopsiAjukan2 type2" id="button-gratis">
                    <span class="btn-txt">Layanan Gratis</span>
                </button>
            </div>
        </div>
        <div class="row" id="form-ajukan">
            <div class="option-gratis" id="option-gratis" style="display: none">
                <div class="dropdown text-center">
                    <button class="btn btn-secondary dropdown-toggle w-50" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih opsi layanan gratis
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark w-50" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" onclick="showContent('form1')">Kegiatan Penanggulangan Bencana</a></li>
                        <li><a class="dropdown-item" onclick="showContent('form2')">Kegiatan Sosial</a></li>
                        <li><a class="dropdown-item" onclick="showContent('form3')">Kegiatan Keagamaan</a></li>
                        <li><a class="dropdown-item" onclick="showContent('form4')">Kegiatan Pertahanan dan Keamanan</a></li>
                        <li><a class="dropdown-item" onclick="showContent('form5')">Kegiatan Pendidikan dan Penilitian non Komersil</a></li>
                        <li><a class="dropdown-item" onclick="showContent('form6')">Pemerintah Pusat atau Daerah</a></li>
                    </ul>
                </div>
            </div>
            <div class="form-content" id="form1" style="display: none;">
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
            <div class="form-content" id="option-berbayar">
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
    </div>
</body>

</html>