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
                        <input type="text" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukkan Nama Depan Admin'); ?>" id="frontNameAdmin" name="Nama_Depan_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="lastNameAdmin" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukkan Nama Belakang Admin'); ?>" id="lastNameAdmin" name="Nama_Belakang_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="userNameAdmin" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukkan Nama Pengguna Admin'); ?>" id="userNameAdmin" name="Nama_Pengguna_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="emailAdmin" class="form-label">Email</label>
                        <input type="email" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukkan Email Admin'); ?>" id="emailAdmin" name="Email_Admin" autocomplete="off">
                    </div>
                    <div class="mb-3 parentPassword">
                        <label for="passwordAdmin" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control inputData" placeholder="<?php echo htmlspecialchars('********'); ?>" id="passwordAdmin" name="Kata_Sandi" autocomplete="off">
                        <i class="fas fa-eye iconInputContainer" id="togglePasswordAdmin"></i>
                    </div>
                    <div class="mb-3 parentConfirmPassword">
                        <label for="confirmPasswordAdmin" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control inputData" placeholder="<?php echo htmlspecialchars('********'); ?>" id="confirmPasswordAdmin" name="Konfirmasi_Kata_Sandi" autocomplete="off">
                        <i class="fas fa-eye iconInputContainer" id="toggleConfirmPasswordAdmin"></i>
                    </div>
                    <div class="mb-3">
                        <label for="numberAdmin" class="form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">+62</span>
                            <input type="number" placeholder="<?php echo htmlspecialchars('Masukkan Nomor Telepon Admin'); ?>" class="form-control inputData" id="numberAdmin" name="No_Telepon_Admin" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="genderAdmin" class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin_Admin" id="genderAdmin" class="form-control inputData">
                            <option value="" selected><?php echo htmlspecialchars('Pilih Jenis Kelamin Admin'); ?></option>
                            <option value="Pria"><?php echo htmlspecialchars('Pria'); ?></option>
                            <option value="Wanita"><?php echo htmlspecialchars('Wanita'); ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="roleAdmin" class="form-label">Peran Admin</label>
                        <select name="Peran_Admin" id="roleAdmin" class="form-control inputData">
                            <?php
                            $peranAdmin = isset($_SESSION['Peran_Admin']) ? $_SESSION['Peran_Admin'] : '';
                            $apakahSuperAdmin = ($peranAdmin == 1);
                            echo ($apakahSuperAdmin) ? '<option value="" selected>' . htmlspecialchars('Pilih Peran Admin') . '</option>' : '';
                            echo ($apakahSuperAdmin) ? '<option value="1">' . htmlspecialchars('Super Admin') . '</option>' : '';
                            echo ($apakahSuperAdmin) ? '<option value="2">' . htmlspecialchars('Instansi A') . '</option>' : '';
                            echo ($apakahSuperAdmin) ? '<option value="3">' . htmlspecialchars('Instansi B') . '</option>' : '';
                            echo ($apakahSuperAdmin) ? '<option value="4">' . htmlspecialchars('Instansi C') . '</option>' : '';
                            echo (!$apakahSuperAdmin && $peranAdmin == 2) ? '<option value="2" selected>' . htmlspecialchars('Instansi A') . '</option>' : '';
                            echo (!$apakahSuperAdmin && $peranAdmin == 3) ? '<option value="3" selected>' . htmlspecialchars('Instansi B') . '</option>' : '';
                            echo (!$apakahSuperAdmin && $peranAdmin == 4) ? '<option value="4" selected>' . htmlspecialchars('Instansi C') . '</option>' : '';
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addressAdmin" class="form-label">Alamat Admin</label>
                        <textarea name="Alamat_Admin" placeholder="<?php echo htmlspecialchars('Masukkan Alamat Admin'); ?>" class="form-control inputData addressAddAdmin" id="addressAdmin" autocomplete="off"></textarea>
                    </div>
                    <div class="pemuat" id="pemuat2"></div>
                    <button type="submit" class="btn btnUpload" name="Simpan" id="btnSimpan""><?php echo htmlspecialchars('Kirim'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>