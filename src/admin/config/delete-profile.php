<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $adminModel = new Admin($koneksi);

    $hapusData = $adminModel->hapusAdmin($id);

    if ($hapusData) {
        $successMessage = "Berhasil menghapus data.";
        setPesanKeberhasilan($successMessage);
        header("Location: $akarUrl/src/admin/pages/login.php");
        session_destroy();
        exit();
    } else {
        $errorMessage = "Gagal menghapus data.";
        setPesanKesalahan($errorMessage);
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit();
    }
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);
    header("Location: $akarUrl/src/admin/pages/data.php");
    exit();
}
