<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'databases.php';
require '../../../vendor/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/src/SMTP.php';

if (isset($_POST['Aturulang'])) {
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['email-user']));

    if (empty($email)) {
        setPesanKesalahan("Email tidak boleh kosong.");
        header("Location: $akarUrl" . "src/user/pages/resetpassword.php");
        exit;
    }

    $obyekPengguna = new Pengguna($koneksi);
    $penggunaData = $obyekPengguna->getPenggunaByEmail($email);
    $perusahaanData = $obyekPengguna->getPerusahaanByEmail($email);

    if ($penggunaData) {
        $namaDepan = $penggunaData['Nama_Depan_Pengguna'];
        $namaBelakang = $penggunaData['Nama_Belakang_Pengguna'];
        $email = $penggunaData['Email_Pengguna'];
        do {
            $tokenBaru = random_int(10000000, 99999999);
            $tokenSudahAda = $obyekPengguna->getPenggunaByToken($tokenBaru);
        } while ($tokenSudahAda);

        require '../../../vendor/autoload.php';
        $mail = new PHPMailer(true);

        $obyekPengguna->updateTokenByEmail($email, $tokenBaru);

        include 'send-forgot-password-email-user.php';

        setPesanKeberhasilan("Email berhasil dikirim.");
        header("Location: $akarUrl" . "src/user/pages/resetpassword.php");
        exit;
    } else if ($perusahaanData) {
        $namaDepan = $perusahaanData['Nama_Depan_Anggota_Perusahaan'];
        $namaBelakang = $perusahaanData['Nama_Belakang_Anggota_Perusahaan'];
        $email = $perusahaanData['Email_Perusahaan'];
        do {
            $tokenBaru = random_int(10000000, 99999999);
            $tokenSudahAda = $obyekPengguna->getPerusahaanByToken($tokenBaru);
        } while ($tokenSudahAda);

        require '../../../vendor/autoload.php';
        $mail = new PHPMailer(true);

        $obyekPengguna->updatePerusahaanTokenByEmail($email, $tokenBaru);

        include 'send-forgot-password-email-user.php';

        setPesanKeberhasilan("Email berhasil dikirim.");
        header("Location: $akarUrl" . "src/user/pages/resetpassword.php");
        exit;
    } else {
        setPesanKesalahan("Email tidak terdaftar.");
        header("Location: $akarUrl" . "src/user/pages/resetpassword.php");
        exit;
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/resetpassword.php");
    exit;
}
