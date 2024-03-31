<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    $objekDataSosial = new Pengajuan($koneksi);

    if ($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['error'] !== UPLOAD_ERR_OK) {
        setPesanKesalahan("Gagal mengupload surat pengantar.");
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    $tujuanSuratPengantar = '../assets/image/uploads/';
    $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['name']);
    $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

    if (!move_uploaded_file($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['tmp_name'], $tujuanFileSuratPengantar)) {
        setPesanKesalahan("Gagal menyimpan surat pengantar.");
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    $dataSosial = array(
        'Nama_Keagamaan' => $nama,
        'No_Telepon_Keagamaan' => $nomorTeleponFormatted,
        'Email_Keagamaan' => $email,
        'Surat_Yang_Ditandatangani_Keagamaan' => $namaSuratPengantarBaru
    );

    $simpanDataSosial = $objekDataSosial->tambahDataKeagamaan($dataSosial);

    $dataPengajuanSosial = array(
        'ID_Pengguna' => $_SESSION['ID_Pengguna'],
        'ID_Perusahaan' => $_SESSION['ID_Perusahaan'],
        'ID_Keagamaan' => $objekDataSosial->ambilIDKeagamaanTerakhir(),
        'Status_Pengajuan' => 'Sedang Ditinjau',
        'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
    );

    $simpanDataPengajuanSosial = $objekDataSosial->tambahDataPengajuanKeagamaan($dataPengajuanSosial);

    if ($simpanDataSosial && $simpanDataPengajuanSosial) {
        setPesanKeberhasilan("Data kegiatan penanggulangan sosial berhasil dikirim harap menunggu konfirmasi oleh admin.");
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
