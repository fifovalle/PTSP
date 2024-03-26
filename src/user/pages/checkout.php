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
    <link rel="stylesheet" href="../assets/css/checkout.css">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <title>PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="header mb-5 ps-5">Pesan</h1>
            <div class="d-flex col-md-12 justify-content-end text-right">
                <button type="button" class="btn btn-outline-warning me-4 mb-4" data-bs-toggle="modal" data-bs-target="#Checkout">Pesan</button>
            </div>

            <div class="col-md-12  justify-content-center">
                <div class="row" id="dropdown-informasi">
                    <div class="col-md-12">
                        <button class="btn btn-secondary dropdown-toggle text-start fw-bold fs-4" type="button" aria-expanded="false" id="Informasi_Button" onclick="toggleTable()">
                            Informasi
                        </button>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-success table-striped" id="Informasi" style="display: none;">
                            <tr class="header_informasi">
                                <th class="number_informasi text-center">NO</th>
                                <th class="title_informasi text-center">NAMA INFORMASI</th>
                                <th class="harga_informasi text-center">HARGA</th>
                                <th class="kuantitas_informasi text-center">KUANTITAS</th>
                            </tr>
                            <?php
                            $idInformasi = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiInformasiModel = new Transaksi($koneksi);
                            $dataTransaksiInformasi = $transaksiInformasiModel->tampilkanTransaksiInformasi($idInformasi);
                            if (!empty($dataTransaksiInformasi)) {
                                $nomorUrut = 1;
                                foreach ($dataTransaksiInformasi as $transaksiInformasi) {
                            ?>
                                    <tr class="content_informasi">
                                        <td class="content_number_informasi py-5 text-center">
                                            <?php echo $nomorUrut++; ?>
                                        </td>
                                        <td class="content_title_informasi py-5 text-center">
                                            <?php
                                            echo $transaksiInformasi['Nama_Informasi'];
                                            ?>
                                        </td>
                                        <td class="content_harga_informasi py-5 text-center">
                                            <?php
                                            $harga = $transaksiInformasi['Harga_Informasi'];
                                            $harga_rupiah = number_format($harga, 0, ',', '.');
                                            echo "Rp " . $harga_rupiah;
                                            ?>
                                        </td>
                                        <td class="content_kuantitas_informasi py-5 text-center"><button type="button" class="btn btn-danger" onclick="kurangiNilai()"><i class="bi bi-dash"></i></button>
                                            <span id="nilai_informasi">1</span>
                                            <button type="button" class="btn btn-primary" class="plus" onclick="tambahNilai()"><i class="bi bi-plus"></i></button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Informasi!</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 justify-content-center my-5">
                    <div class="row" id="dropdown-jasa">
                        <div class="col-md-12">
                            <button class="btn btn-secondary dropdown-toggle text-start fw-bold fs-4" type="button" aria-expanded="false" id="Jasa_Button" onclick="toggleTable1()">
                                Jasa
                            </button>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-success table-striped" id="Jasa" style="display: none;">
                                <tr class="header_jasa">
                                    <th class="number_jasa text-center">NO</th>
                                    <th class="title_jasa text-center">NAMA INFORMASI</th>
                                    <th class="harga_jasa text-center">HARGA</th>
                                    <th class="kuantitas_jasa text-center">KUANTITAS</th>
                                </tr>
                                <?php
                                $idJasa = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                $transaksiJasaModel = new Transaksi($koneksi);
                                $dataTransaksiJasa = $transaksiJasaModel->tampilkanTransaksiJasa($idJasa);
                                if (!empty($dataTransaksiJasa)) {
                                    $nomorUrut = 1;
                                    foreach ($dataTransaksiJasa as $transaksiJasa) {
                                ?>
                                        <tr class="content_jasa">
                                            <td class="content_number_informasi py-5 text-center">
                                                <?php echo $nomorUrut++; ?>
                                            </td>
                                            <td class="content_title_informasi py-5 text-center">
                                                <?php
                                                echo $transaksiJasa['Nama_Jasa'];
                                                ?>
                                            </td>
                                            <td class="content_harga_informasi py-5 text-center">
                                                <?php
                                                $harga = $transaksiJasa['Harga_Jasa'];
                                                $harga_rupiah = number_format($harga, 0, ',', '.');
                                                echo "Rp " . $harga_rupiah;
                                                ?>
                                            </td>
                                            <td class="content_kuantitas_jasa py-5 text-center"><button type="button" class="btn btn-danger" onclick="kurangiNilai1()"><i class="bi bi-dash"></i></button>
                                                <span id="nilai_jasa">1</span>
                                                <button type="button" class="btn btn-primary" onclick="tambahNilai1()"><i class="bi bi-plus"></i></button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Jasa!</td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Checkout -->
    <div class="modal fade" id="Checkout" aria-labelledby="CheckoutLabel" aria-hidden="true">
        <div class="modal-dialog" id="modalCheckout">
            <div class="modal-content">
                <div class="container p-0">
                    <div class="card cart">
                        <label class="title"><button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>PESAN</label>
                        <div class="steps">
                            <div class="step">
                                <div>
                                    <span>PENERIMA</span>
                                    <p>Nama Penerima</p>
                                    <p>Email Penerima</p>
                                    <p>No Telepon Penerima</p>
                                </div>
                                <hr>
                                <div>
                                    <span>PRODUK</span>
                                    <p>Informasi Barang</p>
                                    <p>Jumlah</p>
                                </div>
                                <hr>
                                <div>
                                    <span>METODE PEMBAYARAN</span>
                                    <p>No. Rekening BCA</p>
                                    <p>**** **** **** 4243</p>
                                </div>
                                <hr>
                                <div class="payments">
                                    <span>TOTAL PEMBAYARAN</span>
                                    <div class="details">
                                        <span>TOTAL:</span>
                                        <span>Rp</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card checkout">
                        <div class="footer">
                            <label class="price">Rp</label>
                            <button class="checkout-btn" type="button">Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Checkout -->
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/cart.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>