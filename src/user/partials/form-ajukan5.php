<form class="row form g-3" action="../../../src/admin/config/add-submission5.php" method="POST" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="container my-4" id="TitleForm">
            <h4><b>Form Kegiatan Pendidikan dan Penelitian Non Komersil</b></h4>
        </div>
    </div>
    <div class="container my-3" id="DataPribadi">
        <div class="row">
            <h4 class="header mb-4">Data Pribadi</h4>
            <div class="col-md-6">
                <label for="nameInput">Nama</label>
                <input type="text" class="form-control my-3" id="Nama" name="Nama" placeholder="Masukkan Nama" style="height: 40px" autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="nameInput">NIM / KTP</label>
                <input type="text" class="form-control my-3" id="NIM_atau_KTP" name="NIM_atau_KTP" placeholder="Masukkan NIM / KTP" style="height: 40px" autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="nameInput">Program Studi / Fakultas</label>
                <input type="text" class="form-control my-3" id="Program_Studi_atau_Fakultas" name="Program_Studi_atau_Fakultas" placeholder="Masukkan Program Studi / Fakultas" style="height: 40px" autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="nameInput">Universitas / Instansi</label>
                <input type="text" class="form-control my-3" id="Universitas_atau_Instansi" name="Universitas_atau_Instansi" placeholder="Masukkan Universitas / Instansi" style="height: 40px" autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="phonenumberInput">Nomor Handphone</label>
                <div class="input-group my-3" style="height: 40px">
                    <span class="input-group-text spanNumberData">+62</span>
                    <input type="number" placeholder="Masukkan Nomor Handphone" class="form-control inputData" id="No_HP" name="No_HP" autocomplete="off" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control my-3" id="Email" name="Email" placeholder="Masukkan Email" style="height: 40px" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="container my-3" id="DataKeperluan">
        <div class="row">
            <h4 class="header mb-4">Data Keperluan</h4>
            <div class="col-md-6">
                <label for="suratpengantarInput">Identitas Diri KTP / KTM / SIM / Paspor</label>
                <input type="file" class="form-control my-3" id="Identitas_Diri" name="Identitas_Diri" style="height: 40px" autocomplete="off">
            </div>
            <div class="col-md-6">
                <div class="label-container">
                    <label for="suratpengantarInput" class="label-text">Surat Pengantar dari Kepala Sekolah / Rektor / Dekan</label>
                    <div class="button-container">
                        <button class="info-button" type="button" data-bs-toggle="modal" data-bs-target="#SuratPengantar">
                            <box-icon name='info-circle'></box-icon>
                        </button>
                    </div>
                </div>
                <input type="file" class="form-control my-3" id="Surat_Pengantar" name="Surat_Pengantar" style="height: 40px" autocomplete="off">
            </div>
            <div class="col-md-6">
                <div class="label-container">
                    <label for="suratpengantarInput" class="label-text">Surat Pernyataan Tidak Digunakan Untuk Kepentingan Lain</label>
                    <div class="button-container">
                        <button class="info-button" type="button" data-bs-toggle="modal" data-bs-target="#SuratPernyataan">
                            <box-icon name='info-circle'></box-icon>
                        </button>
                    </div>
                </div>
                <input type="file" class="form-control my-3" id="Surat_Pernyataan" name="Surat_Pernyataan" style="height: 40px" autocomplete="off">
            </div>
            <div class="col-md-6">
                <label for="suratpengantarInput">Proposal Penelitian Berisi Maksud dan Tujuan Penelitian yang Telah Disetujui</label>
                <input type="file" class="form-control my-3" id="Proposal_Penelitian" name="Proposal_Penelitian" style="height: 40px" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <button class="apply" type="submit" name="Apply">
            Ajukan Sekarang
            <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</form>

<!-- Modal Info Surat Pengantar -->
<div class="modal fade" id="SuratPengantar" aria-labelledby="SuratPengantarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" id="modalSuratPengantar">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="SuratPengantarLabel">Contoh Surat Pengantar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="../assets/img/Form Surat Pengantar.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</div>
<!-- End Modal Info Surat Pengantar -->

<!-- Modal Info Surat Pengantar -->
<div class="modal fade" id="SuratPernyataan" aria-labelledby="SuratPernyataanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" id="modalSuratPernyataan">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="SuratPernyataanLabel">Contoh Surat Pernyataan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="../assets/img/Form Surat Pernyataan.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</div>
<!-- End Modal Info Surat Pengantar -->