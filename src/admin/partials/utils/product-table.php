<table class="tableData productTabel">
    <div id="actionsProduct" class="actions">
        <button class="btn btn-primary" onclick="hapus()"><i class="fas fa-edit "></i>
            Sunting</button>
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
                Produk
            </th>
            <th class="text-center" data-field="data2">
                Harga Produk
            </th>
            <th class="text-center" data-field="data3">
                Stok Produk
            </th>
            <th class="text-center" data-field="data4">
                Pemilik Produk
            </th>
            <th class="text-center" data-field="data5">
                Status Produk
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <tr class="trDataN">
            <td class="text-center">
                <input class="checkBoxData checkBoxDataProduct" type="checkbox">
            </td>
            <td class="text-center">1</td>
            <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                <div>
                    <img class="imageData" src="../assets/image/uploads/2.png" alt="Foto Admin">
                </div>
                <div class="deskriptorContainer">
                    <p class="fw-semibold m-auto">Seismon</p>
                    <p class="fw-semibold deskriptorSmall m-auto">Lorem, ipsum...
                    <div class="iconContainerData">
                        <a class="linkData" data-bs-toggle="modal" data-bs-target="#editAdmin" href="">
                            <span class="">
                                <i class=" fas fa-edit"></i>
                            </span>
                        </a>
                        <a class="linkData iconDataRight" href="">
                            <span class="">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>
                    </div>
                    </p>
                </div>
            </td>
            <td class="text-center">Rp 10.000</td>
            <td class="text-center">20</td>
            <td class="text-center">Instansi A</td>
            <td class="text-center">
                <span class="badge text-bg-success">Tersedia</span>
            </td>
        </tr>
    </tbody>
</table>