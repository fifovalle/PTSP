<table class="tableData userTable">
    <div id="actionsUser" class="actions">
        <button class="btn btn-primary" onclick="edit()"><i class="fas fa-edit "></i>
            Sunting</button>
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
        if (!empty($dataPengguna)) {
            function comparePenggunaByName($a, $b)
            {
                return strcmp($a['Nama_Pengguna'], $b['Nama_Pengguna']);
            }
            usort($dataPengguna, 'comparePenggunaByName');
            $nomorUrut = 1;
            foreach ($dataPengguna as $pengguna) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataUser" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="<?php echo $pengguna['Foto']; ?>" alt="Foto Pengguna">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto"><?php echo $pengguna['Nama_Pengguna']; ?></p>
                            <p class="fw-semibold deskriptorSmall m-auto"><?php echo $pengguna['Nama_Depan_Pengguna'] . ' ' . $pengguna['Nama_Belakang_Pengguna']; ?></p>
                            <div class="iconContainerData">
                                <a class="linkData buttonUser" data-id='<?php echo $pengguna['ID_Pengguna']; ?>'>
                                    <span><i class="fas fa-edit"></i></span>
                                </a>
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteUser(<?php echo $pengguna['ID_Pengguna']; ?>)">
                                    <span><i class="fas fa-trash"></i></span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?php echo $pengguna['Email_Pengguna']; ?></td>
                    <td class="text-center"><?php echo $pengguna['Jenis_Kelamin_Pengguna']; ?></td>
                    <td class="text-center"><?php echo $pengguna['No_Telepon_Pengguna']; ?></td>
                    <td class="text-center">
                        <?php echo ($pengguna['Status_Verifikasi_Pengguna'] == 1) ? '<span class="badge text-bg-success">Terverifikasi</span>' : '<span class="badge text-bg-danger">Belum Terverifikasi</span>'; ?>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Pengguna!</td></tr>";
        }
        ?>
    </tbody>
</table>