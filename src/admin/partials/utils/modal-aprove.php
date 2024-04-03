<div class="modal fade" id="aproveFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="editApllyment" name="ID_Admin" autocomplete="off">
                    <div class="mb-3">
                        <label for="fileAproveTransaction" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="fileAproveTransaction" name="Upload_File" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="statusTransactionAprovement" class="form-label">Status Transaksi</label>
                        <select name="Status_Transaksi" id="statusTransactionAprovement" class="form-control inputData">
                            <option value="Belum Disetujui">Belum Disetujui</option>
                            <option value="Disetujui">Disetujui</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanTransaksi" name="Simpan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>