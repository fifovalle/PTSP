<?php
include 'databases.php';

$pembayaranModel = new Pengajuan($koneksi);

$pembayaranID = isset($_GET['pembayaran_id']) ? $_GET['pembayaran_id'] : null;
$dataPembayaran = $pembayaranModel->tampilkanDataLihatPengajuan($pembayaranID);

$pengajuanDitemukan = null;

foreach ($dataPembayaran as $pembayaran) {
    $pembayaranDitemukan = $pembayaran['ID_Tranksaksi'] == $pembayaranID ? $pembayaran : null;
    if ($pembayaranDitemukan) {
        break;
    }
}

echo json_encode($pembayaranDitemukan);
