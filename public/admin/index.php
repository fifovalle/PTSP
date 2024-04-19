<?php
// DATABASES
include '../../src/admin/config/databases.php';
// MEMAKSA MASUK
if (!isset($_SESSION['ID'])) {
    setPesanKesalahan("Anda tidak bisa mengakses halaman ini. Silakan login terlebih dahulu.");
    header("Location: $akarUrl" . "src/admin/pages/login.php");
    exit();
}
$totalTransaksiLainnya = 0;
$adaData = false;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../../src/admin/assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../../src/admin/assets/our/css/index.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- FAVICON -->
    <link rel="icon" href="../../src/admin/assets/image/logo/1.png">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- DRIVE JS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
</head>

<body>
    <!-- NAVBAR START-->
    <?php
    include "../../src/admin/partials/components/navbar.php";
    ?>
    <!-- NAVBAR END-->
    <section class="container-fluid mainWebsite">
        <section class="row">
            <!-- SIDEBAR START -->
            <?php
            include "../../src/admin/partials/components/sidebar.php";
            ?>
            <!-- SIDEBAR END -->
            <div class="container-fluid">
                <!-- MAIN START -->
                <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <h1 class="breadcrumb">Beranda</h1>
                        <div id="iconAllInstansiForDrive" class="iconBreadcrumb d-flex justify-content-between align-content-center gap-3">
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
                        <?php
                        $transaksiModel = new Transaksi($koneksi);
                        $dataTransaksi = $transaksiModel->tampilkanTransaksi();
                        $jumlahDataDitampilkan = 0;
                        if (!$dataTransaksi) {
                        ?>
                            <div class="col-4">
                                <div class="card">
                                    <h5 class="card-title py-4 mx-auto text-danger">Sedang diolah</h5>
                                    <div class="position-relative mx-auto">
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            foreach ($dataTransaksi as $produk) {
                                if ($jumlahDataDitampilkan < 1 && $produk['Total_Transaksi'] > $totalTransaksiLainnya && $produk['ID_Tranksaksi'] > $totalTransaksiLainnya) {
                            ?>
                                    <div class="col-4">
                                        <div class="card">
                                            <h5 class="card-title py-4 mx-auto">Penjualan Terbaik</h5>
                                            <div class="position-relative mx-auto">
                                                <img src="<?php echo $akarUrl ?>src/admin/assets/image/uploads/<?php echo $produk['Foto_Informasi'] ?? $produk['Foto_Jasa']; ?>" class="imageCard card-img-top" alt="Performa Produk Terbaru">
                                                <h5 class="card-title titleProduct fw-bold"><?php echo $produk['Nama_Jasa']; ?></h5>
                                            </div>
                                            <div class="d-flex justify-content-around align-items-center mt-4">
                                                <div class="d-flex justify-content-between gap-3">
                                                    <i class="fas fa-users"><span class="ms-2 many"><?php echo $produk['ID_Pengguna']; ?></span></i>
                                                    <i class="fas fa-money-bill"><span class="ms-2 many">Rp<?php echo number_format($produk['Total_Transaksi'], 0, ',', '.'); ?></span></i>
                                                </div>
                                                <div id="caretIconForDrive">
                                                    <i class="fas fa-caret-up caret-icon"></i>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card-body hidden-content">
                                                <p class="card-text textCardProduct my-3 mb-4">Performa Selama Ini</p>
                                                <div class="row ms-auto">
                                                    <div class="col-7 me-4">Pembeli</div>
                                                    <div class="col-2"><?php echo $produk['ID_Pengguna']; ?></div>
                                                </div>
                                                <div class="row ms-auto">
                                                    <div class="col-7 me-4">Penghasilan</div>
                                                    <div class="col-4">Rp<?php echo number_format($produk['Total_Transaksi'], 0, ',', '.'); ?></div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a id="seeAnaliticForDrive1" href="#" class="card-link">Lihat Analitik</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $jumlahDataDitampilkan++;
                                }
                            }
                        }
                        if ($jumlahDataDitampilkan === 0 && $dataTransaksi) {
                            ?>
                            <div class="col-4">
                                <div class="card">
                                    <h5 class="card-title py-4 mx-auto">Penjualan Terbaik</h5>
                                    <div class="position-relative mx-auto">
                                        <h5 class="py-4 mx-auto text-danger">Tidak Ada Data!</h5>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-4">
                            <div class="card">
                                <h5 class="card-title pt-4 mx-auto">IKM Terbaru</h5>
                                <hr>
                                <?php
                                $ikmModel = new Ikm($koneksi);
                                $dataIKM = $ikmModel->tampilkanIkmTerbaru();
                                if (!$dataIKM) {
                                ?>
                                    <div class="row mx-2 my-3">
                                        <div class="col-3">
                                            <img src="../../src/admin/assets/image/uploads/2.png" alt="GambarPengunjung" class="surveyImageCard">
                                        </div>
                                        <div class="col-9">
                                            <h5>Naufal FIFA</h5>
                                            <p class="card-text textCardProduct">Waduh Saya Puas Banget Sih Bang :)../..</p>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    foreach ($dataIKM as $ikm) {
                                    ?>
                                        <div class="row mx-2 my-3">
                                            <div class="col-3">
                                            </div>
                                            <div class="col-9">
                                                <h5><?php echo $ikm['Nama']; ?></h5>
                                                <p class="card-text textCardProduct"><?php echo $ikm['Informasi_Cuaca_Publik']; ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <div class="card-body btnAnalitic">
                                    <a id="seeAnaliticForDrive2" href="#" class="card-link">Lihat Analitik</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <h5 class="card-title pt-4 mx-auto">Transaksi Terbaru</h5>
                                <hr>
                                <?php
                                $transaksiTerbaruModel = new Transaksi($koneksi);
                                $dataTransaksiTerbaru = $transaksiTerbaruModel->tampilkanTransaksiTerbaru();

                                if (!$dataTransaksiTerbaru) {
                                ?>
                                    <div class="row mx-2 my-3">
                                        <div class="col-3">
                                            <img src="../../src/admin/assets/image/uploads/2.png" alt="GambarPengunjung" class="surveyImageCard">
                                        </div>
                                        <div class="col-9">
                                            <h5>Seismon</h5>
                                            <p class="card-text textCardProduct">Naufal FIFA</p>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    foreach ($dataTransaksiTerbaru as $transaksi) {
                                    ?>
                                        <div class="row mx-2 my-3">
                                            <div class="col-3">
                                                <img src="../../src/admin/assets/image/uploads/<?php echo $transaksi['Foto']; ?>" alt="GambarTransaksi" class="surveyImageCard">
                                            </div>
                                            <div class="col-9">
                                                <h5><?php echo $transaksi['Nama_Pengguna']; ?></h5>
                                                <p class="card-text textCardProduct"><?php echo $transaksi['Tanggal_Pembelian']; ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <div class="card-body btnAnalitic">
                                    <a id="seeAnaliticForDrive3" href="#" class="card-link">Lihat Analitik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FOOTER START -->
                    <?php
                    include "../../src/admin/partials/components/footer.php";
                    ?>
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
    include "../../src/admin/partials/utils/modal-add-admin.php";
    ?>
    <?php
    include "../../src/admin/partials/utils/modal-add-information.php";
    ?>
    <?php
    include "../../src/admin/partials/utils/modal-add-services.php";
    ?>
    <?php
    include "../../src/admin/partials/utils/modal-edit-information.php";
    ?>
    <?php
    include "../../src/admin/partials/utils/modal-edit-services.php";
    ?>
    <?php
    include "../../src/admin/partials/utils/modal-send-feedback.php";
    ?>
    <!-- ALL MODAL END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- CDN DRIVE.JS -->
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <!-- OUR JS -->
    <script src="../../src/admin/assets/our/js/index.js"></script>
    <script src="../../src/admin/assets/our/js/caret.js"></script>
    <script src="../../src/admin/assets/our/js/drive-all.js"></script>
    <script src="../../src/admin/assets/our/js/value-information.js"></script>
    <script src="../../src/admin/assets/our/js/delete-information.js"></script>
    <script src="../../src/admin/assets/our/js/delete-services.js"></script>
    <script src="../../src/admin/assets/our/js/value-services.js"></script>
    <script src="../../src/admin/assets/our/js/search-alldata.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../../src/admin/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- ALERT -->
    <?php include '../../src/admin/partials/utils/alert.php' ?>
</body>

</html>