<?php
include 'databases.php';

if (isset($_POST['Simpan'])) {
    $idAdmin = $_POST['ID_Admin'];
    $namaDepan = $_POST['Nama_Depan_Admin'];
    $namaBelakang = $_POST['Nama_Belakang_Admin'];
    $namaPengguna = $_POST['Nama_Pengguna_Admin'];
    $email = $_POST['Email_Admin'];
    $nomorTelepon = $_POST['No_Telepon_Admin'];
    $alamatAdmin = $_POST['Alamat_Admin'];

    $obyekAdmin = new Admin($koneksi);

    $nomorTeleponFormatted = $nomorTelepon;

    if (strpos($nomorTeleponFormatted, '-') === false) {
        $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . '-' . substr($nomorTeleponFormatted, 3, 4) . '-' . substr($nomorTeleponFormatted, 7);
    }

    if (strpos($nomorTeleponFormatted, '+62') === false) {
        $nomorTeleponFormatted = '+62 ' . $nomorTeleponFormatted;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesanKesalahan .= "Format email tidak valid. ";
    }

    if (empty($namaDepan) || empty($namaBelakang) || empty($namaPengguna) || empty($email) || empty($nomorTelepon) || empty($alamatAdmin)) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    }

    $dataAdmin = array(
        'Nama_Depan_Admin' => $namaDepan,
        'Nama_Belakang_Admin' => $namaBelakang,
        'Nama_Pengguna_Admin' => $namaPengguna,
        'Email_Admin' => $email,
        'No_Telepon_Admin' =>  $nomorTeleponFormatted,
        'Alamat_Admin' => $alamatAdmin
    );

    $statusPerbarui = $obyekAdmin->perbaruiProfile($idAdmin, $dataAdmin);

    if ($statusPerbarui) {
        setPesanKeberhasilan("Data admin berhasil diperbarui.");
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    } else {
        setPesanKesalahan("Gagal memperbarui data admin.");
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    }
} else {
    header("Location: $akarUrl/src/admin/pages/data.php");
    exit;
}
