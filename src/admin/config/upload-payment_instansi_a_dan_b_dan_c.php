<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if (isset($_POST['Kirim'])) {
    $idTransaksia = $_POST['id_instansi_a'];
    $idTransaksib = $_POST['id_instansi_b'];
    $idTransaksic = $_POST['id_instansi_c'];
    $buktiPembayarana = $_FILES['File_Instansi_A']['name'];
    $buktiPembayaranb = $_FILES['File_Instansi_B']['name'];
    $buktiPembayaranc = $_FILES['File_Instansi_C']['name'];
    $ukuranFilea = $_FILES['File_Instansi_A']['size'];
    $ukuranFileb = $_FILES['File_Instansi_B']['size'];
    $ukuranFilec = $_FILES['File_Instansi_C']['size'];
    $tipeFilea = $_FILES['File_Instansi_A']['type'];
    $tipeFileb = $_FILES['File_Instansi_B']['type'];
    $tipeFilec = $_FILES['File_Instansi_C']['type'];
    $tempFilea = $_FILES['File_Instansi_A']['tmp_name'];
    $tempFileb = $_FILES['File_Instansi_B']['tmp_name'];
    $tempFilec = $_FILES['File_Instansi_C']['tmp_name'];

    $extensiFilea = explode('.', $buktiPembayarana);
    $extensiFilea = strtolower(end($extensiFilea));
    $extensiFileb = explode('.', $buktiPembayaranb);
    $extensiFileb = strtolower(end($extensiFileb));
    $extensiFilec = explode('.', $buktiPembayaranc);
    $extensiFilec = strtolower(end($extensiFilec));

    $uniqueIDa = uniqid();
    $uniqueIDb = uniqid();
    $uniqueIDc = uniqid();

    $buktiPembayaranBaruA = $uniqueIDa . '.' . $extensiFilea;
    $buktiPembayaranBaruB = $uniqueIDb . '.' . $extensiFileb;
    $buktiPembayaranBaruC = $uniqueIDc . '.' . $extensiFilec;

    $pathA = '../assets/image/uploads/' . $buktiPembayaranBaruA;
    $pathB = '../assets/image/uploads/' . $buktiPembayaranBaruB;
    $pathC = '../assets/image/uploads/' . $buktiPembayaranBaruC;

    if (($extensiFilea == 'jpg' || $extensiFilea == 'jpeg' || $extensiFilea == 'png') &&
        ($extensiFileb == 'jpg' || $extensiFileb == 'jpeg' || $extensiFileb == 'png') &&
        ($extensiFilec == 'jpg' || $extensiFilec == 'jpeg' || $extensiFilec == 'png')
    ) {

        if ($ukuranFilea <= 1000000 && $ukuranFileb <= 1000000 && $ukuranFilec <= 1000000) {
            move_uploaded_file($tempFilea, $pathA);
            move_uploaded_file($tempFileb, $pathB);
            move_uploaded_file($tempFilec, $pathC);

            $updateA = $transaksi->uploadFileBuktiPembayaran($idTransaksia, $buktiPembayaranBaruA);
            $updateB = $transaksi->uploadFileBuktiPembayaran($idTransaksib, $buktiPembayaranBaruB);
            $updateC = $transaksi->uploadFileBuktiPembayaran($idTransaksic, $buktiPembayaranBaruC);

            if ($updateA && $updateB && $updateC) {
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
