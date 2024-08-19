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

        <div class="modal fade" id="invoicePesanan" tabindex="-1" aria-labelledby="invoicePesananLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="box-invoice">
                    <div class="modal-header">
                        <?php
                        function generateRandomOrderNumber()
                        {
                            $waktu = time();
                            $angkaAcak = mt_rand(1000, 9999);
                            $nomorPesanan = '#' . $waktu . $angkaAcak;
                            return $nomorPesanan;
                        }
                        $nomorPesanan = generateRandomOrderNumber();
                        echo "<h1 class='modal-title fs-5' id='invoicePesananLabel'>Nomor Pesanan Anda: " . $nomorPesanan . "</h1>";
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-2 px-2 pt-0">
                        <div class="container-fluid p-0">
                            <div class="row justify-content-between mb-5">
                                <div class="col-md-2 stamp-logo">
                                    <img src="../assets/img/Logo PTSP1.png" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-4 text-center header-invoice">
                                    <h3 class="title fw-bold">INFORMASI PESANAN</h3>
                                    <?php
                                    $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                                    $transaksiPembeliModel = new Transaksi($koneksi);

                                    $dataTransaksiA = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceA($idPembeli);
                                    $dataTransaksiB = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceB($idPembeli);
                                    $dataTransaksiC = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceC($idPembeli);

                                    function cekStatusPesanan($dataTransaksi)
                                    {
                                        if (empty($dataTransaksi)) {
                                            return null;
                                        }
                                        foreach ($dataTransaksi as $transaksi) {
                                            if (strtolower($transaksi['Status_Pesanan']) !== 'lunas') {
                                                return false;
                                            }
                                        }
                                        return true;
                                    }

                                    $statusLunasA = cekStatusPesanan($dataTransaksiA);
                                    $statusLunasB = cekStatusPesanan($dataTransaksiB);
                                    $statusLunasC = cekStatusPesanan($dataTransaksiC);

                                    $nomorUrut = 1;

                                    if (!empty($dataTransaksiA) || !empty($dataTransaksiB) || !empty($dataTransaksiC)) {
                                        if ($statusLunasA !== null) {
                                    ?>
                                            <div class="col-md-12 mt-3">
                                                <span>
                                                    <strong class="">Status Pesanan Meteorologi:
                                                        <span style="color: <?= $statusLunasA ? 'green' : 'red' ?>;">
                                                            <?= $statusLunasA ? 'Lunas' : 'Belum Lunas' ?>
                                                        </span>
                                                    </strong>
                                                </span>
                                            </div>
                                        <?php
                                        }
                                        if ($statusLunasB !== null) {
                                        ?>
                                            <div class="col-md-12 mt-3">
                                                <span><strong class="">Status Pesanan Klimatologi:
                                                        <span style="color: <?= $statusLunasB ? 'green' : 'red' ?>;">
                                                            <?= $statusLunasB ? 'Lunas' : 'Belum Lunas' ?>
                                                        </span>
                                                    </strong></span>
                                            </div>
                                        <?php
                                        }
                                        if ($statusLunasC !== null) {
                                        ?>
                                            <div class="col-md-12 mt-3">
                                                <span><strong class="">Status Pesanan Geofisika:
                                                        <span style="color: <?= $statusLunasC ? 'green' : 'red' ?>;">
                                                            <?= $statusLunasC ? 'Lunas' : 'Belum Lunas' ?>
                                                        </span>
                                                    </strong></span>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                        $transaksiPembeliModel = new Transaksi($koneksi);
                        $dataTransaksiA = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceA($idPembeli);
                        $hasTransaksiA = !empty($dataTransaksiA);
                        $nomorUrut = 1;
                        if ($hasTransaksiA) {
                        ?>
                            <h5 class="fw-bold mt-4">PENERIMA INSTANSI A (No.Rekening 1111)</h5>
                            <table id="tabelTransaksiA" class="table" style="border-radius: 10px;">
                                <thead class="table-secondary">
                                    <tr>
                                        <td>Produk</td>
                                        <td>Rekening</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataTransaksiA as $transaksi) { ?>
                                        <tr>
                                            <td class="produk ps-3">
                                                <?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?>
                                            </td>
                                            <td class="rekening ps-3">
                                                <?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?>
                                            </td>
                                            <td class="harga ps-3">
                                                Rp<?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?>
                                            </td>
                                            <td class="jumlah ps-3">
                                                <?php echo $transaksi['Jumlah_Barang']; ?>
                                            </td>
                                            <td class="total ps-3">
                                                Rp<?php echo number_format(($transaksi['Total_Transaksi']), 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        <?php
                        $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                        $transaksiPembeliModel = new Transaksi($koneksi);
                        $dataTransaksiB = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceB($idPembeli);
                        $hasTransaksiB = !empty($dataTransaksiB);
                        $nomorUrut = 1;
                        if ($hasTransaksiB) {
                        ?>
                            <h5 class="fw-bold mt-4">PENERIMA INSTANSI B (No.Rekening 2222)</h5>
                            <table class="table" style="border-radius: 10px;">
                                <thead class="table-secondary">
                                    <tr>
                                        <td>Produk</td>
                                        <td>Rekening</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataTransaksiB as $transaksi) { ?>
                                        <tr>
                                            <td class="produk ps-3">
                                                <?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?>
                                            </td>
                                            <td class="rekening ps-3">
                                                <?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?>
                                            </td>
                                            <td class="harga ps-3">
                                                Rp<?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?>
                                            </td>
                                            <td class="jumlah ps-3">
                                                <?php echo $transaksi['Jumlah_Barang']; ?>
                                            </td>
                                            <td class="total ps-3">
                                                Rp<?php echo number_format(($transaksi['Total_Transaksi']), 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        <?php
                        $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                        $transaksiPembeliModel = new Transaksi($koneksi);
                        $dataTransaksiC = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceC($idPembeli);
                        $hasTransaksiC = !empty($dataTransaksiC);
                        $nomorUrut = 1;
                        if ($hasTransaksiC) {
                        ?>
                            <h5 class="fw-bold mt-4">PENERIMA INSTANSI C (No.Rekening 3333)</h5>
                            <table class="table" style="border-radius: 10px;">
                                <thead class="table-secondary">
                                    <tr>
                                        <td>Produk</td>
                                        <td>Rekening</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataTransaksiC as $transaksi) { ?>
                                        <tr>
                                            <td class="produk ps-3">
                                                <?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?>
                                            </td>
                                            <td class="rekening ps-3">
                                                <?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?>
                                            </td>
                                            <td class="harga ps-3">
                                                Rp<?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?>
                                            </td>
                                            <td class="jumlah ps-3">
                                                <?php echo $transaksi['Jumlah_Barang']; ?>
                                            </td>
                                            <td class="total ps-3">
                                                Rp<?php echo number_format(($transaksi['Total_Transaksi']), 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        <div class="container-fluid">
                            <form action="../../admin/config/generate-invoice.php" method="post">
                                <div class="row mx-auto text-end">
                                    <div class="col-md-12 mt-3 mb-2">
                                        <button type="submit" name="generate_pdf" class="btn btn-outline-success mx-2">Download</button>
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#uploadBuktiPembayaran">Upload Bukti Pembayaran</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="uploadBuktiPembayaran" tabindex="-1" aria-labelledby="uploadBuktiPembayaranLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="box-uploadbuktipembayaran">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="uploadBuktiPembayaranLabel">Upload Bukti Pembayaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                        $transaksiPembeliModel = new Transaksi($koneksi);
                        $dataTransaksi = [
                            'METEOROLOGI' => $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceA($idPembeli),
                            'KLIMATOLOGI' => $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceB($idPembeli),
                            'GEOFISIKA' => $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceC($idPembeli)
                        ];

                        foreach ($dataTransaksi as $instansi => $transaksiList) {
                            if (!empty($transaksiList)) {
                                foreach ($transaksiList as $transaksi) {
                                    if (isset($transaksi['Keterangan_Pembayaran_Ditolak'])) : ?>
                                        <div class="col-md-12 text-start">
                                            <div class="alert alert-danger text-danger fw-bold" role="alert">
                                                <div class="d-flex col-md-12 mb-0">
                                                    <span class="align-middle me-3"><box-icon name='message-error' color='rgba(176, 42, 55, 0.9)'></box-icon></span>
                                                    <span class="align-middle m-0"><strong>PERBAIKAN TERHADAP DOKUMEN INSTANSI <?php echo $instansi; ?></strong></span>
                                                </div>
                                                <hr>
                                                <p class="text-dark">
                                                    <?php echo $transaksi['Keterangan_Pembayaran_Ditolak']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-md-12" style="display: none;"></div>
                        <?php endif;
                                }
                            }
                        }
                        ?>
                        <?php if ($hasTransaksiA && !$hasTransaksiB && !$hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment_instansi_a.php" method="post" enctype="multipart/form-data">
                                <h5 class="mb-2">Stasiun Meteorologi
                                    <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiA as $transaksiA) { ?>
                                    <input type="hidden" name="id_instansi_a[]" value="<?= $transaksiA['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file" class="custum-file-upload" id="btnUpload">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file" type="file" name="File_Instansi_A">
                                </label>
                                <div class="container-fluid">
                                    <div class="row" id="preview-header">
                                        <div class="col-md-12 mt-2" id="preview-file" style="display: none;">
                                            <span>
                                                <strong>NamaFile-InstansiMananya-Tanggal</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                </div>
                            </form>
                        <?php } else if (!$hasTransaksiA && $hasTransaksiB && !$hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment_instansi_b.php" method="post" enctype="multipart/form-data">
                                <h5 class="mt-4 mb-2">Stasiun Klimatologi
                                    <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiB as $transaksiB) { ?>
                                    <input type="hidden" name="id_instansi_b" value="<?= $transaksiB['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file" class="custum-file-upload" id="btnUpload">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file" type="file" name="File_Instansi_B">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file" style="display: none;">
                                            <span>
                                                <strong>NamaFile2-InstansiMananya2-Tanggal2</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                </div>
                            </form>
                        <?php } else if (!$hasTransaksiA && !$hasTransaksiB && $hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment_instansi_c.php" method="post" enctype="multipart/form-data">
                                <h5 class="mt-4 mb-2">Stasiun Klimatologi
                                    <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiC as $transaksiC) { ?>
                                    <input type="hidden" name="id_instansi_c" value="<?= $transaksiC['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file" class="custum-file-upload" id="btnUpload">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file" type="file" name="File_Instansi_C">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file" style="display: none;">
                                            <span>
                                                <strong>NamaFile2-InstansiMananya2-Tanggal2</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                </div>
                            </form>
                        <?php } else if ($hasTransaksiA && $hasTransaksiB && !$hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment_instansi_a_dan_b.php" method="post" enctype="multipart/form-data">
                                <h5 class="mb-2">Stasiun Meteorologi
                                    <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiA as $transaksiA) { ?>
                                    <input type="hidden" name="id_instansi_a" value="<?= $transaksiA['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file" class="custum-file-upload" id="btnUpload">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file" type="file" name="File_Instansi_A">
                                </label>
                                <div class="container-fluid">
                                    <div class="row" id="preview-header">
                                        <div class="col-md-12 mt-2" id="preview-file" style="display: none;">
                                            <span>
                                                <strong>NamaFile-InstansiMananya-Tanggal</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-4 mb-2">Stasiun Klimatologi
                                    <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiB as $transaksiB) { ?>
                                    <input type="hidden" name="id_instansi_b" value="<?= $transaksiB['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file2" class="custum-file-upload" id="btnUpload1">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file2" type="file" name="File_Instansi_B">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file2" style="display: none;">
                                            <span>
                                                <strong>NamaFile2-InstansiMananya2-Tanggal2</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                </div>
                            </form>
                        <?php } else if ($hasTransaksiA && !$hasTransaksiB && $hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment_instansi_a_dan_c.php" method="post" enctype="multipart/form-data">
                                <h5 class="mb-2">Stasiun Meteorologi
                                    <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiA as $transaksiA) { ?>
                                    <input type="hidden" name="id_instansi_a" value="<?= $transaksiA['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file" class="custum-file-upload" id="btnUpload">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file" type="file" name="File_Instansi_A">
                                </label>
                                <div class="container-fluid">
                                    <div class="row" id="preview-header">
                                        <div class="col-md-12 mt-2" id="preview-file" style="display: none;">
                                            <span>
                                                <strong>NamaFile-InstansiMananya-Tanggal</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-4 mb-2">Stasiun Geofisika
                                    <span class=" fs-6 text-secondary" id="guide-geofisika"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunGeofisika_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiC as $transaksiC) { ?>
                                    <input type="hidden" name="id_instansi_c" value="<?= $transaksiC['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file2" class="custum-file-upload" id="btnUpload1">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file2" type="file" name="File_Instansi_C">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file2" style="display: none;">
                                            <span>
                                                <strong>NamaFile3-InstansiMananya3-Tanggal3</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                </div>
                            </form>
                        <?php } else if (!$hasTransaksiA && $hasTransaksiB && $hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment_instansi_b_dan_c.php" method="post" enctype="multipart/form-data">
                                <h5 class="mt-4 mb-2">Stasiun Klimatologi
                                    <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiB as $transaksiB) { ?>
                                    <input type="hidden" name="id_instansi_b" value="<?= $transaksiB['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file" class="custum-file-upload" id="btnUpload">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file" type="file" name="File_Instansi_B">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file" style="display: none;">
                                            <span>
                                                <strong>NamaFile2-InstansiMananya2-Tanggal2</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-4 mb-2">Stasiun Geofisika
                                    <span class="fs-6 text-secondary" id="guide-geofisika"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunGeofisika_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiC as $transaksiC) { ?>
                                    <input type="hidden" name="id_instansi_c" value="<?= $transaksiC['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file2" class="custum-file-upload" id="btnUpload1">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file2" type="file" name="File_Instansi_C">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file2" style="display: none;">
                                            <span>
                                                <strong>NamaFile3-InstansiMananya3-Tanggal3</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                </div>
                            </form>
                        <?php } else if ($hasTransaksiA && $hasTransaksiB && $hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment_instansi_a_dan_b_dan_c.php" method="post" enctype="multipart/form-data">
                                <h5 class="mb-2">Stasiun Meteorologi
                                    <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiA as $transaksiA) { ?>
                                    <input type="hidden" name="id_instansi_a" value="<?= $transaksiA['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file" class="custum-file-upload" id="btnUpload">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file" type="file" name="File_Instansi_A">
                                </label>
                                <div class="container-fluid">
                                    <div class="row" id="preview-header">
                                        <div class="col-md-12 mt-2" id="preview-file" style="display: none;">
                                            <span>
                                                <strong>NamaFile-InstansiMananya-Tanggal</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-4 mb-2">Stasiun Klimatologi
                                    <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiB as $transaksiB) { ?>
                                    <input type="hidden" name="id_instansi_b" value="<?= $transaksiB['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file2" class="custum-file-upload" id="btnUpload1">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file2" type="file" name="File_Instansi_B">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file2" style="display: none;">
                                            <span>
                                                <strong>NamaFile2-InstansiMananya2-Tanggal2</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-4 mb-2">Stasiun Geofisika
                                    <span class=" fs-6 text-secondary" id="guide-geofisika"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunGeofisika_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
                                <?php foreach ($dataTransaksiC as $transaksiC) { ?>
                                    <input type="hidden" name="id_instansi_c" value="<?= $transaksiC['ID_Tranksaksi'] ?>">
                                <?php } ?>
                                <label for="file3" class="custum-file-upload" id="btnUpload2">
                                    <div class="icon" id="icon1">
                                        <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Ketuk untuk mengunggah</span>
                                    </div>
                                    <input id="file3" type="file" name="File_Instansi_C">
                                </label>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 mt-2" id="preview-file3" style="display: none;">
                                            <span>
                                                <strong>NamaFile3-InstansiMananya3-Tanggal3</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                </div>
                            </form>
                        <?php } else { ?>
                            <p class="fw-bold text-danger text-center">TIDAK ADA TRANSAKSI!</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function setupFileInput(inputId, previewDivId, labelId, guideId, deleteBtnId) {
                document.getElementById(inputId).addEventListener("change", function() {
                    let file = this.files[0];
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let previewFileDiv = document.getElementById(previewDivId);
                        previewFileDiv.style.display = "block";
                        let fileNameSpan = document.createElement("span");
                        fileNameSpan.innerHTML = "<strong>" + file.name + "</strong>" + "<button type='button' style='border: none; background-color: transparent;' id='" + deleteBtnId + "' class='float-end'><span class='align-middle text-end'><box-icon type='solid' name='trash'></box-icon></span></button>";
                        previewFileDiv.innerHTML = "";
                        previewFileDiv.appendChild(fileNameSpan);
                        let label = document.getElementById(labelId);
                        label.style.display = "none";
                        let guide = document.getElementById(guideId);
                        guide.style.display = "none";
                        document.getElementById(deleteBtnId).addEventListener("click", function() {
                            document.getElementById(inputId).value = "";
                            previewFileDiv.style.display = "none";
                            label.style.display = "block";
                            guide.style.display = "block";
                        });
                    };
                    reader.readAsDataURL(file);
                });
            }

            function deleteFile(inputId, previewDivId, labelId, guideId) {
                document.getElementById(inputId).value = "";
                document.getElementById(previewDivId).style.display = "none";
                document.getElementById(labelId).style.display = "block";
                document.getElementById(guideId).style.display = "block";
            }

            setupFileInput("file", "preview-file", "btnUpload", "guide-meteorologi", "deleteFile");
            setupFileInput("file2", "preview-file2", "btnUpload1", "guide-klimatologi", "deleteFile2");
            setupFileInput("file3", "preview-file3", "btnUpload2", "guide-geofisika", "deleteFile3");
        </script>

        <?php
        include('../partials/modal-histori-ikm.php');

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