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
    $namaDepan = $_POST['Nama_Depan_Admin'];
    $namaBelakang = $_POST['Nama_Belakang_Admin'];
    $namaPengguna = $_POST['Nama_Pengguna_Admin'];
    $email = $_POST['Email_Admin'];
    $nomorTelepon = $_POST['No_Telepon_Admin'];
    $jenisKelamin = $_POST['Jenis_Kelamin_Admin'];
    $peranAdmin = $_POST['Peran_Admin'];
    $alamatAdmin = $_POST['Alamat_Admin'];
    $token = uniqid();

    $pesanKesalahan = '';

    $nomorTeleponFormatted = '+62 ' . substr($nomorTelepon, 0, 3) . '-' . substr($nomorTelepon, 4, 4) . '-' . substr($nomorTelepon, 7);


    if (empty($namaDepan) || empty($namaBelakang) || empty($namaPengguna) || empty($email) || empty($nomorTelepon) || empty($jenisKelamin) || empty($peranAdmin) || empty($alamatAdmin)) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesanKesalahan .= "Format email tidak valid. ";
    }

    if (!is_numeric($nomorTelepon)) {
        $pesanKesalahan .= "Nomor telepon hanya boleh berisi angka. ";
    }

    $fotoAdmin = $_FILES['Foto_Admin'];

    $namaFotoAdmin = $fotoAdmin['name'];
    $fotoAdminTemp = $fotoAdmin['tmp_name'];
    $ukuranFotoAdmin = $fotoAdmin['size'];
    $errorFotoAdmin = $fotoAdmin['error'];

    $tujuanFotoAdmin = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    $apakahaUnggahBerhasil = ($errorFotoAdmin === 0 && !empty($namaFotoAdmin)) && ($ukuranFotoAdmin <= $ukuranMaksimal);
    $pesanKesalahan .= (!$apakahaUnggahBerhasil && empty($pesanKesalahan)) ? "Gagal mengupload foto admin atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB." : '';

    $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
    $formatFoto = strtolower(pathinfo($namaFotoAdmin, PATHINFO_EXTENSION));
    $apakahFormatDisetujui = in_array($formatFoto, $formatYangDisetujui);
    $pesanKesalahan .= (!$apakahFormatDisetujui && empty($pesanKesalahan)) ? "Format foto harus berupa JPG, JPEG, atau PNG." : '';

    $namaFotoAdminBaru = $apakahFormatDisetujui ? uniqid() . '.' . $formatFoto : '';

    $tujuanFotoAdmin = $apakahFormatDisetujui ? '../assets/image/uploads/' . $namaFotoAdminBaru : '';

    $apakahBerhasilDipindahkan = $apakahFormatDisetujui ? move_uploaded_file($fotoAdminTemp, $tujuanFotoAdmin) : false;
    $pesanKesalahan .= (!$apakahBerhasilDipindahkan && empty($pesanKesalahan)) ? "Gagal mengupload foto admin." : '';

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl/src/admin/pages/data.php");
        exit;
    }

    $dataAdmin = array(
        'Foto' => $tujuanFotoAdmin,
        'Nama_Depan_Admin' => $namaDepan,
        'Nama_Belakang_Admin' => $namaBelakang,
        'Nama_Pengguna_Admin' => $namaPengguna,
        'Email_Admin' => $email,
        'No_Telepon_Admin' => $nomorTeleponFormatted,
        'Jenis_Kelamin_Admin' => $jenisKelamin,
        'Peran_Admin' => $peranAdmin,
        'Alamat_Admin' => $alamatAdmin,
        'Status_Verifikasi_Admin' => "Belum Terverifikasi",
        'token' => $token
    );

    $obyekAdmin = new Admin($koneksi);
    $simpanDataAdmin = $obyekAdmin->tambahAdmin($dataAdmin);

    if ($simpanDataAdmin) {
        setPesanKeberhasilan("Data admin berhasil disimpan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data admin.");
    }

    header("Location: $akarUrl/src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl/src/admin/pages/data.php");
    exit;
}
