<div class="modal fade" id="historiPengisianIKM" tabindex="-1" aria-labelledby="historiPengisianIKMLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="box-historiPengisianIKM">
            <?php
            $id = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];
            $ikmModel = new Ikm($koneksi);
            $dataIkm = $ikmModel->tampilkanRiwayatIKMSesuaiPenggunaYangLogin($id);
            ?>
            <div class="modal-header">
                <h3>Histori Pengisian IKM</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-2">
                <div class="container-fluid p-0">
                    <div class="row mx-0 text-center header-ikm">
                        <div class="col-md-2">Pertanyaan</div>
                        <div class="col-md-5">Kualitas Pelayanan</div>
                        <div class="col-md-5">Harapan Konsumen</div>
                    </div>
                    <?php
                    if ($dataIkm != null) {
                        foreach ($dataIkm as $ikm) {
                    ?>
                            <div class="row mx-0 body-ikm">
                                <div class="col-md-2 p-2">Persyaratan pelayanan jelas dan terbuka</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Sangat_Penting" value="<?php echo $ikm['Harapan_Konsumen_Terbuka'] === 'Sangat Penting'; ?>" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Penting" value="<?php echo $ikm['Harapan_Konsumen_Terbuka'] === 'Penting'; ?>" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Kurang_Penting" value="<?php echo $ikm['Harapan_Konsumen_Terbuka'] === 'Kurang Penting'; ?>" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Persyaratan pelayanan mudah dan dipenuhi</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Persyaratan" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Persyaratan" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Persyaratan" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Persyaratan" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Persyaratan'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Persyaratan" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Persyaratan" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Persyaratan" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Persyaratan" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Persyaratan'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Dibutuhkan dalam kehidupan sehari-hari</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Kehidupan" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Kehidupan" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Kehidupan" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Kehidupan" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Kehidupan'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Kehidupan'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Mudah diakses</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Diakses" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju_Kualitas_Pelayanan_Diakses">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Diakses" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju_Kualitas_Pelayanan_Diakses">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Diakses" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju_Kualitas_Pelayanan_Diakses">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Diakses" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Diakses'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju_Kualitas_Pelayanan_Diakses">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Diakses'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Diakses" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Diakses'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting_Harapan_Konsumen_Diakses">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Diakses'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Diakses" id="Penting_Harapan" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Diakses'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting_Harapan_Konsumen_Diakses">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Diakses'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Diakses" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Diakses'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting_Harapan_Konsumen_Diakses">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Diakses'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Diakses" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Diakses'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting_Harapan_Konsumen_Diakses">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Mudah dipahami</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Dipahami" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Dipahami" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Dipahami" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Dipahami" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Dipahami'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Dipahami" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Dipahami" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Dipahami" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Dipahami" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Dipahami'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Akurat</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Akurat" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Akurat" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Akurat" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Akurat" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Akurat'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Akurat'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Akurat" id="Sangat_Setuju" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Akurat'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Akurat'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Akurat" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Akurat'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Akurat'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Akurat" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Akurat'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Akurat'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Akurat" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Akurat'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Ketersediaan jenis data dan informasi</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Data'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Data" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Data'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Data'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Data" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Data'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Data'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Data" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Data'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Data'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Data" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Data'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Data'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Data" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Harapan_Konsumen_Data'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Data'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Data" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Data'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Data'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Data" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Data'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Data'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Data" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Data'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Alur pelayanan jelas dan sederhana</div>
                                <div class="col-md-10 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sederhana" id="Sangat Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sederhana" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sederhana" id="Kurang Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sederhana" id="Tidak Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sederhana'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Sistem dan prosedur pelayanan masih berpeluang menimbulkan KKN</div>
                                <div class="col-md-10 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_KKN" id="Sangat Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_KKN" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_KKN" id="Kurang Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_KKN" id="Tidak Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_KKN'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Informasi target waktu penyelesaian pelayanan jelas</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Waktu" id="Sangat Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Waktu" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Waktu" id="Kurang Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Waktu" id="Tidak Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Waktu'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Waktu'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Harapan_Konsumen_Waktu" id="Sangat Setuju" value="Sangat Setuju" <?php echo ($ikm['Harapan_Konsumen_Waktu'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat Setuju">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Waktu'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Waktu" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Waktu'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Waktu'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Waktu" id="Kurang Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Waktu'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Waktu'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Waktu" id="Tidak Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Waktu'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Penyelesaian pelayanan sesuai dengan target waktu</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sesuai" id="Sangat Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sesuai" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sesuai" id="Kurang Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sesuai" id="Tidak Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sesuai'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sesuai" id="Sangat Setuju" value="Sangat Setuju" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat Setuju">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sesuai" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sesuai" id="Kurang Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sesuai" id="Tidak Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Sesuai'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Biaya pelayanan jelas dan terbuka</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Biaya_Terbuka" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Biaya_Terbuka" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Biaya_Terbuka" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Biaya_Terbuka" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Biaya_Terbuka'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Harapan_Konsumen_Biaya_Terbuka" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Biaya_Terbuka" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Biaya_Terbuka" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Biaya_Terbuka" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Biaya_Terbuka'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Informasi daftar produk atau jasa layanan terbuka dan jelas</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Daftar" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Daftar" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Daftar" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Daftar" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Daftar'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Daftar'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Daftar" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Daftar'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Daftar'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Daftar" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Daftar'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Daftar'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Daftar" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Daftar'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Daftar'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Daftar" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Daftar'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Sarana pengaduan atau keluhan pelayanan publik tersedia</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sarana" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sarana" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sarana" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sarana" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sarana'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sarana'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sarana" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Sarana'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sarana'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sarana" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Sarana'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sarana'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sarana" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Sarana'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sarana'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sarana" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Sarana'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Prosedur dan tindak lanjut penanganan pengaduan jelas</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Prosedur" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Prosedur" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Prosedur" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Prosedur" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Prosedur'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Prosedur" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Prosedur" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Prosedur" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Prosedur" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Prosedur'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Keberadaan petugas layanan jelas</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Keberadaan" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Keberadaan" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Keberadaan" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Keberadaan" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Keberadaan'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Keberadaan" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Keberadaan" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Keberadaan" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Keberadaan" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Keberadaan'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Petugas sigap, ahli, dan cekatan</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Petugas" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Petugas" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Petugas" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Petugas" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Petugas'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Petugas'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Petugas" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Petugas'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Petugas'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Petugas" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Petugas'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Petugas'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Petugas" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Petugas'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Petugas'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Petugas" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Petugas'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Sikap dan perilaku petugas pelayanan baik dan bertanggungjawab</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sikap" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sikap" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sikap" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Sikap" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Sikap'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sikap'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sikap" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Sikap'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sikap'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sikap" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Sikap'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sikap'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sikap" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Sikap'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Sikap'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Sikap" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Sikap'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Sarana dan prasarana pelayanan aman, nyaman, dan mudah dijangkau</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Aman" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Aman" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Aman" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Aman" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Aman'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Aman'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Harapan_Konsumen_Aman" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Harapan_Konsumen_Aman'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Aman'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Aman" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Aman'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Aman'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Aman" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Aman'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Aman'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Aman" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Aman'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                                <div class="col-md-2 p-2">Pelayanan publik pada instansi ini sudah berjalan dengan baik</div>
                                <div class="col-md-5 text-center align-middle p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Sangat Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Sangat_Setuju" value="Sangat Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Sangat Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Setuju">Sangat Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Setuju" value="Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Setuju">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Kurang Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Kurang_Setuju" value="Kurang Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Kurang Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Setuju">Kurang Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] === 'Tidak Setuju') ? 'checked' : ''; ?> name="Kualitas_Pelayanan_Terbuka" id="Tidak_Setuju" value="Tidak Setuju" <?php echo ($ikm['Kualitas_Pelayanan_Terbuka'] !== 'Tidak Setuju') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Setuju">Tidak Setuju</label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center p-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Sangat Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Sangat_Penting" value="Sangat Penting" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Sangat Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Sangat_Penting">Sangat Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Penting" value="Penting" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Penting">Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Kurang Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Kurang_Penting" value="Kurang Penting" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Kurang Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Kurang_Penting">Kurang Penting</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] === 'Tidak Penting') ? 'checked' : ''; ?> name="Harapan_Konsumen_Terbuka" id="Tidak_Penting" value="Tidak Penting" <?php echo ($ikm['Harapan_Konsumen_Terbuka'] !== 'Tidak Penting') ? 'disabled' : ''; ?>>
                                        <label class="form-check-label" for="Tidak_Penting">Tidak Penting</label>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="text-center fw-bold text-danger mt-4">Belum ada data!</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>