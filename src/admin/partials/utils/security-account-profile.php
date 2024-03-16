<?php
$idSessionAdmin = $_SESSION['ID'];
$adminModel = new Admin($koneksi);
$dataAdmin = $adminModel->tampilkanAdminDenganSessionId($idSessionAdmin);
if (!empty($dataAdmin)) {
    $admin = $dataAdmin[0];
?>
    <div class="dataSecurityAccount">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/edit-account-profile.php">
                            <input type="hidden" value="<?php echo $admin['ID_Admin']; ?>" name="ID_Admin">
                            <div class="mb-3">
                                <label for="frontNameAdminProfile" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control inputData" placeholder="Masukan Nama Depan Admin" id="frontNameAdminProfile" value="<?php echo $admin['Nama_Depan_Admin']; ?>" name="Nama_Depan_Admin" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="lastNameAdminProfile" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control inputData" placeholder="Masukan Nama Belakang Admin" value="<?php echo $admin['Nama_Belakang_Admin']; ?>" id="lastNameAdminProfile" name="Nama_Belakang_Admin" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="userNameAdminProfile" class="form-label">Nama Pengguna</label>
                                <input type="text" class="form-control inputData" placeholder="Masukan Nama Pengguna Admin" value="<?php echo $admin['Nama_Pengguna_Admin']; ?>" id="userNameAdminProfile" name="Nama_Pengguna_Admin" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="emailAdminProfile" class="form-label">Email</label>
                                <input type="email" class="form-control inputData" placeholder="Masukan Email Admin" id="emailAdminProfile" value="<?php echo $admin['Email_Admin']; ?>" name="Email_Admin" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="numberAdminProfile" class="form-label">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text spanNumberData">+62</span>
                                    <input type="text" placeholder="Masukan Nomor Telepon Admin" class="form-control inputData" value="<?php echo $admin['No_Telepon_Admin']; ?>" id="numberAdminProfile" name="No_Telepon_Admin" autocomplete="off">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="addressAdminProfile" class="form-label">Alamat Admin</label>
                                <textarea name="Alamat_Admin" placeholder="Masukan Alamat Admin" class="form-control inputData addressAddAdmin" id="addressAdminProfile" autocomplete="off"><?php echo $admin['Alamat_Admin']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btnUpload" name="Simpan">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-danger fw-bold">Peringatan</h5>
                        <p class="fw-semibold">Data yang di hapus tidak dapat dikembalikan</p>
                        <button class="btn btn-danger" onclick="confirmDeleteProfile(<?php echo $admin['ID_Admin']; ?>)">Hapus Akun</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    echo "<p>Data admin tidak ditemukan.</p>";
}
?>