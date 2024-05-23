<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['type'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);
    $type = $_GET['type'];

    $penggunaModel = new Pengguna($koneksi);
    $hapusPengguna = false;
    $hapusPerusahaan = false;

    if ($type === 'pengguna') {
        $hapusPengguna = $penggunaModel->hapusPengguna($id);
    } elseif ($type === 'perusahaan') {
        $hapusPerusahaan = $penggunaModel->hapusPerusahaan($id);
    }

    $successMessage = htmlspecialchars("Data berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = ($hapusPengguna || $hapusPerusahaan) ? $successMessage : $failureMessage;
    $sessionKey = ($hapusPengguna || $hapusPerusahaan) ? 'berhasil' : 'gagal';

    setPesanKeberhasilan(($hapusPengguna || $hapusPerusahaan) ? $successMessage : '');
    setPesanKesalahan(!($hapusPengguna || $hapusPerusahaan) ? $failureMessage : '');

    header("Location: $akarUrl/src/admin/pages/data.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: $akarUrl/src/admin/pages/data.php");
    exit();
}
