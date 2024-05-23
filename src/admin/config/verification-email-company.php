<?php
include 'databases.php';

$token = $_GET['Token'];

$obyekPerusahaan = new Pengguna($koneksi);
$perusahaan = $obyekPerusahaan->getPerusahaanByToken($token);

if ($perusahaan) {
    $updateStatus = $obyekPerusahaan->updatePerusahaanStatusVerifikasi($perusahaan['ID_Perusahaan'], 'Terverifikasi');

    if ($updateStatus) {
        $emptyToken = $obyekPerusahaan->updatePerusahaanToken($perusahaan['ID_Perusahaan'], '');
        if ($emptyToken) {
            setPesanKeberhasilan("Akun perusahaan berhasil diverifikasi. Sekarang Anda dapat login.");
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
