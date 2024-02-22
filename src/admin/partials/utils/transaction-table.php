<table class="tableData transactionTable">
    <div id="actionsTransaction" class="actions">
        <button class="btn btn-primary" onclick="hapus()"><i class="fas fa-edit "></i>
            Sunting</button>
        <button class="btn btn-danger" onclick="edit()"> <i class="fas fa-trash"></i>
            Hapus</button>
    </div>
    <thead>
        <tr>
            <th class="text-center">
                <input class="checkBoxData checkBoxDataTransaction" type="checkbox">
            </th>
            <th class="text-center">No</th>
            <th class="text-center" data-field="data">
                Produk
            </th>
            <th class="text-center" data-field="data2">
                Pengguna
            </th>
            <th class="text-center" data-field="data3">
                Jumlah Produk
            </th>
            <th class="text-center" data-field="data4">
                Tanggal Pembelian
            </th>
            <th class="text-center" data-field="data5">
                Status Transaksi
            </th>
        </tr>
    </thead>
    <tbody class="tbodyData">
        <tr class="trDataN">
            <td class="text-center">
                <input class="checkBoxData checkBoxDataTransaction" type="checkbox">
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
                        <a class="linkData" data-bs-toggle="modal" data-bs-target="#editAdmin">
                            <span class="">
                                <i class=" fas fa-edit"></i>
                            </span>
                        </a>
                        <a class="linkData iconDataRight">
                            <span class="">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>
                    </div>
                    </p>
                </div>
            </td>
            <td class="text-center">Ahsan Ghifari</td>
            <td class="text-center">10</td>
            <td class="text-center">10/09/2024</td>
            <td class="text-center">
                <span class="badge text-bg-danger">Belum Di Setujui</span>
            </td>
        </tr>
    </tbody>
</table>