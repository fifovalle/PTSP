<?php
include 'databases.php';

$transaksiModel = new Transaksi($koneksi);

$transaksiID = isset($_GET['idTransaksi']) ? mysqli_real_escape_string($koneksi, $_GET['idTransaksi']) : null;

$dataTransaksi = $transaksiModel->tampilkanTransaksiSesuaiCheckoutPembeli($transaksiID);

$transaksiDitemukan = null;

foreach ($dataTransaksi as $transaksi) {
    $idTransaksi = htmlspecialchars($transaksi['ID_Tranksaksi']);
    $transaksiDitemukan = $idTransaksi == $transaksiID ? $transaksi : null;
    if ($transaksiDitemukan) {
        break;
    }
}

$transaksiDitemukan = array_map('htmlspecialchars', $transaksiDitemukan);

echo json_encode($transaksiDitemukan);
