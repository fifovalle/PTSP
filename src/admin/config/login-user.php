<?php
include 'databases.php';

$penggunaDatabase = new Pengguna($koneksi);

if (isset($_POST['Masuk'])) {
    $emailNamaPengguna = filter_input(INPUT_POST, 'Nama_Pengguna_Email', FILTER_SANITIZE_EMAIL);
    $kataSandi = filter_input(INPUT_POST, 'Kata_Sandi', FILTER_SANITIZE_STRING);
    $kodeCaptcha = filter_input(INPUT_POST, 'Kode_Captcha', FILTER_SANITIZE_STRING);

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
        $_SESSION['ID_Pengguna'] = htmlspecialchars($pengguna['ID_Pengguna']);
        $_SESSION['Foto_Pengguna'] = htmlspecialchars($pengguna['Foto']);
        $_SESSION['Nama_Pengguna'] = htmlspecialchars($pengguna['Nama_Pengguna']);
        $_SESSION['Nama_Depan_Pengguna'] = htmlspecialchars($pengguna['Nama_Depan_Pengguna']);
        $_SESSION['Nama_Belakang_Pengguna'] = htmlspecialchars($pengguna['Nama_Belakang_Pengguna']);
        $_SESSION['No_Identitas_Pengguna'] = htmlspecialchars($pengguna['No_Identitas_Pengguna']);
        $_SESSION['Pendidikan_Terakhir_Pengguna'] = htmlspecialchars($pengguna['Pendidikan_Terakhir_Pengguna']);
        $_SESSION['Alamat_Pengguna'] = htmlspecialchars($pengguna['Alamat_Pengguna']);
        $_SESSION['Email_Pengguna'] = htmlspecialchars($pengguna['Email_Pengguna']);
        $_SESSION['Pekerjaan_Pengguna'] = htmlspecialchars($pengguna['Pekerjaan_Pengguna']);
        $_SESSION['NPWP_Pengguna'] = htmlspecialchars($pengguna['NPWP_Pengguna']);
        $_SESSION['Jenis_Kelamin_Pengguna'] = htmlspecialchars($pengguna['Jenis_Kelamin_Pengguna']);
        $_SESSION['No_Telepon_Pengguna'] = htmlspecialchars($pengguna['No_Telepon_Pengguna']);

        if ($ingatSaya) {
            $_SESSION['Ingat_Saya_ID'] = $pengguna['ID_pengguna'];
            $_SESSION['Ingat_Saya_Nama_Pengguna'] = $pengguna['Nama_Pengguna_Email'];
        }
    }

    if ($perusahaan !== null) {
        $_SESSION['ID_Perusahaan'] = htmlspecialchars($perusahaan['ID_Perusahaan']);
        $_SESSION['Foto_Perusahaan'] = htmlspecialchars($perusahaan['Foto_Perusahaan']);
        $_SESSION['Nama_Perusahaan'] = htmlspecialchars($perusahaan['Nama_Perusahaan']);
        $_SESSION['Nama_Depan_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Nama_Depan_Anggota_Perusahaan']);
        $_SESSION['Nama_Belakang_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Nama_Belakang_Anggota_Perusahaan']);
        $_SESSION['No_Identitas_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['No_Identitas_Anggota_Perusahaan']);
        $_SESSION['Pendidikan_Terakhir_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Pendidikan_Terakhir_Anggota_Perusahaan']);
        $_SESSION['Alamat_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Alamat_Anggota_Perusahaan']);
        $_SESSION['Email_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Email_Anggota_Perusahaan']);
        $_SESSION['Pekerjaan_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Pekerjaan_Anggota_Perusahaan']);
        $_SESSION['No_NPWP'] = htmlspecialchars($perusahaan['No_NPWP']);
        $_SESSION['Jenis_Kelamin_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Jenis_Kelamin_Anggota_Perusahaan']);
        $_SESSION['No_Telepon_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['No_Telepon_Anggota_Perusahaan']);
        $_SESSION['Nama_Pengguna_Anggota_Perusahaan'] = htmlspecialchars($perusahaan['Nama_Pengguna_Anggota_Perusahaan']);

        if ($ingatSaya) {
            $_SESSION['Ingat_Saya_ID_Perusahaan'] = $perusahaan['ID_perusahaan'];
            $_SESSION['Ingat_Saya_Nama_Perusahaan'] = $perusahaan['Nama_Pengguna_Email'];
        }
    }

    setPesanKeberhasilan("Selamat datang, " . $_SESSION['Nama_Pengguna']);
    if (isset($_SESSION['Nama_Perusahaan'])) {
        setPesanKeberhasilan("Selamat datang Perusahaan, " . $_SESSION['Nama_Perusahaan'] . "!");
    }

    header("Location: $akarUrl" . "src/user/pages/main.php");
    exit();
}

$captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
$_SESSION['captcha'] = $captcha;
