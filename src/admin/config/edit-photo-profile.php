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
    if (isset($_FILES['Foto_Admin'])) {
        $fotoAdmin = $_FILES['Foto_Admin'];

        $namaFotoAdmin = $fotoAdmin['name'];
        $fotoAdminTemp = $fotoAdmin['tmp_name'];
        $ukuranFotoAdmin = $fotoAdmin['size'];
        $errorFotoAdmin = $fotoAdmin['error'];

        $tujuanFotoAdmin = '../assets/image/uploads/';
        $ukuranMaksimal = 2 * 1024 * 1024;

        if ($errorFotoAdmin === 0 && !empty($namaFotoAdmin) && $ukuranFotoAdmin <= $ukuranMaksimal) {
            $ekstensi = pathinfo($namaFotoAdmin, PATHINFO_EXTENSION);
            $namaFotoBaru = uniqid() . '.' . $ekstensi;
            $tujuanFileBaru = $tujuanFotoAdmin . $namaFotoBaru;

            if (move_uploaded_file($fotoAdminTemp, $tujuanFileBaru)) {
                $obyekAdmin = new Admin($koneksi);
                $idAdmin = $_SESSION['ID'];

                $namaFotoLama = $obyekAdmin->getFotoAdminById($idAdmin);

                if (!empty($namaFotoLama)) {
                    $pathFotoLama = $tujuanFotoAdmin . $namaFotoLama;
                    if (file_exists($pathFotoLama)) {
                        unlink($pathFotoLama);
                    }
                }

                $dataAdmin = array(
                    'Foto' => $namaFotoBaru
                );

                $statusPerbarui = $obyekAdmin->perbaruiPhotoProfile($idAdmin, $dataAdmin);

                if ($statusPerbarui) {
                    setPesanKeberhasilan("Foto profil berhasil diperbarui.");
                } else {
                    setPesanKesalahan("Gagal memperbarui foto profil.");
                }
            } else {
                setPesanKesalahan("Gagal mengunggah file.");
            }
        } else {
            setPesanKesalahan("Unggah file gagal. Pastikan file berukuran maksimal 2MB dan dalam format yang benar (JPG, JPEG, atau PNG).");
        }
    } else {
        setPesanKesalahan("Tidak ada file yang diunggah.");
    }
}

header("Location: $akarUrl/src/admin/pages/data.php");
exit;
