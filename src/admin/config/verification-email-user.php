<?php
include 'databases.php';

$token = $_GET['Token'];

$obyekPengguna = new Pengguna($koneksi);
$pengguna = $obyekPengguna->getPenggunaByToken($token);

if ($pengguna) {
    $updateStatus = $obyekPengguna->updateStatusVerifikasi($pengguna['ID_Pengguna'], 'Terverifikasi');

    if ($updateStatus) {
        $emptyToken = $obyekPengguna->updateToken($pengguna['ID_Pengguna'], '');
        if ($emptyToken) {
            setPesanKeberhasilan("Akun admin berhasil diverifikasi. Sekarang Anda dapat login.");
        } else {
            setPesanKesalahan("Gagal mengosongkan token.");
        }
    } else {
        setPesanKesalahan("Gagal memperbarui status verifikasi.");
    }
} else {
    setPesanKesalahan("Token tidak valid atau telah kadaluarsa.");
}

header("Location: $akarUrl" . "src/user/pages/login.php");
exit;
