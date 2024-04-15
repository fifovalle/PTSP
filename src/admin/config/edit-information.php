<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $informasiID = $_POST['ID_Informasi'] ?? '';
    $fotoInformasi = $_FILES['Foto_Informasi'] ?? '';
    $namaInformasi = $_POST['Nama_Informasi'] ?? '';
    $deskripsiInformasi = $_POST['Deskripsi_Informasi'] ?? '';
    $hargaInformasi = $_POST['Harga_Informasi'] ?? '';
    $pemilikInformasi = $_POST['Pemilik_Informasi'] ?? '';
    $kategoriInformasi = $_POST['Kategori_Informasi'] ?? '';
    $statusInformasi = $_POST['Status_Informasi'] ?? '';

    $informasiModel = new Informasi($koneksi);

    $informasiLama = $informasiModel->getDataInformasiById($informasiID);
    $pemilikInformasiLama = $informasiLama['Pemilik_Informasi'];
    $nomorRekeningInformasiLama = $informasiLama['No_Rekening_Informasi'];
    $fotoInformasiLama = $informasiLama['Foto_Informasi'];

    if ($pemilikInformasiLama !== $pemilikInformasi) {
        if ($pemilikInformasi === 'Instansi A') {
            $nomorRekeningInformasi = '1111';
        } elseif ($pemilikInformasi === 'Instansi B') {
            $nomorRekeningInformasi = '2222';
        } elseif ($pemilikInformasi === 'Instansi C') {
            $nomorRekeningInformasi = '3333';
        } else {
            echo json_encode(array("success" => false, "message" => "Instansi tidak valid."));
            exit;
        }

        $updateNomorRekening = $informasiModel->perbaruiNomorRekening($informasiID, $nomorRekeningInformasi);

        if (!$updateNomorRekening) {
            echo json_encode(array("success" => false, "message" => "Gagal memperbarui nomor rekening."));
            exit;
        }
    } else {
        $nomorRekeningInformasi = $nomorRekeningInformasiLama;
    }

    if (empty($fotoInformasi['name'])) {
        $namaFotoBaru = $fotoInformasiLama;
    } else {
        $ekstensi = pathinfo($fotoInformasi['name'], PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../assets/image/uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoInformasi['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        // Hapus foto lama
        if (!empty($fotoInformasiLama)) {
            if (file_exists($fotoInformasiLama)) {
                unlink($fotoInformasiLama);
            } else {
                $pathFotoLama = "../assets/image/uploads/" . $fotoInformasiLama;
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        }
    }

    $dataInformasi = array(
        'Foto_Informasi' => $namaFotoBaru,
        'Nama_Informasi' => $namaInformasi,
        'Deskripsi_Informasi' => $deskripsiInformasi,
        'Harga_Informasi' => $hargaInformasi,
        'Pemilik_Informasi' => $pemilikInformasi,
        'Kategori_Informasi' => $kategoriInformasi,
        'Status_Informasi' => $statusInformasi
    );

    $updateDataInformasi = $informasiModel->perbaruiInformasi($informasiID, $dataInformasi);

    if ($updateDataInformasi) {
        echo json_encode(array("success" => true, "message" => "Data informasi berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data informasi."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
