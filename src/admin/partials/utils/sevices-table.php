<table class="tableData servicesTable">
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
                Jasa
            </th>
            <th class="text-center" data-field="data2">
                Harga Jasa
            </th>
            <th class="text-center" data-field="data4">
                Pemilik Jasa
            </th>
            <th class="text-center" data-field="data5">
                Kategori Jasa
            </th>
            <th class="text-center" data-field="data5">
                Status Jasa
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <?php
        $jasaModel = new jasa($koneksi);
        $dataJasa = $jasaModel->tampilkanDataJasa();

        if (!empty($dataJasa)) {
            $nomorUrut = 1;
            foreach ($dataJasa as $jasa) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataProduct checkBoxDataProductData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo $jasa['Foto_Jasa']; ?>" alt="Foto Jasa">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto"><?php echo $jasa['Nama_Jasa']; ?></p>
                            <p class="fw-semibold deskriptorSmall m-auto">
                                <?php
                                $deskripsi_jasa = $jasa['Deskripsi_Jasa'];
                                echo strlen($deskripsi_jasa) > 4 ? substr($deskripsi_jasa, 0, 4) . '...' : $deskripsi_jasa;
                                ?>
                            </p>
                            <div class="iconContainerData">
                                <a class="linkData buttonServices" data-id='<?php echo $jasa['ID_Jasa']; ?>'>
                                    <span><i class="fas fa-edit"></i></span>
                                </a>
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteServices(<?php echo $jasa['ID_Jasa']; ?>)">
                                    <span>
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">Rp <?php echo number_format($jasa['Harga_Jasa'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?php echo $jasa['Pemilik_Jasa']; ?></td>
                    <td class="text-center"><?php echo $jasa['Kategori_Jasa']; ?></td>
                    <td class="text-center">
                        <?php echo ($jasa['Status_Jasa'] == 'Tersedia') ? '<span class="badge text-bg-success">Tersedia</span>' : '<span class="badge text-bg-danger">Belum Tersedia</span>'; ?>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7' class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Produk!</td></tr>";
        }
        ?>
    </tbody>

</table>