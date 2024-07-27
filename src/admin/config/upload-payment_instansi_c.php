<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if (isset($_POST['Kirim'])) {
    $idTransaksi = $_POST['id_instansi_c'];
    $buktiPembayaran  = $_FILES['File_Instansi_C']['name'];
    $ukuranFile = $_FILES['File_Instansi_C']['size'];
    $tipeFile = $_FILES['File_Instansi_C']['type'];
    $tempFile = $_FILES['File_Instansi_C']['tmp_name'];
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
    } else {
        setPesanKesalahan("Ekstensi file bukan jpg/jpeg/png.");
        header("Location: $akarUrl" . "src/user/pages/pesanan.php");
        exit;
    }
}
