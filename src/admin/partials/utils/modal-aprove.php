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
                <form>
                    <input type="hidden" id="editCreation" name="ID_Pembuatan" autocomplete="off">
                    <div class="mb-3">
                        <label for="fileCreation" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="fileCreation" name="Upload_File" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btnUpload" id="tombolSimpanPembuatan">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>