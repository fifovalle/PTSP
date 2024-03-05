<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/ajukan.css">
    <title>Ajukan PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid mt-5">
        <div class="row" id="option">
            <div class="col" id="button-option">
                <button onclick="showContent('form1')">
                    <span class="box-option">
                        Kegiatan Penanggulangan Bencana
                    </span>
                </button>
                <button onclick="showContent('form2')">
                    <span class="box-option">
                        Kegiatan Sosial
                    </span>
                </button>
                <button onclick="showContent('form3')">
                    <span class="box-option">
                        Kegiatan Keagamaan
                    </span>
                </button>
                <button onclick="showContent('form4')">
                    <span class="box-option">
                        Kegiatan Pertahanan dan Keamanan
                    </span>
                </button>
                <button onclick="showContent('form5')">
                    <span class="box-option">
                        Kegiatan Pendidikan dan Penilitian non Komersil
                    </span>
                </button>
            </div>
            <div class="col" id="button-option">
                <button onclick="showContent('form6')">
                    <span class="box-option">
                        Pemerintah Pusat atau Daerah
                    </span>
                </button>
                <button onclick="showContent('form7')">
                    <span class="box-option">
                        Pelayanan Informasi dengan Tarif PNBP
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
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
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/ajukan.js"></script>
</body>

</html>