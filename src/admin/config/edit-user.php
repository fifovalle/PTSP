<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPengguna = $_POST['ID_Pengguna'] ?? '';
    $namaDepan = $_POST['Nama_Depan_Pengguna'] ?? '';
    $namaBelakang = $_POST['Nama_Belakang_Pengguna'] ?? '';
    $namaPengguna = $_POST['Nama_Pengguna_Pengguna'] ?? '';
    $email = $_POST['Email_Pengguna'] ?? '';
    $nomorTelepon = $_POST['No_Telepon_Pengguna'] ?? '';
    $jenisKelamin = $_POST['Jenis_Kelamin_Pengguna'] ?? '';
    $alamatPengguna = $_POST['Alamat_Pengguna'] ?? '';

    $nomorTeleponFormatted = $nomorTelepon;

    if (strpos($nomorTeleponFormatted, '-') === false) {
        $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . '-' . substr($nomorTeleponFormatted, 3, 4) . '-' . substr($nomorTeleponFormatted, 7);
    }

    if (strpos($nomorTeleponFormatted, '+62') === false) {
        $nomorTeleponFormatted = '+62 ' . $nomorTeleponFormatted;
    }

    $requiredFields = ['ID_Pengguna', 'Nama_Depan_Pengguna', 'Nama_Belakang_Pengguna', 'Nama_Pengguna_Pengguna', 'Email_Pengguna', 'No_Telepon_Pengguna', 'Jenis_Kelamin_Pengguna', 'Alamat_Pengguna'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(array("success" => false, "message" => "Gagal mengedit data pengguna. Harap isi semua field."));
            exit;
        }
    }

    $email = filter_var($_POST['Email_Pengguna'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo json_encode(array("success" => false, "message" => "Format email tidak valid."));
        exit;
    }

    $obyekPengguna = new Pengguna($koneksi);

    if (!empty($_FILES['Foto_Pengguna']['name'])) {
        $fotoPengguna = $_FILES['Foto_Pengguna'];
        $namaFotoAsli = $fotoPengguna['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../assets/image/uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoPengguna['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFotoLama = $obyekPengguna->getFotoPenggunaById($idPengguna);
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
        $namaFotoBaru = $obyekPengguna->getFotoPenggunaById($idPengguna);
    }

    $dataPengguna = array(
        'Foto' => $namaFotoBaru,
        'Nama_Depan_Pengguna' => $namaDepan,
        'Nama_Belakang_Pengguna' => $namaBelakang,
        'Nama_Pengguna' => $namaPengguna,
        'Email_Pengguna' => $email,
        'No_Telepon_Pengguna' => $nomorTeleponFormatted,
        'Jenis_Kelamin_Pengguna' => $jenisKelamin,
        'Alamat_Pengguna' => $alamatPengguna
    );

    $idPengguna = $_POST['ID_Pengguna'];
    $updateDataPengguna = $obyekPengguna->perbaruiPengguna($idPengguna, $dataPengguna);

    if ($updateDataPengguna) {
        echo json_encode(array("success" => true, "message" => "Data pengguna berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengguna."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Token tidak valid."));
    exit;
}
