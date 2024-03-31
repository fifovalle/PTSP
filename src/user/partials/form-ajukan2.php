<form class="row form g-3" action="../../../src/admin/config/add-submission2.php" method="POST" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="container my-4" id="TitleForm">
            <h4><b>Form Kegiatan Sosial</b></h4>
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
                <label for="phonenumberInput">Nomor Handphone</label>
                <div class="input-group my-3" style="height: 40px">
                    <span class="input-group-text spanNumberData">+62</span>
                    <input type="number" placeholder="Masukkan Nomor Handphone" class="form-control inputData" id="No_HP" name="No_HP" autocomplete="off">
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
            <div class="col-md-12">
                <label for="suratpengantarInput">Surat Permintaan Ditandatangani Camat atau Pejabat Setingkat</label>
                <input type="file" class="form-control my-3" id="Surat_Permintaan_Ditandatangani_Camat_atau_Pejabat_Setingkat" name="Surat_Pengantar_Permintaan_Data" style="height: 40px" autocomplete="off">
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