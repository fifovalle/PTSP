<table class="tableData applymentTable">
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
        $dataPengajuan = $transaksiModel->tampilkanPengajuanTransaksi();

        if (!empty($dataPengajuan)) {
            $nomorUrut = 1;
            foreach ($dataPengajuan as $pengajuan) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataTransaction checkBoxDataTransactionData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo htmlspecialchars(($pengajuan['ID_Informasi'] != null) ? $pengajuan['Foto_Informasi'] : (($pengajuan['ID_Jasa'] != null) ? $pengajuan['Foto_Jasa'] : 'nama-file-default.jpg')); ?>" alt="Foto Produk">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto">
                                <?php
                                echo ($pengajuan['ID_Informasi'] != null) ? $pengajuan['Nama_Informasi'] : (($pengajuan['ID_Jasa'] != null) ? $pengajuan['Nama_Jasa'] : 'Nama Tidak Tersedia');
                                ?>
                            </p>
                            <p class="fw-semibold deskriptorSmall m-auto">
                                <?php
                                $deskripsi = ($pengajuan['ID_Informasi'] != null) ? $pengajuan['Deskripsi_Informasi'] : (($pengajuan['ID_Jasa'] != null) ? $pengajuan['Deskripsi_Jasa'] : 'Deskripsi Tidak Tersedia');
                                echo strlen($deskripsi) > 4 ? substr($deskripsi, 0, 4) . '...' : $deskripsi;
                                ?>
                            </p>
                            <div class="iconContainerData">
                                <a class="linkData buttonApplyment" data-bs-toggle="modal" data-id="<?php echo $pengajuan['ID_Pengajuan']; ?>">
                                    <span class="">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                </a>
                                <a class="linkData iconDataRight buttonSeeApplyment" data-bs-toggle="modal" data-id="<?php echo $pengajuan['ID_Pengajuan']; ?>">
                                    <span>
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?php echo ($pengajuan['ID_Pengguna'] != null) ? $pengajuan['Nama_Pengguna'] : (($pengajuan['ID_Perusahaan'] != null) ? $pengajuan['Nama_Pengguna_Anggota_Perusahaan'] : 'Nama Pengguna Tidak Ada') ?></td>
                    <td class="text-center">
                        <?php
                        echo $pengajuan['Keterangan_Surat_Ditolak'] !== NULL ? $pengajuan['Keterangan_Surat_Ditolak'] : "Jika ada surat yang ditolak silahkan untuk diunggah";
                        ?>
                    </td>
                    <td class="text-center"><?php echo $pengajuan['Tanggal_Pengajuan']; ?></td>
                    <td class="text-center">
                        <span class="badge <?php echo ($pengajuan['Status_Pengajuan'] === 'Sedang Ditinjau') ? 'text-bg-warning' : 'text-bg-success'; ?>">
                            <?php echo $pengajuan['Status_Pengajuan']; ?>
                        </span>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Pengajuan!</td></tr>";
        }
        ?>
    </tbody>

</table>