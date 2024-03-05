<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="../assets/css/ikm.css">
    <script src="../assets/js/javascript.js"></script>
    <title>PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <header class="" data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark mx-4 my-3 p-0">
            <div class="container-fluid" id="box-navbar">
                <a class="d-flex navbar-brand">
                    <img src="../assets/img/Logo PTSP1.png" alt="Logo PTSP BMKG Provinsi Bengkulu" width="100" height="50">
                    <h4 class="m-0 p-2 text-black">INDEKS KEPUASAN MASYARAKAT</h4>
                </a>
            </div>
        </nav>
    </header>
    <main class="mb-5">
        <div class="container-fluid p-0">
            <h4 class="text-center mt-5">SURVEY KEPUASAN MASYARAKAT</h4>
            <div class="row category">
                <div class="col-md-4 p-0 text-center">
                    <span class="dot step-one selected">
                        <box-icon name='user' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                    </span>
                    <h3 class="text-white">Data Diri</h3>
                </div>
                <div class="col-md-4 p-0 text-center">
                    <span class="dot step-two">
                        <box-icon name='user-plus' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                    </span>
                    <h3 class="text-white">Layanan Informasi</h3>
                </div>
                <div class="col-md-4 p-0 text-center">
                    <span class="dot step-three">
                        <box-icon name='user-plus' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                    </span>
                    <h3 class="text-white">Layanan Gempa Bumi</h3>
                </div>
            </div>
            <form action="" method="POST">
                <div class="row form" id="DataDiri">
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="Nama" placeholder="Adr***">
                            <label for="floatingInput">Nama</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select class="form-control" id="floatingInput" name="PendidikanTerakhir">
                                <option selected>Pilih Pendidikan Terakhir</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="S1">S1 (Sarjana)</option>
                                <option value="S2">S2 (Magister)</option>
                            </select>
                            <label for="floatingInput">Pendidikan Terakhir</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingInput" name="Date" placeholder="">
                            <label for="floatingInput">Tanggal</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="Pekerjaan" placeholder="">
                            <label for="floatingInput">Pekerjaan Utama</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" name="Umur" placeholder="">
                            <label for="floatingInput">Umur</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="NamaInstansi" placeholder="">
                            <label for="floatingInput">Nama Instansi</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select class="form-control" id="floatingInput" name="JenisKelamin">
                                <option selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <label for="floatingInput">Jenis Kelamin</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select class="form-control" id="floatingInput" name="JenisLayanan">
                                <option selected>Pilih Jenis Layanan</option>
                                <option value="Informasi">Informasi</option>
                                <option value="Jasa">Jasa</option>
                            </select>
                            <label for="floatingInput">Jenis Layanan</label>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-6 mb-4 text-center">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="AsalDaerah" placeholder="">
                            <label for="floatingInput">Asal Daerah</label>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center mt-3">
                            <button type="button" class="btn btn-primary w-50" id="selanjutnya">Selanjutnya</button>
                        </div>
                    </div>
                </div>
                <div class="row form" id="LayananInformasi" style="display: none;">
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                1. Persyaratan pelayanan terbuka, jelas, dan mudah dipenuhi
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                2. Informasi yang diperoleh dibutuhkan dalam kehidupan sehari-hari
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                3. Informasi yang diperoleh mudah diakses, dipahami, dan akurat
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                4. Ketersediaan jenis data dan informasi yang diperoleh beragam
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                5. Alur pelayanan serta system prosedur jelas, sederhana dan bebas KKN
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                6. Penyelesaian pelayanan serta biaya pelayanan sesuai dengan target waktu, jelas dan terbuka
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                7. Informasi daftar produk/jasa layanan public tersedia
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                8. Sarana pengaduan/keluhan pelayanan public tersedia
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                9. Prosedur dan tindak lanjut penanganan pengaduan jelas
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                10. Keberadaan petugas pelayanan serta informasi target waktu penyelesaian jelas
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                11. Petugas sigap, ahli dan cekatan serta sikap dan perilaku petugas pelayana baik dan bertanggung jawab
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                12. Sarana dan prasarana pelayanan aman, nyaman dan mudah dijangkau
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                13. Pelayanan public pada instansi ini sudah berjalan dengan baik
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Setuju">
                                        <label class="form-check-label" for="inlineRadio1">Setuju</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="TidakSetuju">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Setuju</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="button" class="btn btn-primary w-50" id="selanjutnya1">Selanjutnya</button>
                        </div>
                    </div>
                </div>
                <div class="row form" id="LayananGempaBumi" style="display: none;">
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                1. Apakah anda pernah merasakan guncangan gempabumi di wilayah sekitar anda?
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Tidak Pernah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Jarang</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                        <label class="form-check-label" for="inlineRadio2">Kadang-kadang</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="4">
                                        <label class="form-check-label" for="inlineRadio2">Sering</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5">
                                        <label class="form-check-label" for="inlineRadio2">Sangat Sering</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                2. Informasi yang diperoleh dibutuhkan dalam kehidupan sehari-hari
                            </a>
                            <ul class="dropdown-menu px-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Tidak Penting</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">Tidak Terlalu Penting</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                    <label class="form-check-label" for="inlineRadio2">Netral</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="4">
                                    <label class="form-check-label" for="inlineRadio2">Penting</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5">
                                    <label class="form-check-label" for="inlineRadio2">Sangat Penting</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                3. Melalui moda/sarana apa anda menerima informasi gempabumi atau peringatan dini tsunami?
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Televisi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Aplikasi ponsel atau situs web</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                        <label class="form-check-label" for="inlineRadio2">Sistem peringatan otomatis</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="4">
                                        <label class="form-check-label" for="inlineRadio2">Langsung dari pihak berwenang setempat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5">
                                        <label class="form-check-label" for="inlineRadio2">Lainnya</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                4. Seberapa cepat anda menerima informasi gempabumi atau peringatan dini tsunami setelah gempa?
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Sangat Lambat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Lambat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                        <label class="form-check-label" for="inlineRadio2">Sedang</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="4">
                                        <label class="form-check-label" for="inlineRadio2">Cepat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5">
                                        <label class="form-check-label" for="inlineRadio2">Segera</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                5. Apakah informasi gempabumi atau peringatan dini tsunami tersebut dapat dipahami?
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Sangat Sulit Dipahami</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Sulit Dipahami</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                        <label class="form-check-label" for="inlineRadio2">Netral</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="4">
                                        <label class="form-check-label" for="inlineRadio2">Mudah Dipahami</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5">
                                        <label class="form-check-label" for="inlineRadio2">Sangat Mudah Dipahami</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="dropdown questioner">
                            <a class="btn question btn-secondary dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                6. Bagaimana anda merespon informasi gempabumi atau peringatan dini tsunami?
                            </a>
                            <ul class="dropdown-menu px-5">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mb-3" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Tidak melakukan tindakan apa pun, mengabaikan informasi</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mb-3" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Menanyakan bantuan dari pihak berwenang atau ahli</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mb-3" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="3">
                                        <label class="form-check-label" for="inlineRadio2">Tetap tenang dan siap menghadapi situasi
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="4">
                                        <label class="form-check-label" for="inlineRadio2">Memeriksa informasi lebih lanjut sebelum mengambil tindakan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="5">
                                        <label class="form-check-label" for="inlineRadio2">Evakuasi segera ke tempat yang aman
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="submit" class="btn btn-primary w-50" id="submit-ikm">Submit Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="../assets/js/ikm.js"></script>
</body>

</html>