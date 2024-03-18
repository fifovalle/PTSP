<?php
include 'databases.php';

if (isset($_POST['Ubah_Kata_Sandi'])) {
    $resetKataSandi = $_POST['Reset_Kata_Sandi'];
    $konfirmasiReset = $_POST['Konfirmasi_Reset'];
    $adminId = $_POST['ID_Admin'];

    if (!empty($resetKataSandi) && !empty($konfirmasiReset)) {
        if ($resetKataSandi === $konfirmasiReset) {
            $enkripsiKataSandi = password_hash($resetKataSandi, PASSWORD_DEFAULT);

            $obyekAdmin = new Admin($koneksi);
            if (isset($adminId)) {
                $dataAdmin = [
                    'Kata_Sandi' => $enkripsiKataSandi,
                    'Konfirmasi_Kata_Sandi' => $enkripsiKataSandi
                ];
                $berhasilDiubah = $obyekAdmin->perbaruiKataSandi($adminId, $dataAdmin);

                if ($berhasilDiubah) {
                    header("Location:  $akarUrl" . "src/admin/pages/login.php");
                    exit;
                } else {
                    header("Location: $akarUrl" . "src/admin/pages/login.php");
                    exit;
                }
            } else {
                setPesanKesalahan("ID Admin tidak tersedia.");
                header("Location: $akarUrl" . "src/admin/pages/login.php");
                exit;
            }
        } else {
            setPesanKesalahan("Kata sandi dan konfirmasi kata sandi tidak cocok.");
            header("Location: $akarUrl" . "src/admin/pages/login.php");
            exit;
        }
    } else {
        setPesanKesalahan("Harap lengkapi semua bidang yang diperlukan.");
        header("Location: $akarUrl" . "src/admin/pages/login.php");
        exit;
    }
} else {
    setPesanKesalahan("Harap isi formulir dengan benar.");
    header("Location: $akarUrl" . "src/admin/pages/login.php");
    exit;
}
