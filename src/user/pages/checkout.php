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
                <button type="button" class="btn btn-outline-warning me-4 mb-4" id="btnKonfirmasiPesan" data-bs-toggle="modal" data-bs-target="#Checkout">Pesan</button>
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
                                <th class="hapus text-center"></th>
                            </tr>
                            <?php
                            $idInformasi = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiInformasiModel = new Transaksi($koneksi);
                            $dataTransaksiInformasi = $transaksiInformasiModel->tampilkanTransaksiInformasi($idInformasi);
                            if (!empty($dataTransaksiInformasi)) {
                                $nomorUrut = 1;
                                foreach ($dataTransaksiInformasi as $transaksiInformasi) {
                            ?>
                                    <tr class="content_informasi align-middle">
                                        <td class="content_number_informasi text-center">
                                            <?php echo $nomorUrut++; ?>
                                        </td>
                                        <td class="content_title_informasi text-center">
                                            <?php
                                            echo $transaksiInformasi['Nama_Informasi'];
                                            ?>
                                        </td>
                                        <td class="content_harga_informasi text-center">
                                            <?php
                                            $harga = $transaksiInformasi['Harga_Informasi'];
                                            $harga_rupiah = number_format($harga, 0, ',', '.');
                                            echo "Rp" . $harga_rupiah;
                                            ?>
                                        </td>
                                        <td class="content_kuantitas_informasi text-center">
                                            <button type="button" class="btn btn-danger" onclick="kurangiNilai(<?php echo $transaksiInformasi['ID_Tranksaksi']; ?>)"><i class="bi bi-dash"></i></button>
                                            <span class="nilai_informasi" id="nilai_<?php echo $transaksiInformasi['ID_Tranksaksi']; ?>" data-id-tombol="<?php echo $transaksiInformasi['ID_Tranksaksi']; ?>">0</span>
                                            <button type="button" class="btn btn-primary plus" onclick="tambahNilai(<?php echo $transaksiInformasi['ID_Tranksaksi']; ?>)"><i class="bi bi-plus"></i></button>
                                        </td>
                                        <td id="btn-hapus-informasi">
                                            <div type="button" class="btn btn-secondary" onclick="confirmDeleteCheckoutInformation(<?php echo $transaksiInformasi['ID_Tranksaksi']; ?>)">
                                                <span>
                                                    <box-icon name='trash-alt' color='rgba(255,255,255,0.9)'></box-icon>
                                                </span>
                                            </div>
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
                                    <th class="hapus text-center"></th>
                                </tr>
                                <?php
                                $idJasa = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                $transaksiJasaModel = new Transaksi($koneksi);
                                $dataTransaksiJasa = $transaksiJasaModel->tampilkanTransaksiJasa($idJasa);
                                if (!empty($dataTransaksiJasa)) {
                                    $nomorUrut = 1;
                                    foreach ($dataTransaksiJasa as $transaksiJasa) {
                                ?>
                                        <tr class="content_jasa align-middle">
                                            <td class="content_number_informasi text-center">
                                                <?php echo $nomorUrut++; ?>
                                            </td>
                                            <td class="content_title_informasi text-center">
                                                <?php
                                                echo $transaksiJasa['Nama_Jasa'];
                                                ?>
                                            </td>
                                            <td class="content_harga_informasi text-center">
                                                <?php
                                                $harga = $transaksiJasa['Harga_Jasa'];
                                                $harga_rupiah = number_format($harga, 0, ',', '.');
                                                echo "Rp" . $harga_rupiah;
                                                ?>
                                            </td>
                                            <td class="content_kuantitas_informasi text-center">
                                                <button type="button" class="btn btn-danger" onclick="kurangiNilai1(<?php echo $transaksiJasa['ID_Tranksaksi']; ?>)"><i class="bi bi-dash"></i></button>
                                                <span class="nilai_informasi" id="nilai_<?php echo $transaksiJasa['ID_Tranksaksi']; ?>" data-id-tombol="<?php echo $transaksiJasa['ID_Tranksaksi']; ?>">0</span>
                                                <button type="button" class="btn btn-primary plus" onclick="tambahNilai1(<?php echo $transaksiJasa['ID_Tranksaksi']; ?>)"><i class="bi bi-plus"></i></button>
                                            </td>
                                            <td id="btn-hapus-informasi">
                                                <div type="button" class="btn btn-secondary" onclick="confirmDeleteCheckoutJasa(<?php echo $transaksiJasa['ID_Tranksaksi']; ?>)">
                                                    <span>
                                                        <box-icon name='trash-alt' color='rgba(255,255,255,0.9)'></box-icon>
                                                    </span>
                                                </div>
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

    <div class="modal fade" id="Checkout" aria-labelledby="CheckoutLabel" aria-hidden="true">
        <div class="modal-dialog" id="modalCheckout">
            <div class="modal-content">
                <div class="container p-0">
                    <div class="card cart">
                        <label class="title"><button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>KONFIRMASI PESANAN</label>
                        <div class="steps">
                            <div class="row">
                                <?php
                                function generateRandomOrderNumber()
                                {
                                    $waktu = time();
                                    $angkaAcak = mt_rand(1000, 9999);
                                    $nomorPesanan = '#' . $waktu . $angkaAcak;
                                    return $nomorPesanan;
                                }
                                $nomorPesanan = generateRandomOrderNumber();
                                echo "<h4>Nomor Pesanan Anda: " . $nomorPesanan . "</h4>";
                                ?>
                                <?php
                                $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                $transaksiPembeliModel = new Transaksi($koneksi);
                                $dataTransaksiPembeli = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiA($idPembeli);
                                $nomorUrut = 1;
                                if (!empty($dataTransaksiPembeli)) {
                                ?>
                                    <div class="col-md-12 mt-3">
                                        <span class="fw-bold mt-2">PENERIMA INSTANSI A</span>
                                        <div class="row header mt-2 mb-2">
                                            <div class="col-md-5 text-start">
                                                Produk
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Rekening
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Harga
                                            </div>
                                            <div class="col-md-1 text-start">
                                                Jumlah
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Total
                                            </div>
                                        </div>
                                        <div class="row pesanan">
                                            <?php foreach ($dataTransaksiPembeli as $transaksi) { ?>
                                                <div class="col-md-5 text-start mb-2 px-3">
                                                    <p class="produk"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="rekening"><?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?></p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="harga">Rp<?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?></p>
                                                </div>
                                                <div class="col-md-1 text-start mb-2 px-3">
                                                    <p class="jumlah" id="jumlah_barang_<?php echo $transaksi['ID_Tranksaksi']; ?>" data-transaksi-id="<?php echo $transaksi['ID_Tranksaksi']; ?>">0</p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="total" id="total_harga_<?php echo $transaksi['ID_Tranksaksi']; ?>">Rp0</p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                $transaksiPembeliModel = new Transaksi($koneksi);
                                $dataTransaksiPembeli = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiB($idPembeli);
                                $nomorUrut = 1;
                                if (!empty($dataTransaksiPembeli)) {
                                ?>
                                    <div class="col-md-12 mt-3">
                                        <span class="fw-bold mt-2">PENERIMA INSTANSI B</span>
                                        <div class="row header mt-2 mb-2">
                                            <div class="col-md-5 text-start">
                                                Produk
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Rekening
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Harga
                                            </div>
                                            <div class="col-md-1 text-start">
                                                Jumlah
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Total
                                            </div>
                                        </div>
                                        <div class="row pesanan">
                                            <?php foreach ($dataTransaksiPembeli as $transaksi) { ?>
                                                <div class="col-md-5 text-start mb-2 px-3">
                                                    <p class="produk"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="rekening"><?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?></p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="harga">Rp<?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?></p>
                                                </div>
                                                <div class="col-md-1 text-start mb-2 px-3">
                                                    <p class="jumlah" id="jumlah_barang_<?php echo $transaksi['ID_Tranksaksi']; ?>" data-transaksi-id="<?php echo $transaksi['ID_Tranksaksi']; ?>">0</p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="total" id="total_harga_<?php echo $transaksi['ID_Tranksaksi']; ?>">Rp0</p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                $transaksiPembeliModel = new Transaksi($koneksi);
                                $dataTransaksiPembeli = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiC($idPembeli);
                                $nomorUrut = 1;
                                if (!empty($dataTransaksiPembeli)) {
                                ?>
                                    <div class="col-md-12 mt-3">
                                        <span class="fw-bold mt-2">PENERIMA INSTANSI C</span>
                                        <div class="row header mt-2 mb-2">
                                            <div class="col-md-5 text-start">
                                                Produk
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Rekening
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Harga
                                            </div>
                                            <div class="col-md-1 text-start">
                                                Jumlah
                                            </div>
                                            <div class="col-md-2 text-start">
                                                Total
                                            </div>
                                        </div>
                                        <div class="row pesanan">
                                            <?php foreach ($dataTransaksiPembeli as $transaksi) { ?>
                                                <div class="col-md-5 text-start mb-2 px-3">
                                                    <p class="produk"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="rekening"><?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?></p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="harga">Rp<?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?></p>
                                                </div>
                                                <div class="col-md-1 text-start mb-2 px-3">
                                                    <p class="jumlah" id="jumlah_barang_<?php echo $transaksi['ID_Tranksaksi']; ?>" data-transaksi-id="<?php echo $transaksi['ID_Tranksaksi']; ?>">0</p>
                                                </div>
                                                <div class="col-md-2 text-start mb-2 px-3">
                                                    <p class="total" id="total_harga_<?php echo $transaksi['ID_Tranksaksi']; ?>">Rp0</p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-md-12 mt-3 mb-2 text-end">
                                    <button class="btn btn-primary" id="btnPesan">Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../partials/checkout-modal-js.php'; ?>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/cart.js"></script>
    <script src="../assets/js/checkout-to-database.js"></script>
    <script src="../assets/js/hapus-checkout-informasi.js"></script>
    <script src="../assets/js/hapus-checkout-jasa.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>