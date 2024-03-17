<?php
include 'databases.php';

if (isset($_POST['Daftar'])) {
    $noIdentitas = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Identitas']));
    $namaDepan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Depan']));
    $namaBelakang = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Belakang']));
    $pekerjaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Pekerjaan']));
    $pendidikanTerakhir = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Pendidikan_Terakhir']));
    $jenisKelamin = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Jenis_Kelamin']));
    $alamat = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Alamat']));
    $noTelepon = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Telepon']));
    $provinsi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Provinsi']));
    $kabupatenKota = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kabupaten_Kota']));
    $noNPWP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_NPWP']));
    $namaPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Perusahaan']));
    $alamatPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Alamat_Perusahaan']));
    $provinsiPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Provinsi_Perusahaan']));
    $kabupatenKotaPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kabupaten_Kota_Perusahaan']));
    $emailPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email_Perusahaan']));
    $noTeleponPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Telepon_Perusahaan']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $namaPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Pengguna']));
    $kataSandi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kata_Sandi']));
    $konfirmasiKataSandi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Konfirmasi_Kata_Sandi']));
    $token = uniqid();

    // Membuat objek perusahaan
    $obyekPerusahaan = new Pengguna($koneksi);

    $pesanKesalahan = '';

    // Format nomor telepon
    $nomorTeleponFormatted = '+62 ' . substr($noTelepon, 0, 3) . '-' . substr($noTelepon, 3, 4) . '-' . substr($noTelepon, 7);
    $nomorTeleponPerusahaanFormatted = '+62 ' . substr($noTeleponPerusahaan, 0, 3) . '-' . substr($noTeleponPerusahaan, 3, 4) . '-' . substr($noTeleponPerusahaan, 7);

    // Validasi kata sandi
    $panjangKataSandi = strlen($kataSandi) >= 8;
    $persyaratanKataSandi = preg_match('/[A-Z]/', $kataSandi) && preg_match('/[a-z]/', $kataSandi) && preg_match('/[0-9]/', $kataSandi) && preg_match('/[^A-Za-z0-9]/', $kataSandi);
    $kataSandiYangValid = $panjangKataSandi && $persyaratanKataSandi;
    $pesanKesalahan .= (!$kataSandiYangValid && empty($pesanKesalahan)) ? "Kata sandi harus memiliki setidaknya 8 karakter dan mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu simbol." : '';

    $kecocokanKataSandi = $kataSandi === $konfirmasiKataSandi;
    $pesanKesalahan .= (!$kecocokanKataSandi && empty($pesanKesalahan)) ? "Kata sandi dan konfirmasi kata sandi harus sama." : '';

    $hashKataSandi = password_hash($kataSandi, PASSWORD_DEFAULT);

    // Validasi email dan nomor telepon
    if (!filter_var($emailPerusahaan, FILTER_VALIDATE_EMAIL)) {
        $pesanKesalahan .= "Format email tidak valid. ";
    }

    if (!is_numeric($noTelepon)) {
        $pesanKesalahan .= "Nomor telepon individu hanya boleh berisi angka. ";
    }

    if (!is_numeric($noTeleponPerusahaan)) {
        $pesanKesalahan .= "Nomor telepon perusahaan hanya boleh berisi angka. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/user/pages/signup2.php");
        exit;
    }

    // Data perusahaan
    $dataPerusahaan = array(
        'No_Identitas' => $noIdentitas,
        'Nama_Depan' => $namaDepan,
        'Nama_Belakang' => $namaBelakang,
        'Pekerjaan' => $pekerjaan,
        'Pendidikan_Terakhir' => $pendidikanTerakhir,
        'Jenis_Kelamin' => $jenisKelamin,
        'Alamat' => $alamat,
        'No_Telepon' => $nomorTeleponFormatted,
        'Provinsi' => $provinsi,
        'Kabupaten_Kota' => $kabupatenKota,
        'No_NPWP' => $noNPWP,
        'Nama_Perusahaan' => $namaPerusahaan,
        'Alamat_Perusahaan' => $alamatPerusahaan,
        'Provinsi_Perusahaan' => $provinsiPerusahaan,
        'Kabupaten_Kota_Perusahaan' => $kabupatenKotaPerusahaan,
        'Email_Perusahaan' => $emailPerusahaan,
        'No_Telepon_Perusahaan' => $nomorTeleponPerusahaanFormatted,
        'Email' => $email,
        'Nama_Pengguna' => $namaPengguna,
        'Kata_Sandi' => $hashKataSandi,
        'Konfirmasi_Kata_Sandi' => $hashKataSandi,
        'Status_Verifikasi_Perusahaan' => "Belum Terverifikasi",
        'token' => $token
    );

    // Menambahkan perusahaan
    $simpanDataPerusahaan = $obyekPerusahaan->tambahPerusahaan($dataPerusahaan);

    if ($simpanDataPerusahaan) {
        setPesanKeberhasilan("Pendaftaran berhasil, Silahkan ke halaman login.");
    } else {
        setPesanKesalahan("Gagal mendaftar silahkan untuk mencoba lagi.");
    }

    header("Location: $akarUrl" . "src/user/pages/signup2.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/signup2.php");
    exit;
}
?>
