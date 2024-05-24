<?php
include 'databases.php';

if (isset($_POST['Ubah_Kata_Sandi'])) {
    $resetKataSandi = $_POST['Kata_Sandi_Baru'];
    $konfirmasiReset = $_POST['Konfirmasi_Kata_Sandi_Baru'];
    $penggunaID = $_POST['ID_Pengguna'];

    if (!empty($resetKataSandi) && !empty($konfirmasiReset)) {
        if ($resetKataSandi === $konfirmasiReset) {
            $enkripsiKataSandi = password_hash($resetKataSandi, PASSWORD_DEFAULT);

            $obyekPengguna = new Pengguna($koneksi);
            if (isset($penggunaID)) {
                $dataAdmin = [
                    'Kata_Sandi' => $enkripsiKataSandi,
                    'Konfirmasi_Kata_Sandi' => $enkripsiKataSandi
                ];
                $berhasilDiubah = $obyekPengguna->perbaruiKataSandi($penggunaID, $dataAdmin);

                if ($berhasilDiubah) {
                    setPesanKeberhasilan("Kata sandi anda telah diubah.");
                    header("Location:  $akarUrl" . "src/user/pages/login.php");
                    exit;
                } else {
                    setPesanKesalahan("Gagal merubah kata sandi.");
                    header("Location: $akarUrl" . "src/user/pages/login.php");
                    exit;
                }
            } else {
                setPesanKesalahan("ID Admin tidak tersedia.");
                header("Location: $akarUrl" . "src/user/pages/login.php");
                exit;
            }
        } else {
            setPesanKesalahan("Kata sandi dan konfirmasi kata sandi tidak cocok.");
            header("Location: $akarUrl" . "src/user/pages/login.php");
            exit;
        }
    } else {
        setPesanKesalahan("Harap lengkapi semua bidang yang diperlukan.");
        header("Location: $akarUrl" . "src/user/pages/login.php");
        exit;
    }
} else {
    setPesanKesalahan("Harap isi formulir dengan benar.");
    header("Location: $akarUrl" . "src/user/pages/login.php");
    exit;
}
