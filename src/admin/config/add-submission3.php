<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $informasiDibutuhkan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Informasi_Keagamaan_Yang_Dibutuhkan']));

    $objekKegiatanKeagamaan = new Pengajuan($koneksi);
    $pesanKesalahan = '';

    $nomorHPFormatted = preg_replace('/^(\d{3})(\d{4})(\d{4})$/', '+62 $1-$2-$3', $nomorHP);

    $suratPermintaanFile = $_FILES['Surat_Yang_Ditandatangani_Keagamaan'];
    $namaSuratPermintaan = mysqli_real_escape_string($koneksi, htmlspecialchars($suratPermintaanFile['name']));
    $suratPermintaanTemp = $suratPermintaanFile['tmp_name'];
    $ukuranSuratPermintaan = $suratPermintaanFile['size'];
    $errorSuratPermintaan = $suratPermintaanFile['error'];

    $ukuranMaksimal = 2 * 1024 * 1024;
    $formatDisetujui = ['jpg', 'jpeg', 'png'];
    $formatSuratPermintaan = strtolower(pathinfo($namaSuratPermintaan, PATHINFO_EXTENSION));
    $suratPermintaanBaru = uniqid() . '.' . $formatSuratPermintaan;
    $lokasiPenyimpananSurat = '../assets/image/uploads/' . $suratPermintaanBaru;

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    $dataKeagamaan = array(
        'Nama' => $nama,
        'No_Telepon' => $nomorHPFormatted,
        'Email' => $email,
        'Informasi_Keagamaan_Yang_Dibutuhkan' => $informasiDibutuhkan,
        'Surat_Yang_Ditandatangani_Keagamaan' => $suratPermintaanBaru
    );

    $simpanDataKeagamaan = $objekKegiatanKeagamaan->tambahDataKeagamaan($dataKeagamaan);

    if ($simpanDataKeagamaan) {
        setPesanKeberhasilan("Data kegiatan keagamaan berhasil ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menambahkan data kegiatan keagamaan.");
    }

    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}