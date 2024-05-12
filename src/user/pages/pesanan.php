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
    <link rel="stylesheet" href="../assets/css/pesanan.css">
    <title>Pesanan PTSP BMKG Provinsi Bengkulu</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid w-100 mt-5">
        <div class="row">
            <div class="col-md-2 p-0 h-100" id="opsi-pemesanan">
                <div class="row mx-5 my-3">
                    <div class="btn btn-success" id="history-order" onclick="showContentPemesanan('history-pesanan')"> Riwayat Pesanan <span class="badge text-bg-secondary ms-2">
                            <?php
                            $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiModel = new Transaksi($koneksi);
                            $jumlahTransaksi = $transaksiModel->hitungRiwayatTransaksiSesuaiSession($id);
                            echo $jumlahTransaksi;
                            ?>
                        </span></div>
                </div>
                <div class="row mx-5 my-3">
                    <div class="btn btn-outline-success" id="tracking-order" onclick="showContentPemesanan('detail-pesanan')">Pelacakan Pesanan</div>
                </div>
            </div>
            <div class="col-md-10 px-5" id="history-pesanan">
                <div class="container-fluid w-100">
                    <div class="d-flex row status" id="opsi-statuspesanan">
                        <?php
                        $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                        $transaksiModel = new Transaksi($koneksi);
                        $dataTraksaksi = $transaksiModel->tampilkanRiwayatTransaksiSesuaiSession($id);
                        if (!empty($dataTraksaksi)) {
                            $totalPesanan = 0;
                            foreach ($dataTraksaksi as $transaksi) {
                        ?>
                                <div class="col-md-8">
                                    <div class="col" id="nama_barang"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></div>
                                    <div class="col" id="jmlh_barang">x<?php echo $transaksi['Jumlah_Barang']; ?></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col text-end" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                </div>
                            <?php
                                $totalPesanan += ($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']) * $transaksi['Jumlah_Barang'];
                            }
                            ?>
                            <hr class="my-3">
                            <div class="d-flex row">
                                <div class="col text-end" id="total_harga">
                                    <p>Total Pesanan : Rp<?php echo number_format($totalPesanan, 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class='text-danger fw-bold'>Tidak ada data riwayat transaksi Anda.</div>
                            <hr class="my-3">
                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-12 text-start">
                                <button class="btn btn-outline-danger px-2 mx-2" type="button" id="btn-beli-lagi" style="width:100px;">Beli Lagi</button>
                                <?php
                                $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                $transaksiModel = new Transaksi($koneksi);
                                $dataTraksaksi = $transaksiModel->tampilkanRiwayatTransaksiSesuaiSession($id);

                                if (!empty($dataTraksaksi)) {
                                    foreach ($dataTraksaksi as $transaksi) {
                                        if (!empty($transaksi['File_Penerimaan'])) {
                                            echo '<a href="../../admin/assets/image/uploads/' . $transaksi['File_Penerimaan'] . '" class="btn btn-outline-success px-2 mx-2" id="btn-download-file" type="button" style="width:118px;">Download File</a>';
                                        }
                                    }
                                } else {
                                    echo '<button class="btn btn-outline-success px-2 mx-2" id="btn-download-file" onclick="showAlert()" type="button" style="width:118px;">Download File</button>';
                                }
                                ?>
                                <script>
                                    function showAlert() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Tidak Bisa Download File',
                                            text: 'Silahkan isi IKM Anda',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'ikm.php';
                                            }
                                        });
                                    }
                                </script>
                                <button class="btn btn-outline-secondary px-2 mx-2" type="button" style="width:200px;" data-bs-toggle="modal" data-bs-target="#historiPengisianIKM">Riwayat Pengisian IKM</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 px-5" id="detail-pesanan" style="display:none;">
                <div class="container-fluid w-100">
                    <div class="d-flex row text-center mb-3" id="status-pesanan">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pengajuan">Status Pengajuan
                                <span class="badge text-bg-secondary">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $jumlahTransaksi = $transaksiModel->hitungPengajuanTransaksiSesuaiSession($id);
                                    echo $jumlahTransaksi;
                                    ?>
                                </span>
                            </button>
                        </div>
                        <div class=" col-md-3">
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pembayaran">Status Pembayaran
                                <span class="badge text-bg-secondary">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $jumlahTransaksi = $transaksiModel->hitungPembayaranTransaksiSesuaiSession($id);
                                    echo $jumlahTransaksi;
                                    ?>
                                </span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pembuatan">Status Pembuatan
                                <span class="badge text-bg-secondary">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $jumlahTransaksi = $transaksiModel->hitungPembuatanTransaksiSesuaiSession($id);
                                    echo $jumlahTransaksi;
                                    ?>
                                </span>
                            </button>
                        </div>
                        <div class=" col-md-3">
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-selesai">Status Selesai
                                <span class="badge text-bg-secondary">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $jumlahTransaksi = $transaksiModel->hitungSelesaiTransaksiSesuaiSession($id);
                                    echo $jumlahTransaksi;
                                    ?>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class=" d-none" id="ajuan">
                        <div class="d-flex row status">
                            <hr id="line-pesanan">
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $pengajuanModel = new Pengajuan($koneksi);
                                    $dataPengajuan = $pengajuanModel->tampilkanSemuaDataPengajuan();
                                    if (!is_null($dataPengajuan)) {
                                        $statusDiterimaPerusahaan = false;
                                        $statusDiterimaPengguna = false;
                                        $statusSedangDitinjau = false;
                                        $statusDitolak = false;
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPengajuan as $pengajuan) {
                                                if ($pengajuan['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pengajuan['Status_Pengajuan'] == 'Diterima') {
                                                        $statusDiterimaPerusahaan = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['ID_Pengguna'])) {
                                            foreach ($dataPengajuan as $pengajuan) {
                                                if ($pengajuan['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                    if ($pengajuan['Status_Pengajuan'] == 'Diterima') {
                                                        $statusDiterimaPengguna = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$statusDiterimaPerusahaan && !$statusDiterimaPengguna && !$statusSedangDitinjau && !$statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Belum Ada Ajuan</div>
                                                        <p class="card-text">
                                                        <a class="text-decoration-none fw-bold" href="ajukan.php">Klik disini</a> untuk mengajukan pesanan
                                                        </p>
                                                    </div>';
                                        } elseif ($statusDiterimaPerusahaan || $statusDiterimaPengguna) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="check-shield" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Diterima</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        } elseif ($statusSedangDitinjau) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Sedang Ditinjau</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        } elseif ($statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Ditolak</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        }
                                    } else {
                                        echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Belum Ada Ajuan</div>
                                                    <p class="card-text">
                                                    <a class="text-decoration-none fw-bold" href="ajukan.php">Klik disini</a> untuk mengajukan pesanan
                                                    </p>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot">
                                        <box-icon name='money' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibayarkan</div>
                                        <p class="card-text">Perbaharui Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot">
                                        <box-icon name='receipt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibuat</div>
                                        <p class="card-text">Perbaharui Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot">
                                        <box-icon name='cart-alt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title text-center">Pesanan Selesai</div>
                                        <p class="card-text">Perbaharui Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $jumlahDataPerHalaman = 2;
                            $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiModel = new Transaksi($koneksi);
                            $dataTraksaksi = $transaksiModel->tampilkanPengajuanTransaksiSesuaiSession($id);
                            $jumlahHalaman = ceil(count($dataTraksaksi) / $jumlahDataPerHalaman);
                            $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
                            $indexAwal = ($halamanAktif - 1) * $jumlahDataPerHalaman;
                            $indexAkhir = $indexAwal + $jumlahDataPerHalaman;
                            $dataTraksaksiHalaman = array_slice($dataTraksaksi, $indexAwal, $jumlahDataPerHalaman);
                            ?>
                            <div class="row">
                                <?php if (!empty($dataTraksaksiHalaman)) : ?>
                                    <?php $totalPesanan = 0; ?>
                                    <?php foreach ($dataTraksaksiHalaman as $transaksi) : ?>
                                        <div class="col-md-8 mt-3">
                                            <div class="col" id="nama_barang"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></div>
                                            <div class="col" id="jmlh_barang">x<?php echo $transaksi['Jumlah_Barang']; ?></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col text-end" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                        </div>
                                        <?php $totalPesanan += ($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']) * $transaksi['Jumlah_Barang']; ?>
                                    <?php endforeach; ?>
                                    <hr class="my-3">
                                    <div class="d-flex row">
                                        <div class="col text-end" id="total_harga">
                                            <p>Total Pesanan : Rp<?php echo number_format($totalPesanan, 0, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class='text-danger fw-bold'>Tidak ada data transaksi yang tersedia.</div>
                                    <hr class="my-3">
                                <?php endif; ?>
                            </div>
                            <div class="d-flex row mt-4">
                                <div class="col" id="pagination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item <?php echo ($halamanAktif == 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif - 1); ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                <li class="page-item <?php echo ($halamanAktif == $i) ? 'active' : ''; ?>"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            <?php endfor; ?>
                                            <li class="page-item <?php echo ($halamanAktif == $jumlahHalaman) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif + 1); ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <?php
                                $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                $transaksiModel = new Transaksi($koneksi);
                                $dataTraksaksi = $transaksiModel->tampilkanPerbaikanDokumenPengajuanTransaksiSesuaiSession($id);
                                $tampilkanTombol = !empty($dataTraksaksi);
                                $style = $tampilkanTombol ? 'display: block;' : 'display: none;';
                                ?>
                                <div class="col text-end" style="<?php echo $style; ?>">
                                    <?php
                                    echo '<button class="btn btn-outline-primary ms-3 buttonImproveApplyment" type="button" data-bs-toggle="modal" data-id="' . $pengajuan['ID_Pengajuan'] . '" id="btn-perbaikan" style="width:170px;">Perbaikan Dokumen</button>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="pembayaran">
                        <div class="d-flex row status">
                            <hr id="line-pesanan">
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $pengajuanModel = new Pengajuan($koneksi);
                                    $dataPengajuan = $pengajuanModel->tampilkanSemuaDataPengajuan();
                                    if (!is_null($dataPengajuan)) {
                                        $statusDiterimaPerusahaan = false;
                                        $statusDiterimaPengguna = false;
                                        $statusSedangDitinjau = false;
                                        $statusDitolak = false;
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPengajuan as $pengajuan) {
                                                if ($pengajuan['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pengajuan['Status_Pengajuan'] == 'Diterima') {
                                                        $statusDiterimaPerusahaan = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['ID_Pengguna'])) {
                                            foreach ($dataPengajuan as $pengajuan) {
                                                if ($pengajuan['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                    if ($pengajuan['Status_Pengajuan'] == 'Diterima') {
                                                        $statusDiterimaPengguna = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$statusDiterimaPerusahaan && !$statusDiterimaPengguna && !$statusSedangDitinjau && !$statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Belum Ada Ajuan</div>
                                                        <p class="card-text">
                                                        <a class="text-decoration-none fw-bold" href="ajukan.php">Klik disini</a> untuk mengajukan pesanan
                                                        </p>
                                                    </div>';
                                        } elseif ($statusDiterimaPerusahaan || $statusDiterimaPengguna) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="check-shield" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Diterima</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        } elseif ($statusSedangDitinjau) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Sedang Ditinjau</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        } elseif ($statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Ditolak</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        }
                                    } else {
                                        echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Belum Ada Ajuan</div>
                                                    <p class="card-text">
                                                    <a class="text-decoration-none fw-bold" href="ajukan.php">Klik disini</a> untuk mengajukan pesanan
                                                    </p>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $dataTraksaksi = $transaksiModel->tampilkanPembayaranTransaksiSesuaiSession($id);
                                    ?>
                                    <?php
                                    $pembayaranModel = new Pengajuan($koneksi);
                                    $dataPembayaran = $pembayaranModel->tampilkanSemuaDataPembayaran();
                                    if (!is_null($dataPembayaran)) {
                                        $statusDiterimaPerusahaan = false;
                                        $statusDiterimaPengguna = false;
                                        $statusSedangDitinjau = false;
                                        $statusDitolak = false;
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Diterima') {
                                                        $statusDiterimaPerusahaan = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['ID_Pengguna'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Disetujui') {
                                                        $statusDiterimaPengguna = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$statusDiterimaPerusahaan && !$statusDiterimaPengguna && !$statusSedangDitinjau && !$statusDitolak) {
                                            echo '<span class="dot selected">
                                                          <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Unggah Bukti Pembayaran</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>';
                                        } elseif ($statusDiterimaPerusahaan || $statusDiterimaPengguna) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Diterima</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                        </div>';
                                        } elseif ($statusSedangDitinjau) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Sedang Ditinjau</div>
                                                    </div>';
                                        } elseif ($statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                    <div class="card-title">Pembayaran Ditolak</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>
                                                    ';
                                        }
                                    } else {
                                        echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Belum Ada Pembayaran</div>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot ">
                                        <box-icon name='receipt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibuat</div>
                                        <p class="card-text">Perbaharui Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="card">
                                    <span class="dot">
                                        <box-icon name='cart-alt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title text-center">Pesanan Selesai</div>
                                        <p class="card-text">Perbaharui Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $jumlahDataPerHalaman = 2;
                            $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiModel = new Transaksi($koneksi);
                            $dataTraksaksi = $transaksiModel->tampilkanPembayaranTransaksiSesuaiSession($id);
                            $jumlahHalaman = ceil(count($dataTraksaksi) / $jumlahDataPerHalaman);
                            $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
                            $indexAwal = ($halamanAktif - 1) * $jumlahDataPerHalaman;
                            $indexAkhir = $indexAwal + $jumlahDataPerHalaman;
                            $dataTraksaksiHalaman = array_slice($dataTraksaksi, $indexAwal, $jumlahDataPerHalaman);
                            ?>
                            <div class="row">
                                <?php if (!empty($dataTraksaksiHalaman)) : ?>
                                    <?php $totalPesanan = 0; ?>
                                    <?php foreach ($dataTraksaksiHalaman as $transaksi) : ?>
                                        <div class="col-md-8 mt-3">
                                            <div class="col" id="nama_barang"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></div>
                                            <div class="col" id="jmlh_barang">x<?php echo $transaksi['Jumlah_Barang']; ?></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col text-end" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                        </div>
                                        <?php $totalPesanan += ($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']) * $transaksi['Jumlah_Barang']; ?>
                                    <?php endforeach; ?>
                                    <hr class="my-3">
                                    <div class="d-flex row">
                                        <div class="col text-end" id="total_harga">
                                            <p>Total Pesanan : Rp<?php echo number_format($totalPesanan, 0, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class='text-danger fw-bold'>Tidak ada data transaksi yang tersedia.</div>
                                    <hr class="my-3">
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col" id="pagenation">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item <?php echo ($halamanAktif == 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif - 1); ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                <li class="page-item <?php echo ($halamanAktif == $i) ? 'active' : ''; ?>"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            <?php endfor; ?>
                                            <li class="page-item <?php echo ($halamanAktif == $jumlahHalaman) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif + 1); ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="pembuatan">
                        <div class="d-flex row status">
                            <hr id="line-pesanan">
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $pengajuanModel = new Pengajuan($koneksi);
                                    $dataPengajuan = $pengajuanModel->tampilkanSemuaDataPengajuan();
                                    if (!is_null($dataPengajuan)) {
                                        $statusDiterimaPerusahaan = false;
                                        $statusDiterimaPengguna = false;
                                        $statusSedangDitinjau = false;
                                        $statusDitolak = false;
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPengajuan as $pengajuan) {
                                                if ($pengajuan['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pengajuan['Status_Pengajuan'] == 'Diterima') {
                                                        $statusDiterimaPerusahaan = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['ID_Pengguna'])) {
                                            foreach ($dataPengajuan as $pengajuan) {
                                                if ($pengajuan['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                    if ($pengajuan['Status_Pengajuan'] == 'Diterima') {
                                                        $statusDiterimaPengguna = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$statusDiterimaPerusahaan && !$statusDiterimaPengguna && !$statusSedangDitinjau && !$statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Belum Ada Ajuan</div>
                                                        <p class="card-text">
                                                        <a class="text-decoration-none fw-bold" href="ajukan.php">Klik disini</a> untuk mengajukan pesanan
                                                        </p>
                                                    </div>';
                                        } elseif ($statusDiterimaPerusahaan || $statusDiterimaPengguna) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="check-shield" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Diterima</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        } elseif ($statusSedangDitinjau) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Sedang Ditinjau</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        } elseif ($statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Ajuan Ditolak</div>
                                                        <p class="card-text">' . $pengajuan['Tanggal_Pengajuan'] . '</p>
                                                    </div>';
                                        }
                                    } else {
                                        echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Belum Ada Ajuan</div>
                                                    <p class="card-text">
                                                    <a class="text-decoration-none fw-bold" href="ajukan.php">Klik disini</a> untuk mengajukan pesanan
                                                    </p>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $dataTraksaksi = $transaksiModel->tampilkanPembayaranTransaksiSesuaiSession($id);
                                    ?>
                                    <?php
                                    $pembayaranModel = new Pengajuan($koneksi);
                                    $dataPembayaran = $pembayaranModel->tampilkanSemuaDataPembayaran();
                                    if (!is_null($dataPembayaran)) {
                                        $statusDiterimaPerusahaan = false;
                                        $statusDiterimaPengguna = false;
                                        $statusSedangDitinjau = false;
                                        $statusDitolak = false;
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Diterima') {
                                                        $statusDiterimaPerusahaan = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['ID_Pengguna'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Disetujui') {
                                                        $statusDiterimaPengguna = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$statusDiterimaPerusahaan && !$statusDiterimaPengguna && !$statusSedangDitinjau && !$statusDitolak) {
                                            echo '<span class="dot selected">
                                                          <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Unggah Bukti Pembayaran</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>';
                                        } elseif ($statusDiterimaPerusahaan || $statusDiterimaPengguna) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Diterima</div>
                                                        <p class="card-text">' . $pembayaran['Tanggal_Upload_Bukti'] . '</p>
                                                        </div>';
                                        } elseif ($statusSedangDitinjau) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Sedang Ditinjau</div>
                                                    </div>';
                                        } elseif ($statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                    <div class="card-title">Pembayaran Ditolak</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>
                                                    ';
                                        }
                                    } else {
                                        echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Belum Ada Pembayaran</div>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='receipt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibuat</div>
                                        <?php
                                        $id = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : $_SESSION['ID_Perusahaan'];
                                        $transaksiModel = new Transaksi($koneksi);
                                        $dataPembuatanModel = $transaksiModel->tampilkanPembuatanTanggalTransaksi($id);
                                        if ($dataPembuatanModel !== null) {
                                            foreach ($dataPembuatanModel as $data) {
                                        ?>
                                                <p class="card-text"><?php echo $data['Tanggal_Upload_File_Penerimaan']; ?></p>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <p class="card-text">Belum Ada Pembuatan</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="card">
                                    <span class="dot">
                                        <box-icon name='cart-alt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title text-center">Pesanan Selesai</div>
                                        <p class="card-text">Perbaharui Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $jumlahDataPerHalaman = 2;
                            $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiModel = new Transaksi($koneksi);
                            $dataTraksaksi = $transaksiModel->tampilkanPembuatanTransaksiSesuaiSession($id);
                            $jumlahHalaman = ceil(count($dataTraksaksi) / $jumlahDataPerHalaman);
                            $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
                            $indexAwal = ($halamanAktif - 1) * $jumlahDataPerHalaman;
                            $indexAkhir = $indexAwal + $jumlahDataPerHalaman;
                            $dataTraksaksiHalaman = array_slice($dataTraksaksi, $indexAwal, $jumlahDataPerHalaman);
                            ?>
                            <div class="row">
                                <?php if (!empty($dataTraksaksiHalaman)) : ?>
                                    <?php $totalPesanan = 0; ?>
                                    <?php foreach ($dataTraksaksiHalaman as $transaksi) : ?>
                                        <div class="col-md-8 mt-3">
                                            <div class="col" id="nama_barang"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></div>
                                            <div class="col" id="jmlh_barang">x<?php echo $transaksi['Jumlah_Barang']; ?></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col text-end" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                        </div>
                                        <?php $totalPesanan += ($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']) * $transaksi['Jumlah_Barang']; ?>
                                    <?php endforeach; ?>
                                    <hr class="my-3">
                                    <div class="d-flex row">
                                        <div class="col text-end" id="total_harga">
                                            <p>Total Pesanan : Rp<?php echo number_format($totalPesanan, 0, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class='text-danger fw-bold'>Tidak ada data transaksi yang tersedia.</div>
                                    <hr class="my-3">
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col" id="pagenation">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item <?php echo ($halamanAktif == 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif - 1); ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                <li class="page-item <?php echo ($halamanAktif == $i) ? 'active' : ''; ?>"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            <?php endfor; ?>
                                            <li class="page-item <?php echo ($halamanAktif == $jumlahHalaman) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif + 1); ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="selesai">
                        <div class="d-flex row status">
                            <hr id="line-pesanan">
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $dataTraksaksi = $transaksiModel->tampilkanPembayaranTransaksiSesuaiSession($id);
                                    ?>
                                    <?php
                                    $pembayaranModel = new Pengajuan($koneksi);
                                    $dataPembayaran = $pembayaranModel->tampilkanSemuaDataPembayaran();
                                    if (!is_null($dataPembayaran)) {
                                        $statusDiterimaPerusahaan = false;
                                        $statusDiterimaPengguna = false;
                                        $statusSedangDitinjau = false;
                                        $statusDitolak = false;
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Diterima') {
                                                        $statusDiterimaPerusahaan = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['ID_Pengguna'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Disetujui') {
                                                        $statusDiterimaPengguna = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$statusDiterimaPerusahaan && !$statusDiterimaPengguna && !$statusSedangDitinjau && !$statusDitolak) {
                                            echo '<span class="dot selected">
                                                          <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Unggah Bukti Pembayaran</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>';
                                        } elseif ($statusDiterimaPerusahaan || $statusDiterimaPengguna) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Diterima</div>
                                                        <p class="card-text">' . $pembayaran['Tanggal_Upload_Bukti'] . '</p>
                                                        </div>';
                                        } elseif ($statusSedangDitinjau) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Sedang Ditinjau</div>
                                                    </div>';
                                        } elseif ($statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                    <div class="card-title">Pembayaran Ditolak</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>
                                                    ';
                                        }
                                    } else {
                                        echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Belum Ada Pembayaran</div>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiModel = new Transaksi($koneksi);
                                    $dataTraksaksi = $transaksiModel->tampilkanPembayaranTransaksiSesuaiSession($id);
                                    ?>
                                    <?php
                                    $pembayaranModel = new Pengajuan($koneksi);
                                    $dataPembayaran = $pembayaranModel->tampilkanSemuaDataPembayaran();
                                    if (!is_null($dataPembayaran)) {
                                        $statusDiterimaPerusahaan = false;
                                        $statusDiterimaPengguna = false;
                                        $statusSedangDitinjau = false;
                                        $statusDitolak = false;
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Diterima') {
                                                        $statusDiterimaPerusahaan = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['ID_Pengguna'])) {
                                            foreach ($dataPembayaran as $pembayaran) {
                                                if ($pembayaran['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                    if ($pembayaran['Status_Transaksi'] == 'Disetujui') {
                                                        $statusDiterimaPengguna = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                        if (!$statusDiterimaPerusahaan && !$statusDiterimaPengguna && !$statusSedangDitinjau && !$statusDitolak) {
                                            echo '<span class="dot selected">
                                                          <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Unggah Bukti Pembayaran</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>';
                                        } elseif ($statusDiterimaPerusahaan || $statusDiterimaPengguna) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Diterima</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                        </div>';
                                        } elseif ($statusSedangDitinjau) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                        <div class="card-title">Pembayaran Sedang Ditinjau</div>
                                                    </div>';
                                        } elseif ($statusDitolak) {
                                            echo '<span class="dot selected">
                                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                    </span>
                                                    <div class="card-body text-center">
                                                    <div class="card-title">Pembayaran Ditolak</div>
                                                        <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                    </div>
                                                    ';
                                        }
                                    } else {
                                        echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Belum Ada Pembayaran</div>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='receipt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibuat</div>
                                        <?php
                                        $id = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : $_SESSION['ID_Perusahaan'];
                                        $transaksiModel = new Transaksi($koneksi);
                                        $dataPembuatanModel = $transaksiModel->tampilkanPembuatanTanggalTransaksi($id);
                                        if ($dataPembuatanModel !== null) {
                                            foreach ($dataPembuatanModel as $data) {
                                        ?>
                                                <p class="card-text"><?php echo $data['Tanggal_Upload_File_Penerimaan']; ?></p>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <p class="card-text">Belum Ada Pembuatan</p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='cart-alt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title text-center">Pesanan Selesai</div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $jumlahDataPerHalaman = 2;
                            $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiModel = new Transaksi($koneksi);
                            $dataTraksaksi = $transaksiModel->tampilkanSelesaiTransaksiSesuaiSession($id);
                            $jumlahHalaman = ceil(count($dataTraksaksi) / $jumlahDataPerHalaman);
                            $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
                            $indexAwal = ($halamanAktif - 1) * $jumlahDataPerHalaman;
                            $indexAkhir = $indexAwal + $jumlahDataPerHalaman;
                            $dataTraksaksiHalaman = array_slice($dataTraksaksi, $indexAwal, $jumlahDataPerHalaman);
                            ?>
                            <div class="row">
                                <?php if (!empty($dataTraksaksiHalaman)) : ?>
                                    <?php $totalPesanan = 0; ?>
                                    <?php foreach ($dataTraksaksiHalaman as $transaksi) : ?>
                                        <div class="col-md-8 mt-3">
                                            <div class="col" id="nama_barang"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></div>
                                            <div class="col" id="jmlh_barang">x<?php echo $transaksi['Jumlah_Barang']; ?></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col text-end" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                        </div>
                                        <?php $totalPesanan += ($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']) * $transaksi['Jumlah_Barang']; ?>
                                    <?php endforeach; ?>
                                    <hr class="my-3">
                                    <div class="d-flex row">
                                        <div class="col text-end" id="total_harga">
                                            <p>Total Pesanan : Rp<?php echo number_format($totalPesanan, 0, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class='text-danger fw-bold'>Tidak ada data transaksi yang tersedia.</div>
                                    <hr class="my-3">
                                <?php endif; ?>
                            </div>
                            <div class="d-flex row mt-4">
                                <div class="col" id="pagenation">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item <?php echo ($halamanAktif == 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif - 1); ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                <li class="page-item <?php echo ($halamanAktif == $i) ? 'active' : ''; ?>"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            <?php endfor; ?>
                                            <li class="page-item <?php echo ($halamanAktif == $jumlahHalaman) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?halaman=<?php echo ($halamanAktif + 1); ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col text-end">
                                    <button class="btn btn-outline-danger ms-3" type="button" id="btn-beli-lagi1" style="width:100px;">Beli Lagi</button>
                                    <button class="btn btn-outline-success pe-2 ms-2" type="button" id="nilai-ikm" style="width:100px;">Isi Survey</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('../partials/modal-histori-ikm.php');
    include('../partials/modal-perbaikan-pesanan.php');
    include('../partials/modal-invoice-pesanan.php');
    ?>
    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/pesanan.js"></script>
    <script src="../../admin/assets/our/js/value-improve-applyment.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>