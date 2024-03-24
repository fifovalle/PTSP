<?php
include 'databases.php';

$pesanKesalahan = '';

if (isset($_POST['Simpan'])) {
    $jenisPengguna = $_POST['jenisPengguna'];
    if ($jenisPengguna === 'pengguna') {
        $idPengguna = $_POST['ID_Pengguna'];
        $namaDepan = $_POST['Nama_Depan_Pengguna'];
        $namaBelakang = $_POST['Nama_Belakang_Pengguna'];
        $namaPengguna = $_POST['Nama_Pengguna'];
        $pekerjaanPengguna = $_POST['Pekerjaan_Pengguna'];
        $pendidikanTerakhirPengguna = $_POST['Pendidikan_Terakhir_Pengguna'];
        $email = $_POST['Email_Pengguna'];
        $nomorTelepon = $_POST['No_Telepon_Pengguna'];
        $alamatPengguna = $_POST['Alamat_Pengguna'];

        $nomorTeleponFormatted = $nomorTelepon;
        if (strpos($nomorTeleponFormatted, '-') === false) {
            $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . '-' . substr($nomorTeleponFormatted, 3, 4) . '-' . substr($nomorTeleponFormatted, 7);
        }
        if (strpos($nomorTeleponFormatted, '+62') === false) {
            $nomorTeleponFormatted = '+62 ' . $nomorTeleponFormatted;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $pesanKesalahan .= "Format email tidak valid. ";
        }

        if (empty($namaDepan) || empty($namaBelakang) || empty($namaPengguna) || empty($email) || empty($nomorTelepon) || empty($alamatPengguna)) {
            $pesanKesalahan .= "Semua bidang harus diisi. ";
        }

        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: $akarUrl/src/user/pages/profile.php");
            exit;
        }

        $dataPengguna = array(
            'Nama_Depan_Pengguna' => $namaDepan,
            'Nama_Belakang_Pengguna' => $namaBelakang,
            'Nama_Pengguna' => $namaPengguna,
            'Email_Pengguna' => $email,
            'No_Telepon_Pengguna' =>  $nomorTeleponFormatted,
            'Alamat_Pengguna' => $alamatPengguna,
            'Pekerjaan_Pengguna' => $pekerjaanPengguna,
            'Pendidikan_Terakhir_Pengguna' => $pendidikanTerakhirPengguna
        );

        $statusPerbarui = $obyekPengguna->perbaruiPengguna($idPengguna, $dataPengguna);

        if ($statusPerbarui) {
            setPesanKeberhasilan("Data pengguna berhasil diperbarui.");
        } else {
            setPesanKesalahan("Gagal memperbarui data pengguna.");
        }
        header("Location: $akarUrl/src/user/pages/profile.php");
        exit;
    } elseif ($jenisPengguna === 'perusahaan') {
        $idPerusahaan = $_POST['ID_Perusahaan'];
        $namaDepan = $_POST['Nama_Depan_Anggota_Perusahaan'];
        $namaBelakang = $_POST['Nama_Belakang_Anggota_Perusahaan'];
        $pekerjaanPerusahaan = $_POST['Pekerjaan_Anggota_Perusahaan'];
        $pendidikanTerakhirPerusahaan = $_POST['Pendidikan_Terakhir_Perusahaan'];
        $emailPerusahaan = $_POST['Email_Perusahaan'];
        $nomorTeleponPerusahaan = $_POST['No_Telepon_Anggota_Perusahaan'];
        $alamatPerusahaan = $_POST['Alamat_Anggota_Perusahaan'];

        $nomorTeleponFormatted = $nomorTeleponPerusahaan;
        if (strpos($nomorTeleponFormatted, '-') === false) {
            $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . '-' . substr($nomorTeleponFormatted, 3, 4) . '-' . substr($nomorTeleponFormatted, 7);
        }
        if (strpos($nomorTeleponFormatted, '+62') === false) {
            $nomorTeleponFormatted = '+62 ' . $nomorTeleponFormatted;
        }

        if (!filter_var($emailPerusahaan, FILTER_VALIDATE_EMAIL)) {
            $pesanKesalahan .= "Format email perusahaan tidak valid. ";
        }

        if (empty($namaDepan) || empty($namaBelakang) || empty($emailPerusahaan) || empty($nomorTeleponPerusahaan) || empty($alamatPerusahaan)) {
            $pesanKesalahan .= "Semua bidang perusahaan harus diisi. ";
        }

        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: $akarUrl/src/user/pages/profile.php");
            exit;
        }

        $dataPerusahaan = array(
            'Nama_Depan_Anggota_Perusahaan' => $namaDepan,
            'Nama_Belakang_Anggota_Perusahaan' => $namaBelakang,
            'Email_Perusahaan' => $emailPerusahaan,
            'No_Telepon_Anggota_Perusahaan' =>  $nomorTeleponFormatted,
            'Alamat_Anggota_Perusahaan' => $alamatPerusahaan,
            'Pekerjaan_Anggota_Perusahaan' => $pekerjaanPerusahaan,
            'Pendidikan_Terakhir_Perusahaan' => $pendidikanTerakhirPerusahaan
        );

        $statusPerbarui = $objekPerusahaan->perbaruiPerusahaan($idPerusahaan, $dataPerusahaan);

        if ($statusPerbarui) {
            setPesanKeberhasilan("Data perusahaan berhasil diperbarui.");
        } else {
            setPesanKesalahan("Gagal memperbarui data perusahaan.");
        }
        header("Location: $akarUrl/src/user/pages/profile.php");
        exit;
    } else {
        header("Location: $akarUrl/src/user/pages/profile.php");
        exit;
    }
}
