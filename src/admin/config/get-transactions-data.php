<?php
include 'databases.php';

$transaksiModel = new Transaksi($koneksi);

$transaksiID = isset($_GET['transaksi_id']) ? $_GET['transaksi_id'] : null;
$dataTransaksi = $transaksiModel->tampilkanDataTransaksi($transaksiID);

if (!empty($dataTransaksi)) {
    $transaksiDitemukan = null;

    foreach ($dataTransaksi as $transaksi) {
        if ($transaksi['ID_Tranksaksi'] == $transaksiID) {
            $transaksiDitemukan = $transaksi;
            break;
        }
    }

    echo json_encode($transaksiDitemukan);
} else {
    echo json_encode(array("message" => "Data transaksi tidak ditemukan"));
}
