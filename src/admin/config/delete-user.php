<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $penggunaModel = new Pengguna($koneksi);

    $hapusData = $penggunaModel->hapusPengguna($id);

    $successMessage = "Data pengguna berhasil dihapus.";
    $failureMessage = "Gagal menghapus data pengguna.";
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
