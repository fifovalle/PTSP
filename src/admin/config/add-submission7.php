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

    $objekDataTarif = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        $tujuanFolder = '../assets/image/uploads/';
        $suratKTP = uploadFile('Identitas_KTP', $tujuanFolder, true);
        $suratPengantarBaru = uploadFile('Surat_Pengantar', $tujuanFolder);

        if ($suratKTP === false || $suratPengantarBaru === false) {
            setPesanKesalahan("Gagal mengupload file. Hanya diperbolehkan file dengan format PDF, Word, atau Excel.");
            header("Location: $akarUrl" . "src/user/pages/ajukan.php");
            exit();
        }

        $dataTarif = array(
            'Nama_PNBP' => $nama,
            'No_Telepon_PNBP' => $nomorTeleponFormatted,
            'Email_PNBP' => $email,
            'Identitas_KTP_PNBP' => $suratKTP,
            'Surat_Pengantar_PNBP' => $suratPengantarBaru,
        );

        $simpanDataTarif = $objekDataTarif->tambahInformasiPNBP($dataTarif);

        $dataPengajuanTarif = array(
            'ID_Tarif' => $objekDataTarif->ambilIDTarfiTerakhir(),
            'Status_Pengajuan' => 'Sedang Ditinjau',
            'Apakah_Gratis' => '0',
            'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
        );

        $simpanDataPengajuanTarif = $objekDataTarif->tambahDataPengajuanTarif($dataPengajuanTarif);

        $dataPengajuanTarif = array(
            'ID_Pengajuan' => $objekDataTarif->ambilIDPengajuanTerakhir(),
        );

        $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
        $simpanDataTransaksiPengajuanTarif = $obyekDataTransaksi->perbaharuiPengajuanTarifKeTransaksiSesuaiSession($dataPengajuanTarif, $idSession);

        if ($simpanDataTarif && $simpanDataPengajuanTarif && $simpanDataTransaksiPengajuanTarif) {
            setPesanKeberhasilan("Data kegiatan berhasil dikirim harap menunggu konfirmasi oleh admin.");
            header("Location: $akarUrl" . "src/user/pages/pesanan.php");
            exit();
        } else {
            setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan sosial.");
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

function uploadFile($fileInputName, $targetFolder, $isKTP = false)
{
    $ekstensiValidKTP = array('jpg', 'jpeg', 'png');
    $ekstensiValidOther = array('pdf', 'doc', 'docx', 'xls', 'xlsx');

    $fileInfo = pathinfo($_FILES[$fileInputName]['name']);
    $ekstensiFile = strtolower($fileInfo['extension']);

    if ($isKTP) {
        $ekstensiValid = $ekstensiValidKTP;
    } else {
        $ekstensiValid = $ekstensiValidOther;
    }

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

$suratKTP = uploadFile('Identitas_KTP', $tujuanFolder, true);
$suratPengantarBaru = uploadFile('Surat_Pengantar', $tujuanFolder);
