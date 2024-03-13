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
        $mail->Body    = '
        <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8; font-family: \'Trebuchet MS\', sans-serif;" leftmargin="0">
        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
            <tr>
                <td>
                    <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <a href="" title="logo" target="_blank">
                            <img width="120" src="https://sikompas.bmkg.go.id/assets/login/img/bmkg_logo_min.png" title="logo" alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 60px; font-family: \'Trebuchet MS\', sans-serif;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin-top: -10px; font-size:25px;">You Have New Message !</h1>
                                        <span style="display:inline-block; vertical-align:middle; margin:-10px 0 10px 0; border-bottom:2px solid #cecece; width:50px;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;font-family: \'Trebuchet MS\', sans-serif; align-items: left;">
                                        <p style="color:#455056; font-size:15px; line-height:24px; margin-top: 6px; font-family: Trebuchet MS;">Nama Depan: ' . $namaDepan . '</p>
                                        <p style="color:#455056; font-size:15px; line-height:24px; margin-top: 6px; font-family: Trebuchet MS;">Nama Belakang: ' . $namaBelakang . '</p>
                                        <p style="color:#455056; font-size:15px; line-height:24px; margin-top: 6px; font-family: Trebuchet MS;">Email: ' . $email . '</p>
                                        <p style="color:#455056; font-size:15px; line-height:24px; margin-top: 6px; font-family: Trebuchet MS;">Nomor Telepon: ' . $nomorTelepon . '</p>
                                        <p style="color:#455056; font-size:15px; line-height:24px; margin-top: 6px; font-family: Trebuchet MS;">Pesan: ' . $pesan . '</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    </table>
                </td>
            </tr>
        </table>
        </body>
        ';
        $mail->send();
        setPesanKeberhasilan("Pesan berhasil dikirim.");
        header("Location: $akarUrl" . "public/admin/");
        exit;
    } catch (Exception $e) {
        echo "Pesan gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}
