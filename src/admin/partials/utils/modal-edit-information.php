<div class="modal fade" id="editInformation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo htmlspecialchars('Sunting Informasi'); ?></h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="InformationIDEdit" name="ID_Informasi" autocomplete="off">
                    <div class="mb-3">
                        <label for="informationFotoEdit" class="form-label"><?php echo htmlspecialchars('Foto'); ?></label>
                        <input type="file" class="form-control" id="informationFotoEdit" name="Foto_Informasi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="informationNameEdit" class="form-label"><?php echo htmlspecialchars('Nama Informasi'); ?></label>
                        <input type="text" class="form-control inputData" placeholder="<?php echo htmlspecialchars('Masukan Nama Informasi'); ?>" id="informationNameEdit" name="Nama_Informasi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="informationDescriptionEdit" class="form-label"><?php echo htmlspecialchars('Deskripsi Informasi'); ?></label>
                        <textarea name="Deskripsi_Informasi" placeholder="<?php echo htmlspecialchars('Masukan Deskripsi Informasi'); ?>" class="form-control inputData" id="informationDescriptionEdit" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="informationPriceEdit" class="form-label"><?php echo htmlspecialchars('Harga Informasi'); ?></label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="<?php echo htmlspecialchars('Masukan Harga Informasi'); ?>" class="form-control inputData" id="informationPriceEdit" name="Harga_Informasi" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="informationOwnerEdit" class="form-label"><?php echo htmlspecialchars('Pemilik Informasi'); ?></label>
                        <select name="Pemilik_Informasi" id="informationOwnerEdit" class="form-control inputData">
                            <option value="" selected><?php echo htmlspecialchars('Pilih Pemilik Informasi'); ?></option>
                            <option value="Instansi A">Instansi A</option>
                            <option value="Instansi B">Instansi B</option>
                            <option value="Instansi C">Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="informationCategoryEdit" class="form-label"><?php echo htmlspecialchars('Kategori Informasi'); ?></label>
                        <select name="Kategori_Informasi" id="informationCategoryEdit" class="form-control inputData">
                            <option value="" selected><?php echo htmlspecialchars('Pilih Kategori Jasa'); ?></option>
                            <option value="Meteorologi">Meteorologi</option>
                            <option value="Klimatologi">Klimatologi</option>
                            <option value="Geofisika">Geofisika</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="informationStatusEdit" class="form-label"><?php echo htmlspecialchars('Status Informasi'); ?></label>
                        <select name="Status_Informasi" id="informationStatusEdit" class="form-control inputData">
                            <option value="" selected><?php echo htmlspecialchars('Pilih Status Informasi'); ?></option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanInformation" name="Simpan"><?php echo htmlspecialchars('Kirim'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>