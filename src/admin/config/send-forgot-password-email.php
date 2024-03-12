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
    $mail->Body = 'Halo ' . $namaDepan . ',<br><br>'
        . 'Anda telah meminta untuk mereset kata sandi Anda. Silakan klik tautan berikut untuk mereset kata sandi Anda: <br>'
        . '<a href="' . $akarUrl . 'src/admin/config/reset-pass.php?token=' . $tokenBaru . '">Reset Kata Sandi</a><br><br>'
        . 'Jika Anda tidak meminta reset kata sandi, abaikan email ini.<br><br>'
        . 'Terima kasih.<br>'
        . 'Admin';

    $mail->send();
} catch (Exception $e) {
    echo "Pesan gagal terkirim: {$mail->ErrorInfo}";
}
