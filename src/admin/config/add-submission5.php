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
    $nim_atau_ktp = filter_input(INPUT_POST, 'NIM_atau_KTP', FILTER_SANITIZE_STRING);
    $program_studi_atau_fakultas = filter_input(INPUT_POST, 'Program_Studi_atau_Fakultas', FILTER_SANITIZE_STRING);
    $universitas_atau_instansi = filter_input(INPUT_POST, 'Universitas_atau_Instansi', FILTER_SANITIZE_STRING);
    $nomorHP = filter_input(INPUT_POST, 'No_HP', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    $objekDataPendidikan = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Pengantar_Permintaan_Data']['error'] !== UPLOAD_ERR_OK) {
            setPesanKesalahan("Gagal mengupload surat pengantar.");
            header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
            exit();
        }

        $ekstensiValid = array('pdf', 'doc', 'docx', 'xls', 'xlsx');
        $fileInfo = pathinfo($_FILES['Surat_Pengantar_Permintaan_Data']['name']);
        $ekstensiFile = strtolower($fileInfo['extension']);

        if (!in_array($ekstensiFile, $ekstensiValid)) {
            setPesanKesalahan("Format file tidak valid. Hanya diperbolehkan file dengan format PDF, Word, atau Excel.");
            header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
            exit();
        }

        $tujuanFolder = '../assets/image/uploads/';
        $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Pengantar_Permintaan_Data']['name']);
        $tujuanFileSuratPengantar = $tujuanFolder . $namaSuratPengantarBaru;

        if (!move_uploaded_file($_FILES['Surat_Pengantar_Permintaan_Data']['tmp_name'], $tujuanFileSuratPengantar)) {
            setPesanKesalahan("Gagal menyimpan surat pengantar. Pastikan folder tujuan ada dan memiliki izin yang cukup.");
            header("Location: " . $akarUrl . "src/user/pages/ajukan.php");
            exit();
        }

        $dataPendidikan = array(
            'Nama_Pendidikan_Dan_Penelitian' => $nama,
            'NIM_KTP' => $nim_atau_ktp,
            'Program_Studi_Fakultas' => $program_studi_atau_fakultas,
            'Universitas_Instansi' => $universitas_atau_instansi,
            'No_Telepon_Pendidikan_Penelitian' => $nomorTeleponFormatted,
            'Email_Pendidikan_Penelitian' => $email,
            'Surat_Pengantar_Permintaan_Data' => $namaSuratPengantarBaru
        );

        $simpanDataPendidikan = $objekDataPendidikan->tambahDataPendidikanPenelitian($dataPendidikan);

        $dataPengajuanPenelitian = array(
            'ID_Penelitian' => $objekDataPendidikan->ambilIDPenelitianTerakhir(),
            'Status_Pengajuan' => 'Sedang Ditinjau',
            'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
        );

        $simpanDataPengajuanPenelitian = $objekDataPendidikan->tambahDataPengajuanPenelitian($dataPengajuanPenelitian);

        $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
        $simpanDataTransaksiPengajuanPendidikan = $obyekDataTransaksi->perbaharuiPengajuanPendidikanKeTransaksiSesuaiSession($dataPengajuanPenelitian, $idSession);

        if ($simpanDataPendidikan && $simpanDataPengajuanPenelitian && $simpanDataTransaksiPengajuanPendidikan) {
            setPesanKeberhasilan("Data kegiatan pendidikan berhasil dikirim harap menunggu konfirmasi oleh admin.");
            header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
            exit();
        } else {
            setPesanKesalahan("Gagal menambahkan data kegiatan pendidikan.");
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
