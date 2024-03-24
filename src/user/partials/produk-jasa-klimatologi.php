<?php
include '../../admin/config/databases.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/produk-informasi.css">
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid p-0" id="produk-informasi">
        <div class="container text-center">
            <div class="row">
                <h1 class="mb-5">KATALOG PRODUK</h1>
                <div class="col-md-12" id="informasi">
                    <h4 class="my-3">JASA KLIMATOLOGI
                        <hr>
                    </h4>
                    <div class="row pt-5 px-3">
                        <?php
                        $jasaModel = new Jasa($koneksi);
                        $dataJasaKlimatologi = $jasaModel->tampilkanDataJasaKlimatologi();
                        if (!empty($dataJasaKlimatologi)) {
                            $nomorUrut = 1;
                            foreach ($dataJasaKlimatologi as $jasaKlimatologi) {
                        ?>
                                <div class="col-md-4 mb-4 p-1" id="produk">
                                    <div class="card-product">
                                        <div class="card-info text-start ps-3 py-2">
                                            <button type="button" class="info p-0 border-0 bg-transparent"><box-icon name='info-circle'></box-icon></button>
                                        </div>
                                        <div class="card-img my-3">
                                            <span class="dot">
                                                <box-icon name='cloud-lightning' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                            </span>
                                        </div>
                                        <div class="card-title"><?php echo $jasaKlimatologi['Nama_Jasa']; ?></div>
                                        <div class="card-subtitle"><?php echo $jasaKlimatologi['Deskripsi_Jasa']; ?></div>
                                        <hr class="card-divider">
                                        <div class="d-flex card-footer justify-content-between my-4 mx-3">
                                            <div class="card-price text-start"><span>Rp</span><?php echo number_format($jasaKlimatologi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                            <div class="card-button">
                                                <form action="../../admin/config/add-cart-services-klimatologi.php" method="POST">
                                                    <input type="hidden" name="Jasa" value="<?php echo $jasaKlimatologi['ID_Jasa']; ?>">
                                                    <?php if (isset($_SESSION['ID_Pengguna'])) : ?>
                                                        <input type="hidden" name="Pengguna" value="<?php echo $_SESSION['ID_Pengguna']; ?>">
                                                    <?php endif; ?>
                                                    <?php if (isset($_SESSION['ID_Perusahaan'])) : ?>
                                                        <input type="hidden" name="Perusahaan" value="<?php echo $_SESSION['ID_Perusahaan']; ?>">
                                                    <?php endif; ?>
                                                    <button class="card-btn" type="submit" name="tambah_keranjang">
                                                        <span><box-icon name='cart-alt'></box-icon></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $nomorUrut++;
                            }
                        } else {
                            echo "<div class='fw-bold' style='margin-top: -30px; border: 2px solid purple; width: 20%; margin-left: 50%; transform: translateX(-50%); border-radius: 15px; box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.4); color: purple;'>Data Tidak Ditemukan!</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('modal-produk-jasa.php');
    ?>
    <?php
    include('../partials/footer.php');
    ?>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/modal-produk-jasa.js"></script>
</body>

</html>