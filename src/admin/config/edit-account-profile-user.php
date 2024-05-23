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

if (isset($_POST['Simpan'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $username = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $namaDepan = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama', FILTER_SANITIZE_STRING));
    $namaBelakang = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama', FILTER_SANITIZE_STRING));
    $pekerjaan = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Pekerjaan', FILTER_SANITIZE_STRING));
    $pendidikanTerakhir = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'PendidikanTerakhir', FILTER_SANITIZE_STRING));
    $email = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL));
    $noHP = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'No_HP', FILTER_SANITIZE_STRING));
    $jenisKelamin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jenis_Kelamin', FILTER_SANITIZE_STRING));
    $alamat = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING));

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
