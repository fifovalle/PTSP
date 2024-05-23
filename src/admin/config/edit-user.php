<?php
include 'databases.php';

function containsXSS($input)
{
    $xss_patterns = [
        "/<script\b[^>]*>(.*?)<\/script>/is",
        "/<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:/i",
        "/<iframe\b[^>]*>(.*?)<\/iframe>/is",
        "/<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:/i",
        "/<object\b[^>]*>(.*?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<script\b[^>]*>[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
        "/<a\b[^>]*href\s*=\s*(?:\"|')(?:javascript:|.*?\"javascript:).*?(?:\"|')/i",
        "/<embed\b[^>]*>(.*?)<\/embed>/is",
        "/<applet\b[^>]*>(.*?)<\/applet>/is",
        "/<!--.*?-->/",
        "/(<script\b[^>]*>(.*?)<\/script>|<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:|<iframe\b[^>]*>(.*?)<\/iframe>|<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:|<object\b[^>]*>(.*?)<\/object>|on[a-zA-Z]+\s*=\s*\"[^\"]*\"|<[^>]*(>|$)(?:<|>)+|<[^>]*script\s*.*?(?:>|$)|<![^>]*-->|eval\s*\((.*?)\)|setTimeout\s*\((.*?)\)|<[^>]*\bstyle\s*=\s*[\"'][^\"']*[;{][^\"']*['\"]|<meta[^>]*http-equiv=[\"']?refresh[\"']?[^>]*url=|<[^>]*src\s*=\s*\"[^>]*\"[^>]*>|expression\s*\((.*?)\))/i"
    ];

    foreach ($xss_patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $idPengguna = filter_input(INPUT_POST, 'ID_Pengguna', FILTER_SANITIZE_STRING);
    $namaDepan = filter_input(INPUT_POST, 'Nama_Depan_Pengguna', FILTER_SANITIZE_STRING);
    $namaBelakang = filter_input(INPUT_POST, 'Nama_Belakang_Pengguna', FILTER_SANITIZE_STRING);
    $namaPengguna = filter_input(INPUT_POST, 'Nama_Pengguna_Pengguna', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'Email_Pengguna', FILTER_VALIDATE_EMAIL);
    $nomorTelepon = filter_input(INPUT_POST, 'No_Telepon_Pengguna', FILTER_SANITIZE_STRING);
    $jenisKelamin = filter_input(INPUT_POST, 'Jenis_Kelamin_Pengguna', FILTER_SANITIZE_STRING);
    $alamatPengguna = filter_input(INPUT_POST, 'Alamat_Pengguna', FILTER_SANITIZE_STRING);

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
