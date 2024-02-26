<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sunting Pengguna</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editUserID" name="ID_Pengguna" autocomplete="off">
                    <div class="mb-3">
                        <label for="fotoEditUser" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoEditUser" name="Foto_Pengguna" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="frontNameEditUser" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Depan Pengguna" id="frontNameEditUser" name="Nama_Depan_Pengguna" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="backNameEditUser" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Belakang Pengguna" id="backNameEditUser" name="Nama_Belakang_Pengguna" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="userNameEditUser" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Pengguna" id="userNameEditUser" name="Nama_Pengguna_Pengguna" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="emailEditUser" class="form-label">Email</label>
                        <input type="email" class="form-control inputData" placeholder="Masukan Email Pengguna" id="emailEditUser" name="Email_Pengguna" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="numberEditUser" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">+62</span>
                            <input type="text" placeholder="Masukan Nomor Telepon Pengguna" class="form-control inputData" id="numberEditUser" name="No_Telepon_Pengguna" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ganderEditUser" class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin_Pengguna" id="ganderEditUser" class="form-control inputData">
                            <option value="" selected>Pilih Jenis Kelamin Pengguna</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addressEditPengguna" class="form-label">Alamat Pengguna</label>
                        <textarea name="Alamat_Pengguna" placeholder="Masukan Alamat Pengguna" class="form-control inputData addressAddAdmin" id="addressEditPengguna" autocomplete="off"></textarea>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanPengguna" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>