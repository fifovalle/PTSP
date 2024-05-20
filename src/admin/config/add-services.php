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
    $fotoJasa = $_FILES['Foto_Jasa'];
    $namaJasa = filter_input(INPUT_POST, 'Nama_Jasa', FILTER_SANITIZE_STRING);
    $deskripsiJasa = filter_input(INPUT_POST, 'Deskripsi_Jasa', FILTER_SANITIZE_STRING);
    $hargaJasa = filter_input(INPUT_POST, 'Harga_Jasa', FILTER_SANITIZE_STRING);
    $pemilikJasa = filter_input(INPUT_POST, 'Pemilik_Jasa', FILTER_SANITIZE_STRING);
    $noRekening = filter_input(INPUT_POST, 'No_Rekening_Jasa', FILTER_SANITIZE_STRING);
    $kategoriJasa = filter_input(INPUT_POST, 'Kategori_Jasa', FILTER_SANITIZE_STRING);
    $statusJasa = filter_input(INPUT_POST, 'Status_Jasa', FILTER_SANITIZE_STRING);

    $jasaModel = new Jasa($koneksi);

    $pesanKesalahan = '';

    if ($pemilikJasa === 'Instansi A') {
        $nomorRekeningJasa = '1111';
    } elseif ($pemilikJasa === 'Instansi B') {
        $nomorRekeningJasa = '2222';
    } elseif ($pemilikJasa === 'Instansi C') {
        $nomorRekeningJasa = '3333';
    } else {
        $pesanKesalahan .= "Instansi tidak valid. ";
    }

    $nomorRekeningJasaFormatted = $nomorRekeningJasa;

    $namaFotoJasa = $fotoJasa['name'];
    $tempFotoJasa = $fotoJasa['tmp_name'];
    $ukuranFotoJasa = $fotoJasa['size'];
    $errorFotoJasa = $fotoJasa['error'];

    $tujuanFotoJasa = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    if (containsXSS($namaDepan) || containsXSS($namaBelakang) || containsXSS($namaPengguna) || containsXSS($email) || containsXSS($kataSandi) || containsXSS($konfirmasiKataSandi) || containsXSS($nomorTelepon) || containsXSS($jenisKelamin) || containsXSS($peranAdmin) || containsXSS($alamatAdmin)) {
        $pesanKesalahan .= "Input mengandung Serangan XSS, Saya tau anda ingin mennghack web saya 😡👿. ";
    }

    if (($errorFotoJasa === 0 && !empty($namaFotoJasa)) && ($ukuranFotoJasa <= $ukuranMaksimal)) {
        $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
        $formatFotoJasa = strtolower(pathinfo($namaFotoJasa, PATHINFO_EXTENSION));

        if (in_array($formatFotoJasa, $formatYangDisetujui)) {
            $namaFotoJasaBaru = uniqid() . '.' . $formatFotoJasa;
            $tujuanFotoJasa = '../assets/image/uploads/' . $namaFotoJasaBaru;
            $berhasilDiupload = move_uploaded_file($tempFotoJasa, $tujuanFotoJasa);

            if (!$berhasilDiupload) {
                $pesanKesalahan .= "Gagal mengupload foto jasa. ";
            }
        } else {
            $pesanKesalahan .= "Format foto jasa harus berupa JPG, JPEG, atau PNG. ";
        }
    } else {
        $pesanKesalahan .= "Gagal mengupload foto jasa atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB. ";
    }

    if (containsXSS($namaDepan) || containsXSS($namaBelakang) || containsXSS($namaPengguna) || containsXSS($email) || containsXSS($kataSandi) || containsXSS($konfirmasiKataSandi) || containsXSS($nomorTelepon) || containsXSS($jenisKelamin) || containsXSS($peranAdmin) || containsXSS($alamatAdmin)) {
        $pesanKesalahan .= "Input mengandung Serangan XSS, Saya tau anda ingin mennghack web saya 😡👿. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }

    $dataJasa = array(
        'Foto_Jasa' => $namaFotoJasaBaru,
        'Nama_Jasa' => $namaJasa,
        'Deskripsi_Jasa' => $deskripsiJasa,
        'Harga_Jasa' => $hargaJasa,
        'Pemilik_Jasa' => $pemilikJasa,
        'No_Rekening_Jasa' => $nomorRekeningJasaFormatted,
        'Kategori_Jasa' => $kategoriJasa,
        'Status_Jasa' => $statusJasa
    );

    $simpanDataJasa = $jasaModel->tambahJasa($dataJasa);

    if ($simpanDataJasa) {
        setPesanKeberhasilan("Data jasa berhasil disimpan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data jasa.");
    }
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
}
