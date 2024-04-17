<table class="tableData historyApplymentTable">
    <div id="actionsProduct" class="actions">
        <button class="btn btn-danger" onclick="edit()"> <i class="fas fa-trash"></i>
            Hapus</button>
    </div>
    <thead>
        <tr>
            <th class="text-center">
                <input class="checkBoxData checkBoxDataProduct" type="checkbox">
            </th>
            <th class="text-center">No</th>
            <th class="text-center" data-field="data">
                Pengajuan
            </th>
            <th class="text-center" data-field="data2">
                Pengguna
            </th>
            <th class="text-center" data-field="data4">
                Keterangan Surat Yang Ditolak
            </th>
            <th class="text-center" data-field="data5">
                Tanggal Pengajuan
            </th>
            <th class="text-center" data-field="data5">
                Status Pengajuan
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <?php
        $transaksiModel = new Transaksi($koneksi);
        $dataTransaksi = $transaksiModel->tampilkanRiwayatPengajuanTransaksi();

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
                                $deskripsi = ($transaksi['ID_Informasi'] != null) ? $transaksi['Deskripsi_Informasi'] : (($transaksi['ID_Jasa'] != null) ? $transaksi['Deskripsi_Jasa'] : 'Deskripsi Tidak Tersedia');
                                echo strlen($deskripsi) > 4 ? substr($deskripsi, 0, 4) . '...' : $deskripsi;
                                ?>
                            </p>
                            <div class="iconContainerData">
                                <a class="linkData" data-bs-toggle="modal" data-bs-target="#aproveFile">
                                    <span class="">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                </a>
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteTransaction(<?php echo $transaksi['ID_Tranksaksi']; ?>)">
                                    <span>
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?php echo ($transaksi['ID_Pengguna'] != null) ? $transaksi['Nama_Pengguna'] : (($transaksi['ID_Perusahaan'] != null) ? $transaksi['Nama_Pengguna_Anggota_Perusahaan'] : 'Nama Pengguna Tidak Ada') ?></td>
                    <td class="text-center">
                        <?php
                        echo $transaksi['Keterangan_Surat_Ditolak'] !== NULL ? $transaksi['Keterangan_Surat_Ditolak'] : "Tidak ada surat yang ditolak";
                        ?>
                    </td>
                    <td class="text-center"><?php echo $transaksi['Tanggal_Pengajuan']; ?></td>
                    <td class="text-center">
                        <span class="badge <?php echo ($transaksi['Status_Pengajuan'] === 'Diterima') ? 'text-bg-success' : 'text-bg-danger'; ?>">
                            <?php echo $transaksi['Status_Pengajuan']; ?>
                        </span>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Riwayat Pengajuan!</td></tr>";
        }
        ?>
    </tbody>

</table>