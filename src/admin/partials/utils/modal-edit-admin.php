<div class="modal fade" id="editAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sunting Admin</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editAdminID" name="ID_Admin" autocomplete="off">
                    <div class="mb-3">
                        <label for="fotoEditAdmin" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoEditAdmin" name="Foto_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="frontNameEditAdmin" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Depan Admin" id="frontNameEditAdmin" name="Nama_Depan_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="backNameEditAdmin" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Belakang Admin" id="backNameEditAdmin" name="Nama_Belakang_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="userNameEditAdmin" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Pengguna Admin" id="userNameEditAdmin" name="Nama_Pengguna_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="emailEditAdmin" class="form-label">Email</label>
                        <input type="email" class="form-control inputData" placeholder="Masukan Email Admin" id="emailEditAdmin" name="Email_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="numberEditAdmin" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">+62</span>
                            <input type="text" placeholder="Masukan Nomor Telepon Admin" class="form-control inputData" id="numberEditAdmin" name="No_Telepon_Admin" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ganderEditAdmin" class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin_Admin" id="ganderEditAdmin" class="form-control inputData">
                            <option value="" selected>Pilih Jenis Kelamin Admin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3 isAdminActive">
                        <label for="roleEditAdmin" class="form-label">Peran Admin</label>
                        <select name="Peran_Admin" id="roleEditAdmin" class="form-control inputData">
                            <option value="1">Super Admin</option>
                            <option value="2">Instansi A</option>
                            <option value="3">Instansi B</option>
                            <option value="4">Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addressEditAdmin" class="form-label">Alamat Admin</label>
                        <textarea name="Alamat_Admin" placeholder="Masukan Alamat Admin" class="form-control inputData addressAddAdmin" id="addressEditAdmin" autocomplete="off"></textarea>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanAdmin" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>