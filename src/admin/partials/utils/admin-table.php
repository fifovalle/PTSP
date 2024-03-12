<table class="tableData adminTable">
    <div id="actionsAdmin" class="actions">
        <button class="btn btn-danger" onclick="hapus()"> <i class="fas fa-trash"></i>
            Hapus</button>
    </div>
    <thead>
        <tr>
            <th id="checkBoxDataThForDrive" class="text-center">
                <input class="checkBoxData checkBoxDataAdmin" type="checkbox">
            </th>
            <th class="text-center">No</th>
            <th class="text-center" data-field="data">
                Admin
            </th>
            <th class="text-center" data-field="data2">
                Email Admin
            </th>
            <th class="text-center" data-field="data3">
                Peran Admin
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
        $peranAdmin = $_SESSION['Peran_Admin'];
        $adminModel = new Admin($koneksi);
        $dataAdmin = array();
        if ($peranAdmin == '1') {
            $dataAdmin = $adminModel->tampilkanDataAdmin();
        } else {
            $dataAdmin = $adminModel->tampilkanDataAdminOlehPeran($peranAdmin);
        }
        if (!empty($dataAdmin)) {
            function compareAdminByName($a, $b)
            {
                return strcmp($a['Nama_Pengguna_Admin'], $b['Nama_Pengguna_Admin']);
            }
            usort($dataAdmin, 'compareAdminByName');
            $nomorUrut = 1;
            foreach ($dataAdmin as $admin) {
        ?>
                <tr class="trDataN">
                    <td id="checkBoxDataTdForDrive" class="text-center">
                        <input class="checkBoxData checkBoxDataAdmin checkBoxDataAdminData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo $admin['Foto']; ?>" alt="Foto Admin">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto"><?php echo $admin['Nama_Pengguna_Admin']; ?></p>
                            <p class="fw-semibold deskriptorSmall m-auto"><?php echo $admin['Nama_Depan_Admin'] . ' ' . $admin['Nama_Belakang_Admin']; ?></p>
                            <div class="iconContainerData">
                                <a class="linkData buttonAdmin" data-id='<?php echo $admin['ID_Admin']; ?>'>
                                    <span><i class="fas fa-edit"></i></span>
                                </a>
                                <?php
                                $tombolHapus = ($_SESSION['ID'] != $admin['ID_Admin'] && $_SESSION['ID'] != $admin['ID_Admin']) ? 'confirmDeleteAdmin(' . $admin['ID_Admin'] . ');' : '';
                                ?>
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="<?php echo $tombolHapus; ?>" <?php echo ($_SESSION['ID'] == $admin['ID_Admin']) ? 'style="display: none;"' : ''; ?>>
                                    <span><i class="fas fa-trash"></i></span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?php echo $admin['Email_Admin']; ?></td>
                    <td class="text-center">
                        <?php
                        echo ($admin['Peran_Admin'] == '1') ? 'Super Admin' : (($admin['Peran_Admin'] == '2') ? 'Instansi A' : (($admin['Peran_Admin'] == '3') ? 'Instansi B' : (($admin['Peran_Admin'] == '4') ? 'Instansi C' : 'Tidak Diketahui')));
                        ?>
                    </td>
                    <td class="text-center"><?php echo $admin['No_Telepon_Admin']; ?></td>
                    <td class="text-center">
                        <?php echo ($admin['Status_Verifikasi_Admin'] == 'Terverifikasi') ? '<span class="badge text-bg-success">Terverifikasi</span>' : '<span class="badge text-bg-danger">Belum Terverifikasi</span>'; ?>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Admin!</td></tr>";
        }
        ?>
    </tbody>
</table>