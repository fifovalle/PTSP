<?php
include 'databases.php';

if (isset($_POST['Daftar'])) {
    $_SESSION['NPWP'] = $_POST['NPWP_Pengguna'];
    $_SESSION['No_Identitas'] = $_POST['No_Identitas_Pengguna'];
    $_SESSION['Pekerjaan'] = $_POST['Pekerjaan_Pengguna'];
    $_SESSION['Nama_Depan'] = $_POST['Nama_Depan_Pengguna'];
    $_SESSION['Nama_Belakang'] = $_POST['Nama_Belakang_Pengguna'];
    $_SESSION['Pendidikan'] = $_POST['Pendidikan_Terakhir_Pengguna'];
    $_SESSION['Jenis_Kelamin'] = $_POST['Jenis_Kelamin_Pengguna'];
    $_SESSION['Alamat'] = $_POST['Alamat_Pengguna'];
    $_SESSION['No_Telepon'] = $_POST['No_Telepon_Pengguna'];
    $_SESSION['Provinsi'] = $_POST['Provinsi'];
    $_SESSION['Kab/Kota'] = $_POST['Kota_Kabupaten'];
    $_SESSION['Email'] = $_POST['Email_Pengguna'];
    $_SESSION['Nama_Pengguna'] = $_POST['Nama_Pengguna'];
    $_SESSION['Kata_Sandi'] = $_POST['Kata_Sandi'];
    $_SESSION['Konfirmasi_Kata_Sandi'] = $_POST['Konfirmasi_Kata_Sandi'];
    $npwpPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['NPWP_Pengguna']));
    $noIdentitasPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Identitas_Pengguna']));
    $pekerjaanPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Pekerjaan_Pengguna']));
    $namaDepan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Depan_Pengguna']));
    $namaBelakang = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Belakang_Pengguna']));
    $pendidikanTerakhir = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Pendidikan_Terakhir_Pengguna']));
    $jenisKelamin = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Jenis_Kelamin_Pengguna']));
    $alamatPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Alamat_Pengguna']));
    $nomorTelepon = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Telepon_Pengguna']));
    $provinsi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Provinsi']));
    $kotaKabupaten = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kota_Kabupaten']));
    $emailPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email_Pengguna']));
    $namaPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Pengguna']));
    $kataSandi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kata_Sandi']));
    $konfirmasiKataSandi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Konfirmasi_Kata_Sandi']));
    $obyekPengguna = new Pengguna($koneksi);
    do {
        $token = random_int(10000000, 99999999);
        $tokenSudahAda = $obyekPengguna->getPenggunaByToken($token);
    } while ($tokenSudahAda);


    $pesanKesalahan = '';

    $nomorTeleponFormatted = '+62 ' . substr($nomorTelepon, 0, 3) . '-' . substr($nomorTelepon, 3, 4) . '-' . substr($nomorTelepon, 7);

    $panjangKataSandi = strlen($kataSandi) >= 8;
    $persyaratanKataSandi = preg_match('/[A-Z]/', $kataSandi) && preg_match('/[a-z]/', $kataSandi) && preg_match('/[0-9]/', $kataSandi) && preg_match('/[^A-Za-z0-9]/', $kataSandi);
    $kataSandiYangValid = $panjangKataSandi && $persyaratanKataSandi;
    $pesanKesalahan .= (!$kataSandiYangValid && empty($pesanKesalahan)) ? "Kata sandi harus memiliki setidaknya 8 karakter dan mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu simbol." : '';

    $kecocokanKataSandi = $kataSandi === $konfirmasiKataSandi;
    $pesanKesalahan .= (!$kecocokanKataSandi && empty($pesanKesalahan)) ? "Kata sandi dan konfirmasi kata sandi harus sama." : '';

    $hashKataSandi = password_hash($kataSandi, PASSWORD_DEFAULT);

    if (!filter_var($emailPengguna, FILTER_VALIDATE_EMAIL)) {
        $pesanKesalahan .= "Format email tidak valid. ";
    }

    if (!is_numeric($nomorTelepon)) {
        $pesanKesalahan .= "Nomor telepon hanya boleh berisi angka. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/user/pages/signup1.php");
        exit;
    }

    $dataPengguna = array(
        'NPWP_Pengguna' => $npwpPengguna,
        'No_Identitas_Pengguna' => $noIdentitasPengguna,
        'Pekerjaan_Pengguna' => $pekerjaanPengguna,
        'Nama_Depan_Pengguna' => $namaDepan,
        'Nama_Belakang_Pengguna' => $namaBelakang,
        'Pendidikan_Terakhir_Pengguna' => $pendidikanTerakhir,
        'Jenis_Kelamin_Pengguna' => $jenisKelamin,
        'Alamat_Pengguna' => $alamatPengguna,
        'No_Telepon_Pengguna' => $nomorTeleponFormatted,
        'Provinsi' => $provinsi,
        'Kabupaten_Kota' => $kotaKabupaten,
        'Email_Pengguna' => $emailPengguna,
        'Nama_Pengguna' => $namaPengguna,
        'Kata_Sandi' => $hashKataSandi,
        'Konfirmasi_Kata_Sandi' => $hashKataSandi,
        'Status_Verifikasi_Pengguna' => "Belum Terverifikasi",
        'Token' => $token
    );

    $simpanDataPengguna = $obyekPengguna->tambahPengguna($dataPengguna);

    if ($simpanDataPengguna) {
        session_unset();
        setPesanKeberhasilan("Pendaftaran berhasil, Silahkan ke halaman login.");
    } else {
        setPesanKesalahan("Gagal mendaftar silahkan untuk mencoba lagi.");
    }

    header("Location: $akarUrl" . "src/user/pages/signup1.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/signup1.php");
    exit;
}
