<?php
include 'databases.php';

$pembuatanModel = new Transaksi($koneksi);

$pembuatanID = isset($_GET['creation_id']) ? $_GET['creation_id'] : null;
$dataPembuatan = $pembuatanModel->tampilkanDataTransaksi($pembuatanID);

$pembuatanDitemukan = null;

foreach ($dataPembuatan as $pembuatan) {
    $pembuatanDitemukan = $pembuatan['ID_Tranksaksi'] == $pembuatanID ? $pembuatan : null;
    if ($pembuatanDitemukan) {
        break;
    }
}

echo json_encode($pembuatanDitemukan);
