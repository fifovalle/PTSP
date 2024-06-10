<?php
include 'databases.php';

$ikmModel = new Ikm($koneksi);

$ikmID = isset($_GET['ikm_id']) ? $_GET['ikm_id'] : null;
$dataIKM = $ikmModel->tampilkanRiwayatIKM($ikmID);

$ikmDitemukan = null;

foreach ($dataIKM as $ikm) {
    $ikmDitemukan = $ikm['ID_Ikm'] == $ikmID ? $ikm : null;
    if ($ikmDitemukan) {
        break;
    }
}

echo json_encode($ikmDitemukan);
