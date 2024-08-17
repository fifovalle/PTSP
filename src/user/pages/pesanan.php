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
                                <div class="col-md-4 d-flex flex-row">
                                    <?php if ($transaksi['Apakah_Gratis'] == 0) { ?>
                                        <div class="col" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                    <?php } else { ?>
                                        <div class="col text-decoration-line-through" id="harga_barang">
                                            <?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="flex-column gap-3">
                                        <div class="my-2">
                                            <a href="../../admin/assets/image/uploads/<?php echo $transaksi['File_Penerimaan']; ?>" class="btn btn-outline-success h-75" id="btn-download-file" type="button" style="width:200px;">Download File</a>
                                        </div>
                                        <div class="my-2">
                                            <button class="btn btn-outline-secondary tombol-riwayat-isi-ikm" type="button" style="width:200px;" data-bs-toggle="modal" data-id="<?php echo $transaksi['ID_Ikm']; ?>">Riwayat Pengisian IKM</button>
                                        </div>
                                        <div class="col"><?php echo $transaksi['Tanggal_Pembelian']; ?></div>
                                    </div>
                                </div>
                            <?php
                                if ($transaksi['Apakah_Gratis'] == 0) {
                                    $totalPesanan += ($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']) * $transaksi['Jumlah_Barang'];
                                }
                            }

                            ?>
                            <hr class="my-3">
                            <div class="d-flex row">
                                <div class="col text-end" id="total_harga">
                                    <?php if ($totalPesanan > 0) { ?>
                                        <p>Total Pesanan : Rp<?php echo number_format($totalPesanan, 0, ',', '.'); ?></p>
                                    <?php } else { ?> <p>Total Pesanan : Rp0</p> <?php } ?>
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
                                <form action="../../admin/config/generate-invoice.php" method="post">
                                    <?php
                                    if (!empty($dataTraksaksi)) {
                                    ?>
                                        <button type="submit" name="generate_pdf" class="btn btn-outline-success mx-2">Unduh Faktur</button>
                                    <?php
                                    } ?>
                                    <button class="btn btn-outline-danger px-2 mx-2" type="button" id="btn-beli-lagi" style="width:100px;">Beli Lagi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 px-5" id="detail-pesanan" style="display:none;">
                <div class="container-fluid w-100">
                    <div class="d-flex row text-center mb-3" id="status-pesanan">
                        <div class="col-md-3">
                            <?php
                            $transaksiModel = new Transaksi($koneksi);
                            if (isset($_SESSION['ID_Pengguna'])) {
                                $id = $_SESSION['ID_Pengguna'];
                                $jumlahTransaksi = $transaksiModel->hitungPengajuanTransaksiSesuaiSessionPengguna($id);
                            } else if (isset($_SESSION['ID_Perusahaan'])) {
                                $id = $_SESSION['ID_Perusahaan'];
                                $jumlahTransaksi = $transaksiModel->hitungPengajuanTransaksiSesuaiSessionPerusahaan($id);
                            } else {
                                $jumlahTransaksi = 0;
                                echo 'Tidak ada sesi yang aktif.';
                            }
                            ?>
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pengajuan" <?php echo $jumlahTransaksi == 0 ? 'disabled' : ''; ?>>
                                Status Pengajuan
                                <span class="badge text-bg-secondary" id="badge-pengajuan">
                                    <?php echo $jumlahTransaksi; ?>
                                </span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <?php
                            $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                            $transaksiModel = new Transaksi($koneksi);
                            $jumlahTransaksi = $transaksiModel->hitungPembayaranTransaksiSesuaiSession($id);
                            ?>
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pembayaran" <?php echo $jumlahTransaksi == 0 ? 'disabled' : ''; ?>>
                                Status Pembayaran
                                <span class="badge text-bg-secondary" id="badge-pembayaran">
                                    <?php echo $jumlahTransaksi; ?>
                                </span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <?php
                            $jumlahTransaksi = $transaksiModel->hitungPembuatanTransaksiSesuaiSession($id);
                            ?>
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pembuatan" <?php echo $jumlahTransaksi == 0 ? 'disabled' : ''; ?>>
                                Status Pembuatan
                                <span class="badge text-bg-secondary" id="badge-pembuatan">
                                    <?php echo $jumlahTransaksi; ?>
                                </span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <?php
                            $jumlahTransaksi = $transaksiModel->hitungSelesaiTransaksiSesuaiSession($id);
                            ?>
                            <button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-selesai" <?php echo $jumlahTransaksi == 0 ? 'disabled' : ''; ?>>
                                Status Selesai
                                <span class="badge text-bg-secondary" id="badge-selesai">
                                    <?php echo $jumlahTransaksi; ?>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="d-none" id="ajuan">
                        <div class="d-flex row status">
                            <hr id="line-pesanan">
                            <div class="col-md-3">
                                <div class="card">
                                    <?php
                                    $pengajuanModel = new Pengajuan($koneksi);
                                    $transaksiModel = new Transaksi($koneksi);
                                    $dataPengajuan = $pengajuanModel->tampilkanSemuaDataPengajuan2();
                                    $dataTransaksi = $transaksiModel->tampilkanDataTransaksiKetikaSudahDiChekout();

                                    $statusDiterima = false;
                                    $statusSedangDitinjau = false;
                                    $statusDitolak = false;
                                    $belumAdaPengajuan = false;

                                    if (!is_null($dataTransaksi)) {
                                        foreach ($dataTransaksi as $transaksi) {
                                            if (is_null($transaksi['ID_Pengajuan'])) {
                                                $belumAdaPengajuan = true;
                                                break;
                                            }
                                        }
                                    }

                                    if (!is_null($dataPengajuan)) {
                                        if (!empty($_SESSION['ID_Perusahaan'])) {
                                            foreach ($dataPengajuan as $pengajuan) {
                                                if ($pengajuan['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                    if ($pengajuan['Status_Pengajuan'] == 'Diterima') {
                                                        $statusDiterima = true;
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
                                                        $statusDiterima = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') {
                                                        $statusSedangDitinjau = true;
                                                    } elseif ($pengajuan['Status_Pengajuan'] == 'Ditolak') {
                                                        $statusDitolak = true;
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    if ($belumAdaPengajuan) {
                                        echo '<span class="dot selected">
                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Belum Ada Pengajuan</div>
                                        <p class="card-text"><a href="ajukan.php" class="text-decoration-none fw-bold">Klik Disini untuk Pengajuan</a></p>
                                    </div>';
                                    } elseif ($statusDiterima) {
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
                                    } else {
                                        echo '<span class="dot selected">
                                        <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Tidak Ada Ajuan</div>
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
                            $jumlahDataPerHalaman = 5;
                            $transaksiModel = new Transaksi($koneksi);

                            if (isset($_SESSION['ID_Pengguna'])) {
                                $id = $_SESSION['ID_Pengguna'];
                                $dataTransaksi = $transaksiModel->tampilkanPengajuanTransaksiSesuaiSessionPengguna($id);
                            } elseif (isset($_SESSION['ID_Perusahaan'])) {
                                $id = $_SESSION['ID_Perusahaan'];
                                $dataTransaksi = $transaksiModel->tampilkanPengajuanTransaksiSesuaiSessionPerusahaan($id);
                            } else {
                                echo "Tidak ada sesi yang aktif.";
                                exit;
                            }

                            $groupedData = [];
                            foreach ($dataTransaksi as $transaksi) {
                                $groupedData[$transaksi['ID_Pengajuan']][] = $transaksi;
                            }

                            $jumlahHalaman = ceil(count($groupedData) / $jumlahDataPerHalaman);
                            $halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                            $indexAwal = ($halamanAktif - 1) * $jumlahDataPerHalaman;
                            $dataTransaksiHalaman = array_slice($groupedData, $indexAwal, $jumlahDataPerHalaman, true);

                            $totalPesanan = 0;
                            ?>

                            <div class="row">
                                <?php if (!empty($dataTransaksiHalaman)) : ?>
                                    <?php foreach ($dataTransaksiHalaman as $idPengajuan => $transaksiGroup) : ?>
                                        <?php
                                        $statusPengajuan = $transaksiGroup[0]['Status_Pengajuan'] ?? null;
                                        $showButtonPerbaikan = $statusPengajuan === 'Ditolak';
                                        ?>
                                        <?php foreach ($transaksiGroup as $transaksi) : ?>
                                            <div class="col-md-8 mt-3">
                                                <div class="col" id="nama_barang"><?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?></div>
                                                <div class="col" id="jmlh_barang">x<?php echo $transaksi['Jumlah_Barang']; ?></div>
                                            </div>
                                            <div class="col-md-4 d-flex">
                                                <div class="col text-end me-2" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                            </div>
                                            <?php $totalPesanan += ($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']) * $transaksi['Jumlah_Barang']; ?>
                                        <?php endforeach; ?>
                                        <?php if ($showButtonPerbaikan) : ?>
                                            <div class="col-12 mt-3 justify-content-end d-flex">
                                                <button class="btn btn-outline-primary buttonImproveApplyment" type="button" data-bs-toggle="modal" data-id="<?php echo $idPengajuan; ?>">Perbaikan Dokumen</button>
                                            </div>
                                        <?php endif; ?>
                                        <hr class="my-3">
                                    <?php endforeach; ?>
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
                                        <box-icon name="check-shield" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Tidak Ada Ajuan</div>
                                        <p class="card-text">
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
                                    $dataTransaksi = $transaksiModel->tampilkanPembayaranTransaksiSesuaiSession($id);

                                    $statusPembayaran = [
                                        'Diterima' => false,
                                        'Sedang Ditinjau' => false,
                                        'Ditolak' => false,
                                    ];

                                    if (!is_null($dataTransaksi)) {
                                        foreach ($dataTransaksi as $pembayaran) {
                                            if (!empty($_SESSION['ID_Perusahaan']) && $pembayaran['ID_Perusahaan'] == $_SESSION['ID_Perusahaan']) {
                                                if ($pembayaran['Status_Transaksi'] == 'Diterima') {
                                                    $statusPembayaran['Diterima'] = true;
                                                } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                    $statusPembayaran['Sedang Ditinjau'] = true;
                                                } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                    $statusPembayaran['Ditolak'] = true;
                                                }
                                            }
                                            if (!empty($_SESSION['ID_Pengguna']) && $pembayaran['ID_Pengguna'] == $_SESSION['ID_Pengguna']) {
                                                if ($pembayaran['Status_Transaksi'] == 'Disetujui') {
                                                    $statusPembayaran['Diterima'] = true;
                                                } elseif ($pembayaran['Status_Transaksi'] == 'Sedang Ditinjau') {
                                                    $statusPembayaran['Sedang Ditinjau'] = true;
                                                } elseif ($pembayaran['Status_Transaksi'] == 'Ditolak') {
                                                    $statusPembayaran['Ditolak'] = true;
                                                }
                                            }
                                        }

                                        if ($statusPembayaran['Ditolak']) {
                                            echo '<span class="dot selected">
                                                    <box-icon name="x-circle" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Pembayaran Ditolak</div>
                                                    <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                </div>';
                                        } elseif ($statusPembayaran['Diterima']) {
                                            echo '<span class="dot selected">
                                                    <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Pembayaran Diterima</div>
                                                    <p class="card-text">' . $pembayaran['Tanggal_Upload_Bukti'] . '</p>
                                                </div>';
                                        } elseif ($statusPembayaran['Sedang Ditinjau']) {
                                            echo '<span class="dot selected">
                                                    <box-icon name="time" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Pembayaran Sedang Ditinjau</div>
                                                </div>';
                                        } else {
                                            echo '<span class="dot selected">
                                                    <box-icon name="money" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                                </span>
                                                <div class="card-body text-center">
                                                    <div class="card-title">Unggah Bukti Pembayaran</div>
                                                    <p class="card-text"><a type="button" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#invoicePesanan">Klik disini</a> untuk melihat detail pesanan</p>
                                                </div>';
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
                            $jumlahDataPerHalaman = 5;
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
                                        <box-icon name="check-shield" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Tidak Ada Ajuan</div>
                                        <p class="card-text">
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

                                        if ($dataPembuatanModel !== null && count($dataPembuatanModel) > 0) {
                                            usort($dataPembuatanModel, function ($a, $b) {
                                                return strtotime($b['Tanggal_Upload_File_Penerimaan']) - strtotime($a['Tanggal_Upload_File_Penerimaan']);
                                            });

                                            $dataTerbaru = $dataPembuatanModel[0];
                                        ?>
                                            <p class="card-text"><?php echo $dataTerbaru['Tanggal_Upload_File_Penerimaan']; ?></p>
                                        <?php
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
                            $jumlahDataPerHalaman = 5;
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
                                        <box-icon name="check-shield" id="icon" color="rgba(255,255,255,0.9)"></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Tidak Ada Ajuan</div>
                                        <p class="card-text">
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
                                        if ($dataPembuatanModel !== null && !empty($dataPembuatanModel)) {
                                            // Ambil elemen pertama dari array hasil
                                            $data = $dataPembuatanModel[0];
                                        ?>
                                            <p class="card-text"><?php echo $data['Tanggal_Upload_File_Penerimaan']; ?></p>
                                        <?php
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
                            $jumlahDataPerHalaman = 5;
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
                                        <div class="col-md-4 d-flex flex-row">
                                            <div class="col" id="harga_barang"><?php echo 'Rp' . number_format($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa'], 0, ',', '.'); ?></div>
                                            <button class="btn btn-outline-success pe-2 h-50 nilai-ikm" type="button" data-id="<?php echo $transaksi['ID_Tranksaksi']; ?>" style="width:100px;">Isi Survey</button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="perbaikanPesanan" tabindex="-1" aria-labelledby="perbaikanPesananLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="box-perbaikan">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="perbaikanPesananLabel">Perbaikan Dokumen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <input type="hidden" name="ID_Pengajuan" id="improveIDPengajuan">
                        <input type="hidden" name="ID_Sub_Pengajuan" id="improveIDSubPengajuan">
                        <div class="modal-body">
                            <div class="col-md-12 text-start">
                                <div class="alert alert-danger text-danger fw-bold" role="alert">
                                    <div class="d-flex col-md-12 mb-0">
                                        <span class="align-middle me-3"><box-icon name='message-error' color='rgba(176, 42, 55, 0.9)'></box-icon></span>
                                        <span class="align-middle m-0"><strong>PERBAIKAN TERHADAP DOKUMEN</strong></span>
                                    </div>
                                    <hr>
                                    <p class="text-dark" id="perbaikanPesananTeks"></p>
                                </div>
                            </div>
                            <select class="form-select" name="Perbaikan_Dokumen" aria-label="Default select example">
                                <option value="" selected>Pilih perbaikan dokumen</option>
                                <option value="1">Surat Pengantar Permintaan Data</option>
                                <option value="2">Surat Permintaan Ditandatangani Camat atau Pejabat Setingkat</option>
                                <option value="3">Surat Pengantar dari Kepala Sekolah / Rektor / Dekan</option>
                                <option value="4">Proposal Penelitian Berisi Maksud dan Tujuan Penelitian yang Telah Disetujui</option>
                                <option value="5">Identitas Diri KTP / KTM / SIM / Paspor</option>
                                <option value="6">Surat Pernyataan Tidak Digunakan Untuk Kepentingan Lain</option>
                                <option value="7">Mempunyai Perjanjian Kerjasama dengan BMKG tentang Kebutuhan Informasi MKKuG</option>
                                <option value="8">Surat Pengantar (Pemerintah pusat atau daerah)</option>
                                <option value="9">Surat Pengantar (Pelayanan informasi dengan tarif PNBP)</option>
                            </select>
                            <div class="mb-3 mt-4">
                                <input class="form-control" name="Unggah_Dokumen" type="file" id="formFile">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="tombolSimpanImproveApplyment" name="Simpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        include('../partials/modal-histori-ikm.php');
        include('../partials/modal-invoice-pesanan.php');
        ?>
    </div>
    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/pesanan.js"></script>
    <script src="../../admin/assets/our/js/value-improve-applyment.js"></script>
    <script src="../../admin/assets/our/js/value-see-ikm-user.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>