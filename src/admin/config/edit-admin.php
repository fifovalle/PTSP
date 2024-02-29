<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAdmin = $_POST['ID_Admin'] ?? '';
    $namaDepan = $_POST['Nama_Depan_Admin'] ?? '';
    $namaBelakang = $_POST['Nama_Belakang_Admin'] ?? '';
    $namaPengguna = $_POST['Nama_Pengguna_Admin'] ?? '';
    $email = $_POST['Email_Admin'] ?? '';
    $nomorTelepon = $_POST['No_Telepon_Admin'] ?? '';
    $jenisKelamin = $_POST['Jenis_Kelamin_Admin'] ?? '';
    $peranAdmin = $_POST['Peran_Admin'] ?? '';
    $alamatAdmin = $_POST['Alamat_Admin'] ?? '';

    $nomorTeleponFormatted = $nomorTelepon;

    if (strpos($nomorTeleponFormatted, '-') === false) {
        $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . '-' . substr($nomorTeleponFormatted, 3, 4) . '-' . substr($nomorTeleponFormatted, 7);
    }

    if (strpos($nomorTeleponFormatted, '+62') === false) {
        $nomorTeleponFormatted = '+62 ' . $nomorTeleponFormatted;
    }


    $requiredFields = ['ID_Admin', 'Nama_Depan_Admin', 'Nama_Belakang_Admin', 'Nama_Pengguna_Admin', 'Email_Admin', 'No_Telepon_Admin', 'Jenis_Kelamin_Admin', 'Peran_Admin', 'Alamat_Admin'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(array("success" => false, "message" => "Gagal mengedit data admin. Harap isi semua field."));
            exit;
        }
    }

    $email = filter_var($_POST['Email_Admin'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo json_encode(array("success" => false, "message" => "Format email tidak valid."));
        exit;
    }

    $obyekAdmin = new Admin($koneksi);

    if (!empty($_FILES['Foto_Admin']['name'])) {
        $fotoAdmin = $_FILES['Foto_Admin'];
        $namaFotoAsli = $fotoAdmin['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../assets/image/uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoAdmin['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFotoLama = $obyekAdmin->getFotoAdminById($idAdmin);
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
        $namaFotoBaru = $obyekAdmin->getFotoAdminById($idAdmin);
    }

    $dataAdmin = array(
        'Foto' => $namaFotoBaru,
        'Nama_Depan_Admin' => $namaDepan,
        'Nama_Belakang_Admin' => $namaBelakang,
        'Nama_Pengguna_Admin' => $namaPengguna,
        'Email_Admin' => $email,
        'No_Telepon_Admin' => $nomorTeleponFormatted,
        'Jenis_Kelamin_Admin' => $jenisKelamin,
        'Peran_Admin' => $peranAdmin,
        'Alamat_Admin' => $alamatAdmin
    );

    $idAdmin = $_POST['ID_Admin'];
    $updateDataAdmin = $obyekAdmin->perbaruiAdmin($idAdmin, $dataAdmin);

    if ($updateDataAdmin) {
        echo json_encode(array("success" => true, "message" => "Data admin berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data admin."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Token tidak valid."));
    exit;
}
