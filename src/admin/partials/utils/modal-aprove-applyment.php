<div class="modal fade" id="approveApplicationModal" tabindex="-1" aria-labelledby="approveApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="approveApplicationModalLabel">Penerimaan</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form id="formUpdatePengajuan" method="POST">
                    <input type="hidden" id="editApplymentID" name="ID_Pengajuan" autocomplete="off">
                    <div class="mb-3">
                        <label for="editStatusTransactionApplyment" class="form-label">Status Pengajuan</label>
                        <select name="Status_Pengajuan" id="editStatusTransactionApplyment" class="form-control inputData">
                            <option value="Ditolak">Ditolak</option>
                            <option value="Diterima">Diterima</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editApakahGratis" class="form-label">Produk Gratis</label>
                        <select name="Apakah_Gratis" id="editApakahGratis" class="form-control inputData">
                            <option value="1">Gratis</option>
                            <option value="0">Bayar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDescriptionApplyment" class="form-label">Keterangan Pengajuan Yang Ditolak</label>
                        <textarea name="Keterangan_Surat_Ditolak" class="form-control" id="editDescriptionApplyment" placeholder="Masukkan Keterangan"></textarea>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanApplyment" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>