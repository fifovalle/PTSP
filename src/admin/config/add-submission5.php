<?php
include 'databases.php';

if (isset($_POST['Apply'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $nim_atau_ktp = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['NIM_atau_KTP']));
    $program_studi_atau_fakultas = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Program_Studi_atau_Fakultas']));
    $universitas_atau_instansi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Universitas_atau_Instansi']));
    $nomorHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));

    $nomorTeleponFormatted = '+62 ' . substr($nomorHP, 0, 3) . '-' . substr($nomorHP, 4, 4) . '-' . substr($nomorHP, 7);

    if (!isset($_SESSION['ID_Produk'])) {
        setPesanKesalahan("Silahkan memilih katalog produk terlebih dahulu");
        header("Location: $akarUrl" . "src/user/pages/katalogproduk.php");
        exit();
    }

    $objekDataPendidikan = new Pengajuan($koneksi);
    $obyekDataTransaksi = new Transaksi($koneksi);

    $dataCekPengajuan = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
    $hasilCekPengguna = $obyekDataTransaksi->cekPengguna($dataCekPengajuan);

    if ($hasilCekPengguna) {
        if ($_FILES['Surat_Pengantar_Permintaan_Data']['error'] !== UPLOAD_ERR_OK) {
            setPesanKesalahan("Gagal mengupload surat pengantar.");
            header("Location: $akarUrl" . "src/user/pages/ajukan.php");
            exit;
        }

        $tujuanFolder = '../assets/image/uploads/';
        $namaSuratPengantarBaru = uniqid() . '_' . basename($_FILES['Surat_Pengantar_Permintaan_Data']['name']);
        $tujuanFileSuratPengantar = $tujuanFolder . $namaSuratPengantarBaru;

        if (!move_uploaded_file($_FILES['Surat_Pengantar_Permintaan_Data']['tmp_name'], $tujuanFileSuratPengantar)) {
            setPesanKesalahan("Gagal menyimpan surat pengantar. Pastikan folder tujuan ada dan memiliki izin yang cukup.");
            header("Location: $akarUrl" . "src/user/pages/ajukan.php");
            exit;
        }

        $dataPendidikan = array(
            'Nama_Pendidikan_Dan_Penelitian' => $nama,
            'NIM_KTP' => $nim_atau_ktp,
            'Program_Studi_Fakultas' => $program_studi_atau_fakultas,
            'Universitas_Instansi' => $universitas_atau_instansi,
            'No_Telepon_Pendidikan_Penelitian' => $nomorTeleponFormatted,
            'Email_Pendidikan_Penelitian' => $email,
            'Surat_Pengantar_Permintaan_Data' => $namaSuratPengantarBaru
        );

        $simpanDataPendidikan = $objekDataPendidikan->tambahDataPendidikanPenelitian($dataPendidikan);

        $dataPengajuanPenelitian = array(
            'ID_Penelitian' => $objekDataPendidikan->ambilIDPenelitianTerakhir(),
            'Status_Pengajuan' => 'Sedang Ditinjau',
            'Tanggal_Pengajuan' => date('Y-m-d H:i:s')
        );

        $simpanDataPengajuanPenelitian = $objekDataPendidikan->tambahDataPengajuanPenelitian($dataPengajuanPenelitian);

        $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);
        $simpanDataTransaksiPengajuanPendidikan = $obyekDataTransaksi->perbaharuiPengajuanPendidikanKeTransaksiSesuaiSession($dataPengajuanPenelitian, $idSession);

        if ($simpanDataPendidikan && $simpanDataPengajuanPenelitian && $simpanDataTransaksiPengajuanPendidikan) {
            setPesanKeberhasilan("Data kegiatan pendidikan berhasil dikirim harap menunggu konfirmasi oleh admin.");
            header("Location: $akarUrl" . "src/user/pages/checkout.php");
            exit();
        } else {
            setPesanKesalahan("Gagal menambahkan data kegiatan pendidikan.");
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
