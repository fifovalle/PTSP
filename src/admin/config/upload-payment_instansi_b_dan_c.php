<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if (isset($_POST['Kirim'])) {
    $idTransaksib = $_POST['id_instansi_b'];
    $idTransaksic = $_POST['id_instansi_c'];
    $buktiPembayaranb = $_FILES['File_Instansi_B']['name'];
    $buktiPembayaranc = $_FILES['File_Instansi_C']['name'];
    $ukuranFileb = $_FILES['File_Instansi_B']['size'];
    $ukuranFilec = $_FILES['File_Instansi_C']['size'];
    $tipeFileb = $_FILES['File_Instansi_B']['type'];
    $tipeFilec = $_FILES['File_Instansi_C']['type'];
    $tempFileb = $_FILES['File_Instansi_B']['tmp_name'];
    $tempFilec = $_FILES['File_Instansi_C']['tmp_name'];

    $extensiFileb = explode('.', $buktiPembayaranb);
    $extensiFileb = strtolower(end($extensiFileb));
    $extensiFilec = explode('.', $buktiPembayaranc);
    $extensiFilec = strtolower(end($extensiFilec));

    $uniqueIDb = uniqid();
    $uniqueIDc = uniqid();

    $buktiPembayaranBaruB = $uniqueIDb . '.' . $extensiFileb;
    $buktiPembayaranBaruC = $uniqueIDc . '.' . $extensiFilec;

    $pathB = '../assets/image/uploads/' . $buktiPembayaranBaruB;
    $pathC = '../assets/image/uploads/' . $buktiPembayaranBaruC;

    if (($extensiFileb == 'jpg' || $extensiFileb == 'jpeg' || $extensiFileb == 'png') &&
        ($extensiFilec == 'jpg' || $extensiFilec == 'jpeg' || $extensiFilec == 'png')
    ) {

        if ($ukuranFileb <= 1000000 && $ukuranFilec <= 1000000) {
            move_uploaded_file($tempFileb, $pathB);
            move_uploaded_file($tempFilec, $pathC);

            $updateB = $transaksi->uploadFileBuktiPembayaran($idTransaksib, $buktiPembayaranBaruB);
            $updateC = $transaksi->uploadFileBuktiPembayaran($idTransaksic, $buktiPembayaranBaruC);

            if ($updateB && $updateC) {
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
