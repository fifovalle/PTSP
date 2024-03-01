<table class="tableData informationTable">
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
                Informasi
            </th>
            <th class="text-center" data-field="data2">
                Harga Informasi
            </th>
            <th class="text-center" data-field="data3">
                Jenis Informasi
            </th>
            <th class="text-center" data-field="data4">
                Pemilik Informasi
            </th>
            <th class="text-center" data-field="data5">
                Kategori Informasi
            </th>
            <th class="text-center" data-field="data5">
                Status Informasi
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <?php
        $informasiModel = new Informasi($koneksi);
        $dataInformasi = $informasiModel->tampilkanDataInformasi();

        if (!empty($dataInformasi)) {
            $nomorUrut = 1;
            foreach ($dataInformasi as $informasi) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataProduct checkBoxDataProductData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo $informasi['Foto_Informasi']; ?>" alt="Foto Jasa">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto"><?php echo $informasi['Nama_Informasi']; ?></p>
                            <p class="fw-semibold deskriptorSmall m-auto"><?php echo $informasi['Deskripsi_Informasi']; ?></p>
                            <div class="iconContainerData">
                                <a class="linkData buttonProduk" data-id='<?php echo $informasi['ID_Informasi']; ?>'>
                                    <span><i class="fas fa-edit"></i></span>
                                </a>
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteProduct(<?php echo $informasi['ID_Informasi']; ?>)">
                                    <span>
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">Rp <?php echo number_format($informasi['Harga_Informasi'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?php echo $informasi['Stok_Informasi']; ?></td>
                    <td class="text-center"><?php echo $informasi['Pemilik_Informasi']; ?></td>
                    <td class="text-center"><?php echo $informasi['Kategori_Informasi']; ?></td>
                    <td class="text-center">
                        <?php
                        echo ($informasi['Status_Informasi'] == 1) ? '<span class="badge text-bg-success">Tersedia</span>' : '<span class="badge text-bg-danger">Tidak Tersedia</span>';
                        ?>
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