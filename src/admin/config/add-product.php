<?php
include 'databases.php';
$akarUrl = "http://localhost/PTSP/";
$halamanSaatIni = basename($_SERVER['PHP_SELF']);

$_SESSION['gagal'] = $_SESSION['gagal'] ?? '';

function setPesanKesalahan($pesan_kesalahan)
{
    $_SESSION['gagal'] = $pesan_kesalahan;
}

function setPesanKeberhasilan($pesan_keberhasilan)
{
    $_SESSION['berhasil'] = $pesan_keberhasilan;
}

if (isset($_POST['Simpan'])) {
    $namaProduk = $_POST['Nama_Produk'];
    $deskripsiProduk = $_POST['Deskripsi_Produk'];
    $hargaProduk = $_POST['Harga_Produk'];
    $stokProduk = $_POST['Stok_Produk'];
    $pemilikProduk = $_POST['Pemilik_Produk'];
    $noRekening = $_POST['No_Rekening'];
    $statusProduk = $_POST['Status_Produk'];

    $produkModel = new Produk($koneksi);

    $pesanKesalahan = '';

    if (empty($namaProduk) || empty($deskripsiProduk) || empty($hargaProduk) || empty($stokProduk) || empty($pemilikProduk) || empty($statusProduk)) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

    if ($pemilikProduk === 'Instansi A') {
        $nomorRekening = '1111';
    } elseif ($pemilikProduk === 'Instansi B') {
        $nomorRekening = '2222';
    } elseif ($pemilikProduk === 'Instansi C') {
        $nomorRekening = '3333';
    } else {
        $pesanKesalahan .= "Instansi tidak valid. ";
    }

    $nomorRekeningFormatted = $nomorRekening;

    $fotoProduk = $_FILES['Foto_Produk'];

    $namaFotoProduk = $fotoProduk['name'];
    $fotoProdukTemp = $fotoProduk['tmp_name'];
    $ukuranFotoProduk = $fotoProduk['size'];
    $errorFotoProduk = $fotoProduk['error'];

    $tujuanFotoProduk = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    $apakahUnggahBerhasil = ($errorFotoProduk === 0 && !empty($namaFotoProduk)) && ($ukuranFotoProduk <= $ukuranMaksimal);
    $pesanKesalahan .= (!$apakahUnggahBerhasil && empty($pesanKesalahan)) ? "Gagal mengupload foto produk atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB." : '';

    $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
    $formatFotoProduk = strtolower(pathinfo($namaFotoProduk, PATHINFO_EXTENSION));
    $apakahFormatDisetujui = in_array($formatFotoProduk, $formatYangDisetujui);
    $pesanKesalahan .= (!$apakahFormatDisetujui && empty($pesanKesalahan)) ? "Format foto produk harus berupa JPG, JPEG, atau PNG." : '';

    $namaFotoProdukBaru = $apakahFormatDisetujui ? uniqid() . '.' . $formatFotoProduk : '';

    $tujuanFotoProduk = $apakahFormatDisetujui ? '../assets/image/uploads/' . $namaFotoProdukBaru : '';

    $berhasilDipindahkan = $apakahFormatDisetujui ? move_uploaded_file($fotoProdukTemp, $tujuanFotoProduk) : false;
    $pesanKesalahan .= (!$berhasilDipindahkan && empty($pesanKesalahan)) ? "Gagal mengupload foto produk." : '';

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    }

    $dataProduk = array(
        'Foto_Produk' => $namaFotoProdukBaru,
        'Nama_Produk' => $namaProduk,
        'Deskripsi_Produk' => $deskripsiProduk,
        'Harga_Produk' => $hargaProduk,
        'Stok_Produk' => $stokProduk,
        'Pemilik_Produk' => $pemilikProduk,
        'No_Rekening' => $nomorRekeningFormatted,
        'Status_Produk' => $statusProduk
    );

    $simpanDataProduk = $produkModel->tambahProduk($dataProduk);

    if ($simpanDataProduk) {
        setPesanKeberhasilan("Data produk berhasil disimpan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data produk.");
    }

    header("Location: $akarUrl/src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl/src/admin/pages/data.php");
    exit;
}
