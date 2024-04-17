<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    $obyekDataBencana = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Pengantar_Permintaan_Data']['error'] === UPLOAD_ERR_OK) {
            $tujuanSuratPengantar = '../assets/image/uploads/';
            $ekstensiFile = pathinfo($_FILES['Surat_Pengantar_Permintaan_Data']['name'], PATHINFO_EXTENSION);
            $namaSuratPengantarBaru = uniqid() . '.' . $ekstensiFile;
            $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

            if (move_uploaded_file($_FILES['Surat_Pengantar_Permintaan_Data']['tmp_name'], $tujuanFileSuratPengantar)) {
                $dataBencana = array(
                    'Nama_Bencana' => $nama,
                    'No_Telepon_Bencana' => $nomorTeleponFormatted,
                    'Email_Bencana' => $email,
                    'Surat_Pengantar_Permintaan_Data_Bencana' => $namaSuratPengantarBaru
                );

                $simpanDataBencana = $obyekDataBencana->tambahDataBencana($dataBencana);

                $dataPengajuanBencana = array(
                    'ID_Bencana' => $obyekDataBencana->ambilIDBencanaTerakhir(),
                    'Status_Pengajuan' => 'Sedang Ditinjau',
                    'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
                );

                $simpanDataPengajuanBencana = $obyekDataBencana->tambahDataPengajuanBencana($dataPengajuanBencana);

                $dataPengajuanBencana = array(
                    'ID_Pengajuan' => $obyekDataBencana->ambilIDPengajuanTerakhir(),
                );

                $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

                $simpanDataTransaksiPengajuanBencana = $obyekDataTransaksi->perbaharuiPengajuanBencanaKeTransaksiSesuaiSession($dataPengajuanBencana, $idSession);

                if ($simpanDataBencana && $simpanDataPengajuanBencana && $simpanDataTransaksiPengajuanBencana) {
                    setPesanKeberhasilan("Data kegiatan penanggulangan bencana berhasil dikirim harap menunggu konfirmasi oleh admin.");
                    header("Location: $akarUrl" . "src/user/pages/checkout.php");
                    exit();
                } else {
                    setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan bencana.");
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
        exit();
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/ajukan.php");
    exit();
}
