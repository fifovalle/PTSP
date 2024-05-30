<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'databases.php';
require '../../../vendor/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/src/SMTP.php';

function containsXSS($input)
{
    $xss_patterns = [
        "/<script\b[^>]*>(.*?)<\/script>/is",
        "/<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:/i",
        "/<iframe\b[^>]*>(.*?)<\/iframe>/is",
        "/<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:/i",
        "/<object\b[^>]*>(.*?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<script\b[^>]*>[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
        "/<a\b[^>]*href\s*=\s*(?:\"|')(?:javascript:|.*?\"javascript:).*?(?:\"|')/i",
        "/<embed\b[^>]*>(.*?)<\/embed>/is",
        "/<applet\b[^>]*>(.*?)<\/applet>/is",
        "/<!--.*?-->/",
        "/(<script\b[^>]*>(.*?)<\/script>|<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:|<iframe\b[^>]*>(.*?)<\/iframe>|<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:|<object\b[^>]*>(.*?)<\/object>|on[a-zA-Z]+\s*=\s*\"[^\"]*\"|<[^>]*(>|$)(?:<|>)+|<[^>]*script\s*.*?(?:>|$)|<![^>]*-->|eval\s*\((.*?)\)|setTimeout\s*\((.*?)\)|<[^>]*\bstyle\s*=\s*[\"'][^\"']*[;{][^\"']*['\"]|<meta[^>]*http-equiv=[\"']?refresh[\"']?[^>]*url=|<[^>]*src\s*=\s*\"[^>]*\"[^>]*>|expression\s*\((.*?)\))/i"
    ];

    foreach ($xss_patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }

    return false;
}

if (isset($_POST['Simpan'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $namaDepan = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama_Depan_Admin', FILTER_SANITIZE_STRING));
    $namaBelakang = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama_Belakang_Admin', FILTER_SANITIZE_STRING));
    $namaPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama_Pengguna_Admin', FILTER_SANITIZE_STRING));
    $email = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Email_Admin', FILTER_SANITIZE_EMAIL));
    $kataSandi = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Kata_Sandi', FILTER_SANITIZE_STRING));
    $konfirmasiKataSandi = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Konfirmasi_Kata_Sandi', FILTER_SANITIZE_STRING));
    $nomorTelepon = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'No_Telepon_Admin', FILTER_SANITIZE_STRING));
    $jenisKelamin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jenis_Kelamin_Admin', FILTER_SANITIZE_STRING));
    $peranAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Peran_Admin', FILTER_SANITIZE_STRING));
    $alamatAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Alamat_Admin', FILTER_SANITIZE_STRING));
    $obyekAdmin = new Admin($koneksi);
    do {
        $token = random_int(10000000, 99999999);
        $tokenSudahAda = $obyekAdmin->getAdminByToken($token);
    } while ($tokenSudahAda);

    $pesanKesalahan = '';

    $nomorTeleponFormatted = '+62 ' . substr($nomorTelepon, 0, 3) . '-' . substr($nomorTelepon, 4, 4) . '-' . substr($nomorTelepon, 7);

    if (empty($namaDepan) || empty($namaBelakang) || empty($namaPengguna) || empty($email) || empty($kataSandi) || empty($konfirmasiKataSandi) || empty($nomorTelepon) || empty($jenisKelamin) || empty($peranAdmin) || empty($alamatAdmin)) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

    $panjangKataSandi = strlen($kataSandi) >= 8;
    $persyaratanKataSandi = preg_match('/[A-Z]/', $kataSandi) && preg_match('/[a-z]/', $kataSandi) && preg_match('/[0-9]/', $kataSandi) && preg_match('/[^A-Za-z0-9]/', $kataSandi);
    $kataSandiYangValid = $panjangKataSandi && $persyaratanKataSandi;
    $pesanKesalahan .= (!$kataSandiYangValid && empty($pesanKesalahan)) ? "Kata sandi harus memiliki setidaknya 8 karakter dan mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu simbol." : '';

    $kecocokanKataSandi = $kataSandi === $konfirmasiKataSandi;
    $pesanKesalahan .= (!$kecocokanKataSandi && empty($pesanKesalahan)) ? "Kata sandi dan konfirmasi kata sandi harus sama." : '';

    $hashKataSandi = password_hash($kataSandi, PASSWORD_DEFAULT);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesanKesalahan .= "Format email tidak valid. ";
    }

    if (!is_numeric($nomorTelepon)) {
        $pesanKesalahan .= "Nomor telepon hanya boleh berisi angka. ";
    }


    $fotoAdmin = $_FILES['Foto_Admin'];

    $namaFotoAdmin = mysqli_real_escape_string($koneksi, htmlspecialchars($fotoAdmin['name']));
    $fotoAdminTemp = $fotoAdmin['tmp_name'];
    $ukuranFotoAdmin = $fotoAdmin['size'];
    $errorFotoAdmin = $fotoAdmin['error'];

    $tujuanFotoAdmin = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    $apakahaUnggahBerhasil = ($errorFotoAdmin === 0 && !empty($namaFotoAdmin)) && ($ukuranFotoAdmin <= $ukuranMaksimal);
    $pesanKesalahan .= (!$apakahaUnggahBerhasil && empty($pesanKesalahan)) ? "Gagal mengupload foto admin atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB." : '';

    $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
    $formatFoto = strtolower(pathinfo($namaFotoAdmin, PATHINFO_EXTENSION));
    $apakahFormatDisetujui = in_array($formatFoto, $formatYangDisetujui);
    $pesanKesalahan .= (!$apakahFormatDisetujui && empty($pesanKesalahan)) ? "Format foto harus berupa JPG, JPEG, atau PNG." : '';

    $namaFotoAdminBaru = $apakahFormatDisetujui ? uniqid() . '.' . $formatFoto : '';

    $tujuanFotoAdmin = $apakahFormatDisetujui ? '../assets/image/uploads/' . $namaFotoAdminBaru : '';

    $apakahBerhasilDipindahkan = $apakahFormatDisetujui ? move_uploaded_file($fotoAdminTemp, $tujuanFotoAdmin) : false;
    $pesanKesalahan .= (!$apakahBerhasilDipindahkan && empty($pesanKesalahan)) ? "Gagal mengupload foto admin." : '';

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }

    if ($obyekAdmin->cekEmailSudahAda($email)) {
        setPesanKesalahan("Email yang dimasukkan sudah terdaftar.");
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }

    if ($obyekAdmin->cekNamaPenggunaAdminSudahAda($namaPengguna)) {
        setPesanKesalahan("Nama Pengguna Admin yang dimasukkan sudah terdaftar.");
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }

    $dataAdmin = array(
        'Foto' => $namaFotoAdminBaru,
        'Nama_Depan_Admin' => $namaDepan,
        'Nama_Belakang_Admin' => $namaBelakang,
        'Nama_Pengguna_Admin' => $namaPengguna,
        'Email_Admin' => $email,
        'Kata_Sandi' => $hashKataSandi,
        'Konfirmasi_Kata_Sandi' => $hashKataSandi,
        'No_Telepon_Admin' => $nomorTeleponFormatted,
        'Jenis_Kelamin_Admin' => $jenisKelamin,
        'Peran_Admin' => $peranAdmin,
        'Alamat_Admin' => $alamatAdmin,
        'Status_Verifikasi_Admin' => "Belum Terverifikasi",
        'Token' => $token
    );

    $simpanDataAdmin = $obyekAdmin->tambahAdmin($dataAdmin);

    if ($simpanDataAdmin) {
        require '../../../vendor/autoload.php';
        $mail = new PHPMailer(true);
        include 'send-verification-email.php';
    } else {
        setPesanKesalahan("Gagal menyimpan data admin.");
    }
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
}
