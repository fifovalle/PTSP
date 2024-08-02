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

if (isset($_POST['Apply'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $nama = filter_input(INPUT_POST, 'Nama', FILTER_SANITIZE_STRING);
    $nomorHP = filter_input(INPUT_POST, 'No_HP', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    $objekDataPusatDanDaerah = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        $tujuanFolder = '../assets/image/uploads/';
        $suratPerjanjian = uploadFile('Mempunyai_Perjanjian_Kerjasama_dengan_BMKG', $tujuanFolder);
        $suratPengantarBaru = uploadFile('Surat_Pengantar', $tujuanFolder);

        if ($suratPerjanjian === false || $suratPengantarBaru === false) {
            setPesanKesalahan("Gagal mengupload file. Hanya diperbolehkan file dengan format PDF, Word, atau Excel.");
            header("Location: $akarUrl" . "src/user/pages/ajukan.php");
            exit();
        }

        $dataPusat = array(
            'Nama_Pusat_Daerah' => $nama,
            'No_Telepon_Pusat_Daerah' => $nomorTeleponFormatted,
            'Email_Pusat_Daerah' => $email,
            'Memiliki_Kerja_Sama_Dengan_BMKG' => $suratPerjanjian,
            'Surat_Pengantar_Pusat_Daerah' => $suratPengantarBaru,
        );

        $simpanDataPusat = $objekDataPusatDanDaerah->tambahDataPusatDaerah($dataPusat);

        $dataPengajuanPusat = array(
            'ID_Pusat_Daerah' => $objekDataPusatDanDaerah->ambilIDPusatTerakhir(),
            'Status_Pengajuan' => 'Sedang Ditinjau',
            'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
        );

        $simpanDataPengajuanPusat = $objekDataPusatDanDaerah->tambahDataPengajuanPusat($dataPengajuanPusat);

        $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
        $simpanDataTransaksiPengajuanPusat = $obyekDataTransaksi->perbaharuiPengajuanPusatKeTransaksiSesuaiSession($dataPengajuanPusat, $idSession);

        if ($simpanDataPusat && $simpanDataPengajuanPusat && $simpanDataTransaksiPengajuanPusat) {
            setPesanKeberhasilan("Data kegiatan berhasil dikirim harap menunggu konfirmasi oleh admin.");
            header("Location: $akarUrl" . "src/user/pages/pesanan.php");
            exit();
        } else {
            setPesanKesalahan("Gagal menambahkan data.");
            header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
            exit();
        }
    } else {
        setPesanKesalahan("Silahkan memilih katalog produk terlebih dahulu");
        header("Location: $akarUrl" . "src/user/pages/katalogproduk.php");
        exit();
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit();
}

function uploadFile($fileInputName, $targetFolder)
{
    $ekstensiValid = array('pdf', 'doc', 'docx', 'xls', 'xlsx');
    $fileInfo = pathinfo($_FILES[$fileInputName]['name']);
    $ekstensiFile = strtolower($fileInfo['extension']);

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        return false;
    }

    $namaFileBaru = uniqid() . '_' . basename($_FILES[$fileInputName]['name']);
    $tujuanFile = $targetFolder . $namaFileBaru;

    if (!move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $tujuanFile)) {
        return false;
    }

    return $namaFileBaru;
}
