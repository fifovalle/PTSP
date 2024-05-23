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
    if (isset($_FILES['Foto'])) {
        $foto = $_FILES['Foto'];

        $namaFoto = $foto['name'];
        $fotoTemp = $foto['tmp_name'];
        $ukuranFoto = $foto['size'];
        $errorFoto = $foto['error'];

        $tujuanFoto = '../assets/image/uploads/';
        $ukuranMaksimal = 2 * 1024 * 1024;

        if ($errorFoto === 0 && !empty($namaFoto) && $ukuranFoto <= $ukuranMaksimal) {
            $ekstensi = pathinfo($namaFoto, PATHINFO_EXTENSION);
            $namaFotoBaru = uniqid() . '.' . $ekstensi;
            $tujuanFileBaru = $tujuanFoto . $namaFotoBaru;

            if (move_uploaded_file($fotoTemp, $tujuanFileBaru)) {
                if (isset($_SESSION['ID_Pengguna'])) {
                    $obyek = new Pengguna($koneksi);
                    $id = $_SESSION['ID_Pengguna'];
                    $namaFieldFoto = 'Foto';
                    $namaFotoLama = $obyek->getFotoPenggunaById($id);
                } elseif (isset($_SESSION['ID_Perusahaan'])) {
                    $obyek = new Pengguna($koneksi);
                    $id = $_SESSION['ID_Perusahaan'];
                    $namaFieldFoto = 'Foto_Perusahaan';
                    $namaFotoLama = $obyek->getFotoPerusahaanById($id);
                }

                if (!empty($namaFotoLama)) {
                    $pathFotoLama = $tujuanFoto . $namaFotoLama;
                    if (file_exists($pathFotoLama)) {
                        unlink($pathFotoLama);
                    }
                }

                $data = array(
                    $namaFieldFoto => $namaFotoBaru
                );

                if (isset($_SESSION['ID_Pengguna'])) {
                    $statusPerbarui = $obyek->perbaruiFotoPengguna($id, $data);
                } elseif (isset($_SESSION['ID_Perusahaan'])) {
                    $statusPerbarui = $obyek->perbaruiFotoPerusahaan($id, $data);
                }

                if ($statusPerbarui) {
                    setPesanKeberhasilan("Foto profil berhasil diperbarui, Silahkan Login kembali.");
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

header("Location: $akarUrl/src/user/pages/profile.php");
exit;
