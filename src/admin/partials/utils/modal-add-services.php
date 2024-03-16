<div class="modal fade" id="addServices" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jasa</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/add-services.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="servicesFoto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="servicesFoto" name="Foto_Jasa" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="servicesName" class="form-label">Nama Jasa</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Jasa" id="servicesName" name="Nama_Jasa" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="servicesDescription" class="form-label">Deskripsi Jasa</label>
                        <textarea name="Deskripsi_Jasa" placeholder="Masukan Deskripsi Jasa" class="form-control inputData addressAddPengguna" id="servicesDescription" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="servicesPrice" class="form-label">Harga Jasa</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="Masukan Harga Jasa" class="form-control inputData" id="servicesPrice" name="Harga_Jasa" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="servicesOwner" class="form-label">Pemilik Jasa</label>
                        <select name="Pemilik_Jasa" id="servicesOwner" class="form-control inputData">
                            <?php
                            $peranAdmin = isset($_SESSION['Peran_Admin']) ? $_SESSION['Peran_Admin'] : '';
                            $apakahSuperAdmin = ($peranAdmin == 1);
                            echo ($apakahSuperAdmin) ? '<option value="" selected>' . htmlspecialchars('Pilih Pemilik Jasa') . '</option>' : '';
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
                        <label for="servicesCategory" class="form-label">Kategori Jasa</label>
                        <select name="Kategori_Jasa" id="servicesCategory" class="form-control inputData">
                            <option value="" selected>Pilih Kategori Jasa</option>
                            <option value="Meteorologi">Meteorologi</option>
                            <option value="Klimatologi">Klimatologi</option>
                            <option value="Geofisika">Geofisika</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sevicesStatus" class="form-label">Status Jasa</label>
                        <select name="Status_Jasa" id="sevicesStatus" class="form-control inputData">
                            <option value="" selected>Pilih Status Jasa</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>