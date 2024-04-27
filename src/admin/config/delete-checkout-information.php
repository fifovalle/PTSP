<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $transaksiModel = new Transaksi($koneksi);

    $hapusData = $transaksiModel->hapusTransaksi($id);

    $successMessage = "Informasi berhasil dihapus.";
    $failureMessage = "Gagal menghapus data.";
    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';
    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');
    header("Location: $akarUrl/src/user/pages/checkout.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);
    header("Location: $akarUrl/src/user/pages/checkout.php");
    exit();
}
