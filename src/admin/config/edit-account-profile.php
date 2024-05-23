<?php
include 'databases.php';

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
    $idAdmin = filter_input(INPUT_POST, 'ID_Admin', FILTER_SANITIZE_STRING);
    $namaDepan = filter_input(INPUT_POST, 'Nama_Depan_Admin', FILTER_SANITIZE_STRING);
    $namaBelakang = filter_input(INPUT_POST, 'Nama_Belakang_Admin', FILTER_SANITIZE_STRING);
    $namaPengguna = filter_input(INPUT_POST, 'Nama_Pengguna_Admin', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'Email_Admin', FILTER_VALIDATE_EMAIL);
    $nomorTelepon = filter_input(INPUT_POST, 'No_Telepon_Admin', FILTER_SANITIZE_STRING);
    $alamatAdmin = filter_input(INPUT_POST, 'Alamat_Admin', FILTER_SANITIZE_STRING);

    $obyekAdmin = new Admin($koneksi);

    $nomorTeleponFormatted = $nomorTelepon;

    if (strpos($nomorTeleponFormatted, '-') === false) {
        $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . '-' . substr($nomorTeleponFormatted, 3, 4) . '-' . substr($nomorTeleponFormatted, 7);
    }

    if (strpos($nomorTeleponFormatted, '+62') === false) {
        $nomorTeleponFormatted = '+62 ' . $nomorTeleponFormatted;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesanKesalahan .= "Format email tidak valid. ";
    }

    if (empty($namaDepan) || empty($namaBelakang) || empty($namaPengguna) || empty($email) || empty($nomorTelepon) || empty($alamatAdmin)) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    }

    $dataAdmin = array(
        'Nama_Depan_Admin' => $namaDepan,
        'Nama_Belakang_Admin' => $namaBelakang,
        'Nama_Pengguna_Admin' => $namaPengguna,
        'Email_Admin' => $email,
        'No_Telepon_Admin' =>  $nomorTeleponFormatted,
        'Alamat_Admin' => $alamatAdmin
    );

    $statusPerbarui = $obyekAdmin->perbaruiProfile($idAdmin, $dataAdmin);

    if ($statusPerbarui) {
        setPesanKeberhasilan("Data admin berhasil diperbarui.");
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    } else {
        setPesanKesalahan("Gagal memperbarui data admin.");
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    }
} else {
    header("Location: $akarUrl/src/admin/pages/data.php");
    exit;
}
