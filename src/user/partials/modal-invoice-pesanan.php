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
                            <div class="col-md-12 mt-3 status-invoice">
                                <span><strong class="">Status Pesanan : Belum Lunas</strong></span>
                            </div>
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
                <?php if (isset($transaksi['Keterangan_Pembayaran_Ditolak']) && !empty($transaksi['Keterangan_Pembayaran_Ditolak'])) : ?>
                    <div class="col-md-12 text-start">
                        <div class="alert alert-danger text-danger fw-bold" role="alert">
                            <div class="d-flex col-md-12 mb-0">
                                <span class="align-middle me-3"><box-icon name='message-error' color='rgba(176, 42, 55, 0.9)'></box-icon></span>
                                <span class="align-middle m-0"><strong>PERBAIKAN TERHADAP DOKUMEN</strong></span>
                            </div>
                            <hr>
                            <p class="text-dark">
                                <?php echo $transaksi['Keterangan_Pembayaran_Ditolak']; ?>
                            </p>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-md-12" style="display: none;"></div>
                <?php endif; ?>
                <?php if ($hasTransaksiA && !$hasTransaksiB && !$hasTransaksiC) { ?>
                    <form action="../../admin/config/upload-payment.php" method="post" enctype="multipart/form-data">
                        <h5 class="mb-2">Stasiun Meteorologi
                            <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                            </span>
                        </h5>
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
                    <?php } else if (!$hasTransaksiA && $hasTransaksiB && !$hasTransaksiC) { ?>
                        <form action="../../admin/config/upload-payment.php" method="post" enctype="multipart/form-data">
                            <h5 class="mt-4 mb-2">Stasiun Klimatologi
                                <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                                </span>
                            </h5>
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
                                <input id="file2" type="file">
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
                        <?php } else if (!$hasTransaksiA && !$hasTransaksiB && $hasTransaksiC) { ?>
                            <form action="../../admin/config/upload-payment.php" method="post" enctype="multipart/form-data">
                                <h5 class="mt-4 mb-2">Stasiun Geofisika
                                    <span class=" fs-6 text-secondary" id="guide-geofisika"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunGeofisika_NoPesanan_TanggalPesanan)</strong>
                                    </span>
                                </h5>
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
                                    <input id="file3" type="file">
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
                            <?php } else if ($hasTransaksiA && $hasTransaksiB && !$hasTransaksiC) { ?>
                                <form action="../../admin/config/upload-payment.php" method="post" enctype="multipart/form-data">
                                    <h5 class="mb-2">Stasiun Meteorologi
                                        <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                                        </span>
                                    </h5>
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
                                        <input id="file" type="file">
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
                                        <input id="file2" type="file">
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
                                <?php } else if ($hasTransaksiA && !$hasTransaksiB && $hasTransaksiC) { ?>
                                    <form action="../../admin/config/upload-payment.php" method="post" enctype="multipart/form-data">
                                        <h5 class="mb-2">Stasiun Meteorologi
                                            <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                                            </span>
                                        </h5>
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
                                            <input id="file" type="file">
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
                                            <input id="file3" type="file">
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
                                    <?php } else if (!$hasTransaksiA && $hasTransaksiB && $hasTransaksiC) { ?>
                                        <form action="../../admin/config/upload-payment.php" method="post" enctype="multipart/form-data">
                                            <h5 class="mt-4 mb-2">Stasiun Klimatologi
                                                <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                                                </span>
                                            </h5>
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
                                                <input id="file2" type="file">
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
                                                <input id="file3" type="file">
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
                                        <?php } else if ($hasTransaksiA && $hasTransaksiB && $hasTransaksiC) { ?>
                                            <form action="../../admin/config/upload-payment.php" method="post" enctype="multipart/form-data">
                                                <h5 class="mb-2">Stasiun Meteorologi
                                                    <span class="fs-6 text-secondary" id="guide-meteorologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunMeteorologi_NoPesanan_TanggalPesanan)</strong>
                                                    </span>
                                                </h5>
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
                                            <?php } else { ?>
                                                <p class="fw-bold text-danger text-center">TIDAK ADA TRANSAKSI!</p>
                                            <?php } ?>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-outline-primary" name="Kirim">Kirim Bukti</button>
                                            </div>
                                            </form>
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