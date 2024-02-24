<?php
// AKAR TAUTAN
$akarUrl = "http://localhost/PTSP/";
// HALAMAN SAAT DIBUKA
$halamanSaatIni = basename($_SERVER['PHP_SELF']);
?>
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/add-product.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productFoto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="productFoto" name="Foto_Produk" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nameProduct" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control inputData" placeholder="Masukan Nama Produk" id="nameProduct" name="Nama_Produk" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="descriptionProduct" class="form-label">Deskripsi Produk</label>
                        <textarea name="Deskripsi_Produk" placeholder="Masukan Deskripsi Produk" class="form-control inputData addressAddPengguna" id="descriptionProduct" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Harga Produk</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData">Rp</span>
                            <input type="number" placeholder="Masukan Harga Produk" class="form-control inputData" id="productPrice" name="Harga_Produk" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stok Produk</label>
                        <div class="input-group">
                            <span class="input-group-text spanNumberData"><i class="bx bxs-box"></i></span>
                            <input type="number" placeholder="Masukan Stok Produk" class="form-control inputData" id="productStock" name="Stok_Produk" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="owner" class="form-label">Pemilik Produk</label>
                        <select name="Pemilik_Produk" id="owner" class="form-control inputData">
                            <option value="" selected>Pilih Pemilik Produk</option>
                            <option value="Instansi A">Instansi A</option>
                            <option value="Instansi B">Instansi B</option>
                            <option value="Instansi C">Instansi C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productStatus" class="form-label">Status Produk</label>
                        <select name="Status_Produk" id="productStatus" class="form-control inputData">
                            <option value="" selected>Pilih Status Produk</option>
                            <option value="1">Tersedia</option>
                            <option value="2">Tidak Tersedia</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>