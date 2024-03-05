<form class="row form g-3" action="" method="POST">
    <div class="col-md-12">
        <div class="container my-4" id="TitleForm">
            <h4><b>Form Pelayanban Informasi dengan Tarif PNBP</b></h4>
        </div>
    </div>
    <div class="container my-3" id="DataPribadi">
        <div class="row">
            <h4 class="header mb-4">Data Pribadi</h4>
            <div class="col-md-6">
                <label for="nameInput">Nama</label>
                <input type="text" class="form-control my-3" id="Nama" name="Nama" placeholder="Masukkan Nama" style="height: 40px">
            </div>
            <div class="col-md-6">
                <label for="phonenumberInput">Nomor Handphone</label>
                <input type="tel" class="form-control my-3" id="No_HP" name="No_HP" placeholder="Masukkan Nomor Handphone" style="height: 40px">
            </div>
            <div class="col-md-6">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control my-3" id="Email" name="Email" placeholder="Masukkan Email" style="height: 40px">
            </div>
        </div>
    </div>
    <div class="container my-3" id="DataKeperluan">
        <div class="row">
            <h4 class="header mb-4">Data Keperluan</h4>
            <div class="col-md-6">
                <label for="informasidataInput">Data Informasi yang Dibutuhkan</label>
                <input type="text" class="form-control my-3" id="Data_dan_Informasi_Yang_Dibutuhkan" name="Data_dan_Informasi_Yang_Dibutuhkan" placeholder="Masukkan Data Informasi yang Dibutuhkan" style="height: 40px">
            </div>
            <div class="col-md-6">
                <label for="suratpengantarInput">Identitas (KTP)</label>
                <input type="file" class="form-control my-3" id="Identitas_(KTP)" name="Identitas_(KTP)" style="height: 40px">
            </div>
            <div class="col-md-6">
                <label for="suratpengantarInput">Surat Pengantar</label>
                <input type="file" class="form-control my-3" id="Surat_Pengantar" name="Surat_Pengantar" style="height: 40px">
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <button class="apply" type="submit">
            Apply Now
            <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</form>