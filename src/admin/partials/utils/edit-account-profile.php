<?php
$idSessionAdmin = $_SESSION['ID'];
$adminModel = new Admin($koneksi);
$dataAdmin = $adminModel->tampilkanAdminDenganSessionId($idSessionAdmin);
if (!empty($dataAdmin)) {
    $admin = $dataAdmin[0];
?>
    <div class="dataEditAccount">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/edit-account-profile.php">
                    <input type="hidden" value="<?php echo $admin['ID_Admin']; ?>" name="ID_Admin">
                    <div class="mb-3">
                        <label for="frontNameAdmin" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Depan Admin" id="frontNameAdmin" value="<?php echo $admin['Nama_Depan_Admin']; ?>" name="Nama_Depan_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="lastNameAdmin" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Belakang Admin" value="<?php echo $admin['Nama_Belakang_Admin']; ?>" id="lastNameAdmin" name="Nama_Belakang_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="userNameAdmin" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Pengguna Admin" value="<?php echo $admin['Nama_Pengguna_Admin']; ?>" id="userNameAdmin" name="Nama_Pengguna_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="emailAdmin" class="form-label">Email</label>
                        <input type="email" class="form-control inputData" placeholder="Masukan Email Admin" id="emailAdmin" value="<?php echo $admin['Email_Admin']; ?>" name="Email_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="numberAdmin" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">+62</span>
                            <input type="text" placeholder="Masukan Nomor Telepon Admin" class="form-control inputData" value="<?php echo $admin['No_Telepon_Admin']; ?>" id="numberAdmin" name="No_Telepon_Admin" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addressAdmin" class="form-label">Alamat Admin</label>
                        <textarea name="Alamat_Admin" placeholder="Masukan Alamat Admin" class="form-control inputData addressAddAdmin" id="addressAdmin" autocomplete="off"><?php echo $admin['Alamat_Admin']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btnUpload" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
<?php
} else {
    echo "<p>Data admin tidak ditemukan.</p>";
}
?>