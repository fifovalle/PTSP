<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'databases.php';
require '../../../vendor/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/src/SMTP.php';

if (isset($_POST['Kirim'])) {
    $namaDepan = $_POST['Nama_Depan_Pengirim'];
    $namaBelakang = $_POST['Nama_Belakang_Pengirim'];
    $email = $_POST['Email_Pengirim'];
    $nomorTelepon = $_POST['No_Telepon_Pengirim'];
    $pesan = $_POST['Pesan_Pengirim'];

    if (empty($namaDepan) || empty($namaBelakang) || empty($email) || empty($nomorTelepon) || empty($pesan)) {
        setPesanKesalahan("Semua field harus diisi.");
        header("Location: $akarUrl" . "public/admin/");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setPesanKesalahan("Format email tidak valid.");
        header("Location: $akarUrl" . "public/admin/");
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'fifanaufal10@gmail.com';
        $mail->Password = 'vqio euwq gppe ppww';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $namaDepan . ' ' . $namaBelakang);
        $mail->addAddress('syntaxsquad24@gmail.com', 'Programmer PTSP');

        $mail->isHTML(true);
        $mail->Subject = 'Pesan dari Form Kontak';
        $mail->Body    = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pesan dari Form Kontak</title>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container">
                <h1 class="mb-4">Pesan dari Form Kontak</h1>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama Depan:</strong> ' . $namaDepan . '</p>
                        <p><strong>Nama Belakang:</strong> ' . $namaBelakang . '</p>
                        <p><strong>Email:</strong> ' . $email . '</p>
                        <p><strong>Nomor Telepon:</strong> ' . $nomorTelepon . '</p>
                        <p><strong>Pesan:</strong></p>
                        <p>' . $pesan . '</p>
                    </div>
                </div>
            </div>
        </body>
        </html>';

        $mail->send();
        setPesanKeberhasilan("Pesan berhasil dikirim.");
        header("Location: $akarUrl" . "public/admin/");
        exit;
    } catch (Exception $e) {
        echo "Pesan gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}
