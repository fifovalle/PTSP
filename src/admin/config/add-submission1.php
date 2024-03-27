<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $informasiDibutuhkan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Data_Informasi_Yang_Dibutuhkan']));

    $obyekDataBencana = new Pengajuan($koneksi);

    if ($_FILES['Surat_Pengantar_Permintaan_Data']['error'] !== UPLOAD_ERR_OK) {
        setPesanKesalahan("Gagal mengupload surat pengantar.");
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    $tujuanSuratPengantar = '../assets/image/uploads/';
    $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Pengantar_Permintaan_Data']['name']);
    $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

    if (!move_uploaded_file($_FILES['Surat_Pengantar_Permintaan_Data']['tmp_name'], $tujuanFileSuratPengantar)) {
        setPesanKesalahan("Gagal menyimpan surat pengantar.");
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }


    $dataBencana = array(
        'Nama_Bencana' => $nama,
        'No_Telepon_Bencana' => $nomorHP,
        'Email_Bencana' => $email,
        'Informasi_Bencana_Yang_Dibutuhkan' => $informasiDibutuhkan,
        'Surat_Pengantar_Permintaan_Data_Bencana' => $namaSuratPengantarBaru
    );

    $simpanDataBencana = $obyekDataBencana->tambahDataBencana($dataBencana);

    $dataPengajuanBencana = array(
        'ID_Pengguna' => $_SESSION['ID_Pengguna'],
        'ID_Perusahaan' => $_SESSION['ID_Perusahaan'],
        'ID_Bencana' => $obyekDataBencana->ambilIDBencanaTerakhir(),
        'Status_Pengajuan' => 'Sedang Ditinjau',
        'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
    );

    $simpanDataPengajuanBencana = $obyekDataBencana->tambahDataPengajuanBencana($dataPengajuanBencana);

    if ($simpanDataBencana && $simpanDataPengajuanBencana) {
        setPesanKeberhasilan("Data kegiatan penanggulangan bencana berhasil dikirim harap menunggu konfirmasi oleh admin.");
        header("Location: $akarUrl" . "src/user/pages/checkout.php");
        exit();
    } else {
        setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan bencana.");
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}
