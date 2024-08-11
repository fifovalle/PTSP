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
    $pembayaranID = filter_input(INPUT_POST, 'ID_Pembayaran', FILTER_SANITIZE_STRING);
    $keterangan = filter_input(INPUT_POST, 'Keterangan_Pembayaran_Ditolak', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'Status_Transaksi', FILTER_SANITIZE_STRING);

    $databasesModel = new Transaksi($koneksi);

    if ($status === 'Disetujui') {
        $keterangan = NULL;
        $statusPesanan = 'Lunas';
    } else {
        $statusPesanan = 'Belum Lunas';
    }

    if ($status === 'Ditolak' && $keterangan === '') {
        echo json_encode(array("success" => false, "message" => "Anda harus memasukkan keterangan."));
        exit;
    }

    $updatePayment = $databasesModel->perbaruiPembayaran(
        $pembayaranID,
        $keterangan,
        $status,
        $statusPesanan
    );

    if ($updatePayment) {
        echo json_encode(array("success" => true, "message" => "Data sukses diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Data gagal diperbarui."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Request tidak valid."));
    exit;
}
