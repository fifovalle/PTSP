<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    if (!isset($_SESSION['ID_Produk'])) {
        setPesanKesalahan("Silahkan memilih katalog produk terlebih dahulu");
        header("Location: $akarUrl" . "src/user/pages/katalogproduk.php");
        exit();
    }

    $objekDataPusatDanDaerah = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        $tujuanFolder = '../assets/image/uploads/';
        $suratPerjanjian = uploadFile('Mempunyai_Perjanjian_Kerjasama_dengan_BMKG', $tujuanFolder);
        $suratPengantarBaru = uploadFile('Surat_Pengantar', $tujuanFolder);

        $dataPusat = array(
            'Nama_Pusat_Daerah' => $nama,
            'No_Telepon_Pusat_Daerah' => $nomorTeleponFormatted,
            'Email_Pusat_Daerah' => $email,
            'Memiliki_Kerja_Sama_Dengan_BMKG' => $suratPerjanjian,
            'Surat_Pengantar_Pusat_Daerah' => $suratPengantarBaru,
        );

        $simpanDataPusat = $objekDataPusatDanDaerah->tambahDataPusatDaerah($dataPusat);

        $dataPengajuanPusat = array(
            'ID_Pusat_Daerah' => $objekDataPusatDanDaerah->ambilIDPusatTerakhir(),
            'Status_Pengajuan' => 'Sedang Ditinjau',
            'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
        );

        $simpanDataPengajuanPusat = $objekDataPusatDanDaerah->tambahDataPengajuanPusat($dataPengajuanPusat);

        $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
        $simpanDataTransaksiPengajuanPusat = $obyekDataTransaksi->perbaharuiPengajuanPusatKeTransaksiSesuaiSession($dataPengajuanPusat, $idSession);

        if ($simpanDataPusat && $simpanDataPengajuanPusat && $simpanDataTransaksiPengajuanPusat) {
            setPesanKeberhasilan("Data kegiatan berhasil dikirim harap menunggu konfirmasi oleh admin.");
            header("Location: $akarUrl" . "src/user/pages/checkout.php");
            exit();
        } else {
            setPesanKesalahan("Gagal menambahkan data.");
        }
    } else {
        setPesanKesalahan("Silahkan memilih katalog produk terlebih dahulu");
        header("Location: $akarUrl" . "src/user/pages/katalogproduk.php");
        exit();
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}

function uploadFile($fileInputName, $tujuanFolder)
{
    if ($_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
    }

    $namaFileBaru = uniqid() . '_' . basename($_FILES[$fileInputName]['name']);
    $tujuanFile = $tujuanFolder . $namaFileBaru;

    if (!move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $tujuanFile)) {
    }

    return $namaFileBaru;
}
