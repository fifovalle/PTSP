<?php
include 'databases.php';

$informasiModel = new Informasi($koneksi);

$informasiID = isset($_GET['informasi_id']) ? mysqli_real_escape_string($koneksi, $_GET['informasi_id']) : null;

$dataInformasi = $informasiModel->tampilkanDataInformasi($informasiID);

$informasiDitemukan = null;

foreach ($dataInformasi as $informasi) {
    $idInformasi = htmlspecialchars($informasi['ID_Informasi']);
    $informasiDitemukan = $idInformasi == $informasiID ? $informasi : null;
    if ($informasiDitemukan) {
        break;
    }
}

$informasiDitemukan = array_map('htmlspecialchars', $informasiDitemukan);

echo json_encode($informasiDitemukan);
?>
