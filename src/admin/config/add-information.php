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
    $fotoInformasi = $_FILES['Foto_Informasi'];
    $namaInformasi = filter_input(INPUT_POST, 'Nama_Informasi', FILTER_SANITIZE_STRING);
    $deskripsiInformasi = filter_input(INPUT_POST, 'Deskripsi_Informasi', FILTER_SANITIZE_STRING);
    $hargaInformasi = filter_input(INPUT_POST, 'Harga_Informasi', FILTER_SANITIZE_NUMBER_INT);
    $pemilikInformasi = filter_input(INPUT_POST, 'Pemilik_Informasi', FILTER_SANITIZE_STRING);
    $noRekening = filter_input(INPUT_POST, 'No_Rekening_Informasi', FILTER_SANITIZE_STRING);
    $kategoriInformasi = filter_input(INPUT_POST, 'Kategori_Informasi', FILTER_SANITIZE_STRING);
    $statusInformasi = filter_input(INPUT_POST, 'Status_Informasi', FILTER_SANITIZE_STRING);

    $namaInformasi = $purifier->purify($namaInformasi);
    $deskripsiInformasi = $purifier->purify($deskripsiInformasi);

    $informasiModel = new Informasi($koneksi);

    $pesanKesalahan = '';

    if ($pemilikInformasi === 'Instansi A') {
        $nomorRekeningInformasi = '1111';
    } elseif ($pemilikInformasi === 'Instansi B') {
        $nomorRekeningInformasi = '2222';
    } elseif ($pemilikInformasi === 'Instansi C') {
        $nomorRekeningInformasi = '3333';
    } else {
        $pesanKesalahan .= "Instansi tidak valid. ";
    }

    $nomorRekeningInformasiFormatted = $nomorRekeningInformasi;


    $namaFotoInformasi = $fotoInformasi['name'];
    $tempFotoInformasi = $fotoInformasi['tmp_name'];
    $ukuranFotoInformasi = $fotoInformasi['size'];
    $errorFotoInformasi = $fotoInformasi['error'];

    $tujuanFotoInformasi = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    if (($errorFotoInformasi === 0 && !empty($namaFotoInformasi)) && ($ukuranFotoInformasi <= $ukuranMaksimal)) {
        $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
        $formatFotoInformasi = strtolower(pathinfo($namaFotoInformasi, PATHINFO_EXTENSION));

        if (in_array($formatFotoInformasi, $formatYangDisetujui)) {
            $namaFotoInformasiBaru = uniqid() . '.' . $formatFotoInformasi;
            $tujuanFotoInformasi = '../assets/image/uploads/' . $namaFotoInformasiBaru;
            $berhasilDiupload = move_uploaded_file($tempFotoInformasi, $tujuanFotoInformasi);

            if (!$berhasilDiupload) {
                $pesanKesalahan .= "Gagal mengupload foto informasi. ";
            }
        } else {
            $pesanKesalahan .= "Format foto informasi harus berupa JPG, JPEG, atau PNG. ";
        }
    } else {
        $pesanKesalahan .= "Gagal mengupload foto informasi atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB. ";
    }

    if (containsXSS($namaDepan) || containsXSS($namaBelakang) || containsXSS($namaPengguna) || containsXSS($email) || containsXSS($kataSandi) || containsXSS($konfirmasiKataSandi) || containsXSS($nomorTelepon) || containsXSS($jenisKelamin) || containsXSS($peranAdmin) || containsXSS($alamatAdmin)) {
        $pesanKesalahan .= "Input mengandung Serangan XSS, Saya tau anda ingin mennghack web saya 😡👿. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }

    $dataInformasi = array(
        'Foto_Informasi' => $namaFotoInformasiBaru,
        'Nama_Informasi' => $namaInformasi,
        'Deskripsi_Informasi' => $deskripsiInformasi,
        'Harga_Informasi' => $hargaInformasi,
        'Pemilik_Informasi' => $pemilikInformasi,
        'No_Rekening_Informasi' => $nomorRekeningInformasiFormatted,
        'Kategori_Informasi' => $kategoriInformasi,
        'Status_Informasi' => $statusInformasi
    );

    $simpanDataInformasi = $informasiModel->tambahInformasi($dataInformasi);

    if ($simpanDataInformasi) {
        setPesanKeberhasilan("Data informasi berhasil disimpan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data informasi.");
    }
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
}
