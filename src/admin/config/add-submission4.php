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

    $objekDataPertahanan = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Yang_Ditandatangani_Pertahanan']['error'] === UPLOAD_ERR_OK) {
            $ekstensiValid = array('pdf', 'doc', 'docx', 'xls', 'xlsx');
            $fileInfo = pathinfo($_FILES['Surat_Yang_Ditandatangani_Pertahanan']['name']);
            $ekstensiFile = strtolower($fileInfo['extension']);

            if (in_array($ekstensiFile, $ekstensiValid)) {
                $tujuanSuratPengantar = '../assets/image/uploads/';
                $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Yang_Ditandatangani_Pertahanan']['name']);
                $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

                if (move_uploaded_file($_FILES['Surat_Yang_Ditandatangani_Pertahanan']['tmp_name'], $tujuanFileSuratPengantar)) {
                    $dataPertahanan = array(
                        'Nama_Pertahanan' => $nama,
                        'No_Telepon_Pertahanan' => $nomorTeleponFormatted,
                        'Email_Pertahanan' => $email,
                        'Surat_Yang_Ditandatangani_Pertahanan' => $namaSuratPengantarBaru
                    );

                    $simpanDataPertahanan = $objekDataPertahanan->tambahDataPertahanan($dataPertahanan);

                    $dataPengajuanPertahanan = array(
                        'ID_Pertahanan' => $objekDataPertahanan->ambilIDKeamananTerakhir(),
                        'Status_Pengajuan' => 'Sedang Ditinjau',
                        'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
                    );

                    $simpanDataPengajuanPertahanan = $objekDataPertahanan->tambahDataPengajuanPertahanaan($dataPengajuanPertahanan);

                    $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

                    $simpanDataTransaksiPengajuanPertahanan = $obyekDataTransaksi->perbaharuiPengajuanPertahananKeTransaksiSesuaiSession($dataPengajuanPertahanan, $idSession);

                    if ($simpanDataPertahanan && $simpanDataPengajuanPertahanan && $simpanDataTransaksiPengajuanPertahanan) {
                        setPesanKeberhasilan("Data kegiatan penanggulangan pertahanan berhasil dikirim harap menunggu konfirmasi oleh admin.");
                        header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
                        exit();
                    } else {
                        setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan pertahanan.");
                        header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
                        exit();
                    }
                } else {
                    setPesanKesalahan("Gagal menyimpan surat pengantar.");
                    header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
                    exit();
                }
            } else {
                setPesanKesalahan("Format file tidak valid. Hanya diperbolehkan file dengan format PDF, Word, atau Excel.");
                header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
                exit();
            }
        } else {
            setPesanKesalahan("Gagal mengupload surat pengantar.");
            header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
            exit();
        }
    } else {
        setPesanKesalahan("Silahkan memilih katalog produk terlebih dahulu");
        header("Location: " . $akarUrl . "src/user/pages/katalogproduk.php");
        exit();
    }
} else {
    header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
    exit();
}
