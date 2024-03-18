<?php
include 'databases.php';

$penggunaDatabase = new Pengguna($koneksi);

if (isset($_POST['Masuk'])) {
    $emailNamaPengguna = htmlspecialchars($_POST['Nama_Pengguna_Email']);
    $kataSandi = htmlspecialchars($_POST['Kata_Sandi']);
    $kodeCaptcha = htmlspecialchars($_POST['Kode_Captcha']);

    if (empty($emailNamaPengguna) || empty($kataSandi) || empty($kodeCaptcha)) {
        setPesanKesalahan("Semua field harus diisi.");
        header("Location: $akarUrl" . "src/user/pages/login.php");
        exit();
    }

    if ($kodeCaptcha !== $_SESSION['captcha']) {
        setPesanKesalahan("Kode Captcha yang Anda masukkan salah.");
        header("Location: $akarUrl" . "src/user/pages/login.php");
        exit();
    }

    $pengguna = $penggunaDatabase->autentikasiPengguna($emailNamaPengguna, $kataSandi);
    $perusahaan = $penggunaDatabase->autentikasiPerusahaan($emailNamaPengguna, $kataSandi);

    if ($pengguna === null && $perusahaan === null) {
        setPesanKesalahan("Maaf, email atau kata sandi yang Anda masukkan tidak ditemukan.");
        header("Location: $akarUrl" . "src/user/pages/login.php");
        exit();
    }

    if ($pengguna !== null) {
        $_SESSION['ID'] = htmlspecialchars($pengguna['ID_pengguna']);
        $_SESSION['Nama_Pengguna'] = htmlspecialchars($pengguna['Nama_Pengguna_Email']);

        if ($ingatSaya) {
            $_SESSION['Ingat_Saya_ID'] = $pengguna['ID_pengguna'];
            $_SESSION['Ingat_Saya_Nama_Pengguna'] = $pengguna['Nama_Pengguna_Email'];
        }
    }

    if ($perusahaan !== null) {
        $_SESSION['ID_Perusahaan'] = htmlspecialchars($perusahaan['ID_perusahaan']);
        $_SESSION['Nama_Perusahaan'] = htmlspecialchars($perusahaan['Nama_Pengguna_Email']);

        if ($ingatSaya) {
            $_SESSION['Ingat_Saya_ID_Perusahaan'] = $perusahaan['ID_perusahaan'];
            $_SESSION['Ingat_Saya_Nama_Perusahaan'] = $perusahaan['Nama_Pengguna_Email'];
        }
    }

    setPesanKeberhasilan("Selamat datang, " . $_SESSION['Nama_Pengguna']);
    if (isset($_SESSION['Nama_Perusahaan'])) {
        setPesanKeberhasilan("Selamat datang " . $_SESSION['Nama_Perusahaan'] . "!");
    }

    header("Location: $akarUrl" . "src/user/pages/main.php");
    exit();
}

$captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
$_SESSION['captcha'] = $captcha;
