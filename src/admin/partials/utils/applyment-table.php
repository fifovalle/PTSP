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
        $pengajuanModel = new Pengajuan($koneksi);
        $dataPengajuan = $pengajuanModel->tampilkanDataPengajuan();

        if (!empty($dataPengajuan)) {
            $nomorUrut = 1;
            foreach ($dataPengajuan as $pengajuan) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataProduct checkBoxDataProductData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo $pengajuan['Surat_Pengantar_Permintaan_Data_Bencana'] ?? $pengajuan['Surat_Yang_Ditandatangani_Sosial'] ?? $pengajuan['Surat_Yang_Ditandatangani_Keagamaan'] ?? $pengajuan['Surat_Yang_Ditandatangani_Pertahanan'] ?? $pengajuan['Surat_Pengantar_Kepsek_Rektor_Dekan']; ?>" alt="Foto">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto"><?php echo $pengajuan['Nama_Bencana'] ?? $pengajuan['Nama_Sosial'] ?? $pengajuan['Nama_Keagamaan'] ?? $pengajuan['Nama_Pertahanan'] ?? $pengajuan['Nama_Pendidikan_Dan_Penelitian']; ?></p>
                            <p class="fw-semibold deskriptorSmall m-auto">
                                <?php
                                $no_telepon = $pengajuan['No_Telepon_Bencana'] ?? $pengajuan['No_Telepon_Sosial'] ?? $pengajuan['No_Telepon_Keagamaan'] ?? $pengajuan['No_Telepon_Pertahanan'] ?? $pengajuan['No_Telepon_Pendidikan_Penelitian'];
                                echo strlen($no_telepon) > 4 ? substr($no_telepon, 0, 4) . '...' : $no_telepon;
                                ?>
                            </p>
                            <div class="iconContainerData">
                                <a class="linkData buttonServices" data-id='<?php echo $pengajuan['ID_Pengajuan']; ?>'>
                                    <span><i class="fas fa-edit"></i></span>
                                </a>
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteServices(<?php echo $pengajuan['ID_Pengajuan']; ?>)">
                                    <span>
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?php echo $pengajuan['Nama_Pengguna'] ? $pengajuan['Nama_Pengguna'] : $pengajuan['Nama_Perusahaan']; ?></td>
                    <td class="text-center"><?php echo $pengajuan['Keterangan_Surat_Ditolak']; ?></td>
                    <td class="text-center"><?php echo $pengajuan['Tanggal_Pengajuan']; ?></td>
                    <td class="text-center">
                        <?php echo ($pengajuan['Status_Pengajuan'] == 'Sedang Ditinjau') ? '<span class="badge text-bg-warning text-white">Sedang Ditinjau</span>' : '<span class="badge text-bg-danger">Ditolak</span>'; ?>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Pengajuan!</td></tr>";
        }
        ?>
    </tbody>

</table>