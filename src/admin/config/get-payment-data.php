<?php
include 'databases.php';

$pembayaranModel = new Transaksi($koneksi);

$pembayaranID = isset($_GET['pembayaran_id']) ? $_GET['pembayaran_id'] : null;
$dataPembayaran = $pembayaranModel->tampilkanDataTransaksi($pembayaranID);

$pembayaranDitemukan = null;

foreach ($dataPembayaran as $pembayaran) {
    $pembayaranDitemukan = $pembayaran['ID_Tranksaksi'] == $pembayaranID ? $pembayaran : null;
    if ($pembayaranDitemukan) {
        break;
    }
}

echo json_encode($pembayaranDitemukan);
