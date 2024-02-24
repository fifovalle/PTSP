<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sunting Produk</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editProdukID" name="ID_Produk" autocomplete="off">
                    <div class="mb-3">
                        <label for="productEditFoto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="productEditFoto" name="Foto_Produk" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nameEditProduct" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Produk" id="nameEditProduct" name="Nama_Produk" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="descriptionEditProduct" class="form-label">Deskripsi Produk</label>
                        <textarea name="Deskripsi_Produk" placeholder="Masukan Deskripsi Produk" class="form-control inputData addressAddPengguna" id="descriptionEditProduct" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productEditPrice" class="form-label">Harga Produk</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="Masukan Harga Produk" class="form-control inputData" id="productEditPrice" name="Harga_Produk" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productEditStock" class="form-label">Stok Produk</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData"><i class="bx bxs-box"></i></span>
                            <input type="number" placeholder="Masukan Stok Produk" class="form-control inputData" id="productEditStock" name="Stok_Produk" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="ownerEdit" class="form-label">Pemilik Produk</label>
                        <select name="Pemilik_Produk" id="ownerEdit" class="form-control inputData">
                            <option value="" selected>Pilih Pemilik Produk</option>
                            <option value="Instansi A">Instansi A</option>
                            <option value="Instansi B">Instansi B</option>
                            <option value="Instansi C">Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productEditStatus" class="form-label">Status Produk</label>
                        <select name="Status_Produk" id="productEditStatus" class="form-control inputData">
                            <option value="" selected>Pilih Status Produk</option>
                            <option value="1">Tersedia</option>
                            <option value="2">Tidak Tersedia</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanProduk" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>