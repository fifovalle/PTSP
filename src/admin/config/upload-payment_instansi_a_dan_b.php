<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if (isset($_POST['Kirim'])) {
    $idTransaksia = $_POST['id_instansi_a'];
    $idTransaksib = $_POST['id_instansi_b'];
    $buktiPembayarana = $_FILES['File_Instansi_A']['name'];
    $buktiPembayaranb = $_FILES['File_Instansi_B']['name'];
    $ukuranFilea = $_FILES['File_Instansi_A']['size'];
    $ukuranFileb = $_FILES['File_Instansi_B']['size'];
    $tipeFilea = $_FILES['File_Instansi_A']['type'];
    $tipeFileb = $_FILES['File_Instansi_B']['type'];
    $tempFilea = $_FILES['File_Instansi_A']['tmp_name'];
    $tempFileb = $_FILES['File_Instansi_B']['tmp_name'];

    $extensiFilea = explode('.', $buktiPembayarana);
    $extensiFilea = strtolower(end($extensiFilea));
    $extensiFileb = explode('.', $buktiPembayaranb);
    $extensiFileb = strtolower(end($extensiFileb));

    $uniqueIDa = uniqid();
    $uniqueIDb = uniqid();

    $buktiPembayaranBaruA =  $uniqueIDa . '.' . $extensiFilea;
    $buktiPembayaranBaruB =  $uniqueIDb . '.' . $extensiFileb;

    $pathA = '../assets/image/uploads/' . $buktiPembayaranBaruA;
    $pathB = '../assets/image/uploads/' . $buktiPembayaranBaruB;

    if (($extensiFilea == 'jpg' || $extensiFilea == 'jpeg' || $extensiFilea == 'png') &&
        ($extensiFileb == 'jpg' || $extensiFileb == 'jpeg' || $extensiFileb == 'png')
    ) {

        if ($ukuranFilea <= 1000000 && $ukuranFileb <= 1000000) {
            move_uploaded_file($tempFilea, $pathA);
            move_uploaded_file($tempFileb, $pathB);

            $updateA = $transaksi->uploadFileBuktiPembayaran($idTransaksia, $buktiPembayaranBaruA);
            $updateB = $transaksi->uploadFileBuktiPembayaran($idTransaksib, $buktiPembayaranBaruB);

            if ($updateA && $updateB) {
                setPesanKeberhasilan("Bukti pembayaran berhasil diupload.");
                header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
                exit;
            } else {
                setPesanKesalahan("Bukti pembayaran gagal diupload.");
                header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
                exit;
            }
        } else {
            setPesanKesalahan("Ukuran file terlalu besar.");
            header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
            exit;
        }
    } else {
        setPesanKesalahan("Ekstensi file bukan jpg/jpeg/png.");
        header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
        exit;
    }
}
