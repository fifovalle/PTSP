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
                    <input type="hidden" id="editAdminID" name="ID_Admin" autocomplete="off" value="<?php echo htmlspecialchars($id_admin); ?>">
                    <div class="mb-3">
                        <label for="fotoEditAdmin" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoEditAdmin" name="Foto_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="frontNameEditAdmin" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Depan Admin" id="frontNameEditAdmin" name="Nama_Depan_Admin" autocomplete="off" value="<?php echo htmlspecialchars($nama_depan_admin); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="backNameEditAdmin" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Belakang Admin" id="backNameEditAdmin" name="Nama_Belakang_Admin" autocomplete="off" value="<?php echo htmlspecialchars($nama_belakang_admin); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="userNameEditAdmin" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Pengguna Admin" id="userNameEditAdmin" name="Nama_Pengguna_Admin" autocomplete="off" value="<?php echo htmlspecialchars($nama_pengguna_admin); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="emailEditAdmin" class="form-label">Email</label>
                        <input type="email" class="form-control inputData" placeholder="Masukan Email Admin" id="emailEditAdmin" name="Email_Admin" autocomplete="off" value="<?php echo htmlspecialchars($email_admin); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="numberEditAdmin" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">+62</span>
                            <input type="text" placeholder="Masukan Nomor Telepon Admin" class="form-control inputData" id="numberEditAdmin" name="No_Telepon_Admin" autocomplete="off" value="<?php echo htmlspecialchars($no_telepon_admin); ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ganderEditAdmin" class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin_Admin" id="ganderEditAdmin" class="form-control inputData">
                            <option value="" <?php if (isset($_POST['Jenis_Kelamin_Admin']) && $_POST['Jenis_Kelamin_Admin'] === "") echo "selected"; ?>>Pilih Jenis Kelamin Admin</option>
                            <option value="Pria" <?php if (isset($_POST['Jenis_Kelamin_Admin']) && $_POST['Jenis_Kelamin_Admin'] === "Pria") echo "selected"; ?>>Pria</option>
                            <option value="Wanita" <?php if (isset($_POST['Jenis_Kelamin_Admin']) && $_POST['Jenis_Kelamin_Admin'] === "Wanita") echo "selected"; ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3 isAdminActive">
                        <label for="roleEditAdmin" class="form-label">Peran Admin</label>
                        <select name="Peran_Admin" id="roleEditAdmin" class="form-control inputData">
                            <option value="1" <?php if (isset($_POST['Peran_Admin']) && $_POST['Peran_Admin'] == '1') echo 'selected'; ?>>Super Admin</option>
                            <option value="2" <?php if (isset($_POST['Peran_Admin']) && $_POST['Peran_Admin'] == '2') echo 'selected'; ?>>Instansi A</option>
                            <option value="3" <?php if (isset($_POST['Peran_Admin']) && $_POST['Peran_Admin'] == '3') echo 'selected'; ?>>Instansi B</option>
                            <option value="4" <?php if (isset($_POST['Peran_Admin']) && $_POST['Peran_Admin'] == '4') echo 'selected'; ?>>Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addressEditAdmin" class="form-label">Alamat Admin</label>
                        <textarea name="Alamat_Admin" placeholder="Masukan Alamat Admin" class="form-control inputData addressAddAdmin" id="addressEditAdmin" autocomplete="off"><?php echo htmlspecialchars($alamat_admin); ?></textarea>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanAdmin" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>