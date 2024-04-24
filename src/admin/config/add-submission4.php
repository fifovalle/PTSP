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

    $objekDataPertahanan = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Yang_Ditandatangani_Pertahanan']['error'] === UPLOAD_ERR_OK) {
            $tujuanSuratPengantar = '../assets/image/uploads/';
            $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Yang_Ditandatangani_Pertahanan']['name']);
            $tujuanFileSuratPengantar = $tujuanSuratPengantar . $namaSuratPengantarBaru;

            if (move_uploaded_file($_FILES['Surat_Yang_Ditandatangani_Pertahanan']['tmp_name'], $tujuanFileSuratPengantar)) {
                $dataPertahanan = array(
                    'Nama_Pertahanan' => $nama,
                    'No_Telepon_Pertahanan' => $nomorTeleponFormatted,
                    'Email_Pertahanan' => $email,
                    'Surat_Yang_Ditandatangani_Pertahanan' => $namaSuratPengantarBaru
                );

                $simpanDataPertahanan = $objekDataPertahanan->tambahDataPertahanan($dataPertahanan);

                $dataPengajuanPertahanan = array(
                    'ID_Pertahanan' => $objekDataPertahanan->ambilIDKeamananTerakhir(),
                    'Status_Pengajuan' => 'Sedang Ditinjau',
                    'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
                );

                $simpanDataPengajuanPertahanan = $objekDataPertahanan->tambahDataPengajuanPertahanaan($dataPengajuanPertahanan);

                $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

                $simpanDataTransaksiPengajuanPertahanan = $obyekDataTransaksi->perbaharuiPengajuanPertahananKeTransaksiSesuaiSession($dataPengajuanPertahanan, $idSession);

                if ($simpanDataPertahanan && $simpanDataPengajuanPertahanan && $simpanDataTransaksiPengajuanPertahanan) {
                    setPesanKeberhasilan("Data kegiatan penanggulangan pertahanan berhasil dikirim harap menunggu konfirmasi oleh admin.");
                    header("Location: $akarUrl" . "src/user/pages/checkout.php");
                    exit();
                } else {
                    setPesanKesalahan("Gagal menambahkan data kegiatan penanggulangan pertahanan.");
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
