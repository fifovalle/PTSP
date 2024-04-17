<div class="modal fade" id="seeApplyment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pengajuan</h1>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $pengajuanModel = new Transaksi($koneksi);
                                $dataPengajuan = $pengajuanModel->tampilkanSemuaPengajuanTransaksi();
                                if (!empty($dataPengajuan)) {
                                    $pengajuan = $dataPengajuan[0];
                                ?>
                                    <div class="row">
                                        <div>
                                            <h5 class="card-title fw-bold">Informasi Pembeli</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Nama</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $pengajuan['Nama_Bencana']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $pengajuan['Email_Bencana']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">No Hp</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $pengajuan['No_Telepon_Bencana']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Surat</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img class="imageModalDetail" src="../assets/image/uploads/<?php echo $pengajuan['Surat_Pengantar_Permintaan_Data_Bencana']; ?>" alt="Deskripsi Gambar">
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                                } else {
                                    echo "<p>Data pengajuan tidak ditemukan.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $pengajuanModel = new Transaksi($koneksi);
                                $dataPengajuan = $pengajuanModel->tampilkanSemuaPengajuanTransaksi();
                                if (!empty($dataPengajuan)) {
                                    $pengajuan = $dataPengajuan[0];
                                ?>
                                    <div class="row">
                                        <div>
                                            <h5 class="card-title fw-bold">Informasi Produk</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Informasi</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo !empty($pengajuan['Nama_Informasi']) ? $pengajuan['Nama_Informasi'] : '-'; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Jasa</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo !empty($pengajuan['Nama_Jasa']) ? $pengajuan['Nama_Jasa'] : '-'; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Deskripsi</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php echo $pengajuan['Deskripsi_Informasi'] ?? $pengajuan['Deskripsi_Jasa']; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Gambar</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img class="imageModalDetail" src="../assets/image/uploads/<?php echo $pengajuan['Foto_Informasi'] ?? $pengajuan['Foto_Jasa']; ?>" alt="Deskripsi Gambar">
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                                } else {
                                    echo "<p>Data pengajuan tidak ditemukan.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>