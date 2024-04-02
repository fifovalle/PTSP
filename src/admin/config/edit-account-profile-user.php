<?php
include 'databases.php';

if (isset($_POST['Simpan'])) {
    $username = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['username']));
    $namaDepan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $namaBelakang = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $pekerjaan = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Pekerjaan']));
    $pendidikanTerakhir = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['PendidikanTerakhir']));
    $email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Email']));
    $noHP = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['No_HP']));
    $jenisKelamin = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Jenis_Kelamin']));
    $alamat = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['alamat']));

    $obyekPengguna = new Pengguna($koneksi);

    if (isset($_SESSION['ID_Pengguna']) || isset($_SESSION['ID_Perusahaan'])) {
        if ($username == $_SESSION['ID_Pengguna'] || $username == $_SESSION['ID_Perusahaan']) {
            $username = isset($_SESSION['Nama_Pengguna']) ? $_SESSION['Nama_Pengguna'] : $_SESSION['Nama_Pengguna_Anggota_Perusahaan'];
            $namaDepan = isset($_SESSION['Nama_Depan_Pengguna']) ? $_SESSION['Nama_Depan_Pengguna'] : $_SESSION['Nama_Depan_Anggota_Perusahaan'];
            $namaBelakang = isset($_SESSION['Nama_Belakang_Pengguna']) ? $_SESSION['Nama_Belakang_Pengguna'] : $_SESSION['Nama_Belakang_Anggota_Perusahaan'];
            $pekerjaan = isset($_SESSION['Pekerjaan_Pengguna']) ? $_SESSION['Pekerjaan_Pengguna'] : $_SESSION['Pekerjaan_Anggota_Perusahaan'];
            $pendidikanTerakhir = isset($_SESSION['Pendidikan_Terakhir_Pengguna']) ? $_SESSION['Pendidikan_Terakhir_Pengguna'] : $_SESSION['Pendidikan_Terakhir_Anggota_Perusahaan'];
            $email = isset($_SESSION['Email_Pengguna']) ? $_SESSION['Email_Pengguna'] : $_SESSION['Email_Anggota_Perusahaan'];
            $noHP = isset($_SESSION['No_Telepon_Pengguna']) ? $_SESSION['No_Telepon_Pengguna'] : $_SESSION['No_Telepon_Anggota_Perusahaan'];
            $jenisKelamin = isset($_SESSION['Jenis_Kelamin_Pengguna']) ? $_SESSION['Jenis_Kelamin_Pengguna'] : $_SESSION['Jenis_Kelamin_Anggota_Perusahaan'];
            $alamat = isset($_SESSION['Alamat_Pengguna']) ? $_SESSION['Alamat_Pengguna'] : $_SESSION['Alamat_Anggota_Perusahaan'];
        }

        if (isset($_SESSION['ID_Pengguna'])) {
            $dataPengguna = array(
                'Nama_Pengguna' => $username,
                'Nama_Depan_Pengguna' => $namaDepan,
                'Nama_Belakang_Pengguna' => $namaBelakang,
                'Pekerjaan_Pengguna' => $pekerjaan,
                'Pendidikan_Terakhir_Pengguna' => $pendidikanTerakhir,
                'Email_Pengguna' => $email,
                'No_Telepon_Pengguna' => $noHP,
                'Jenis_Kelamin_Pengguna' => $jenisKelamin,
                'Alamat_Pengguna' => $alamat
            );
            $editPengguna = $obyekPengguna->perbaruiPengguna($_SESSION['ID_Pengguna'], $dataPengguna);

            if ($editPengguna) {
                setPesanKeberhasilan("Data pengguna berhasil diperbarui.");
            } else {
                setPesanKesalahan("Gagal memperbarui data pengguna. Silakan coba lagi.");
            }
        } elseif (isset($_SESSION['ID_Perusahaan'])) {
            $dataPerusahaan = array(
                'Nama_Pengguna_Anggota_Perusahaan' => $username,
                'Nama_Depan_Anggota_Perusahaan' => $namaDepan,
                'Nama_Belakang_Anggota_Perusahaan' => $namaBelakang,
                'Pekerjaan_Anggota_Perusahaan' => $pekerjaan,
                'Pendidikan_Terakhir_Anggota_Perusahaan' => $pendidikanTerakhir,
                'Email_Anggota_Perusahaan' => $email,
                'No_Telepon_Anggota_Perusahaan' => $noHP,
                'Jenis_Kelamin_Anggota_Perusahaan' => $jenisKelamin,
                'Alamat_Anggota_Perusahaan' => $alamat
            );
            $editPerusahaan = $obyekPengguna->perbaruiPerusahaan($_SESSION['ID_Perusahaan'], $dataPerusahaan);

            if ($editPerusahaan) {
                setPesanKeberhasilan("Data perusahaan berhasil diperbarui.");
            } else {
                setPesanKesalahan("Gagal memperbarui data perusahaan. Silakan coba lagi.");
            }
        }
    }

    header("Location: $akarUrl" . "src/user/pages/profile.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/user/pages/profile.php");
    exit;
}
?>
