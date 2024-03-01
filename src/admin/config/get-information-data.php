<?php
include 'databases.php';

$informasiModel = new Informasi($koneksi);

$informasiID = isset($_GET['informasi_id']) ? $_GET['informasi_id'] : null;
$dataInformasi = $informasiModel->tampilkanDataInformasi($informasiID);

$informasiDitemukan = null;

foreach ($dataInformasi as $infomasi) {
    $informasiDitemukan = $infomasi['ID_Informasi'] == $informasiID ? $infomasi : null;
    if ($informasiDitemukan) {
        break;
    }
}

echo json_encode($informasiDitemukan);
