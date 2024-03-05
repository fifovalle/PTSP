<?php
// AKAR TAUTAN
$akarUrl = "http://localhost/PTSP/";
// HALAMAN SAAT DIBUKA
$halamanSaatIni = basename($_SERVER['PHP_SELF']);
?>
<div class="modal fade" id="modalSuntingFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sunting Foto Profil</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/edit-photo-profile.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="fw-bold unggahFoto" for="unggahFoto">Unggah Foto</label>
                        <label for="unggahFoto" class="upload-icon">
                            <i class="bx bx-plus"></i>
                        </label>
                        <input type="file" name="Foto_Admin" class="form-control-file visually-hidden" id="unggahFoto">
                    </div>
                    <button type="submit" class="btn btnUpload" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>