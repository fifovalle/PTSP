<?php
include '../../admin/config/databases.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/pesanan.css">
    <title>Pesanan PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid w-100 mt-5">
        <div class="row">
            <div class="col-md-2 p-0 h-100" id="opsi-pemesanan">
                <div class="row mx-5 my-3">
                    <div class="btn btn-success" id="history-order" onclick="showContentPemesanan('history-pesanan')"> Riwayat Pesanan <span class="badge text-bg-secondary ms-2">0</span></div>
                </div>
                <div class="row mx-5 my-3">
                    <div class="btn btn-outline-success" id="tracking-order" onclick="showContentPemesanan('detail-pesanan')">Pelacakan Pesanan</div>
                </div>
            </div>
            <div class="col-md-10 px-5" id="history-pesanan">
                <div class="container-fluid w-100">
                    <div class="d-flex row status" id="opsi-statuspesanan">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="col" id="nama_barang">Informasi Klimatologi - Data Iklim 1 Bulan</div>
                                <div class="col" id="jmlh_barang">x2</div>
                            </div>
                            <div class="col-md-4">
                                <div class="col text-end" id="harga_barang">Rp30.000</div>
                            </div>
                            <hr class="my-3">
                        </div>
                        <div class="d-flex row">
                            <div class="col text-end" id="total_harga">
                                <p>Total Pesanan :</p> Rp30.000
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex col ">
                                <button class="btn btn-outline-danger px-2 mx-3" type="button" id="btn-beli-lagi" style="width:100px;">Beli Lagi</button>
                                <button class="btn btn-outline-success px-2 mx-3" type="button" style="width:100px;">Download</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 px-5" id="detail-pesanan" style="display:none;">
                <div class="container-fluid w-100">
                    <div class="d-flex row text-center mb-3" id="status-pesanan">
                        <div class="col-md-3"><button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pengajuan">Status Pengajuan <span class="badge text-bg-secondary">0</span></button></div>
                        <div class=" col-md-3"><button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pembayaran">Status Pembayaran <span class="badge text-bg-secondary">0</span></button></div>
                        <div class="col-md-3"><button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-pembuatan">Status Pembuatan <span class="badge text-bg-secondary">0</span></button></div>
                        <div class=" col-md-3"><button type="button" class="btn btn-outline-primary opsi-statuspesanan" id="btn-status-selesai">Status Selesai <span class="badge text-bg-secondary">0</span></button></div>
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
                                        <p class="card-text">Update Tanggal</p>
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
                                        <p class="card-text">Update Tanggal</p>
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
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col" id="nama_barang">Informasi Klimatologi - Data Iklim 1 Bulan</div>
                                    <div class="col" id="jmlh_barang">x2</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col text-end" id="harga_barang">Rp30.000</div>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="d-flex row">
                                <div class="col text-end" id="total_harga">
                                    <p>Total Pesanan :</p> Rp30.000
                                </div>
                            </div>
                            <div class="d-flex row mt-4">
                                <div class="col" id="pagenation">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col text-end">
                                    <button class="btn btn-outline-primary ms-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btn-perbaikan" style="width:170px;">Perbaikan Dokumen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="pembayaran">
                        <div class="d-flex row status">
                            <hr id="line-pesanan">
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='check-shield' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Ajuan Diterima</div>
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='money' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibayarkan</div>
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot ">
                                        <box-icon name='receipt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibuat</div>
                                        <p class="card-text">Update Tanggal</p>
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
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col" id="nama_barang">Informasi Klimatologi - Data Iklim 1 Bulan</div>
                                    <div class="col" id="jmlh_barang">x2</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col text-end" id="harga_barang">Rp30.000</div>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="d-flex row">
                                <div class="col text-end" id="total_harga">
                                    <p>Total Pesanan :</p> Rp30.000
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" id="pagenation">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
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
                                    <span class="dot selected">
                                        <box-icon name='check-shield' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Ajuan Diterima</div>
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='money' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibayarkan</div>
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='receipt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibuat</div>
                                        <p class="card-text">Update Tanggal</p>
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
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col" id="nama_barang">Informasi Klimatologi - Data Iklim 1 Bulan</div>
                                    <div class="col" id="jmlh_barang">x2</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col text-end" id="harga_barang">Rp30.000</div>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="d-flex row">
                                <div class="col text-end" id="total_harga">
                                    <p>Total Pesanan :</p> Rp30.000
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" id="pagenation">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
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
                                    <span class="dot selected">
                                        <box-icon name='check-shield' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Ajuan Diterima</div>
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='money' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibayarkan</div>
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <span class="dot selected">
                                        <box-icon name='receipt' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                                    </span>
                                    <div class="card-body text-center">
                                        <div class="card-title">Pesanan Dibuat</div>
                                        <p class="card-text">Update Tanggal</p>
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
                                        <p class="card-text">Update Tanggal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col" id="nama_barang">Informasi Klimatologi - Data Iklim 1 Bulan</div>
                                    <div class="col" id="jmlh_barang">x2</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col text-end" id="harga_barang">Rp30.000</div>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col" id="nama_barang">Informasi Meteorologi - Data Statistik Petir 1 Bulan</div>
                                    <div class="col" id="jmlh_barang">x2</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col text-end" id="harga_barang">Rp30.000</div>
                                </div>
                                <hr class="my-3">
                            </div>
                            <div class="d-flex row">
                                <div class="col text-end" id="total_harga">
                                    <p>Total Pesanan :</p> Rp30.000
                                </div>
                            </div>
                            <div class="d-flex row mt-4">
                                <div class="col" id="pagenation">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
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
    include('../partials/modal-perbaikan-pesanan.php');
    ?>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/pesanan.js"></script>
</body>

</html>