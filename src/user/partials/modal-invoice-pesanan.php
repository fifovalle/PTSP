<div class="modal fade" id="invoicePesanan" tabindex="-1" aria-labelledby="invoicePesananLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="box-perbaikan">
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
            <div class="modal-body">
                <h4 class="mb-4">INFORMASI PESANAN</h4>
                <?php
                $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                $transaksiPembeliModel = new Transaksi($koneksi);
                $dataTransaksiPembeli = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceA($idPembeli);
                $nomorUrut = 1;
                if (!empty($dataTransaksiPembeli)) {
                ?>
                    <h6 class="fw-bold mt-4">PENERIMA INSTANSI A</h6>
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
                            <?php foreach ($dataTransaksiPembeli as $transaksi) { ?>
                                <tr>
                                    <td class="produk ps-3">
                                        <?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?>
                                    </td>
                                    <td class="rekening ps-3">
                                        <?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?>
                                    </td>
                                    <td class="harga ps-3">
                                        Rp <?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?>
                                    </td>
                                    <td class="jumlah ps-3">
                                        <?php echo $transaksi['Jumlah_Barang']; ?>
                                    </td>
                                    <td class="total ps-3">
                                        Rp <?php echo number_format(($transaksi['Total_Transaksi']), 0, ',', '.'); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <?php
                $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                $transaksiPembeliModel = new Transaksi($koneksi);
                $dataTransaksiPembeli = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceB($idPembeli);
                $nomorUrut = 1;
                if (!empty($dataTransaksiPembeli)) {
                ?>
                    <h6 class="fw-bold mt-4">PENERIMA INSTANSI B</h6>
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
                            <?php foreach ($dataTransaksiPembeli as $transaksi) { ?>
                                <tr>
                                    <td class="produk ps-3">
                                        <?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?>
                                    </td>
                                    <td class="rekening ps-3">
                                        <?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?>
                                    </td>
                                    <td class="harga ps-3">
                                        Rp <?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?>
                                    </td>
                                    <td class="jumlah ps-3">
                                        <?php echo $transaksi['Jumlah_Barang']; ?>
                                    </td>
                                    <td class="total ps-3">
                                        Rp <?php echo number_format(($transaksi['Total_Transaksi']), 0, ',', '.'); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <?php
                $idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
                $transaksiPembeliModel = new Transaksi($koneksi);
                $dataTransaksiPembeli = $transaksiPembeliModel->tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceC($idPembeli);
                $nomorUrut = 1;
                if (!empty($dataTransaksiPembeli)) {
                ?>
                    <h6 class="fw-bold mt-4">PENERIMA INSTANSI C</h6>
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
                            <?php foreach ($dataTransaksiPembeli as $transaksi) { ?>
                                <tr>
                                    <td class="produk ps-3">
                                        <?php echo $transaksi['Nama_Informasi'] ?? $transaksi['Nama_Jasa']; ?>
                                    </td>
                                    <td class="rekening ps-3">
                                        <?php echo $transaksi['No_Rekening_Informasi'] ?? $transaksi['No_Rekening_Jasa']; ?>
                                    </td>
                                    <td class="harga ps-3">
                                        Rp <?php echo number_format(($transaksi['Harga_Informasi'] ?? $transaksi['Harga_Jasa']), 0, ',', '.'); ?>
                                    </td>
                                    <td class="jumlah ps-3">
                                        <?php echo $transaksi['Jumlah_Barang']; ?>
                                    </td>
                                    <td class="total ps-3">
                                        Rp <?php echo number_format(($transaksi['Total_Transaksi']), 0, ',', '.'); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>