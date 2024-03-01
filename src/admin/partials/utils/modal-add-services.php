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
                <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/add-information.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productFoto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="productFoto" name="Foto_Jasa" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nameProduct" class="form-label">Nama Jasa</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Jasa" id="nameProduct" name="Nama_Jasa" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="descriptionProduct" class="form-label">Deskripsi Jasa</label>
                        <textarea name="Deskripsi_Jasa" placeholder="Masukan Deskripsi Jasa" class="form-control inputData addressAddPengguna" id="descriptionProduct" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Harga Jasa</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="Masukan Harga Jasa" class="form-control inputData" id="productPrice" name="Harga_Jasa" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="owner" class="form-label">Pemilik Jasa</label>
                        <select name="Pemilik_Jasa" id="owner" class="form-control inputData">
                            <option value="" selected>Pilih Pemilik Jasa</option>
                            <option value="Instansi A">Instansi A</option>
                            <option value="Instansi B">Instansi B</option>
                            <option value="Instansi C">Instansi C</option>
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
                        <label for="sevicesCategory" class="form-label">Status Jasa</label>
                        <select name="Status_Jasa" id="sevicesCategory" class="form-control inputData">
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