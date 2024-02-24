<?php
include 'databases.php';

$produkModel = new Produk($koneksi);

$produkID = isset($_GET['produk_id']) ? $_GET['produk_id'] : null;
$dataProduk = $produkModel->tampilkanDataProduk($produkID);

$produkDitemukan = null;

foreach ($dataProduk as $produk) {
    $produkDitemukan = $produk['ID_Produk'] == $produkID ? $produk : null;
    if ($produkDitemukan) {
        break;
    }
}

echo json_encode($produkDitemukan);
