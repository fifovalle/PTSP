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
    $namaDepan = filter_input(INPUT_POST, 'Nama_Depan_Pengguna', FILTER_SANITIZE_STRING);
    $namaBelakang = filter_input(INPUT_POST, 'Nama_Belakang_Pengguna', FILTER_SANITIZE_STRING);
    $namaPengguna = filter_input(INPUT_POST, 'Nama_Pengguna_Pengguna', FILTER_SANITIZE_STRING);
    $emailPengguna = filter_input(INPUT_POST, 'Email_Pengguna', FILTER_SANITIZE_STRING);
    $kataSandi = filter_input(INPUT_POST, 'Password_Pengguna', FILTER_SANITIZE_STRING);
    $konfirmasiKataSandi = filter_input(INPUT_POST, 'Confirm_Password_Pengguna', FILTER_SANITIZE_STRING);
    $nomorTelepon = filter_input(INPUT_POST, 'No_Telepon_Pengguna', FILTER_SANITIZE_STRING);
    $jenisKelamin = filter_input(INPUT_POST, 'Jenis_Kelamin_Pengguna', FILTER_SANITIZE_STRING);
    $alamatPengguna = filter_input(INPUT_POST, 'Alamat_Pengguna', FILTER_SANITIZE_STRING);
    $token = uniqid();

    $pesanKesalahan = '';

    $nomorTeleponFormatted = '+62 ' . substr($nomorTelepon, 0, 3) . '-' . substr($nomorTelepon, 4, 4) . '-' . substr($nomorTelepon, 7);

    if (empty($namaDepan) || empty($namaBelakang) || empty($namaPengguna) || empty($emailPengguna) || empty($kataSandi) || empty($konfirmasiKataSandi) || empty($nomorTelepon) || empty($jenisKelamin) || empty($alamatPengguna)) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

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

    $fotoPengguna = $_FILES['Foto_Pengguna'];

    $namaFotoPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($fotoPengguna['name']));
    $fotoPenggunaTemp = $fotoPengguna['tmp_name'];
    $ukuranFotoPengguna = $fotoPengguna['size'];
    $errorFotoPengguna = $fotoPengguna['error'];

    $tujuanFotoPengguna = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    $apakahUnggahBerhasil = ($errorFotoPengguna === 0 && !empty($namaFotoPengguna)) && ($ukuranFotoPengguna <= $ukuranMaksimal);
    $pesanKesalahan .= (!$apakahUnggahBerhasil && empty($pesanKesalahan)) ? "Gagal mengupload foto pengguna atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB." : '';

    $formatDisetujui = ['jpg', 'jpeg', 'png'];
    $formatFotoPengguna = strtolower(pathinfo($namaFotoPengguna, PATHINFO_EXTENSION));
    $apakahFormatDisetujui = in_array($formatFotoPengguna, $formatDisetujui);
    $pesanKesalahan .= (!$apakahFormatDisetujui && empty($pesanKesalahan)) ? "Format foto harus berupa JPG, JPEG, atau PNG." : '';

    $namaFotoPenggunaBaru = $apakahFormatDisetujui ? uniqid() . '.' . $formatFotoPengguna : '';

    $tujuanFotoPengguna = $apakahFormatDisetujui ? '../assets/image/uploads/' . $namaFotoPenggunaBaru : '';

    $apakahBerhasilDipindahkan = $apakahFormatDisetujui ? move_uploaded_file($fotoPenggunaTemp, $tujuanFotoPengguna) : false;
    $pesanKesalahan .= (!$apakahBerhasilDipindahkan && empty($pesanKesalahan)) ? "Gagal mengupload foto pengguna." : '';

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }
    $dataPengguna = array(
        'Foto' => $namaFotoPenggunaBaru,
        'Nama_Depan_Pengguna' => $namaDepan,
        'Nama_Belakang_Pengguna' => $namaBelakang,
        'Nama_Pengguna' => $namaPengguna,
        'Email_Pengguna' => $emailPengguna,
        'Kata_Sandi' => $hashKataSandi,
        'Konfirmasi_Kata_Sandi' => $hashKataSandi,
        'No_Telepon_Pengguna' => $nomorTeleponFormatted,
        'Jenis_Kelamin_Pengguna' => $jenisKelamin,
        'Alamat_Pengguna' => $alamatPengguna,
        'Status_Verifikasi_Pengguna' => "Belum Terverifikasi",
        'token' => $token
    );

    $obyekPengguna = new Pengguna($koneksi);
    $simpanDataPengguna = $obyekPengguna->tambahPengguna($dataPengguna);

    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Data pengguna berhasil disimpan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
}
