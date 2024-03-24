<?php
include 'databases.php';

if (isset($_POST['tambah_keranjang'])) {
    if (isset($_SESSION['ID_Pengguna']) || isset($_SESSION['ID_Perusahaan'])) {
        $informasi = $_POST['Informasi'];
        $pengguna = isset($_POST['Pengguna']) ? $_POST['Pengguna'] : null;
        $perusahaan = isset($_POST['Perusahaan']) ? $_POST['Perusahaan'] : null;
        $transaksiModel = new Transaksi($koneksi);

        if (!is_null($pengguna) && $transaksiModel->cekPenggunaTerdaftar($pengguna)) {
            $dataKeranjang = array(
                'ID_Informasi' => $informasi,
                'ID_Pengguna' => $pengguna,
                'Status_Keranjang' => 1
            );

            $simpanDataKeranjang = $transaksiModel->masukKeranjangTransaksiPengguna($dataKeranjang);

            if ($simpanDataKeranjang) {
                setPesanKeberhasilan("berhasil");
            } else {
                setPesanKesalahan("Gagal");
            }
        } else {
            setPesanKesalahan("Pengguna belum terdaftar atau tidak valid.");
        }

        if (!is_null($perusahaan) && $transaksiModel->cekPerusahaanTerdaftar($perusahaan)) {
            $dataKeranjang = array(
                'ID_Informasi' => $informasi,
                'ID_Perusahaan' => $perusahaan,
                'Status_Keranjang' => 1
            );

            $simpanDataKeranjang = $transaksiModel->masukKeranjangTransaksiPerusahaan($dataKeranjang);

            if ($simpanDataKeranjang) {
                setPesanKeberhasilan("berhasil");
            } else {
                setPesanKesalahan("Gagal");
            }
        } else {
            setPesanKesalahan("Perusahaan belum terdaftar atau tidak valid.");
        }
    } else {
        setPesanKesalahan("Anda harus login atau mendaftar terlebih dahulu.");
    }

    header("Location: $akarUrl" . "src/user/pages/checkout.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/checkout.php");
    exit;
}
