<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    $objekDataSosial = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Pengantar_Permintaan_Data']['error'] === UPLOAD_ERR_OK) {
            $tujuanSuratPengantar = '../assets/image/uploads/';
            $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Pengantar_Permintaan_Data']['name']);
            $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

            if (move_uploaded_file($_FILES['Surat_Pengantar_Permintaan_Data']['tmp_name'], $tujuanFileSuratPengantar)) {
                $dataSosial = array(
                    'Nama_Sosial' => $nama,
                    'No_Telepon_Sosial' => $nomorTeleponFormatted,
                    'Email_Sosial' => $email,
                    'Surat_Yang_Ditandatangani_Sosial' => $namaSuratPengantarBaru
                );

                $simpanDataSosial = $objekDataSosial->tambahDataSosial($dataSosial);

                $dataPengajuanSosial = array(
                    'ID_Sosial' => $objekDataSosial->ambilIDSosialTerakhir(),
                    'Status_Pengajuan' => 'Sedang Ditinjau',
                    'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
                );

                $simpanDataPengajuanSosial = $objekDataSosial->tambahDataPengajuanSosial($dataPengajuanSosial);

                $dataPengajuanSosial = array(
                    'ID_Pengajuan' => $objekDataSosial->ambilIDPengajuanTerakhir(),
                );

                $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

                $simpanDataTransaksiPengajuanSosial = $obyekDataTransaksi->perbaharuiPengajuanSosialKeTransaksiSesuaiSession($dataPengajuanSosial, $idSession);

                if ($simpanDataSosial && $simpanDataPengajuanSosial && $simpanDataTransaksiPengajuanSosial) {
                    setPesanKeberhasilan("Data kegiatan penanggulangan sosial berhasil dikirim harap menunggu konfirmasi oleh admin.");
                    header("Location: $akarUrl" . "src/user/pages/checkout.php");
                    exit;
                } else {
                    setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan sosial.");
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
    exit();
}
