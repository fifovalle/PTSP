<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $adminModel = new Admin($koneksi);

    $hapusData = $adminModel->hapusAdmin($id);

    $successMessage = "Data berhasil dihapus.";
    $failureMessage = "Gagal menghapus data.";
    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';
    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');
    header("Location: $akarUrl/src/admin/pages/data.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);
    header("Location: $akarUrl/src/admin/pages/data.php");
    exit();
}
