<?php
include 'databases.php';

if (isset($_GET['q'])) {
    $kataKunci = $_GET['q'];

    $informasiModel = new Informasi($koneksi);
    $informasiModel->cariDataLiveInformasi($kataKunci);
}
?>
