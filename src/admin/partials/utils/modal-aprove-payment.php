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
                <form method="POST" action="../config/approve-transaction.php" enctype="multipart/form-data">
                    <input type="hidden" id="editApllyment" name="ID_Admin" autocomplete="off">
                    <div class="mb-3">
                        <label for="descriptionApplyment" class="form-label">Keterangan Pembayaran Yang Ditolak</label>
                        <textarea name="Ket_Pengajuan" class="form-control" id="descriptionApplyment" placeholder="Masukkan Keterangan"></textarea>
                    </div>
                    <!-- JIKA STATUS PEMBAYARAN INI DI SETUJUI MAKA STATUS PESANAN OTOMATIS LUNAS DAN SEBALIKNYA -->
                    <div class="mb-3">
                        <label for="statusTransactionAprovement" class="form-label">Status Pembayaran</label>
                        <select name="Status_Transaksi" id="statusTransactionAprovement" class="form-control inputData">
                            <option value="Ditolak">Ditolak</option>
                            <option value="Disetujui">Disetujui</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanTransaksi" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>