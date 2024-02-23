<?php
require_once 'databases.php';

$_SESSION['gagal'] = $_SESSION['gagal'] ?? '';

function setPesanKesalahan($pesan_kesalahan)
{
    $_SESSION['gagal'] = $pesan_kesalahan;
}

function setPesanKeberhasilan($pesan_keberhasilan)
{
    $_SESSION['berhasil'] = $pesan_keberhasilan;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAdmin = $_POST['idAdmin'] ?? '';
    $namaDepan = $_POST['Nama_Depan'] ?? '';
    $namaBelakang = $_POST['Nama_Belakang'] ?? '';
    $namaPengguna = $_POST['Nama_Pengguna'] ?? '';
    $Apakah_Admin = $_POST['Apakah_Admin'] ?? '';
    $emailBaru = $_POST['Email_Baru'] ?? '';

    if (!is_numeric($idAdmin) || $idAdmin <= 0) {
        $errorMessage = "ID Admin tidak valid.";
        setPesanKesalahan($errorMessage);
        echo json_encode(array("success" => false, "message" => $errorMessage));
        exit;
    }

    $fotoAdmin = $_FILES['fotoEditAdmin'];
    $namaFotoAdmin = $fotoAdmin['name'];
    $fotoAdminTemp = $fotoAdmin['tmp_name'];
    $ukuranFotoAdmin = $fotoAdmin['size'];
    $errorFotoAdmin = $fotoAdmin['error'];

    $tujuanDirektori = '../assets/image/uploads/';
    $namaFotoAdminBaru = uniqid() . '_' . $namaFotoAdmin;
    $tujuanFotoAdmin = $tujuanDirektori . $namaFotoAdminBaru;

    if ($ukuranFotoAdmin > 2 * 1024 * 1024) {
        $errorMessage = "Ukuran foto admin melebihi batas maksimal 2MB.";
        setPesanKesalahan($errorMessage);
        echo json_encode(array("success" => false, "message" => $errorMessage));
        exit;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFoto = strtolower(pathinfo($namaFotoAdmin, PATHINFO_EXTENSION));

    if (!in_array($ekstensiFoto, $ekstensiValid)) {
        $errorMessage = "Format foto harus berupa JPG, JPEG, atau PNG.";
        setPesanKesalahan($errorMessage);
        echo json_encode(array("success" => false, "message" => $errorMessage));
        exit;
    }

    if (move_uploaded_file($fotoAdminTemp, $tujuanFotoAdmin)) {
        $adminModel = new Admin($koneksi);
        $adminData = $adminModel->getDataById($idAdmin);

        if ($adminData['Email'] === $emailBaru) {
            $verifikasiEmailData = $adminData;
            $verifikasiEmailData['Nama_Belakang'] = $namaBelakang;
            $verifikasiEmailData['Apakah_Admin'] = $Apakah_Admin;
        } else {
        }

        $akunData = array(
            "Apakah_Admin" => $Apakah_Admin,
            "Nama_Pengguna" => $namaPengguna,
            "Email_Baru" => $emailBaru,
            "Foto" => $tujuanFotoAdmin
        );

        $updateStatus = $adminModel->perbaruiAdmin($idAdmin, $akunData, $verifikasiEmailData);

        if ($updateStatus) {
            $successMessage = "Data admin berhasil diperbarui.";
            echo json_encode(array("success" => true, "message" => $successMessage));
        } else {
            $errorMessage = "Gagal memperbarui data admin.";
            setPesanKesalahan($errorMessage);
            echo json_encode(array("success" => false, "message" => $errorMessage));
        }
    } else {
        $errorMessage = "Gagal mengupload foto admin.";
        setPesanKesalahan($errorMessage);
        echo json_encode(array("success" => false, "message" => $errorMessage));
    }
}
