<?php
include 'databases.php';

$jasaModel = new Jasa($koneksi);

$jasaID = isset($_GET['jasa_id']) ? $_GET['jasa_id'] : null;
$dataJasa = $jasaModel->tampilkanDataJasa($jasaID);

$jasaDitemukan = null;

foreach ($dataJasa as $jasa) {
    $jasaDitemukan = $jasa['ID_Jasa'] == $jasaID ? $jasa : null;
    if ($jasaDitemukan) {
        break;
    }
}

echo json_encode($jasaDitemukan);
