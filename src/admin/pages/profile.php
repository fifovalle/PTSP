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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../assets/our/css/index.css">
    <link rel="stylesheet" href="../assets/our/css/data.css">
    <link rel="stylesheet" href="../assets/our/css/profile.css">
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
                <main class="col-md-1 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <h1 class="breadcrumb">Profil Saya</h1>
                    </div>
                    <div class="row mx-auto">
                        <div class="col-lg-12 mb-2">
                            <img src="../assets/image/pages/2.jpg" class="banner-image" alt="Banner Image">
                        </div>
                    </div>
                    <?php
                    $idSessionAdmin = $_SESSION['ID'];
                    $adminModel = new Admin($koneksi);
                    $dataAdmin = $adminModel->tampilkanAdminDenganSessionId($idSessionAdmin);
                    if (!empty($dataAdmin)) {
                        $admin = $dataAdmin[0];
                    ?>
                        <div class="row mx-auto">
                            <div class="col-lg-12 mb-2">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <div class="avatar">
                                                    <img id="avatarForDrive" src="../assets/image/uploads/<?php echo $admin['Foto']; ?>" class="avatarimage" alt="Avatar">
                                                    <div class="middle" id="editAvatar" data-bs-toggle="modal" data-bs-target="#modalSuntingFoto"><i class='bx bx-pencil'></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h3 class="textProfile"><?php echo $admin['Nama_Depan_Admin'] . ' ' . $admin['Nama_Belakang_Admin']; ?>
                                            </h3>
                                            <p class="d-flex text textProfileDesc">
                                                <i class='bx bx-cog'></i>
                                                <?php
                                                echo ($admin['Peran_Admin'] == '1') ? 'Super Admin' : (($admin['Peran_Admin'] == '2') ? 'Instansi A' : (($admin['Peran_Admin'] == '3') ? 'Instansi B' : (($admin['Peran_Admin'] == '4') ? 'Instansi C' : 'Tidak Diketahui')));
                                                ?></h6>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<p>Data admin tidak ditemukan.</p>";
                    }
                    ?>
                    <div id="menuProfilForDrive" class="col-12">
                        <div class="row">
                            <div class="menu col-2">
                                <p class="fw-semibold dataAll active">Akun</p>
                            </div>
                            <div class="menu col-2">
                                <p class="fw-semibold dataAll">Keamanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-auto">
                        <div class="col-lg-12 mb-3">
                            <!-- ALL MENU ACCOUNT START -->
                            <?php include "../partials/utils/account-profile.php" ?>
                            <?php include "../partials/utils/security-account-profile.php" ?>
                            <!-- ALL MENU ACCOUNT END -->
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
    include "../partials/utils/modal-edit-foto-profile.php";
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
    <script src="../assets/our/js/index.js"></script>
    <script src="../assets/our/js/profile.js"></script>
    <script src="../assets/our/js/value-information.js"></script>
    <script src="../assets/our/js/search-alldata.js"></script>
    <script src="../assets/our/js/delete-information.js"></script>
    <script src="../assets/our/js/delete-services.js"></script>
    <script src="../assets/our/js/delete-profile.js"></script>
    <script src="../assets/our/js/value-information.js"></script>
    <script src="../assets/our/js/drive-all.js"></script>
    <script src="../assets/our/js/value-services.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- ALERT -->
    <?php include '../partials/utils/alert.php' ?>
</body>

</html>