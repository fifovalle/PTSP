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
                <form action="" method="post">
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
                </form>
                <form action="" method="post">
                    <h5 class="mt-4 mb-2">Stasiun Klimatologi
                        <span class="fs-6 text-secondary" id="guide-klimatologi"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunKlimatologi_NoPesanan_TanggalPesanan)</strong>
                        </span>
                    </h5>
                    <label for="file" class="custum-file-upload" id="btnUpload1">
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
                </form>
                <form action="" method="post">
                    <h5 class="mt-4 mb-2">Stasiun Geofisika
                        <span class=" fs-6 text-secondary" id="guide-geofisika"> <strong><i> Format File : </i>(BuktiPembayaran_StasiunGeofisika_NoPesanan_TanggalPesanan)</strong>
                        </span>
                    </h5>
                    <label for="file" class="custum-file-upload" id="btnUpload2">
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Kirim Bukti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    <?php if ($hasTransaksiA) { ?>
        document.getElementById("file").addEventListener("change", function() {
            let file = this.files[0];
            let reader = new FileReader();
            reader.onload = function(e) {
                let previewFileDiv = document.getElementById("preview-file");
                previewFileDiv.style.display = "block";
                let fileNameSpan = document.createElement("span");
                fileNameSpan.innerHTML = "<strong>" + file.name + "</strong>" + "<span class='align-middle text-end'><box-icon type='solid' name='trash'></box-icon></span>";
                previewFileDiv.innerHTML = "";
                previewFileDiv.appendChild(fileNameSpan);
                let label = document.getElementById("btnUpload");
                label.style.display = "none";
                let guide = document.getElementById("guide-meteorologi");
                guide.style.display = "none";
            };
            reader.readAsDataURL(file);
        });
    <?php } else { ?>
        document.getElementById("file").addEventListener("change", function() {
            Swal.fire({
                icon: 'error',
                title: 'Tidak Ada Transaksi di Instansi A',
                text: 'Anda tidak memiliki transaksi di Instansi A.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        });
    <?php } ?>

    <?php if ($hasTransaksiB) { ?>
        document.getElementById("file2").addEventListener("change", function() {
            let file2 = this.files[0];
            let reader2 = new FileReader();
            reader2.onload = function(e) {
                let previewFileDiv2 = document.getElementById("preview-file2");
                previewFileDiv2.style.display = "block";
                let fileNameSpan2 = document.createElement("span");
                fileNameSpan2.innerHTML = "<strong>" + file2.name + "</strong>" + "<button type="
                "><span class='align-middle'><box-icon type='solid' name='trash'></box-icon></span></button>";
                previewFileDiv2.innerHTML = "";
                previewFileDiv2.appendChild(fileNameSpan2);
                let label2 = document.getElementById("btnUpload1");
                label2.style.display = "none";
                let guide2 = document.getElementById("guide-klimatologi");
                guide2.style.display = "none";
            };
            reader2.readAsDataURL(file2);
        });
    <?php } else { ?>
        document.getElementById("file2").addEventListener("change", function() {
            Swal.fire({
                icon: 'error',
                title: 'Tidak Ada Transaksi di Instansi B',
                text: 'Anda tidak memiliki transaksi di Instansi B.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        });
    <?php } ?>

    <?php if ($hasTransaksiC) { ?>
        document.getElementById("file3").addEventListener("change", function() {
            let file3 = this.files[0];
            let reader3 = new FileReader();
            reader3.onload = function(e) {
                let previewFileDiv3 = document.getElementById("preview-file3");
                previewFileDiv3.style.display = "block";
                let fileNameSpan3 = document.createElement("span");
                fileNameSpan3.innerHTML = "<strong>" + file3.name + "</strong>" + "<span class='align-middle'><box-icon type='solid' name='trash'></box-icon></span>";
                previewFileDiv3.innerHTML = "";
                previewFileDiv3.appendChild(fileNameSpan3);
                let label3 = document.getElementById("btnUpload2");
                label3.style.display = "none";
                let guide3 = document.getElementById("guide-geofisika");
                guide3.style.display = "none";
            };
            reader3.readAsDataURL(file3);
        });
    <?php } else { ?>
        document.getElementById("file3").addEventListener("change", function() {
            Swal.fire({
                icon: 'error',
                title: 'Tidak Ada Transaksi di Instansi C',
                text: 'Anda tidak memiliki transaksi di Instansi C.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        });
    <?php } ?>
</script>