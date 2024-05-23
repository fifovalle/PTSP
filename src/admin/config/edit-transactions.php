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
    $transaksiID = filter_input(INPUT_POST, 'ID_Transaksi', FILTER_SANITIZE_STRING);
    $statusTransaksi = filter_input(INPUT_POST, 'Status_Transaksi', FILTER_SANITIZE_STRING);
    $keteranganPembayaranDitolak = filter_input(INPUT_POST, 'Keterangan_Pembayaran_Ditolak', FILTER_SANITIZE_STRING);

    $databasesModel = new Transaksi($koneksi);
    $transaksiModel = $databasesModel->getDataTransaksiById($transaksiID);

    if (!$transaksiModel) {
        echo json_encode(array("success" => false, "message" => "Transaksi tidak ditemukan."));
        exit;
    }

    $statusTransaksiOptions = ['Disetujui', 'Belum Disetujui', 'Ditolak', 'Sedang Ditinjau'];
    if (!in_array($statusTransaksi, $statusTransaksiOptions)) {
        echo json_encode(array("success" => false, "message" => "Status transaksi tidak valid."));
        exit;
    }

    if ($statusTransaksi === 'Ditolak') {
        if (empty($keteranganPembayaranDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan pembayaran ditolak harus diisi jika transaksi ditolak."));
            exit;
        }
    } else {
        if (!empty($keteranganPembayaranDitolak)) {
            echo json_encode(array("success" => false, "message" => "Keterangan pembayaran ditolak tidak boleh diisi jika transaksi disetujui."));
            exit;
        }
    }

    if ($statusTransaksi === 'Diterima') {
        $keteranganPembayaranDitolak = null;
    }

    $updateTransaksi = $databasesModel->perbaruiTransaksi(
        $transaksiID,
        $statusTransaksi,
        $keteranganPembayaranDitolak
    );

    if ($updateTransaksi) {
        echo json_encode(array("success" => true, "message" => "Data transaksi berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data transaksi."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
