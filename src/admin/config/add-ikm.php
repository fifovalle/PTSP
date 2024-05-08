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
    $KualitasPelayananTerbuka = isset($_POST['Kualitas_Pelayanan_Terbuka']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Terbuka'])) : '';
    $HarapanKonsumenTerbuka = isset($_POST['Harapan_Konsumen_Terbuka']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Terbuka'])) : '';
    $KualitasPelayananKehidupan = isset($_POST['Kualitas_Pelayanan_Kehidupan']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Kehidupan'])) : '';
    $HarapanKonsumenKehidupan = isset($_POST['Harapan_Konsumen_Kehidupan']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Kehidupan'])) : '';
    $KualitasPelayananDipahami = isset($_POST['Kualitas_Pelayanan_Dipahami']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Dipahami'])) : '';
    $HarapanKonsumenDipahami = isset($_POST['Harapan_Konsumen_Dipahami']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Dipahami'])) : '';
    $KualitasPelayananPersyaratan = isset($_POST['Kualitas_Pelayanan_Persyaratan']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Persyaratan'])) : '';
    $HarapanKonsumenPersyaratan = isset($_POST['Harapan_Konsumen_Persyaratan']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Persyaratan'])) : '';
    $KualitasPelayananDiakses = isset($_POST['Kualitas_Pelayanan_Diakses']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Diakses'])) : '';
    $HarapanKonsumenDiakses = isset($_POST['Harapan_Konsumen_Diakses']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Diakses'])) : '';
    $KualitasPelayananAkurat = isset($_POST['Kualitas_Pelayanan_Akurat']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Akurat'])) : '';
    $HarapanKonsumenAkurat = isset($_POST['Harapan_Konsumen_Akurat']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Akurat'])) : '';
    $KualitasPelayananData = isset($_POST['Kualitas_Pelayanan_Data']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Data'])) : '';
    $HarapanKonsumenData = isset($_POST['Harapan_Konsumen_Data']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Data'])) : '';
    $KualitasPelayananSederhana = isset($_POST['Kualitas_Pelayanan_Sederhana']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Sederhana'])) : '';
    $KualitasPelayananWaktu = isset($_POST['Kualitas_Pelayanan_Waktu']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Waktu'])) : '';
    $HarapanKonsumenWaktu = isset($_POST['Harapan_Konsumen_Waktu']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Waktu'])) : '';
    $KualitasPelayananBiayaTerbuka = isset($_POST['Kualitas_Pelayanan_Biaya_Terbuka']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Biaya_Terbuka'])) : '';
    $HarapanKonsumenBiayaTerbuka = isset($_POST['Harapan_Konsumen_Biaya_Terbuka']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Biaya_Terbuka'])) : '';
    $KualitasPelayananKKN = isset($_POST['Kualitas_Pelayanan_KKN']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_KKN'])) : '';
    $KualitasPelayananSesuai = isset($_POST['Kualitas_Pelayanan_Sesuai']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Sesuai'])) : '';
    $HarapanKonsumenSesuai = isset($_POST['Harapan_Konsumen_Sesuai']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Sesuai'])) : '';
    $KualitasPelayananDaftar = isset($_POST['Kualitas_Pelayanan_Daftar']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Daftar'])) : '';
    $HarapanKonsumenDaftar = isset($_POST['Harapan_Konsumen_Daftar']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Daftar'])) : '';
    $KualitasPelayananSarana = isset($_POST['Kualitas_Pelayanan_Sarana']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Sarana'])) : '';
    $HarapanKonsumenSarana = isset($_POST['Harapan_Konsumen_Sarana']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Sarana'])) : '';
    $KualitasPelayananProsedur = isset($_POST['Kualitas_Pelayanan_Prosedur']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Prosedur'])) : '';
    $HarapanKonsumenProsedur = isset($_POST['Harapan_Konsumen_Prosedur']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Prosedur'])) : '';
    $KualitasPelayananPetugas = isset($_POST['Kualitas_Pelayanan_Petugas']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Petugas'])) : '';
    $HarapanKonsumenPetugas = isset($_POST['Harapan_Konsumen_Petugas']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Petugas'])) : '';
    $KualitasPelayananAman = isset($_POST['Kualitas_Pelayanan_Aman']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Aman'])) : '';
    $HarapanKonsumenAman = isset($_POST['Harapan_Konsumen_Aman']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Aman'])) : '';
    $KualitasPelayananKeberadaan = isset($_POST['Kualitas_Pelayanan_Keberadaan']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Keberadaan'])) : '';
    $HarapanKonsumenKeberadaan = isset($_POST['Harapan_Konsumen_Keberadaan']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Keberadaan'])) : '';
    $KualitasPelayananSikap = isset($_POST['Kualitas_Pelayanan_Sikap']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Sikap'])) : '';
    $HarapanKonsumenSikap = isset($_POST['Harapan_Konsumen_Sikap']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Sikap'])) : '';
    $KualitasPelayananPublik = isset($_POST['Kualitas_Pelayanan_Publik']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Kualitas_Pelayanan_Publik'])) : '';
    $HarapanKonsumenPublik = isset($_POST['Harapan_Konsumen_Publik']) ? mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['Harapan_Konsumen_Publik'])) : '';

    $objekIkm = new Ikm($koneksi);
    $objekTranksaksi = new Transaksi($koneksi);

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
        'Kunjungan' => $c25,
        'Kualitas_Pelayanan_Terbuka' => $KualitasPelayananTerbuka,
        'Harapan_Konsumen_Terbuka' => $HarapanKonsumenTerbuka,
        'Kualitas_Pelayanan_Kehidupan' => $KualitasPelayananKehidupan,
        'Harapan_Konsumen_Kehidupan' => $HarapanKonsumenKehidupan,
        'Kualitas_Pelayanan_Dipahami' => $KualitasPelayananDipahami,
        'Harapan_Konsumen_Dipahami' => $HarapanKonsumenDipahami,
        'Kualitas_Pelayanan_Persyaratan' => $KualitasPelayananPersyaratan,
        'Harapan_Konsumen_Persyaratan' => $HarapanKonsumenPersyaratan,
        'Kualitas_Pelayanan_Diakses' => $KualitasPelayananDiakses,
        'Harapan_Konsumen_Diakses' => $HarapanKonsumenDiakses,
        'Kualitas_Pelayanan_Akurat' => $KualitasPelayananAkurat,
        'Harapan_Konsumen_Akurat' => $HarapanKonsumenAkurat,
        'Kualitas_Pelayanan_Data' => $KualitasPelayananData,
        'Harapan_Konsumen_Data' => $HarapanKonsumenData,
        'Kualitas_Pelayanan_Sederhana' => $KualitasPelayananSederhana,
        'Kualitas_Pelayanan_Waktu' => $KualitasPelayananWaktu,
        'Harapan_Konsumen_Waktu' => $HarapanKonsumenWaktu,
        'Kualitas_Pelayanan_Biaya_Terbuka' => $KualitasPelayananBiayaTerbuka,
        'Harapan_Konsumen_Biaya_Terbuka' => $HarapanKonsumenBiayaTerbuka,
        'Kualitas_Pelayanan_KKN' => $KualitasPelayananKKN,
        'Kualitas_Pelayanan_Sesuai' => $KualitasPelayananSesuai,
        'Harapan_Konsumen_Sesuai' => $HarapanKonsumenSesuai,
        'Kualitas_Pelayanan_Daftar' => $KualitasPelayananDaftar,
        'Harapan_Konsumen_Daftar' => $HarapanKonsumenDaftar,
        'Kualitas_Pelayanan_Sarana' => $KualitasPelayananSarana,
        'Harapan_Konsumen_Sarana' => $HarapanKonsumenSarana,
        'Kualitas_Pelayanan_Prosedur' => $KualitasPelayananProsedur,
        'Harapan_Konsumen_Prosedur' => $HarapanKonsumenProsedur,
        'Kualitas_Pelayanan_Petugas' => $KualitasPelayananPetugas,
        'Harapan_Konsumen_Petugas' => $HarapanKonsumenPetugas,
        'Kualitas_Pelayanan_Aman' => $KualitasPelayananAman,
        'Harapan_Konsumen_Aman' => $HarapanKonsumenAman,
        'Kualitas_Pelayanan_Keberadaan' => $KualitasPelayananKeberadaan,
        'Harapan_Konsumen_Keberadaan' => $HarapanKonsumenKeberadaan,
        'Kualitas_Pelayanan_Sikap' => $KualitasPelayananSikap,
        'Harapan_Konsumen_Sikap' => $HarapanKonsumenSikap,
        'Kualitas_Pelayanan_Publik' => $KualitasPelayananPublik,
        'Harapan_Konsumen_Publik' => $HarapanKonsumenPublik
    );
    $ambilIKMTerakhir = $objekIkm->ambilIDIKMTerakhir();

    $dataIkmTransaksi = array(
        'ID_IKM' => $ambilIKMTerakhir,
    );

    $idSession = isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : null);

    $simpanDataTransaksi = $objekTranksaksi->updateIKMNULLSesuaiTransaksi($dataIkmTransaksi, $idSession);
    $simpanDataIkm = $objekIkm->tambahDataIkm($dataIkm);

    if ($simpanDataIkm && $simpanDataTransaksi) {
        setPesanKeberhasilan("Data berhasil ditambahkan.");
        header("Location: $akarUrl" . "src/user/pages/pesanan.php");
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
