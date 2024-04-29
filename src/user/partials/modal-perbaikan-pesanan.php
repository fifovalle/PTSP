<div class="modal fade" id="perbaikanPesanan" tabindex="-1" aria-labelledby="perbaikanPesananLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="box-perbaikan">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="perbaikanPesananLabel">Perbaikan Dokumen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID_Penngajuan" id="improveIDPengajuan">
                <div class="modal-body">
                    <select class="form-select" name="Perbaikan_Dokumen" aria-label="Default select example">
                        <option value="" selected>Pilih perbaikan dokumen</option>
                        <option value="1">Surat Pengantar Permintaan Data</option>
                        <option value="2">Surat Permintaan Ditandatangani Camat atau Pejabat Setingkat</option>
                        <option value="3">Surat Pengantar dari Kepala Sekolah / Rektor / Dekan</option>
                        <option value="4">Proposal Penelitian Berisi Maksud dan Tujuan Penelitian yang Telah Disetujui</option>
                        <option value="5">Identitas Diri KTP / KTM / SIM / Paspor</option>
                        <option value="6">Surat Pernyataan Tidak Digunakan Untuk Kepentingan Lain</option>
                        <option value="7">Mempunyai Perjanjian Kerjasama dengan BMKG tentang Kebutuhan Informasi MKKuG</option>
                        <option value="8">Surat Pengantar (Pemerintah pusat atau daerah)</option>
                        <option value="9">Surat Pengantar (Pelayanan informasi dengan tarif PNBP)</option>
                    </select>
                    <div class="mb-3 mt-4">
                        <input class="form-control" name="dokumen" type="file" id="formFile">
                    </div>
                    <div class="col text-end">
                        <p class="text-danger fw-bold">
                            <?php echo $pengajuan['Keterangan_Surat_Ditolak']; ?>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanImproveApplyment" name="Simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>