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
            <th class="text-center" data-field="data3">
                Jenis Jasa
            </th>
            <th class="text-center" data-field="data4">
                Pemilik Jasa
            </th>
            <th class="text-center" data-field="data5">
                Status Jasa
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <?php
        $produkModel = new Produk($koneksi);
        $dataProduk = $produkModel->tampilkanDataProduk();

        if (!empty($dataProduk)) {
            $nomorUrut = 1;
            foreach ($dataProduk as $produk) {
        ?>
                <tr class="trDataN">
                    <td class="text-center">
                        <input class="checkBoxData checkBoxDataProduct checkBoxDataProductData" type="checkbox">
                    </td>
                    <td class="text-center"><?php echo $nomorUrut++; ?></td>
                    <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                        <div>
                            <img class="imageData" src="../assets/image/uploads/<?php echo $produk['Foto_Produk']; ?>" alt="Foto Produk">
                        </div>
                        <div class="deskriptorContainer">
                            <p class="fw-semibold m-auto"><?php echo $produk['Nama_Produk']; ?></p>
                            <p class="fw-semibold deskriptorSmall m-auto"><?php echo $produk['Deskripsi_Produk']; ?></p>
                            <div class="iconContainerData">
                                <a class="linkData buttonProduk" data-id='<?php echo $produk['ID_Produk']; ?>'>
                                    <span><i class="fas fa-edit"></i></span>
                                </a>
                                <a class="linkData iconDataRight" href="javascript:void(0);" onclick="confirmDeleteProduct(<?php echo $produk['ID_Produk']; ?>)">
                                    <span>
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">Rp <?php echo number_format($produk['Harga_Produk'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?php echo $produk['Stok_Produk']; ?></td>
                    <td class="text-center"><?php echo $produk['Pemilik_Produk']; ?></td>
                    <td class="text-center">
                        <?php
                        echo ($produk['Status_Produk'] == 1) ? '<span class="badge text-bg-success">Tersedia</span>' : '<span class="badge text-bg-danger">Tidak Tersedia</span>';
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