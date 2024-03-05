<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $informasiModel = new Informasi($koneksi);

    $hapusData = $informasiModel->hapusInformasi($id);

    $pesanKeberhasilan = "Data berhasil dihapus.";
    $pesanKegagalan = "Gagal menghapus data.";
    $pesanRespon = $hapusData ? htmlspecialchars($pesanKeberhasilan) : htmlspecialchars($pesanKegagalan);
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? htmlspecialchars($pesanKeberhasilan) : '');
    setPesanKesalahan(!$hapusData ? htmlspecialchars($pesanKegagalan) : '');

    header("Location: " . htmlspecialchars($akarUrl) . "src/admin/pages/data.php");
    exit();
} else {
    $pesanKesalahan = "Halaman tidak dapat diakses.";
    setPesanKesalahan(htmlspecialchars($pesanKesalahan));
    header("Location: " . htmlspecialchars($akarUrl) . "src/admin/pages/data.php");
    exit();
}
?>
