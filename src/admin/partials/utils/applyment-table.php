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
                Jenis Transaksi
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
            $groupedData = [];
            foreach ($dataPengajuan as $pengajuan) {
                $groupedData[$pengajuan['ID_Pengajuan']][] = $pengajuan;
            }

            $nomorUrut = 1;
            foreach ($groupedData as $idPengajuan => $pengajuanGroup) {
        ?>
                <tr class="trDataN">
                    <td class="text-center" rowspan="<?php echo count($pengajuanGroup); ?>">
                        <input class="checkBoxData checkBoxDataTransaction checkBoxDataTransactionData" type="checkbox">
                    </td>
                    <td class="text-center" rowspan="<?php echo count($pengajuanGroup); ?>">
                        <?php echo $nomorUrut++; ?>
                    </td>
                    <?php foreach ($pengajuanGroup as $index => $pengajuan) { ?>
                        <?php if ($index > 0) echo '<tr class="trDataN">'; ?>
                        <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                            <div>
                                <img class="imageData" src="../assets/image/uploads/<?php echo htmlspecialchars(($pengajuan['ID_Informasi'] != null) ? $pengajuan['Foto_Informasi'] : (($pengajuan['ID_Jasa'] != null) ? $pengajuan['Foto_Jasa'] : 'nama-file-default.jpg')); ?>" alt="Foto Produk">
                            </div>
                            <div class="deskriptorContainer">
                                <p class="fw-semibold m-auto">
                                    <?php
                                    $namaPengajuan = ($pengajuan['ID_Informasi'] != null) ? $pengajuan['Nama_Informasi'] : (($pengajuan['ID_Jasa'] != null) ? $pengajuan['Nama_Jasa'] : 'Nama Tidak Tersedia');
                                    echo strlen($namaPengajuan) > 6 ? substr($namaPengajuan, 0, 6) . '...' : $namaPengajuan;
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
                            echo !empty($pengajuan['Keterangan_Surat_Ditolak']) ? $pengajuan['Keterangan_Surat_Ditolak'] : "Jika ada surat yang ditolak silahkan untuk diunggah";
                            ?>
                        </td>
                        <td class="text-center"><?php echo $pengajuan['Tanggal_Pengajuan']; ?></td>
                        <td class="text-center">
                            <span class=" badge <?php echo ($pengajuan['Apakah_Gratis'] === '1') ? 'text-bg-info' : 'text-bg-info'; ?>">
                                <?php echo ($pengajuan['Apakah_Gratis'] === '1') ? 'Bayar' : 'Gratis'; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge <?php echo ($pengajuan['Status_Pengajuan'] === 'Sedang Ditinjau') ? 'text-bg-warning' : 'text-bg-danger'; ?>">
                                <?php echo $pengajuan['Status_Pengajuan']; ?>
                            </span>
                        </td>
                        <?php if ($index < count($pengajuanGroup) - 1) echo '</tr>'; ?>
                    <?php } ?>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Pengajuan!</td></tr>";
        }
        ?>
    </tbody>
</table>