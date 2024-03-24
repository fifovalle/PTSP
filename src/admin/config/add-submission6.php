<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $dataInformasi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Data_dan_Informasi_Yang_Dibutuhkan']));

    $objekPemerintah = new Pengajuan($koneksi);
    $pesanKesalahan = '';

    $nomorHPFormatted = preg_replace('/^(\d{3})(\d{4})(\d{4})$/', '+62 $1-$2-$3', $nomorHP);

    $suratKerjaSamaBmkg = $_FILES['Mempunyai_Perjanjian_Kerjasama_dengan_BMKG'];
    $namaSurat = mysqli_real_escape_string($koneksi, htmlspecialchars($suratKerjaSamaBmkg['name']));
    $suratBmkgTemp = $suratKerjaSamaBmkg['tmp_name'];
    $ukuranSuratKerjaSama = $suratKerjaSamaBmkg['size'];
    $errorSuratBmkg = $suratKerjaSamaBmkg['error'];

    $suratPengantarFile = $_FILES['Surat_Pengantar'];
    $namaSuratPengantar = mysqli_real_escape_string($koneksi, htmlspecialchars($suratPengantarFile['name']));
    $suratPengantarTemp = $suratPengantarFile['tmp_name'];
    $ukuranSuratPengantar = $suratPengantarFile['size'];
    $errorSuratPengantar = $suratPengantarFile['error'];

    $ukuranMaksimal = 5 * 1024 * 1024;
    $formatDisetujui = ['jpg', 'jpeg', 'png', 'pdf'];

    $formatBmkg = strtolower(pathinfo($namaSurat, PATHINFO_EXTENSION));
    $formatPengantar = strtolower(pathinfo($namaSuratPengantar, PATHINFO_EXTENSION));

    $suratKerjaSama = uniqid() . '.' . $formatBmkg;
    $lokasiSuratBmkg = '../assets/image/uploads/' . $suratKerjaSama;

    $suratPengantarBaru = uniqid() . '.' . $formatPengantar;
    $lokasiPenyimpananPengantar = '../assets/image/uploads/' . $suratPengantarBaru;

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    $data = array(
        'Nama_Pusat_Daerah' => $nama,
        'No_Telepon_Pusat_Daerah' => $nomorHPFormatted,
        'Email_Pusat_Daerah' => $email,
        'Informasi_Pusat_Daerah_Yang_Dibutuhkan' => $dataInformasi,
        'Memiliki_Kerja_Sama_Dengan_BMKG' => $suratKerjaSama,
        'Surat_Pengantar_Pusat_Daerah' => $suratPengantarBaru
    );

    $simpanData = $objekPemerintah->tambahDataPusatDaerah($data);

    if ($simpanData) {
        setPesanKeberhasilan("Data berhasil ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menambahkan data.");
    }

    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}
