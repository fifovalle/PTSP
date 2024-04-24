<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    $objekDataKeagamaan = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['error'] === UPLOAD_ERR_OK) {
            $tujuanSuratPengantar = '../assets/image/uploads/';
            $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['name']);
            $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

            if (move_uploaded_file($_FILES['Surat_Yang_Ditandatangani_Keagamaan']['tmp_name'], $tujuanFileSuratPengantar)) {
                $dataKeagamaan = array(
                    'Nama_Keagamaan' => $nama,
                    'No_Telepon_Keagamaan' => $nomorTeleponFormatted,
                    'Email_Keagamaan' => $email,
                    'Surat_Yang_Ditandatangani_Keagamaan' => $namaSuratPengantarBaru
                );

                $simpanDataKeagamaan = $objekDataKeagamaan->tambahDataKeagamaan($dataKeagamaan);

                $dataPengajuanKeagamaan = array(
                    'ID_Keagamaan' => $objekDataKeagamaan->ambilIDKeagamaanTerakhir(),
                    'Status_Pengajuan' => 'Sedang Ditinjau',
                    'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
                );

                $simpanDataPengajuanKeagamaan = $objekDataKeagamaan->tambahDataPengajuanKeagamaan($dataPengajuanKeagamaan);

                $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

                $simpanDataTransaksiPengajuanKeagamaan = $obyekDataTransaksi->perbaharuiPengajuanKeagamaanKeTransaksiSesuaiSession($dataPengajuanKeagamaan, $idSession);

                if ($simpanDataKeagamaan && $simpanDataPengajuanKeagamaan && $simpanDataTransaksiPengajuanKeagamaan) {
                    setPesanKeberhasilan("Data kegiatan penanggulangan keagamaan berhasil dikirim harap menunggu konfirmasi oleh admin.");
                    header("Location: $akarUrl" . "src/user/pages/checkout.php");
                    exit();
                } else {
                    setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan keagamaan.");
                }
            } else {
                setPesanKesalahan("Gagal menyimpan surat pengantar.");
            }
        } else {
            setPesanKesalahan("Gagal mengupload surat pengantar.");
        }
    } else {
        setPesanKesalahan("Silahkan memilih katalog produk terlebih dahulu");
        header("Location: $akarUrl" . "src/user/pages/katalogproduk.php");
        exit;
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit;
}
