<?php
include 'databases.php';

if (isset($_POST['Ubah_Kata_Sandi'])) {
    $resetKataSandi = $_POST['Kata_Sandi_Baru'];
    $konfirmasiReset = $_POST['Konfirmasi_Kata_Sandi_Baru'];
    $penggunaID = $_POST['ID_ALL'];

    if (!empty($resetKataSandi) && !empty($konfirmasiReset)) {
        if ($resetKataSandi === $konfirmasiReset) {
            $enkripsiKataSandi = password_hash($resetKataSandi, PASSWORD_DEFAULT);

            $obyekPengguna = new Pengguna($koneksi);
            if (!empty($penggunaID)) {
                $dataPengguna = [
                    'Kata_Sandi' => $enkripsiKataSandi,
                    'Konfirmasi_Kata_Sandi' => $enkripsiKataSandi
                ];

                $cekPengguna = $obyekPengguna->getPenggunaByID($penggunaID);
                $cekPerusahaan = $obyekPengguna->getPerusahaansByID($penggunaID);

                if ($cekPengguna) {
                    $berhasilDiubah = $obyekPengguna->perbaruiKataSandi($penggunaID, $dataPengguna);
                } else if ($cekPerusahaan) {
                    $berhasilDiubah = $obyekPengguna->perbaruiKataSandiPerusahaan($penggunaID, $dataPengguna);
                }

                if ($berhasilDiubah) {
                    setPesanKeberhasilan("Kata sandi Anda telah diubah.");
                    header("Location: $akarUrl" . "src/user/pages/login.php");
                    exit;
                } else {
                    setPesanKesalahan("Gagal mengubah kata sandi.");
                }
            } else {
                setPesanKesalahan("ID Pengguna tidak tersedia.");
            }
        } else {
            setPesanKesalahan("Kata sandi dan konfirmasi kata sandi tidak cocok.");
        }
    } else {
        setPesanKesalahan("Harap lengkapi semua bidang yang diperlukan.");
    }

    header("Location: $akarUrl" . "src/user/pages/login.php");
    exit;
} else {
    setPesanKesalahan("Harap isi formulir dengan benar.");
    header("Location: $akarUrl" . "src/user/pages/login.php");
    exit;
}
