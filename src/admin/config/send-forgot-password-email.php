<?php
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'fifanaufal10@gmail.com';
    $mail->Password = 'vqio euwq gppe ppww';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('syntaxsquad24@gmail.com', 'Nama Pengirim');
    $mail->addAddress($emailAdmin, $namaDepan . ' ' . $namaBelakang);

    $mail->isHTML(true);
    $mail->Subject = 'Lupa Kata Sandi - Permintaan Reset Kata Sandi';
    $mail->Body = '
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
                                        <td style="padding:0 35px; font-family: \'Trebuchet MS\', sans-serif;">
                                            <h1 style="color:#1e1e2d; font-weight:500; margin:0; font-size:32px;">Halo ' . $namaDepan . '!</h1>
                                            <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                            <p style="color:#455056; font-size:15px; line-height:24px; margin:0;">
                                                Anda telah meminta untuk mereset kata sandi Anda. Silakan klik tautan berikut untuk mereset kata sandi Anda! Jika Anda tidak meminta reset kata sandi, abaikan email ini.
                                            </p>
                                            <a href="' . $akarUrl . 'src/admin/config/reset-pass.php?token=' . $tokenBaru . '" style="background:#20e277; text-decoration:none !important; font-weight:500; margin-top:18px; color:#fff; text-transform:uppercase; font-size:14px; padding:10px 24px; display:inline-block; border-radius:50px;">Reset Kata Sandi</a>
                                            <p style="color: #6c757d; font-size:12px; margin-top:15px;">
                                                Jika Anda tidak meminta reset kata sandi, abaikan email ini.
                                            </p>
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
} catch (Exception $e) {
    echo "Pesan gagal terkirim: {$mail->ErrorInfo}";
}
