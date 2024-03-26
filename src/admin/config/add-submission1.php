<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $informasiDibutuhkan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Data_Informasi_Yang_Dibutuhkan']));

    $obyekDataBencana = new Pengajuan($koneksi);

    $pesanKesalahan = '';

    $nomorHPFormatted = preg_replace('/^(\d{3})(\d{4})(\d{4})$/', '+62 $1-$2-$3', $nomorHP);

    $suratPengantarFile = $_FILES['Surat_Pengantar_Permintaan_Data'];

    $namaSuratPengantar = mysqli_real_escape_string($koneksi, htmlspecialchars($suratPengantarFile['name']));
    $suratPengantarTemp = $suratPengantarFile['tmp_name'];
    $ukuranSuratPengantar = $suratPengantarFile['size'];
    $errorSuratPengantar = $suratPengantarFile['error'];

    $tujuanSuratPengantar = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    $apakahUnggahBerhasil = ($errorSuratPengantar === 0 && !empty($namaSuratPengantar)) && ($ukuranSuratPengantar <= $ukuranMaksimal);
    $pesanKesalahan .= (!$apakahUnggahBerhasil && empty($pesanKesalahan)) ? "Gagal mengupload surat pengantar atau surat pengantar tidak diunggah atau ukuran melebihi batas maksimal 2MB." : '';

    $formatDisetujui = ['jpg', 'jpeg', 'png'];
    $formatSuratPengantar = strtolower(pathinfo($namaSuratPengantar, PATHINFO_EXTENSION));
    $apakahFormatDisetujui = in_array($formatSuratPengantar, $formatDisetujui);
    $pesanKesalahan .= (!$apakahFormatDisetujui && empty($pesanKesalahan)) ? "Format surat pengantar harus berupa JPG, JPEG, atau PNG." : '';

    $namaSuratPengantarBaru = $apakahFormatDisetujui ? uniqid() . '.' . $formatSuratPengantar : '';

    $tujuanSuratPengantar = $apakahFormatDisetujui ? '../assets/image/uploads/' . $namaSuratPengantarBaru : '';

    $apakahBerhasilDipindahkan = $apakahFormatDisetujui ? move_uploaded_file($suratPengantarTemp, $tujuanSuratPengantar) : false;
    $pesanKesalahan .= (!$apakahBerhasilDipindahkan && empty($pesanKesalahan)) ? "Gagal mengupload surat pengantar." : '';

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    $dataBencana = array(
        'Nama' => $nama,
        'No_Telepon' => $nomorHPFormatted,
        'Email' => $email,
        'Informasi_Bencana_Yang_Dibutuhkan' => $informasiDibutuhkan,
        'Surat_Pengantar_Permintaan_Data' => $namaSuratPengantarBaru
    );

    $simpanDataBencana = $obyekDataBencana->tambahDataBencana($dataBencana);

    if ($simpanDataBencana) {
        $_SESSION['Ajuan'] = true;
        setPesanKeberhasilan("Data kegiatan penanggulangan bencana berhasil dikirim harap menunggu konfirmasi oleh admin.");
        header("Location: $akarUrl" . "src/user/pages/checkout.php");
        exit();
    } else {
        setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan bencana.");
    }

    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}
