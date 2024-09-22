<div class="modal fade" id="seeHistoryPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between gap-3">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Riwayat Transaksi</h1>
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <span class="ikoneDownload">
                            <i class="fas fa-download"></i>
                        </span>
                    </h1>
                </div>
                <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div>
                                        <h5 class="card-title fw-bold">Informasi Pembeli</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Nama</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary fw-bold" id="namaPembayarHistory">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary text-secondary fw-bold" id="emailPembayarHistory">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                                <div class=" row">
                                    <div class="col-4">
                                        <h6 class="mb-0">No Hp</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary text-secondary fw-bold" id="noHPPembayarHistory">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div>
                                        <h5 class="card-title fw-bold">Informasi Produk</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Informasi</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary text-secondary fw-bold" id="informasiPembayarHistory">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Jasa</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary text-secondary fw-bold" id="jasaPembayarHistory">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Transaksi</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary text-secondary fw-bold" id="deskripsiPembayarHistory">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Jenis</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary text-secondary fw-bold" id="jenisPembayaran">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Tanggal Penerimaan</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary text-secondary fw-bold" id="tanggalPenerimaan">
                                        <!-- MEMUNCULKAN PEMBAYAR DENGAN JS -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">Bukti</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <img id="buktiPembayaran" class="imageModalDetail">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">File Penerimaan</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <embed type="application/pdf" id="buktiFilePenerimaan" width="100%" height="600px">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="mb-0">File Dokumen Ajuan</h6>
                                    </div>
                                    <div class="col-sm-6 text-secondary">
                                        <embed type="application/pdf" id="buktiFileDokumen" width="100%" height="600px">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>