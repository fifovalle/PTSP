<?php
include 'databases.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $obyekAdmin = new Admin($koneksi);
    $tampilkanSemua = $obyekAdmin->tampilkanDataAdmin($token);
    $hasil = $obyekAdmin->getAdminByToken($token);
    if ($hasil) {
        $kosongkanToken = $obyekAdmin->updateToken($hasil['ID_Admin'], '');
?>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Atur Ulang Kata Sandi</title>
            <!-- OUR CSS -->
            <link rel="stylesheet" type="text/css" href="../assets/our/css/reset-pass.css">
            <!-- FONT -->
            <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
            <!-- FAVICON -->
            <link rel="icon" href="../assets/image/logo/1.png">
            <!-- SWEETALERT -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <!-- DRIVE JS  -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
        </head>

        <body>
            <img class="wave" src="../assets/image/pages/wave.png">
            <!-- MAIN START -->
            <div class="container">
                <div class="img">
                    <img src="../assets/image/pages/loginbg.svg">
                    <div class="img2">
                        <img src="../assets/image/pages/reset-pass.svg">
                    </div>
                </div>
                <div class="login-content">
                    <form id="formulirLoginForDrive" action="reset-pass-to-database.php" method="post">
                        <img class="imgForm" src="../assets/image/logo/logo2.png">
                        <h2 class="title">Atur Ulang Kata Sandi</h2>
                        <input type="hidden" name="ID_Admin" value="<?= $hasil['ID_Admin'] ?>">
                        <div id="resetKataSandi" class="input-div pass">
                            <div class="i">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="div">
                                <h5>Kata Sandi</h5>
                                <input type="password" class="input" name="Reset_Kata_Sandi" id="resetPassword" autocomplete="off">
                                <i class="fas fa-eye iconInputContainer" id="togglePassword"></i>
                            </div>
                        </div>
                        <div id="resetKataSandi" class="input-div pass">
                            <div class="i">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="div">
                                <h5>Konfirmasi Kata Sandi</h5>
                                <input type="password" class="input" name="Konfirmasi_Reset" id="resetConfirmPassword" autocomplete="off">
                                <i class="fas fa-eye iconInputContainer" id="toggleConfirmPassword"></i>
                            </div>
                        </div>
                        <button id="btnLoginForDrive" name="Ubah_Kata_Sandi" type="submit" class="btn">Ubah Kata Sandi</button>
                    </form>
                </div>
            </div>
            <!-- MAIN END -->

            <!-- CDN JQUERY -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
            <!-- CDN DRIVE.JS -->
            <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
            <!-- OUR JS -->
            <script src="../assets/our/js/reset-pass.js"></script>
            <script src="../assets/our/js/drive-all.js"></script>
            <!-- ICON -->
            <script src="https://kit.fontawesome.com/a81368914c.js"></script>
            <!-- ALERT -->
            <?php include '../partials/utils/alert.php' ?>
        </body>


        </html>
<?php
    } else {
        setPesanKesalahan("Token tidak valid.");
        header("Location: $akarUrl" . "src/admin/pages/forgot-pass.php");
        exit;
    }
} else {
    setPesanKesalahan("Token tidak ditemukan dalam URL.");
    header("Location: $akarUrl" . "src/admin/pages/forgot-pass.php");
    exit;
}
?>