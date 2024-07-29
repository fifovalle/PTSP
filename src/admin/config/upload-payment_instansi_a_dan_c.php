<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if (isset($_POST['Kirim'])) {
    $idTransaksia = $_POST['id_instansi_a'];
    $idTransaksic = $_POST['id_instansi_c'];
    $buktiPembayarana = $_FILES['File_Instansi_A']['name'];
    $buktiPembayaranc = $_FILES['File_Instansi_C']['name'];
    $ukuranFilea = $_FILES['File_Instansi_A']['size'];
    $ukuranFilec = $_FILES['File_Instansi_C']['size'];
    $tipeFilea = $_FILES['File_Instansi_A']['type'];
    $tipeFilec = $_FILES['File_Instansi_C']['type'];
    $tempFilea = $_FILES['File_Instansi_A']['tmp_name'];
    $tempFilec = $_FILES['File_Instansi_C']['tmp_name'];

    $extensiFilea = explode('.', $buktiPembayarana);
    $extensiFilea = strtolower(end($extensiFilea));
    $extensiFilec = explode('.', $buktiPembayaranc);
    $extensiFilec = strtolower(end($extensiFilec));

    $uniqueIDa = uniqid();
    $uniqueIDc = uniqid();

    $buktiPembayaranBaruA = $uniqueIDa . '.' . $extensiFilea;
    $buktiPembayaranBaruC = $uniqueIDc . '.' . $extensiFilec;

    $pathA = '../assets/image/uploads/' . $buktiPembayaranBaruA;
    $pathC = '../assets/image/uploads/' . $buktiPembayaranBaruC;

    if (($extensiFilea == 'jpg' || $extensiFilea == 'jpeg' || $extensiFilea == 'png') &&
        ($extensiFilec == 'jpg' || $extensiFilec == 'jpeg' || $extensiFilec == 'png')
    ) {

        if ($ukuranFilea <= 1000000 && $ukuranFilec <= 1000000) {
            move_uploaded_file($tempFilea, $pathA);
            move_uploaded_file($tempFilec, $pathC);

            $updateA = $transaksi->uploadFileBuktiPembayaran($idTransaksia, $buktiPembayaranBaruA);
            $updateC = $transaksi->uploadFileBuktiPembayaran($idTransaksic, $buktiPembayaranBaruC);

            if ($updateA && $updateC) {
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
