<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);
$overallSuccess = true;

$fileAtemp = $_FILES['File_Instansi_A']['tmp_name'];
$namaFileA = $_FILES['File_Instansi_A']['name'];
$ukuranFileA = $_FILES['File_Instansi_A']['size'];
$errorFileA = $_FILES['File_Instansi_A']['error'];

$fileBtemp = $_FILES['File_Instansi_B']['tmp_name'];
$namaFileB = $_FILES['File_Instansi_B']['name'];
$ukuranFileB = $_FILES['File_Instansi_B']['size'];
$errorFileB = $_FILES['File_Instansi_B']['error'];

$fileCtemp = $_FILES['File_Instansi_C']['tmp_name'];
$namaFileC = $_FILES['File_Instansi_C']['name'];
$ukuranFileC = $_FILES['File_Instansi_C']['size'];
$errorFileC = $_FILES['File_Instansi_C']['error'];

if ($errorFileA === 0) {
    $tujuanFileA = '../assets/image/uploads/';
    $tujuanFileBaruA = $tujuanFileA . uniqid() . '_' . $namaFileA;

    if (move_uploaded_file($fileAtemp, $tujuanFileBaruA)) {
        foreach ($_POST['id_instansi_a'] as $idInstansiA) {
            $transaksi->uploadFileBuktiPembayaran($tujuanFileBaruA, $idInstansiA);
        }
        setPesanKeberhasilan("File untuk Instansi A berhasil diunggah.");
    } else {
        setPesanKesalahan("Gagal mengunggah file untuk Instansi A.");
        $overallSuccess = false;
    }
} else {
    setPesanKesalahan("Gagal mengunggah file untuk Instansi A. Error: $errorFileA");
    $overallSuccess = false;
}

if ($errorFileB === 0) {
    $tujuanFileB = '../assets/image/uploads/';
    $tujuanFileBaruB = $tujuanFileB . uniqid() . '_' . $namaFileB;

    if (move_uploaded_file($fileBtemp, $tujuanFileBaruB)) {
        foreach ($_POST['id_instansi_b'] as $idInstansiB) {
            $transaksi->uploadFileBuktiPembayaran($tujuanFileBaruB, $idInstansiB);
        }
        setPesanKeberhasilan("File untuk Instansi B berhasil diunggah.");
    } else {
        setPesanKesalahan("Gagal mengunggah file untuk Instansi B.");
        $overallSuccess = false;
    }
} else {
    setPesanKesalahan("Gagal mengunggah file untuk Instansi B. Error: $errorFileB");
    $overallSuccess = false;
}

if ($errorFileC === 0) {
    $tujuanFileC = '../assets/image/uploads/';
    $tujuanFileBaruC = $tujuanFileC . uniqid() . '_' . $namaFileC;

    if (move_uploaded_file($fileCtemp, $tujuanFileBaruC)) {
        foreach ($_POST['id_instansi_c'] as $idInstansiC) {
            $transaksi->uploadFileBuktiPembayaran($tujuanFileBaruC, $idInstansiC);
        }
        setPesanKeberhasilan("File untuk Instansi C berhasil diunggah.");
    } else {
        setPesanKesalahan("Gagal mengunggah file untuk Instansi C.");
        $overallSuccess = false;
    }
} else {
    setPesanKesalahan("Gagal mengunggah file untuk Instansi C. Error: $errorFileC");
    $overallSuccess = false;
}

if ($overallSuccess) {
    setPesanKeberhasilan("Semua file berhasil diunggah.");
} else {
    setPesanKesalahan("Beberapa file gagal diunggah.");
}

header("Location: $akarUrl/src/user/pages/pesanan.php");
exit;
