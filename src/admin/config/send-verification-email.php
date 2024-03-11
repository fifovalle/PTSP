<?php
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'fifanaufal10@gmail.com';
$mail->Password = 'vqio euwq gppe ppww';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('syntaxsquad24@gmail.com', 'Nama Pengirim');
$mail->addAddress($email, $namaDepan . ' ' . $namaBelakang);
$mail->Subject = 'Verifikasi Akun Admin';
$mail->Body = "Halo,\n\nSilakan klik tautan berikut untuk verifikasi akun admin Anda:\n\n";
$mail->Body .= "$akarUrl" . "src/admin/config/verification-email.php?Token=$token";
$mail->Body .= "\n\nTerima kasih.";
try {
    $mail->send();
    setPesanKeberhasilan("Data admin berhasil disimpan. Email verifikasi telah dikirim.");
    header("Location: $akarUrl" . "src/admin/pages/data.php");
} catch (Exception $e) {
    setPesanKesalahan("Gagal mengirim email verifikasi: {$mail->ErrorInfo}");
    header("Location: $akarUrl" . "src/admin/pages/data.php");
}
