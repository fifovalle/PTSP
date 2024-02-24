<?php
// AKAR TAUTAN
$akarUrl = "http://localhost/PTSP/";
// HALAMAN SAAT DIBUKA
$halamanSaatIni = basename($_SERVER['PHP_SELF']);
?>
<div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/add-admin.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fotoAdmin" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="fotoAdmin" name="Foto_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="frontNameAdmin" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Depan Admin" id="frontNameAdmin" name="Nama_Depan_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="lastNameAdmin" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Belakang Admin" id="lastNameAdmin" name="Nama_Belakang_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="userNameAdmin" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Pengguna Admin" id="userNameAdmin" name="Nama_Pengguna_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="emailAdmin" class="form-label">Email</label>
                        <input type="email" class="form-control inputData" placeholder="Masukan Email Admin" id="emailAdmin" name="Email_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3 parentPassword">
                        <label for="passwordAdmin" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control inputData" placeholder="&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;" id="passwordAdmin" name="Kata_Sandi">
                        <i class="fas fa-eye iconInputContainer" id="togglePasswordAdmin"></i>
                    </div>
                    <div class="mb-3 parentConfirmPassword">
                        <label for="confirmPasswordAdmin" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control inputData" placeholder="&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;&#x002A;" id="confirmPasswordAdmin" name="Konfirmasi_Kata_Sandi">
                        <i class="fas fa-eye iconInputContainer" id="toggleConfirmPasswordAdmin"></i>
                    </div>
                    <div class="mb-3">
                        <label for="numberAdmin" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">+62</span>
                            <input type="number" placeholder="Masukan Nomor Telepon Admin" class="form-control inputData" id="numberAdmin" name="No_Telepon_Admin" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="genderAdmin" class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin_Admin" id="genderAdmin" class="form-control inputData">
                            <option value="" selected>Pilih Jenis Kelamin Admin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="roleAdmin" class="form-label">Peran Admin</label>
                        <select name="Peran_Admin" id="roleAdmin" class="form-control inputData">
                            <option value="" selected>Pilih Peran Admin</option>
                            <option value="1">Super Admin</option>
                            <option value="2">Instansi A</option>
                            <option value="3">Instansi B</option>
                            <option value="4">Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addressAdmin" class="form-label">Alamat Admin</label>
                        <textarea name="Alamat_Admin" placeholder="Masukan Alamat Admin" class="form-control inputData addressAddAdmin" id="addressAdmin" autocomplete="off"></textarea>
                    </div>
                    <button type="submit" class="btn btnUpload" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>