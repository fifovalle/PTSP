<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $dataInformasi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Data_dan_Informasi_Yang_Dibutuhkan']));

    $objekInformasiPnbp = new Pengajuan($koneksi);
    $pesanKesalahan = '';

    $nomorHPFormatted = preg_replace('/^(\d{3})(\d{4})(\d{4})$/', '+62 $1-$2-$3', $nomorHP);

    $suratIdentitasFile = $_FILES['Identitas_KTP'];
    $namaSuratIdentitas = mysqli_real_escape_string($koneksi, htmlspecialchars($suratIdentitasFile['name']));
    $suratIdentitasTemp = $suratIdentitasFile['tmp_name'];
    $ukuranSuratIdentitas = $suratIdentitasFile['size'];
    $errorSuratIdentitas = $suratIdentitasFile['error'];

    $suratPengantarFile = $_FILES['Surat_Pengantar'];
    $namaSuratPengantar = mysqli_real_escape_string($koneksi, htmlspecialchars($suratPengantarFile['name']));
    $suratPengantarTemp = $suratPengantarFile['tmp_name'];
    $ukuranSuratPengantar = $suratPengantarFile['size'];
    $errorSuratPengantar = $suratPengantarFile['error'];

    $ukuranMaksimal = 5 * 1024 * 1024;
    $formatDisetujui = ['jpg', 'jpeg', 'png', 'pdf'];

    $formatIdentitas = strtolower(pathinfo($namaSuratIdentitas, PATHINFO_EXTENSION));
    $formatPengantar = strtolower(pathinfo($namaSuratPengantar, PATHINFO_EXTENSION));

    $suratIdentitasBaru = uniqid() . '.' . $formatIdentitas;
    $lokasiPenyimpananIdentitas = '../assets/image/uploads/' . $suratIdentitasBaru;

    $suratPengantarBaru = uniqid() . '.' . $formatPengantar;
    $lokasiPenyimpananPengantar = '../assets/image/uploads/' . $suratPengantarBaru;

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/user/pages/ajukan.php");
        exit;
    }

    $data = array(
        'Nama_PNBP' => $nama,
        'No_Telepon_PNBP' => $nomorHPFormatted,
        'Email_PNBP' => $email,
        'Informasi_PNBP_Yang_Dibutuhkan' => $dataInformasi,
        'Identitas_KTP_PNBP' => $suratIdentitasBaru,
        'Surat_Pengantar_PNBP' => $suratPengantarBaru
    );

    $simpanData = $objekInformasiPnbp->tambahInformasiPNBP($data);

    if ($simpanData) {
        $_SESSION['Ajuan'] = true;
        setPesanKeberhasilan("Data kegiatan penanggulangan bencana berhasil dikirim harap menunggu konfirmasi oleh admin.");
        header("Location: $akarUrl" . "src/user/pages/checkout.php");
        exit();
    } else {
        setPesanKesalahan("Gagal menambahkan data.");
    }

    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}
