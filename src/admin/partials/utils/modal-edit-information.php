<div class="modal fade" id="editInformation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sunting Informasi</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="InformationIDEdit" name="ID_Informasi" autocomplete="off">
                    <div class="mb-3">
                        <label for="informationFotoEdit" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="informationFotoEdit" name="Foto_Informasi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="informationNameEdit" class="form-label">Nama Informasi</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Informasi" id="informationNameEdit" name="Nama_Informasi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="informationDescriptionEdit" class="form-label">Deskripsi Informasi</label>
                        <textarea name="Deskripsi_Informasi" placeholder="Masukan Deskripsi Informasi" class="form-control inputData" id="informationDescriptionEdit" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="informationPriceEdit" class="form-label">Harga Informasi</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="Masukan Harga Informasi" class="form-control inputData" id="informationPriceEdit" name="Harga_Informasi" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="informationOwnerEdit" class="form-label">Pemilik Informasi</label>
                        <select name="Pemilik_Informasi" id="informationOwnerEdit" class="form-control inputData">
                            <option value="" selected>Pilih Pemilik Informasi</option>
                            <option value="Instansi A">Instansi A</option>
                            <option value="Instansi B">Instansi B</option>
                            <option value="Instansi C">Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="informationCategoryEdit" class="form-label">Kategori Informasi</label>
                        <select name="Kategori_Informasi" id="informationCategoryEdit" class="form-control inputData">
                            <option value="" selected>Pilih Kategori Jasa</option>
                            <option value="Meteorologi">Meteorologi</option>
                            <option value="Klimatologi">Klimatologi</option>
                            <option value="Geofisika">Geofisika</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="informationStatusEdit" class="form-label">Status Informasi</label>
                        <select name="Status_Informasi" id="informationStatusEdit" class="form-control inputData">
                            <option value="" selected>Pilih Status Informasi</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanInformation" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>