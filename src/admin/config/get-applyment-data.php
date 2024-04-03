<?php
include 'databases.php';

$pengajuanModel = new Pengajuan($koneksi);

$pengajuanID = isset($_GET['pengajuan_id']) ? $_GET['pengajuan_id'] : null;
$dataPengajuan = $pengajuanModel->tampilkanDataPengajuan($pengajuanID);

$pengajuanDitemukan = null;

foreach ($dataPengajuan as $pengajuan) {
    $pengajuanDitemukan = $pengajuan['ID_Pengajuan'] == $pengajuanID ? $pengajuan : null;
    if ($pengajuanDitemukan) {
        break;
    }
}

echo json_encode($pengajuanDitemukan);
