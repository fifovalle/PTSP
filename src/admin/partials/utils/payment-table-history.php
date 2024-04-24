<table class="tableData paymentTableHistory">
    <div id="actionsTransaction" class="actions">
        <button class="btn btn-danger" onclick="edit()"> <i class="fas fa-trash"></i>
            Hapus</button>
    </div>
    <thead>
        <tr>
            <th class="text-center">
                <input class="checkBoxData checkBoxDataTransaction" type="checkbox">
            </th>
            <th class="text-center">No</th>
            <th class="text-center" data-field="data">
                Produk
            </th>
            <th class="text-center" data-field="data2">
                Pengguna
            </th>
            <th class="text-center" data-field="data2">
                Jenis Produk
            </th>
            <th class="text-center" data-field="data3">
                Jumlah Produk
            </th>
            <th class="text-center" data-field="data4">
                Tanggal Pembelian
            </th>
            <th class="text-center" data-field="data5">
                Status Transaksi
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <?php
        $riwayatTransaksiModel = new Transaksi($koneksi);
        $dataRiwayatTransaksi = $riwayatTransaksiModel->tampilkanRiwayatTransaksi();

        if (!empty($dataRiwayatTransaksi)) {
            $nomorUrut = 1;
            foreach ($dataRiwayatTransaksi as $riwayatTransaksi) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataTransaction checkBoxDataTransactionData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo htmlspecialchars(($riwayatTransaksi['ID_Informasi'] != null) ? $riwayatTransaksi['Foto_Informasi'] : (($riwayatTransaksi['ID_Jasa'] != null) ? $riwayatTransaksi['Foto_Jasa'] : 'nama-file-default.jpg')); ?>" alt="Foto Produk">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto">
                                <?php
                                echo ($riwayatTransaksi['ID_Informasi'] != null) ? $riwayatTransaksi['Nama_Informasi'] : (($riwayatTransaksi['ID_Jasa'] != null) ? $riwayatTransaksi['Nama_Jasa'] : 'Nama Tidak Tersedia');
                                ?>
                            </p>
                            <p class="fw-semibold deskriptorSmall m-auto">
                                <?php
                                echo ($riwayatTransaksi['ID_Informasi'] != null) ? $riwayatTransaksi['Deskripsi_Informasi'] : (($riwayatTransaksi['ID_Jasa'] != null) ? $riwayatTransaksi['Deskripsi_Jasa'] : 'Deskripsi Tidak Tersedia');
                                ?>
                            </p>
                            <div class="iconContainerData">
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteHistoryTransaction(<?php echo $riwayatTransaksi['ID_Tranksaksi']; ?>)">
                                    <span>
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?php echo ($riwayatTransaksi['ID_Pengguna'] != null) ? $riwayatTransaksi['Nama_Pengguna'] : (($riwayatTransaksi['ID_Perusahaan'] != null) ? $riwayatTransaksi['Nama_Pengguna_Anggota_Perusahaan'] : 'Nama Pengguna Tidak Ada') ?></td>
                    <td class="text-center"><?php echo ($riwayatTransaksi['ID_Informasi'] != null) ? 'Informasi' : (($riwayatTransaksi['ID_Jasa'] != null) ? 'Jasa' : 'Tidak Diketahui') ?></td>
                    <td class="text-center"><?php echo $riwayatTransaksi['Jumlah_Barang']; ?></td>
                    <td class="text-center"><?php echo $riwayatTransaksi['Tanggal_Pembelian']; ?></td>
                    <td class="text-center">
                        <span class="badge <?php echo ($riwayatTransaksi['Status_Transaksi'] === 'Belum Disetujui') ? 'text-bg-danger' : 'text-bg-success'; ?>">
                            <?php echo $riwayatTransaksi['Status_Transaksi']; ?>
                        </span>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Riwayat Pembayaran!</td></tr>";
        }
        ?>
    </tbody>
</table>