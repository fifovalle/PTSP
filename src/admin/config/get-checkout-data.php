<?php
include 'databases.php';

$transaksiModel = new Transaksi($koneksi);

$transaksiID = isset($_GET['idUpdate']) ? mysqli_real_escape_string($koneksi, $_GET['idUpdate']) : null;

$dataTransaksi = $transaksiModel->tampilkanTransaksiSesuaiCheckoutPembeli($transaksiID);

$transaksiDitemukan = null;

foreach ($dataTransaksi as $transaksi) {
    $idTransaksi = htmlspecialchars($transaksi['ID_Tranksaksi'] ?? $transaksi['ID_Jasa']);
    $transaksiDitemukan = $idTransaksi == $transaksiID ? $transaksi : null;
    if ($transaksiDitemukan) {
        break;
    }
}

$transaksiDitemukan = array_map('htmlspecialchars', $transaksiDitemukan);

echo json_encode($transaksiDitemukan);
