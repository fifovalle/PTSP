<div class="modal fade" id="addInformation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Informasi</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo htmlspecialchars($akarUrl); ?>src/admin/config/add-information.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="informationFoto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="informationFoto" name="Foto_Informasi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="informationName" class="form-label">Nama Informasi</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Informasi" id="informationName" name="Nama_Informasi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="informationDescription" class="form-label">Deskripsi Informasi</label>
                        <textarea name="Deskripsi_Informasi" placeholder="Masukan Deskripsi Informasi" class="form-control inputData addressAddPengguna" id="informationDescription" autocomplete="off"><?php echo htmlspecialchars($_POST['Deskripsi_Informasi'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="informationPrice" class="form-label">Harga Informasi</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="Masukan Harga Informasi" class="form-control inputData" id="informationPrice" name="Harga_Informasi" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="informationOwner" class="form-label">Pemilik Informasi</label>
                        <select name="Pemilik_Informasi" id="informationOwner" class="form-control inputData">
                            <?php
                            $peranAdmin = isset($_SESSION['Peran_Admin']) ? $_SESSION['Peran_Admin'] : '';
                            $apakahSuperAdmin = ($peranAdmin == 1);
                            echo ($apakahSuperAdmin) ? '<option value="" selected>' . htmlspecialchars('Pilih Pemilik Informasi') . '</option>' : '';
                            echo ($apakahSuperAdmin) ? '<option value="Instansi A">' . htmlspecialchars('Instansi A') . '</option>' : '';
                            echo ($apakahSuperAdmin) ? '<option value="Instansi B">' . htmlspecialchars('Instansi B') . '</option>' : '';
                            echo ($apakahSuperAdmin) ? '<option value="Instansi C">' . htmlspecialchars('Instansi C') . '</option>' : '';
                            echo (!$apakahSuperAdmin && $peranAdmin == 2) ? '<option value="Instansi A" selected>' . htmlspecialchars('Instansi A') . '</option>' : '';
                            echo (!$apakahSuperAdmin && $peranAdmin == 3) ? '<option value="Instansi B" selected>' . htmlspecialchars('Instansi B') . '</option>' : '';
                            echo (!$apakahSuperAdmin && $peranAdmin == 4) ? '<option value="Instansi C" selected>' . htmlspecialchars('Instansi C') . '</option>' : '';
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="informationCategory" class="form-label">Kategori Informasi</label>
                        <select name="Kategori_Informasi" id="informationCategory" class="form-control inputData">
                            <option value="" selected>Pilih Kategori Jasa</option>
                            <option value="<?php echo htmlspecialchars("Meteorologi"); ?>">Meteorologi</option>
                            <option value="<?php echo htmlspecialchars("Klimatologi"); ?>">Klimatologi</option>
                            <option value="<?php echo htmlspecialchars("Geofisika"); ?>">Geofisika</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="informationStatus" class="form-label">Status Informasi</label>
                        <select name="Status_Informasi" id="informationStatus" class="form-control inputData">
                            <option value="" selected>Pilih Status Informasi</option>
                            <option value="<?php echo htmlspecialchars("1"); ?>">Tersedia</option>
                            <option value="<?php echo htmlspecialchars("2"); ?>">Tidak Tersedia</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>