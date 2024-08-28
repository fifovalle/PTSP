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

    $objekDataKeagamaan = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['error'] === UPLOAD_ERR_OK) {
            $ekstensiValid = array('pdf', 'doc', 'docx', 'xls', 'xlsx');
            $fileInfo = pathinfo($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['name']);
            $ekstensiFile = strtolower($fileInfo['extension']);

            if (in_array($ekstensiFile, $ekstensiValid)) {
                $tujuanSuratPengantar = '../assets/image/uploads/';
                $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['name']);
                $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

                if (move_uploaded_file($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['tmp_name'], $tujuanFileSuratPengantar)) {
                    $dataKeagamaan = array(
                        'Nama_Keagamaan' => $nama,
                        'No_Telepon_Keagamaan' => $nomorTeleponFormatted,
                        'Email_Keagamaan' => $email,
                        'Surat_Yang_Ditandatangani_Keagamaan' => $namaSuratPengantarBaru
                    );

                    $simpanDataKeagamaan = $objekDataKeagamaan->tambahDataKeagamaan($dataKeagamaan);

                    $dataPengajuanKeagamaan = array(
                        'ID_Keagamaan' => $objekDataKeagamaan->ambilIDKeagamaanTerakhir(),
                        'Status_Pengajuan' => 'Sedang Ditinjau',
                        'Apakah_Gratis' => '1',
                        'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
                    );

                    $simpanDataPengajuanKeagamaan = $objekDataKeagamaan->tambahDataPengajuanKeagamaan($dataPengajuanKeagamaan);

                    $dataPengajuanKeagamaan = array(
                        'ID_Pengajuan' => $objekDataKeagamaan->ambilIDPengajuanTerakhir(),
                    );

                    $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

                    $simpanDataTransaksiPengajuanKeagamaan = $obyekDataTransaksi->perbaharuiPengajuanKeagamaanKeTransaksiSesuaiSession($dataPengajuanKeagamaan, $idSession);

                    if ($simpanDataKeagamaan && $simpanDataPengajuanKeagamaan && $simpanDataTransaksiPengajuanKeagamaan) {
                        setPesanKeberhasilan("Data kegiatan penanggulangan keagamaan berhasil dikirim harap menunggu konfirmasi oleh admin.");
                        header("Location: $akarUrl" . "src/user/pages/pesanan.php");
                        exit();
                    } else {
                        setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan keagamaan.");
                        header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
                        exit();
                    }
                } else {
                    setPesanKesalahan("Gagal menyimpan surat pengantar.");
                    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
                    exit();
                }
            } else {
                setPesanKesalahan("Format file tidak valid. Hanya diperbolehkan file dengan format PDF, Word, atau Excel.");
                header("Location: $akarUrl" . "src/user/pages/ajukan.php");
                exit();
            }
        } else {
            setPesanKesalahan("Gagal mengupload surat pengantar.");
            header("Location: $akarUrl" . "src/user/pages/ajukan.php");
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
