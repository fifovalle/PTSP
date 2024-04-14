                    <!-- Grid column -->
                    <!-- Grid column -->
<?php
include 'databases.php';

if (isset($_POST['Daftar'])) {
    $_SESSION['No_Identitas'] = htmlspecialchars($_POST['No_Identitas_Anggota_Perusahaan']);
    $_SESSION['Nama_Depan'] = htmlspecialchars($_POST['Nama_Depan_Anggota_Perusahaan']);
    $_SESSION['Nama_Belakang'] = htmlspecialchars($_POST['Nama_Belakang_Anggota_Perusahaan']);
    $_SESSION['Pekerjaan'] = htmlspecialchars($_POST['Pekerjaan_Anggota_Perusahaan']);
    $_SESSION['Pendidikan'] = htmlspecialchars($_POST['Pendidikan_Terakhir_Anggota_Perusahaan']);
    $_SESSION['Jenis_Kelamin'] = htmlspecialchars($_POST['Jenis_Kelamin_Anggota_Perusahaan']);
    $_SESSION['Alamat'] = htmlspecialchars($_POST['Alamat_Anggota_Perusahaan']);
    $_SESSION['No_Telepon'] = htmlspecialchars($_POST['No_Telepon_Anggota_Perusahaan']);
    $_SESSION['Provinsi'] = htmlspecialchars($_POST['Provinsi_Anggota_Perusahaan']);
    $_SESSION['Kab/Kota'] = htmlspecialchars($_POST['Kabupaten_Kota_Anggota_Perusahaan']);
    $_SESSION['NPWP'] = htmlspecialchars($_POST['No_NPWP']);
    $_SESSION['Nama_Perusahaan'] = htmlspecialchars($_POST['Nama_Perusahaan']);
    $_SESSION['Alamat_Perusahaan'] = htmlspecialchars($_POST['Alamat_Perusahaan']);
    $_SESSION['Provinsi_Perusahaan'] = htmlspecialchars($_POST['Provinsi_Perusahaan']);
    $_SESSION['Kab/KotaPerusahaan'] = htmlspecialchars($_POST['Kabupaten_Kota_Perusahaan']);
    $_SESSION['Email_Perusahaan'] = htmlspecialchars($_POST['Email_Perusahaan']);
    $_SESSION['No_Telepon_Perusahaan'] = htmlspecialchars($_POST['No_Telepon_Perusahaan']);
    $_SESSION['Email_Anggota'] = htmlspecialchars($_POST['Email_Anggota_Perusahaan']);
    $_SESSION['Nama_Pengguna'] = htmlspecialchars($_POST['Nama_Pengguna_Anggota_Perusahaan']);
    $_SESSION['Kata_Sandi'] = htmlspecialchars($_POST['Kata_Sandi_Anggota_Perusahaan']);
    $_SESSION['Konfirmasi_Kata_Sandi'] = $_POST['Konfirmasi_Kata_Sandi_Anggota_Perusahaan'];
    $noIdentitas = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Identitas_Anggota_Perusahaan']));
    $namaDepan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Depan_Anggota_Perusahaan']));
    $namaBelakang = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Belakang_Anggota_Perusahaan']));
    $pekerjaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Pekerjaan_Anggota_Perusahaan']));
    $pendidikanTerakhir = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Pendidikan_Terakhir_Anggota_Perusahaan']));
    $jenisKelamin = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Jenis_Kelamin_Anggota_Perusahaan']));
    $alamat = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Alamat_Anggota_Perusahaan']));
    $noTelepon = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Telepon_Anggota_Perusahaan']));
    $provinsi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Provinsi_Anggota_Perusahaan']));
    $kabupatenKota = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kabupaten_Kota_Anggota_Perusahaan']));
    $noNPWP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_NPWP']));
    $namaPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Perusahaan']));
    $alamatPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Alamat_Perusahaan']));
    $provinsiPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Provinsi_Perusahaan']));
    $kabupatenKotaPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kabupaten_Kota_Perusahaan']));
    $emailPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email_Perusahaan']));
    $noTeleponPerusahaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_Telepon_Perusahaan']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email_Anggota_Perusahaan']));
    $namaPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama_Pengguna_Anggota_Perusahaan']));
    $kataSandi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kata_Sandi_Anggota_Perusahaan']));
    $konfirmasiKataSandi = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Konfirmasi_Kata_Sandi_Anggota_Perusahaan']));
    $obyekPerusahaan = new Pengguna($koneksi);
    do {
        $token = random_int(10000000, 99999999);
        $tokenSudahAda = $obyekPerusahaan->getPerusahaanByToken($token);
    } while ($tokenSudahAda);

    $pesanKesalahan = '';

    $nomorTeleponFormatted = '+62 ' . substr($noTelepon, 0, 3) . '-' . substr($noTelepon, 3, 4) . '-' . substr($noTelepon, 7);
    $nomorTeleponPerusahaanFormatted = '+62 ' . substr($noTeleponPerusahaan, 0, 3) . '-' . substr($noTeleponPerusahaan, 3, 4) . '-' . substr($noTeleponPerusahaan, 7);

    $panjangKataSandi = strlen($kataSandi) >= 8;
    $persyaratanKataSandi = preg_match('/[A-Z]/', $kataSandi) && preg_match('/[a-z]/', $kataSandi) && preg_match('/[0-9]/', $kataSandi) && preg_match('/[^A-Za-z0-9]/', $kataSandi);
    $kataSandiYangValid = $panjangKataSandi && $persyaratanKataSandi;
    $pesanKesalahan .= (!$kataSandiYangValid && empty($pesanKesalahan)) ? "Kata sandi harus memiliki setidaknya 8 karakter dan mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu simbol." : '';

    $kecocokanKataSandi = $kataSandi === $konfirmasiKataSandi;
    $pesanKesalahan .= (!$kecocokanKataSandi && empty($pesanKesalahan)) ? "Kata sandi dan konfirmasi kata sandi harus sama." : '';

    $hashKataSandi = password_hash($kataSandi, PASSWORD_DEFAULT);

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

    $dataPerusahaan = array(
        'No_Identitas_Anggota_Perusahaan' => $noIdentitas,
        'Nama_Depan_Anggota_Perusahaan' => $namaDepan,
        'Nama_Belakang_Anggota_Perusahaan' => $namaBelakang,
        'Pekerjaan_Anggota_Perusahaan' => $pekerjaan,
        'Pendidikan_Terakhir_Anggota_Perusahaan' => $pendidikanTerakhir,
        'Jenis_Kelamin_Anggota_Perusahaan' => $jenisKelamin,
        'Alamat_Anggota_Perusahaan' => $alamat,
        'No_Telepon_Anggota_Perusahaan' => $nomorTeleponFormatted,
        'Provinsi_Anggota_Perusahaan' => $provinsi,
        'Kabupaten_Kota_Anggota_Perusahaan' => $kabupatenKota,
        'No_NPWP' => $noNPWP,
        'Nama_Perusahaan' => $namaPerusahaan,
        'Alamat_Perusahaan' => $alamatPerusahaan,
        'Provinsi_Perusahaan' => $provinsiPerusahaan,
        'Kabupaten_Kota_Perusahaan' => $kabupatenKotaPerusahaan,
        'Email_Perusahaan' => $emailPerusahaan,
        'No_Telepon_Perusahaan' => $nomorTeleponPerusahaanFormatted,
        'Email_Anggota_Perusahaan' => $email,
        'Nama_Pengguna_Anggota_Perusahaan' => $namaPengguna,
        'Kata_Sandi_Anggota_Perusahaan' => $hashKataSandi,
        'Konfirmasi_Kata_Sandi_Anggota_Perusahaan' => $hashKataSandi,
        'Status_Verifikasi_Perusahaan' => "Belum Terverifikasi",
        'Token' => $token
    );

    $simpanDataPerusahaan = $obyekPerusahaan->tambahPerusahaan($dataPerusahaan);

    if ($simpanDataPerusahaan) {
        session_unset();
        setPesanKeberhasilan("Pendaftaran berhasil, Silahkan ke halaman login.");
    } else {
        setPesanKesalahan("Gagal mendaftar silahkan untuk mencoba lagi.");
    }

    header("Location: $akarUrl" . "src/user/pages/login.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/signup2.php");
    exit;
}
