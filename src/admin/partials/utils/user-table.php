<table class="tableData userTable">
    <div id="actionsUser" class="actions">
        <button class="btn btn-danger" onclick="hapus()"> <i class="fas fa-trash"></i>
            Hapus</button>
    </div>
    <thead>
        <tr>
            <th class="text-center">
                <input class="checkBoxData checkBoxDataUser" type="checkbox">
            </th>
            <th class="text-center">No</th>
            <th class="text-center" data-field="data">
                Pengguna
            </th>
            <th class="text-center" data-field="data2">
                Email Pengguna
            </th>
            <th class="text-center" data-field="data3">
                Jenis Kelamin
            </th>
            <th class="text-center" data-field="data4">
                No Telp
            </th>
            <th class="text-center" data-field="data5">
                Status Verifikasi
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <?php
        $penggunaModel = new Pengguna($koneksi);
        $dataPengguna = $penggunaModel->tampilkanDataPengguna();
        $dataPerusahaan = $penggunaModel->tampilkanDataPerusahaan();
        if ($dataPengguna !== null && $dataPerusahaan !== null) {
            $dataGabungan = array_merge($dataPengguna, $dataPerusahaan);
            function compareByName($a, $b)
            {
                return strcmp($a['Nama_Pengguna'] ?? $a['Nama_Perusahaan'], $b['Nama_Pengguna'] ?? $b['Nama_Perusahaan']);
            }
            usort($dataGabungan, 'compareByName');
            $nomorUrut = 1;
            if (!empty($dataGabungan)) {
                foreach ($dataGabungan as $data) {
        ?>
                    <tr class="trDataN">
                        <td class="text-center">
                            <input class="checkBoxData checkBoxDataUser checkBoxDataUserData" type="checkbox">
                        </td>
                        <td class="text-center"><?php echo $nomorUrut++; ?></td>
                        <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                            <div>
                                <img class="imageData" src="../assets/image/uploads/<?php echo $data['Foto']; ?>" alt="Foto Pengguna">
                            </div>
                            <div class="deskriptorContainer">
                                <p class="fw-semibold m-auto"><?php echo $data['Nama_Pengguna'] ?? $data['Nama_Perusahaan']; ?></p>
                                <?php if (isset($data['Nama_Depan_Pengguna'])) : ?>
                                    <p class="fw-semibold deskriptorSmall m-auto"><?php echo $data['Nama_Depan_Pengguna'] . ' ' . $data['Nama_Belakang_Pengguna']; ?></p>
                                <?php else : ?>
                                    <p class="fw-semibold deskriptorSmall m-auto"><?php echo $data['Nama_Perusahaan']; ?></p>
                                <?php endif; ?>
                                <div class="iconContainerData">
                                    <a class="linkData buttonUser" data-id='<?php echo $data['ID_Pengguna'] ?? $data['ID_Perusahaan']; ?>'>
                                        <span><i class="fas fa-edit"></i></span>
                                    </a>
                                    <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteUser(<?php echo $data['ID_Pengguna'] ?? $data['ID_Perusahaan']; ?>)">
                                        <span><i class="fas fa-trash"></i></span>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><?php echo htmlspecialchars($data['Email_Pengguna'] ?? $data['Email_Perusahaan']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($data['Jenis_Kelamin_Pengguna'] ?? ''); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($data['No_Telepon_Pengguna'] ?? ''); ?></td>
                        <td class="text-center">
                            <?php
                            if (isset($data['Status_Verifikasi_Pengguna'])) {
                                echo ($data['Status_Verifikasi_Pengguna'] == 'Terverifikasi') ? '<span class="badge text-bg-success">Terverifikasi</span>' : '<span class="badge text-bg-danger">Belum Terverifikasi</span>';
                            } else {
                                echo '<span class="badge text-bg-secondary">Status Tidak Tersedia</span>';
                            }
                            ?>
                        </td>
                    </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Pengguna atau Perusahaan!</td></tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak ada data pengguna atau data perusahaan!</td></tr>";
        }
        ?>
    </tbody>

</table>