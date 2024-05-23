<div class="modal fade" id="aproveFilePayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <form id="formUpdateTransaksi" method="POST">
                    <input type="hidden" id="editPayment" name="ID_Pembayaran" autocomplete="off" value="<?php echo htmlspecialchars($id_pembayaran); ?>">
                    <div class="mb-3">
                        <label for="descriptionApplyment" class="form-label">Keterangan Pembayaran Yang Ditolak</label>
                        <textarea name="Keterangan_Pembayaran_Ditolak" class="form-control" id="descriptionApplyment" placeholder="Masukkan Keterangan"><?php echo htmlspecialchars($keterangan_pembayaran_ditolak); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="statusTransactionAprovement" class="form-label">Status Pembayaran</label>
                        <select name="Status_Transaksi" id="statusTransactionAprovement" class="form-control inputData">
                            <option value="Ditolak" <?php if ($status_transaksi == 'Ditolak') echo ' selected="selected"'; ?>>Ditolak</option>
                            <option value="Disetujui" <?php if ($status_transaksi == 'Disetujui') echo ' selected="selected"'; ?>>Disetujui</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanPembayaran" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>