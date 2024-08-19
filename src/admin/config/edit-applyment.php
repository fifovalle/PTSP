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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $pengajuanID = filter_input(INPUT_POST, 'ID_Pengajuan', FILTER_SANITIZE_STRING);
    $statusPengajuan = filter_input(INPUT_POST, 'Status_Pengajuan', FILTER_SANITIZE_STRING);
    $apakahGratis = filter_input(INPUT_POST, 'Apakah_Gratis', FILTER_SANITIZE_STRING);
    $keteranganSuratDitolak = filter_input(INPUT_POST, 'Keterangan_Surat_Ditolak', FILTER_SANITIZE_STRING);

    $databasesModel = new Pengajuan($koneksi);
    $pengajuanModel = $databasesModel->getDataPengajuanById($pengajuanID);

    if (!$pengajuanModel) {
        echo json_encode(array("success" => false, "message" => "Pengajuan tidak ditemukan."));
        exit;
    }

    $statusPengajuan = $_POST['Status_Pengajuan'] ?? '';
    if (!in_array($statusPengajuan, ['Sedang Ditinjau', 'Ditolak', 'Diterima'])) {
        echo json_encode(array("success" => false, "message" => "Status pengajuan tidak valid."));
        exit;
    }

    $apakahGratis = $_POST['Apakah_Gratis'] ?? '';
    if (!in_array($apakahGratis, ['0', '1'])) {
        echo json_encode(array("success" => false, "message" => "Pilihan apakah gratis tidak valid."));
        exit;
    }

    $keteranganSuratDitolak = $_POST['Keterangan_Surat_Ditolak'] ?? '';
    if (strlen($keteranganSuratDitolak) > 100) {
        echo json_encode(array("success" => false, "message" => "Keterangan surat ditolak tidak boleh lebih dari 100 karakter."));
        exit;
    }

    if ($statusPengajuan === 'Ditolak') {
        if (empty($keteranganSuratDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan surat ditolak harus diisi jika pengajuan ditolak."));
            exit;
        }
    } else {
        if (!empty($keteranganSuratDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan surat ditolak tidak boleh diisi jika pengajuan diterima."));
            exit;
        }
    }

    $updatePengajuan = $databasesModel->perbaruiPengajuan(
        $pengajuanID,
        $statusPengajuan,
        $apakahGratis,
        $keteranganSuratDitolak
    );

    if ($updatePengajuan) {
        echo json_encode(array("success" => true, "message" => "Data pengajuan berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengajuan."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
