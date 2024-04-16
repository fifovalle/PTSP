<?php
include '../../admin/config/databases.php';
?>
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
    <link rel="icon" href="../../admin/assets/image/logo/1.png">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
                    <h3 class="text-black">Penilaian Layanan</h3>
                </div>
            </div>
            <form action="../../../src/admin/config/add-ikm.php" method="POST">
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
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
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
                                <option value="Masyarakat Umum">Masyarakat Umum</option>
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
                                    <input class="form-check-input border border-primary" type="checkbox" value="Informasi cuaca publik" id="c_1" name="c_1">
                                </td>
                                <td>Informasi cuaca publik (rutin, peringatan, dini cuaca, pasang surut air laut)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="2">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Informasi cuaca khusus" id="c_2" name="c_2">
                                </td>
                                <td>Informasi cuaca khusus (maritim, penerbangan, klaim asuransi)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="3">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Analisis cuaca" id="c_3" name="c_3">
                                </td>
                                <td>Analisis cuaca (kecelakaan pesawat, kecelakaan kapal laut)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="4">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Informasi titik" id="c_4" name="c_4">
                                </td>
                                <td>Informasi titik panas(hotspot)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="5">
                                    <input class="form-check-input border border-primary" type="checkbox" value="lnformasi tentang tingkat kemudahan terjadinya kebakaran hutan dan lahan" id="c_5" name="c_5">
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
                                    <input class="form-check-input border border-primary" type="checkbox" value="Prakiraan musim" id="c_6" name="c_6">
                                </td>
                                <td>Prakiraan musim</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="7">
                                    <input class="form-check-input border border-primary" type="checkbox" value="lnformasi iklim khusus" id="c_7" name="c_7">
                                </td>
                                <td>lnformasi iklim khusus</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="8">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Analisis dan prakiraan curah hujan bulanan/dasarian" id="c_8" name="c_8">
                                </td>
                                <td>Analisis dan prakiraan curah hujan bulanan/dasarian</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="9">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Tren curah hujan" id="c_9" name="c_9">
                                </td>
                                <td>Tren curah hujan</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="10">
                                    <input class="form-check-input border border-primary" type="checkbox" value="lnformasi kualitas udara" id="c_10" name="c_10">
                                </td>
                                <td>lnformasi kualitas udara</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="11">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Analisis iklim ekstrim" id="c_11" name="c_11">
                                </td>
                                <td>Analisis iklim ekstrim</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="12">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Informasi iklim terapan" id="c_12" name="c_12">
                                </td>
                                <td>Informasi iklim terapan (peta potensi energi baru terbarukan, informasi potensi DBD, dst)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="13">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Informasi perubahan iklim" id="c_13" name="c_13">
                                </td>
                                <td>Informasi perubahan iklim (keterpaparan dan/atau proveksi)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="14">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Pengambilan dan pengujian sampel parameter iklim dan kualitas udara(laboratorium)" id="c_14" name="c_14">
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
                                    <input class="form-check-input border border-primary" type="checkbox" value="Informasi gempabumi dan peringatan dini tsunami" id="c_15" name="c_15">
                                </td>
                                <td>Informasi gempabumi dan peringatan dini tsunami</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="16">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Peta seismisitas" id="c_16" name="c_16">
                                </td>
                                <td>Peta seismisitas</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="17">
                                    <input class="form-check-input border border-primary" type="checkbox" value="lnformasi tanda waktu" id="c_17" name="c_17">
                                </td>
                                <td>lnformasi tanda waktu(hilal dan gerhana)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="18">
                                    <input class="form-check-input border border-primary" type="checkbox" value="lnformasi geofisika potensial" id="c_18" name="c_18">
                                </td>
                                <td>lnformasi geofisika potensial(gravitasi, magnet bumi, dan hari guruh/petir)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="19">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Peta rendaman tsunami" id="c_19" name="c_19">
                                </td>
                                <td>Peta rendaman tsunami</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="20">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Informasi seismologi teknik" id="c_20" name="c_20">
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
                                    <input class="form-check-input border border-primary" type="checkbox" value="Data meteorologi, klimatologi, dan geofisika" id="c_21" name="c_21">
                                </td>
                                <td>Data meteorologi, klimatologi, dan geofisika(suhu, curah hujan, angin, dan grid)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="22">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Kalibrasi" id="c_22" name="c_22">
                                </td>
                                <td>Kalibrasi (peralatan MKG)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="23">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Konsultasi" id="c_23" name="c_23">
                                </td>
                                <td>Konsultasi(untuk penerapan informasi khusus MKG)</td>
                            </tr>
                            <tr>
                                <td class="c-frame text-center" scope="24">
                                    <input class="form-check-input border border-primary" type="checkbox" value="Sewa peralatan MKG" id="c_24" name="c_24">
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
                                    <input class="form-check-input border border-primary" type="checkbox" value="Kunjungan" id="c_25" name="c_25">
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
                            <div class="col-md-12 p-0">
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Terbuka" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Terbuka" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Terbuka" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Terbuka" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Terbuka" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Terbuka" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Terbuka" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Terbuka" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Persyaratan" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Persyaratan" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Persyaratan" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Persyaratan" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Persyaratan" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Persyaratan" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Persyaratan" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Persyaratan" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Kehidupan" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Kehidupan" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Kehidupan" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Kehidupan" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Kehidupan" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Kehidupan" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Kehidupan" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Kehidupan" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Diakses" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Diakses" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Diakses" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Diakses" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Diakses" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Diakses" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Diakses" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Diakses" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Dipahami" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Dipahami" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Dipahami" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Dipahami" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Dipahami" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Dipahami" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Dipahami" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Dipahami" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Akurat" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Akurat" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Akurat" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Akurat" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Akurat" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Akurat" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Akurat" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Akurat" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Data" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Data" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Data" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Data" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Data" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Data" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Data" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Data" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4 text-center">
                                <button class="d-flex btn btn-primary py-2 px-2 mx-auto" id="btn_next1">
                                    <box-icon name='right-arrow' color='rgba(255,255,255,0.9)'>
                                    </box-icon>
                                </button>
                            </div>
                        </div>
                        <div class="row justify-content-around" id="kuisioner_pt2" style="display: none;">
                            <div class="col-md-12 p-0">
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sederhana" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sederhana" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sederhana" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sederhana" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_KKN" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_KKN" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_KKN" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_KKN" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Waktu" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Waktu" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Waktu" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Waktu" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Waktu" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Waktu" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Waktu" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Waktu" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sesuai" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sesuai" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sesuai" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sesuai" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sesuai" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sesuai" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sesuai" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sesuai" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Biaya_Terbuka" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Biaya_Terbuka" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Biaya_Terbuka" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Biaya_Terbuka" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Biaya_Terbuka" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Biaya_Terbuka" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Biaya_Terbuka" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Biaya_Terbuka" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Daftar" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Daftar" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Daftar" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Daftar" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Daftar" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Daftar" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Daftar" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Daftar" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sarana" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sarana" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sarana" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sarana" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sarana" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sarana" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sarana" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sarana" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4 text-center">
                                <button class="d-flex btn btn-primary py-2 px-2 mx-auto" id="btn_next2">
                                    <box-icon name='right-arrow' color='rgba(255,255,255,0.9)'>
                                    </box-icon>
                                </button>
                            </div>
                        </div>
                        <div class="row justify-content-around" id="kuisioner_pt3" style="display: none;">
                            <div class="col-md-12 p-0">
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Prosedur" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Prosedur" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Prosedur" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Prosedur" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Prosedur" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Prosedur" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Prosedur" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Prosedur" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Keberadaan" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Keberadaan" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Keberadaan" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Keberadaan" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Keberadaan" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Keberadaan" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Keberadaan" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Keberadaan" id="inlineRadio3_2" value="option4">
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Petugas" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Petugas" id="Setuju" value=" Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Petugas" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Petugas" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Petugas" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Petugas" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Petugas" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Petugas" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sikap" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sikap" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sikap" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Sikap" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sikap" id="Sangat Penting" value="option1">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sikap" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sikap" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Sikap" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Aman" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Aman" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Aman" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Aman" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Aman" id="Sangat Penting" value="option1">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Aman" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Aman" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Aman" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
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
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Publik" id="Sangat Setuju" value="Sangat Setuju">
                                                    <label class="form-check-label" for="Sangat Setuju">Sangat Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Publik" id="Setuju" value="Setuju">
                                                    <label class="form-check-label" for="Setuju">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Publik" id="Kurang Setuju" value="Kurang Setuju">
                                                    <label class="form-check-label" for="Kurang Setuju">Kurang Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Kualitas_Pelayanan_Publik" id="Tidak Setuju" value="Tidak Setuju">
                                                    <label class="form-check-label" for="Tidak Setuju">Tidak Setuju</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <span class="kategori1">Harapan Konsumen</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Publik" id="Sangat Penting" value="Sangat Penting">
                                                    <label class="form-check-label" for="Sangat Penting">Sangat Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Publik" id="Penting" value="Penting">
                                                    <label class="form-check-label" for="Penting">Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-0">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Publik" id="Kurang Penting" value="Kurang Penting">
                                                    <label class="form-check-label" for="Kurang Penting">Kurang Penting</label>
                                                </div>
                                                <div class="form-check form-check-inline px-3">
                                                    <input class="form-check-input" type="radio" name="Harapan_Konsumen_Publik" id="Tidak Penting" value="Tidak Penting">
                                                    <label class="form-check-label" for="Tidak Penting">Tidak Penting</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary w-50" id="submit-ikm" name="submit">Submit Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="../assets/js/ikm.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>