<?php
include 'databases.php';

$pengjuanModel = new Pengajuan($koneksi);

$pengajuanID = isset($_GET['pengajuan_id']) ? $_GET['pengajuan_id'] : null;
$dataPengajuan = $pengjuanModel->tampilkanDataLihatPengajuan($pengajuanID);

$pengajuanDitemukan = null;

foreach ($dataPengajuan as $pengajuan) {
    $pengajuanDitemukan = $pengajuan['ID_Pengajuan'] == $pengajuanID ? $pengajuan : null;
    if ($pengajuanDitemukan) {
        break;
    }
}

echo json_encode($pengajuanDitemukan);
