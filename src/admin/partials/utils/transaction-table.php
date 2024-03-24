<table class="tableData transactionTable">
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
        $transaksiModel = new Transaksi($koneksi);
        $dataTransaksi = $transaksiModel->tampilkanTransaksi();

        if (!empty($dataTransaksi)) {
            $nomorUrut = 1;
            foreach ($dataTransaksi as $transaksi) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataTransaction checkBoxDataTransactionData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo htmlspecialchars(($transaksi['ID_Informasi'] != null) ? $transaksi['Foto_Informasi'] : (($transaksi['ID_Jasa'] != null) ? $transaksi['Foto_Jasa'] : 'nama-file-default.jpg')); ?>" alt="Foto Produk">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto">
                                <?php
                                echo ($transaksi['ID_Informasi'] != null) ? $transaksi['Nama_Informasi'] : (($transaksi['ID_Jasa'] != null) ? $transaksi['Nama_Jasa'] : 'Nama Tidak Tersedia');
                                ?>
                            </p>
                            <p class="fw-semibold deskriptorSmall m-auto">
                                <?php
                                echo ($transaksi['ID_Informasi'] != null) ? $transaksi['Deskripsi_Informasi'] : (($transaksi['ID_Jasa'] != null) ? $transaksi['Deskripsi_Jasa'] : 'Deskripsi Tidak Tersedia');
                                ?>
                            </p>
                            <div class="iconContainerData">
                                <a class="linkData" data-bs-toggle="modal" data-bs-target="#editAdmin">
                                    <span class="">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                                <a class="linkData iconDataRight">
                                    <span class="">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?php echo ($transaksi['ID_Pengguna'] != null) ? $transaksi['Nama_Pengguna'] : (($transaksi['ID_Perusahaan'] != null) ? $transaksi['Nama_Pengguna_Anggota_Perusahaan'] : 'Nama Pengguna Tidak Ada') ?></td>
                    <td class="text-center"><?php echo ($transaksi['ID_Informasi'] != null) ? 'Informasi' : (($transaksi['ID_Jasa'] != null) ? 'Jasa' : 'Tidak Diketahui') ?></td>
                    <td class="text-center"><?php echo $transaksi['Jumlah_Barang']; ?></td>
                    <td class="text-center"><?php echo $transaksi['Tanggal_Pembelian']; ?></td>
                    <td class="text-center">
                        <span class="badge <?php echo ($transaksi['Status_Transaksi'] === 'Belum Disetujui') ? 'text-bg-danger' : 'text-bg-success'; ?>">
                            <?php echo $transaksi['Status_Transaksi']; ?>
                        </span>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Transaksi!</td></tr>";
        }
        ?>
    </tbody>
</table>