<div class="modal fade" id="editServices" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sunting Jasa</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="servicesIDEdit" name="ID_Jasa" autocomplete="off">
                    <div class="mb-3">
                        <label for="servicesFotoEdit" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="servicesFotoEdit" name="Foto_Jasa" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="servicesNameEdit" class="form-label">Nama Jasa</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Jasa" id="servicesNameEdit" name="Nama_Jasa" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="servicesDescriptionEdit" class="form-label">Deskripsi Jasa</label>
                        <textarea name="Deskripsi_Jasa" placeholder="Masukan Deskripsi Jasa" class="form-control inputData" id="servicesDescriptionEdit" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="servicesPriceEdit" class="form-label">Harga Jasa</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="Masukan Harga Jasa" class="form-control inputData" id="servicesPriceEdit" name="Harga_Jasa" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="servicesOwnerEdit" class="form-label">Pemilik Jasa</label>
                        <select name="Pemilik_Jasa" id="servicesOwnerEdit" class="form-control inputData">
                            <option value="" selected>Pilih Pemilik Informasi</option>
                            <option value="Instansi A">Instansi A</option>
                            <option value="Instansi B">Instansi B</option>
                            <option value="Instansi C">Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="servicesCategoryEdit" class="form-label">Kategori Informasi</label>
                        <select name="Kategori_Jasa" id="servicesCategoryEdit" class="form-control inputData">
                            <option value="" selected>Pilih Kategori Jasa</option>
                            <option value="Meteorologi">Meteorologi</option>
                            <option value="Klimatologi">Klimatologi</option>
                            <option value="Geofisika">Geofisika</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="servicesStatusEdit" class="form-label">Status Jasa</label>
                        <select name="Status_Jasa" id="servicesStatusEdit" class="form-control inputData">
                            <option value="" selected>Pilih Status Informasi</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanServices" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>