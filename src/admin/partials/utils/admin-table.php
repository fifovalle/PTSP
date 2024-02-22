<table class="tableData adminTable">
    <div id="actionsAdmin" class="actions">
        <button class="btn btn-primary" onclick="hapus()"><i class="fas fa-edit "></i>
            Sunting</button>
        <button class="btn btn-danger" onclick="edit()"> <i class="fas fa-trash"></i>
            Hapus</button>
    </div>
    <thead>
        <tr>
            <th class="text-center">
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
        <tr class="trDataN">
            <td class="text-center">
                <input class="checkBoxData checkBoxDataAdmin" type="checkbox">
            </td>
            <td class="text-center">1</td>
            <td class="text-center flex-wrap d-flex justify-content-evenly gap-2">
                <div>
                    <img class="imageData" src="../assets/image/uploads/1.jpg" alt="Foto Admin">
                </div>
                <div class="deskriptorContainer">
                    <p class="fw-semibold m-auto">zonaDeveloper</p>
                    <p class="fw-semibold deskriptorSmall m-auto">Naufal FIFA
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
            <td class="text-center">Naufal@gmail.com</td>
            <td class="text-center">Super Admin</td>
            <td class="text-center">+62 812-3456-789</td>
            <td class="text-center">
                <span class="badge text-bg-success">Terverifikasi</span>
            </td>
        </tr>
    </tbody>
</table>