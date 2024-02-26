<?php
include 'databases.php';
$akarUrl = "http://localhost/PTSP/";
$halamanSaatIni = basename($_SERVER['PHP_SELF']);

$adminDatabase = new Admin($koneksi);

$_SESSION['gagal'] = $_SESSION['gagal'] ?? '';

function setPesanKesalahan($pesan_kesalahan)
{
    $_SESSION['gagal'] = $pesan_kesalahan;
}

function setPesanKeberhasilan($pesan_keberhasilan)
{
    $_SESSION['berhasil'] = $pesan_keberhasilan;
}

if (isset($_POST['Masuk'])) {
    $emailNamaPengguna = $_POST['Email_Nama_Pengguna'];
    $kataSandi = $_POST['Kata_Sandi'];

    if (empty($emailNamaPengguna) || empty($kataSandi)) {
        setPesanKesalahan("Semua field harus diisi.");
        header("Location: $akarUrl" . "src/admin/pages/login.php");
        exit();
    }

    $admin = $adminDatabase->autentikasiAdmin($emailNamaPengguna, $kataSandi);

    if ($admin === null) {
        setPesanKesalahan("Maaf, email atau kata sandi yang Anda masukkan tidak ditemukan. Silakan hubungi admin untuk mendaftar.");
        header("Location: $akarUrl" . "src/admin/pages/login.php");
        exit();
    }

    $_SESSION['ID'] = $admin['ID_Admin'];
    $_SESSION['Foto'] = $admin['Foto'];
    $_SESSION['Nama_Pengguna'] = $admin['Nama_Pengguna_Admin'];
    $_SESSION['Peran_Admin'] = $admin['Peran_Admin'];

    setPesanKeberhasilan("Selamat datang, " . $_SESSION['Nama_Pengguna'] . "!");
    header("Location: $akarUrl" . "public/");
    exit();
}
