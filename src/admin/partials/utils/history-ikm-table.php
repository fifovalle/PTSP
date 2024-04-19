<table class="tableData historyIkmTable">
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
                Pengguna
            </th>
            <th class="text-center" data-field="data2">
                IKM
            </th>
            <th class="text-center" data-field="data4">
                Pendidikan Terakhir
            </th>
            <th class="text-center" data-field="data5">
                NIK
            </th>
            <th class="text-center" data-field="data5">
                Umur
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <?php
        $ikmModel = new Ikm($koneksi);
        $dataIkm = $ikmModel->tampilkanRiwayatIKM();

        if (!empty($dataIkm)) {
            $nomorUrut = 1;
            foreach ($dataIkm as $ikm) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataTransaction checkBoxDataTransactionData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto">
                                <?php
                                echo $ikm['Nama'];
                                ?>
                            </p>
                            <p class="fw-semibold deskriptorSmall m-auto">
                                <?php
                                echo $ikm['Jenis_Kelamin'];
                                ?>
                            </p>
                            <div class="iconContainerData">
                                <a class="linkData" data-bs-toggle="modal" data-bs-target="#aproveFile">
                                    <span class="">
                                        <i class="fas fa-eye"></i>
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
                    <td class="text-center"><?php echo $ikm['Informasi_Cuaca_Publik']; ?></td>
                    <td class="text-center"><?php echo $ikm['Pendidikan_Terakhir']; ?></td>
                    <td class="text-center"><?php echo $ikm['NIK']; ?></td>
                    <td class="text-center"><?php echo $ikm['Umur']; ?></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Riwayat Pengajuan!</td></tr>";
        }
        ?>
    </tbody>

</table>