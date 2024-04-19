<div class="modal fade" id="aproveApllyment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Penerimaan</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editApplyment" name="ID_Admin" autocomplete="off">
                    <div class="mb-3">
                        <label for="fileAproveApplyment" class="form-label">Upload Foto Keterangan Surat Yang Ditolak</label>
                        <input type="file" class="form-control" id="fileAproveApplyment" name="Upload_Bukti" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="statusTransactionApplyment" class="form-label">Status Pengajuan</label>
                        <select name="Status_Pengajuan" id="statusTransactionApplyment" class="form-control inputData">
                            <option value="Belum Disetujui">Belum Disetujui</option>
                            <option value="Sedang Ditinjau">Sedang Ditinjau</option>
                            <option value="Disetujui">Disetujui</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="apakahGratis" class="form-label">Produk Gratis</label>
                        <select name="apakahGratis" id="apakahGratis" class="form-control inputData">
                            <option value="1">Gratis</option>
                            <option value="0">Bayar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descriptionApplyment" class="form-label">Keterangan Pengajuan Yang Ditolak</label>
                        <textarea name="Ket_Pengajuan" class="form-control" id="descriptionApplyment" placeholder="Masukkan Keterangan"></textarea>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanPengajuan" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>