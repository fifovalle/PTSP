<?php
include 'databases.php';

$token = $_GET['Token'];

$obyekAdmin = new Admin($koneksi);
$admin = $obyekAdmin->getAdminByToken($token);

if ($admin) {
    $updateStatus = $obyekAdmin->updateStatusVerifikasi($admin['ID_Admin'], 'Terverifikasi');

    if ($updateStatus) {
        $emptyToken = $obyekAdmin->updateToken($admin['ID_Admin'], '');
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

header("Location: $akarUrl" . "src/admin/pages/data.php");
exit;
