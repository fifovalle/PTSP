<?php
include 'databases.php';

$produkModel = new Produk($koneksi);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduk = $_POST['ID_Produk'] ?? '';
    $namaProduk = $_POST['Nama_Produk'] ?? '';
    $deskripsiProduk = $_POST['Deskripsi_Produk'] ?? '';
    $hargaProduk = $_POST['Harga_Produk'] ?? '';
    $stokProduk = $_POST['Stok_Produk'] ?? '';
    $pemilikProduk = $_POST['Pemilik_Produk'] ?? '';
    $noRekening = $_POST['No_Rekening'] ?? '';
    $statusProduk = $_POST['Status_Produk'] ?? '';

    $requiredFields = ['ID_Produk', 'Nama_Produk', 'Deskripsi_Produk', 'Harga_Produk', 'Stok_Produk', 'Pemilik_Produk', 'Status_Produk'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(array("success" => false, "message" => "Gagal mengedit data produk. Harap isi semua field."));
            exit;
        }
    }

    if ($pemilikProduk === 'Instansi A') {
        $nomorRekening = '1111';
    } elseif ($pemilikProduk === 'Instansi B') {
        $nomorRekening = '2222';
    } elseif ($pemilikProduk === 'Instansi C') {
        $nomorRekening = '3333';
    } else {
        echo json_encode(array("success" => false, "message" => "Instansi tidak valid."));
        exit;
    }

    $nomorRekeningFormatted = $nomorRekening;

    $obyekProduk = new Produk($koneksi);

    if (!empty($_FILES['Foto_Produk']['name'])) {
        $fotoProduk = $_FILES['Foto_Produk'];
        $namaFotoAsli = $fotoProduk['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../assets/image/uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoProduk['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFotoLama = $produkModel->getFotoProdukById($idProduk);
        if (!empty($namaFotoLama)) {
            if (file_exists($namaFotoLama)) {
                unlink($namaFotoLama);
            } else {
                $pathFotoLama = "../assets/image/uploads/" . $namaFotoLama;
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        }
    } else {
        $tujuanFoto = $produkModel->getFotoProdukById($idProduk);
    }

    $dataProduk = array(
        'Foto_Produk' => $tujuanFoto,
        'Nama_Produk' => $namaProduk,
        'Deskripsi_Produk' => $deskripsiProduk,
        'Harga_Produk' => $hargaProduk,
        'Stok_Produk' => $stokProduk,
        'Pemilik_Produk' => $pemilikProduk,
        'No_Rekening' => $nomorRekeningFormatted,
        'Status_Produk' => $statusProduk
    );

    $updateDataProduk = $produkModel->perbaruiProduk($idProduk, $dataProduk);

    if ($updateDataProduk) {
        echo json_encode(array("success" => true, "message" => "Data produk berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data produk."));
        exit;
    }
}
