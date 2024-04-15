<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jasaID = $_POST['ID_Jasa'] ?? '';
    $fotoJasa = $_FILES['Foto_Jasa'] ?? '';
    $namaJasa = $_POST['Nama_Jasa'] ?? '';
    $deskripsiJasa = $_POST['Deskripsi_Jasa'] ?? '';
    $hargaJasa = $_POST['Harga_Jasa'] ?? '';
    $pemilikJasa = $_POST['Pemilik_Jasa'] ?? '';
    $kategoriJasa = $_POST['Kategori_Jasa'] ?? '';
    $statusJasa = $_POST['Status_Jasa'] ?? '';

    $jasaModel = new Jasa($koneksi);

    $jasaLama = $jasaModel->getDataJasaById($jasaID);
    $pemilikJasaLama = $jasaLama['Pemilik_Jasa'];
    $nomorRekeningJasaLama = $jasaLama['No_Rekening_Jasa'];
    $fotoJasaLama = $jasaLama['Foto_Jasa'];

    if ($pemilikJasaLama !== $pemilikJasa) {
        if ($pemilikJasa === 'Instansi A') {
            $nomorRekeningJasa = '1111';
        } elseif ($pemilikJasa === 'Instansi B') {
            $nomorRekeningJasa = '2222';
        } elseif ($pemilikJasa === 'Instansi C') {
            $nomorRekeningJasa = '3333';
        } else {
            echo json_encode(array("success" => false, "message" => "Instansi tidak valid."));
            exit;
        }

        $updateNomorRekeningJasa = $jasaModel->perbaruiNomorRekening($jasaID, $nomorRekeningJasa);

        if (!$updateNomorRekeningJasa) {
            echo json_encode(array("success" => false, "message" => "Gagal memperbarui nomor rekening jasa."));
            exit;
        }
    } else {
        $nomorRekeningJasa = $nomorRekeningJasaLama;
    }

    if (empty($fotoJasa['name'])) {
        $namaFotoBaru = $fotoJasaLama;
    } else {
        $ekstensi = pathinfo($fotoJasa['name'], PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../assets/image/uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoJasa['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        if (!empty($fotoJasaLama)) {
            if (file_exists($fotoJasaLama)) {
                unlink($fotoJasaLama);
            } else {
                $pathFotoLama = "../assets/image/uploads/" . $fotoJasaLama;
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        }
    }

    $dataJasa = array(
        'Foto_Jasa' => $namaFotoBaru,
        'Nama_Jasa' => $namaJasa,
        'Deskripsi_Jasa' => $deskripsiJasa,
        'Harga_Jasa' => $hargaJasa,
        'Pemilik_Jasa' => $pemilikJasa,
        'Kategori_Jasa' => $kategoriJasa,
        'Status_Jasa' => $statusJasa
    );

    $updateDataJasa = $jasaModel->perbaruiJasa($jasaID, $dataJasa);

    if ($updateDataJasa) {
        echo json_encode(array("success" => true, "message" => "Data jasa berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data jasa."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
