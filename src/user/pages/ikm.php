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
                    <h3 class="text-black">Data Diri</h3>
                </div>
                <div class="col-md-4 p-0 text-center">
                    <span class="dot step-two">
                        <box-icon name='user-plus' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                    </span>
                    <h3 class="text-black">Jenis Layanan Yang Dipilih</h3>
                </div>
                <div class="col-md-4 p-0 text-center">
                    <span class="dot step-three">
                        <box-icon name='user-plus' id="icon" color='rgba(255,255,255,0.9)'></box-icon>
                    </span>
                    <h3 class="text-black">Layanan Gempa Bumi</h3>
                </div>
            </div>
            <form action="" method="POST">
                <div class="row form justify-content-between mx-5" id="DataDiri">
                    <div class="col-md-4 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="Nama" placeholder="Adr***">
                            <label for="floatingInput">Nama</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="form-floating">
                            <select class="form-control" id="floatingInput" name="JenisKelamin">
                                <option selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <label for="floatingInput">Jenis Kelamin</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
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
                    <div class="col-md-4 mb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" name="NIK" placeholder="">
                            <label for="floatingInput">NIK</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingInput" name="Umur" placeholder="">
                            <label for="floatingInput">Umur</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="Pekerjaan" placeholder="">
                            <label for="floatingInput">Pekerjaan</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-floating">
                            <select class="form-control" id="floatingInput" name="Koresponden">
                                <option selected>Pilih Koresponden</option>
                                <option value="Masyarakat_Umum">Masyarakat Umum</option>
                                <option value="Instansi">Instansi</option>
                            </select>
                            <label for="floatingInput">Koresponden</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="form-floating">
                            <select class="form-control" id="floatingInput" name="JenisLayanan">
                                <option selected>Pilih Jenis Layanan</option>
                                <option value="Informasi">Informasi</option>
                                <option value="Jasa">Jasa</option>
                            </select>
                            <label for="floatingInput">Jenis Layanan</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 text-center">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="AsalDaerah" placeholder="">
                            <label for="floatingInput">Asal Daerah</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center mt-5">
                            <button type="button" class="btn btn-primary w-50" id="selanjutnya">Selanjutnya</button>
                        </div>
                    </div>
                </div>
                <div class="row form justify-content-center" id="JenisLayanan" style="display: none;">
                    <table class="table table-striped text-start w-50 mx-auto">
                        <tbody class="align-middle">
                            <tr>
                                <th colspan="2">
                                    <h6>METEOROLOGI</h6>
                                </th>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="1">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_1" name="c_1">
                                </td>
                                <td>Informasi cuaca publik (rutin, peringatan, dini cuaca, pasang surut air laut)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="2">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_2" name="c_2">
                                </td>
                                <td>Informasi cuaca khusus (maritim, penerbangan, klaim asuransi)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="3">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_3" name="c_3">
                                </td>
                                <td>Analisis cuaca (kecelakaan pesawat, kecelakaan kapal laut)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="4">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_4" name="c_4">
                                </td>
                                <td>Informasi titik panas(hotspot)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="5">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_5" name="c_5">
                                </td>
                                <td>lnformasi tentang tingkat kemudahan terjadinya kebakaran hutan dan lahan</td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <h6>KLIMATOLOGI</h6>
                                </th>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="6">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_6" name="c_6">
                                </td>
                                <td>Prakiraan musim</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="7">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_7" name="c_7">
                                </td>
                                <td>lnformasi iklim khusus</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="8">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_8" name="c_8">
                                </td>
                                <td>Analisis dan prakiraan curah hujan bulanan/dasarian</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="9">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_9" name="c_9">
                                </td>
                                <td>Tren curah hujan</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="10">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_10" name="c_10">
                                </td>
                                <td>lnformasi kualitas udara</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="11">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_11" name="c_11">
                                </td>
                                <td>Analisis iklim ekstrim</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="12">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_12" name="c_12">
                                </td>
                                <td>Informasi iklim terapan (peta potensi energi baru terbarukan, informasi potensi DBD, dst)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="13">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_13" name="c_13">
                                </td>
                                <td>Informasi perubahan iklim (keterpaparan dan/atau proveksi)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="14">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_14" name="c_14">
                                </td>
                                <td>Pengambilan dan pengujian sampel parameter iklim dan kualitas udara(laboratorium)</td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <h6>GEOFISIKA</h6>
                                </th>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="15">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_15" name="c_15">
                                </td>
                                <td>Informasi gempabumi dan peringatan dini tsunami</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="16">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_16" name="c_16">
                                </td>
                                <td>Peta seismisitas</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="17">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_17" name="c_17">
                                </td>
                                <td>lnformasi tanda waktu(hilal dan gerhana)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="18">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_18" name="c_18">
                                </td>
                                <td>lnformasi geofisika potensial(gravitasi, magnet bumi, dan hari guruh/petir)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="19">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_19" name="c_19">
                                </td>
                                <td>Peta rendaman tsunami</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="20">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_20" name="c_20">
                                </td>
                                <td>Informasi seismologi teknik(shake map)(peta mikrozonasi dan percepatan tanah)</td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <h6>INSTRUMENTASI</h6>
                                </th>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="21">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_21" name="c_21">
                                </td>
                                <td>Data meteorologi, klimatologi, dan geofisika(suhu, curah hujan, angin, dan grid)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="22">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_22" name="c_22">
                                </td>
                                <td>Kalibrasi (peralatan MKG)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="23">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_23" name="c_23">
                                </td>
                                <td>Konsultasi(untuk penerapan informasi khusus MKG)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="24">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_24" name="c_24">
                                </td>
                                <td>Sewa peralatan MKG</td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <h6>HUMAS</h6>
                                </th>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="25">
                                    <input class="form-check-input border border-primary" type="checkbox" value="" id="c_25" name="c_25">
                                </td>
                                <td>Kunjungan</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center mt-5">
                            <button type="button" class="btn btn-primary w-50" id="selanjutnya1">Selanjutnya</button>
                        </div>
                    </div>
                </div>
                <div class="row form" id="UnsurPelayanan" style="display: none;">
                    <div class="container-fluid w-100 unsur-pelayanan headkuis">
                        <div class="row justify-content-around" id="kuisioner_pt1">
                            <div class="col-md-12">
                                <h2 class="title text-center my-5">Unsur Pelayanan</h2>
                                <div class="row">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Persyaratan pelayanan jelas dan terbuka</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt1" id="inlineRadio3_1" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt1" id="inlineRadio4_1" value="option4">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt2" id="inlineRadio3_2" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis1_pt2" id="inlineRadio4_2" value="option4">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Persyaratan pelayanan mudah dan dipenuhi</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis2_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Dibutuhkan dalam kehidupan sehari-hari</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis3_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Mudah diakses</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis4_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Mudah dipahami</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio1_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis5_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Akurat</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis6_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Ketersediaan jenis data dan informasi</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt1" id="inlineRadio3_1" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt1" id="inlineRadio4_1" value="option4">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt2" id="inlineRadio3_2" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis7_pt2" id="inlineRadio3_2" value="option4">
                                                    <label class="form-check-label" for="inlineRadio3_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5 text-center">
                                <button class="btn btn-primary py-2 px-2" id="btn_next1"><box-icon name='right-arrow' color='rgba(255,255,255,0.9)'></box-icon></button>
                            </div>
                        </div>
                        <div class="row justify-content-around" id="kuisioner_pt2" style="display: none;">
                            <div class="col-md-12">
                                <h2 class="title text-center my-5">Unsur Pelayanan</h2>
                                <div class="row">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Alur pelayanan jelas dan sederhana</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis8_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis8_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis8_pt1" id="inlineRadio3_1" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis8_pt1" id="inlineRadio4_1" value="option4">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Sistem dan prosedur pelayanan masih berpeluang menimbulkan KKN</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis9_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis9_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis9_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis9_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Informasi target waktu penyelesaian pelayanan jelas</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis10_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Penyelesaian pelayanan sesuai dengan target waktu</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis11_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Biaya pelayanan jelas dan terbuka</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio1_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis12_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Informasi daftar produk atau jasa layanan terbuka dan jelas</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis13_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Sarana pengaduan atau keluhan pelayanan publik tersedia</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt1" id="inlineRadio3_1" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt1" id="inlineRadio4_1" value="option4">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt2" id="inlineRadio3_2" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis14_pt2" id="inlineRadio3_2" value="option4">
                                                    <label class="form-check-label" for="inlineRadio3_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5 text-center">
                                <button class="btn btn-primary py-2 px-2" type="button" id="btn_next2"><box-icon name='right-arrow' color='rgba(255,255,255,0.9)'></box-icon></button>
                            </div>
                        </div>
                        <div class="row justify-content-around" id="kuisioner_pt3" style="display: none;">
                            <div class="col-md-12">
                                <h2 class="title text-center my-5">Unsur Pelayanan</h2>
                                <div class="row">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Prosedur dan tindak lanjut penanganan pengaduan jelas</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt1" id="inlineRadio3_1" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt1" id="inlineRadio4_1" value="option4">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt2" id="inlineRadio3_2" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis15_pt2" id="inlineRadio3_2" value="option4">
                                                    <label class="form-check-label" for="inlineRadio3_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Keberadaan petugas layanan jelas</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt2" id="inlineRadio3_2" value="option3">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis16_pt2" id="inlineRadio3_2" value="option4">
                                                    <label class="form-check-label" for="inlineRadio3_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Petugas sigap, ahli, dan cekatan</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis17_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Sikap dan perilaku petugas pelayanan baik dan bertanggungjawab</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis18_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 px-2 py-2 bodykuis1">
                                        <h5 class="kuisioner">Sarana dan prasarana pelayanan aman, nyaman, dan mudah dijangkau</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio1_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis19_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-2 py-2 bodykuis2">
                                        <h5 class="kuisioner">Pelayanan publik pada instansi ini sudah berjalan dengan baik</h5>
                                        <div class="row mt-2 py-2">
                                            <div class="col-md-3 mb-2">
                                                <span class="kategori1">Kualitas Pelayanan</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt1" id="inlineRadio1_1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_1">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt1" id="inlineRadio2_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_1">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt1" id="inlineRadio3_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_1">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt1" id="inlineRadio4_1" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_1">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt2" id="inlineRadio1_2" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1_2">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt2" id="inlineRadio2_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2_2">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt2" id="inlineRadio3_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio3_2">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Kuis20_pt2" id="inlineRadio4_2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio4_2">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary w-50" id="submit-ikm">Submit Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="../assets/js/ikm.js"></script>
</body>

</html>