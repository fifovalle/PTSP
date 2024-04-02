<?php
include 'databases.php';

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Nama']));
    $jenisKelamin = mysqli_real_escape_string($koneksi, $_POST['JenisKelamin']);
    $pendidikanTerakhir = mysqli_real_escape_string($koneksi, $_POST['PendidikanTerakhir']);
    $NIK = mysqli_real_escape_string($koneksi, $_POST['NIK']);
    $umur = mysqli_real_escape_string($koneksi, $_POST['Umur']);
    $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['Pekerjaan']);
    $koresponden = mysqli_real_escape_string($koneksi, $_POST['Koresponden']);
    $jenisLayanan = mysqli_real_escape_string($koneksi, $_POST['JenisLayanan']);
    $asalDaerah = mysqli_real_escape_string($koneksi, $_POST['AsalDaerah']);
    
    $c1 = isset($_POST['c_1']) ? mysqli_real_escape_string($koneksi, $_POST['c_1']) : '';
    $c2 = isset($_POST['c_2']) ? mysqli_real_escape_string($koneksi, $_POST['c_2']) : '';
    $c3 = isset($_POST['c_3']) ? mysqli_real_escape_string($koneksi, $_POST['c_3']) : '';
    $c4 = isset($_POST['c_4']) ? mysqli_real_escape_string($koneksi, $_POST['c_4']) : '';
    $c5 = isset($_POST['c_5']) ? mysqli_real_escape_string($koneksi, $_POST['c_5']) : '';
    $c6 = isset($_POST['c_6']) ? mysqli_real_escape_string($koneksi, $_POST['c_6']) : '';
    $c7 = isset($_POST['c_7']) ? mysqli_real_escape_string($koneksi, $_POST['c_7']) : '';
    $c8 = isset($_POST['c_8']) ? mysqli_real_escape_string($koneksi, $_POST['c_8']) : '';
    $c9 = isset($_POST['c_9']) ? mysqli_real_escape_string($koneksi, $_POST['c_9']) : '';
    $c10 = isset($_POST['c_10']) ? mysqli_real_escape_string($koneksi, $_POST['c_10']) : '';
    $c11 = isset($_POST['c_11']) ? mysqli_real_escape_string($koneksi, $_POST['c_11']) : '';
    $c12 = isset($_POST['c_12']) ? mysqli_real_escape_string($koneksi, $_POST['c_12']) : '';
    $c13 = isset($_POST['c_13']) ? mysqli_real_escape_string($koneksi, $_POST['c_13']) : '';
    $c14 = isset($_POST['c_14']) ? mysqli_real_escape_string($koneksi, $_POST['c_14']) : '';
    $c15 = isset($_POST['c_15']) ? mysqli_real_escape_string($koneksi, $_POST['c_15']) : '';
    $c16 = isset($_POST['c_16']) ? mysqli_real_escape_string($koneksi, $_POST['c_16']) : '';
    $c17 = isset($_POST['c_17']) ? mysqli_real_escape_string($koneksi, $_POST['c_17']) : '';
    $c18 = isset($_POST['c_18']) ? mysqli_real_escape_string($koneksi, $_POST['c_18']) : '';
    $c19 = isset($_POST['c_19']) ? mysqli_real_escape_string($koneksi, $_POST['c_19']) : '';
    $c20 = isset($_POST['c_20']) ? mysqli_real_escape_string($koneksi, $_POST['c_20']) : '';
    $c21 = isset($_POST['c_21']) ? mysqli_real_escape_string($koneksi, $_POST['c_21']) : '';
    $c22 = isset($_POST['c_22']) ? mysqli_real_escape_string($koneksi, $_POST['c_22']) : '';
    $c23 = isset($_POST['c_23']) ? mysqli_real_escape_string($koneksi, $_POST['c_23']) : '';
    $c24 = isset($_POST['c_24']) ? mysqli_real_escape_string($koneksi, $_POST['c_24']) : '';
    $c25 = isset($_POST['c_25']) ? mysqli_real_escape_string($koneksi, $_POST['c_25']) : '';
    
    $objekIkm = new Ikm($koneksi);

    $dataIkm = array(
        'Nama' => $nama,
        'Jenis_Kelamin' => $jenisKelamin,
        'Pendidikan_Terakhir' => $pendidikanTerakhir,
        'NIK' => $NIK,
        'Umur' => $umur,
        'Pekerjaan' => $pekerjaan,
        'Koresponden' => $koresponden,
        'Jenis_Layanan' => $jenisLayanan,
        'Asal_Daerah' => $asalDaerah,
        'Informasi_Cuaca_Publik' => $c1, 
        'Informasi_Cuaca_Khusus' => $c2, 
        'Analisis_Cuaca' => $c3, 
        'Informasi_Titik_Panas' => $c4, 
        'Informasi_Tentang_Tingkat' => $c5,
        'Prakiraan_Musim' => $c6, 
        'Informasi_Iklim_Khusus' => $c7, 
        'Analisis_Prakiraan' => $c8, 
        'Tren_Curah_Hujan' => $c9, 
        'Informasi_Kualitas_Udara' => $c10, 
        'Analisis_Iklim_Ekstrim' => $c11, 
        'Informasi_Iklim_Terapan' => $c12,
        'Informasi_Perubahan_Iklim' => $c13, 
        'Pengambilan_Pengujian' => $c14,
        'Informasi_Gempabumi' => $c15,
        'Peta_Seismisitas' => $c16, 
        'Informasi_Tanda_Waktu' => $c17, 
        'Informasi_Geofisika_Potensial' => $c18, 
        'Peta_Rendaman_Tsunami' => $c19, 
        'Informasi_Seismologi_Teknik' => $c20, 
        'Data_MKG' => $c21, 
        'Kalibrasi' => $c22, 
        'Konsultasi' => $c23, 
        'Sewa_Peralatan_MKG' => $c24, 
        'Kunjungan' => $c25
    );
    
    $simpanDataIkm = $objekIkm->tambahDataIkm($dataIkm);

    if ($simpanDataIkm) {
        setPesanKeberhasilan("Data berhasil ditambahkan.");
        header("Location: $akarUrl" . "src/user/pages/ikm.php");
        exit();
    } else {
        setPesanKesalahan("Gagal menambahkan data.");
        header("Location: $akarUrl" . "src/user/pages/ikm.php");
        exit;
    }
} else {
    header("Location: $akarUrl" . "src/user/pages/ikm.php");
    exit;
}
?>
