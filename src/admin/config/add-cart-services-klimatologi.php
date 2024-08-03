<?php
include 'databases.php';

if (isset($_POST['tambah_keranjang'])) {
    if (isset($_SESSION['ID_Pengguna']) || isset($_SESSION['ID_Perusahaan'])) {
        $jasa = $_POST['Jasa'];
        $pemilik_jasa = $_POST['Pemilik_Jasa'];
        $pengguna = isset($_POST['Pengguna']) ? $_POST['Pengguna'] : null;
        $perusahaan = isset($_POST['Perusahaan']) ? $_POST['Perusahaan'] : null;
        $tanggal_pembelian = date('Y-m-d H:i:s');
        $transaksiModel = new Transaksi($koneksi);

        if (!is_null($pengguna)) {
            if ($transaksiModel->cekJasaDiKeranjangPengguna($jasa, $pengguna)) {
                setPesanKesalahan("Jasa sudah ada di keranjang.");
                header("Location: $akarUrl" . "src/user/pages/checkout.php");
                exit;
            }
            if (!$transaksiModel->cekPenggunaTerdaftar($pengguna)) {
                setPesanKesalahan("Pengguna belum terdaftar atau tidak valid.");
                header("Location: $akarUrl" . "src/user/partials/produk-jasa-klimatologi.php");
                exit;
            }
            if ($transaksiModel->apakahSudahMembeliJasaLainPengguna($pemilik_jasa, $pengguna)) {
                setPesanKesalahan("Anda sudah membeli jasa lain dari pemilik jasa yang berbeda.");
                header("Location: $akarUrl" . "src/user/pages/checkout.php");
                exit;
            }
            $dataKeranjang = array(
                'ID_Jasa' => $jasa,
                'ID_Pengguna' => $pengguna,
                'Tanggal_Pembelian' => $tanggal_pembelian,
                'Status_Transaksi' => "Belum Disetujui",
            );

            $simpanDataKeranjang = $transaksiModel->masukKeranjangTransaksiPenggunaJasa($dataKeranjang);

            if ($simpanDataKeranjang) {
                setPesanKeberhasilan("Berhasil Ditambahkan Ke Keranjang Silahkan Cek Keranjang Untuk Chekout");
            } else {
                setPesanKesalahan("Maaf, terjadi kesalahan saat mencoba menambahkan jasa ke keranjang belanja. Mohon coba lagi nanti.");
            }
        }

        if (!is_null($perusahaan)) {
            if ($transaksiModel->cekJasaDiKeranjangPerusahaan($jasa, $perusahaan)) {
                setPesanKesalahan("Jasa sudah ada di keranjang.");
                header("Location: $akarUrl" . "src/user/pages/checkout.php");
                exit;
            }
            if (!$transaksiModel->cekPerusahaanTerdaftar($perusahaan)) {
                setPesanKesalahan("Perusahaan belum terdaftar atau tidak valid.");
                header("Location: $akarUrl" . "src/user/partials/produk-jasa-klimatologi.php");
                exit;
            }
            if ($transaksiModel->apakahSudahMembeliJasaLainPerusahaan($pemilik_jasa, $perusahaan)) {
                setPesanKesalahan("Anda sudah membeli jasa lain dari pemilik jasa yang berbeda.");
                header("Location: $akarUrl" . "src/user/pages/checkout.php");
                exit;
            }
            $dataKeranjang = array(
                'ID_Jasa' => $jasa,
                'ID_Perusahaan' => $perusahaan,
                'Tanggal_Pembelian' => $tanggal_pembelian,
                'Status_Transaksi' => "Belum Disetujui",
            );

            $simpanDataKeranjang = $transaksiModel->masukKeranjangTransaksiPerusahaanJasa($dataKeranjang);

            if ($simpanDataKeranjang) {
                setPesanKeberhasilan("Berhasil Ditambahkan Ke Keranjang Silahkan Cek Keranjang Untuk Chekout");
            } else {
                setPesanKesalahan("Gagal");
            }
        }
    } else {
        setPesanKesalahan("Anda harus login atau mendaftar terlebih dahulu.");
        header("Location: $akarUrl" . "src/user/pages/login.php");
        exit;
    }

    header("Location: $akarUrl" . "src/user/partials/produk-jasa-klimatologi.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/partials/produk-jasa-klimatologi.php");
    exit;
}
