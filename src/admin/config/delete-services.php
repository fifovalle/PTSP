<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $jasaModel = new Jasa($koneksi);

    $hapusData =  $jasaModel->hapusJasa($id);

    $pesanKeberhasilan = "Data berhasil dihapus.";
    $pesanKegagalan = "Gagal menghapus data.";
    $pesanRespon = $hapusData ? $pesanKeberhasilan : $pesanKegagalan;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $pesanKeberhasilan : '');
    setPesanKesalahan(!$hapusData ? $pesanKegagalan : '');

    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit();
} else {
    $pesanKesalahan = "Halaman tidak dapat diakses.";
    setPesanKesalahan($pesanKesalahan);
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit();
}
