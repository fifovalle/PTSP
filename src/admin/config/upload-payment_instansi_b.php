<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if (isset($_POST['Kirim'])) {
    $idTransaksi = $_POST['id_instansi_b'];
    $buktiPembayaran  = $_FILES['File_Instansi_B']['name'];
    $ukuranFile = $_FILES['File_Instansi_B']['size'];
    $tipeFile = $_FILES['File_Instansi_B']['type'];
    $tempFile = $_FILES['File_Instansi_B']['tmp_name'];
    $extensiFile = explode('.', $buktiPembayaran);
    $extensiFile = strtolower(end($extensiFile));
    $uniqueID = uniqid();
    $buktiPembayaranBaru =  $uniqueID . '.' . $extensiFile;
    $path = '../assets/image/uploads/' . $buktiPembayaranBaru;
    if ($extensiFile == 'jpg' || $extensiFile == 'jpeg' || $extensiFile == 'png') {
        if ($ukuranFile <= 1000000) {
            move_uploaded_file($tempFile, $path);
            $update = $transaksi->uploadFileBuktiPembayaran($idTransaksi, $buktiPembayaranBaru);
            if ($update) {
                setPesanKeberhasilan("Bukti pembayaran berhasil diupload.");
                header("Location: $akarUrl" . "src/user/pages/pesanan.php");
                exit;
            } else {
                setPesanKesalahan("Bukti pembayaran gagal diupload.");
                header("Location: $akarUrl" . "src/user/pages/pesanan.php");
                exit;
            }
        } else {
            setPesanKesalahan("Ukuran file terlalu besar.");
            header("Location: $akarUrl" . "src/user/pages/pesanan.php");
            exit;
        }
    }
}
