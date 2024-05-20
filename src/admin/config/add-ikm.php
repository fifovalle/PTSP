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

if (isset($_POST['submit'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $nama = filter_input(INPUT_POST, 'Nama', FILTER_SANITIZE_STRING);
    $jenisKelamin = filter_input(INPUT_POST, 'JenisKelamin', FILTER_SANITIZE_STRING);
    $pendidikanTerakhir = filter_input(INPUT_POST, 'PendidikanTerakhir', FILTER_SANITIZE_STRING);
    $NIK = filter_input(INPUT_POST, 'NIK', FILTER_SANITIZE_STRING);
    $umur = filter_input(INPUT_POST, 'Umur', FILTER_SANITIZE_STRING);
    $pekerjaan = filter_input(INPUT_POST, 'Pekerjaan', FILTER_SANITIZE_STRING);
    $koresponden = filter_input(INPUT_POST, 'Koresponden', FILTER_SANITIZE_STRING);
    $jenisLayanan = filter_input(INPUT_POST, 'JenisLayanan', FILTER_SANITIZE_STRING);
    $asalDaerah = filter_input(INPUT_POST, 'AsalDaerah', FILTER_SANITIZE_STRING);
    $c1 = isset($_POST['c_1']) ? filter_input(INPUT_POST, 'c_1', FILTER_SANITIZE_STRING) : '';
    $c2 = isset($_POST['c_2']) ? filter_input(INPUT_POST, 'c_2', FILTER_SANITIZE_STRING) : '';
    $c3 = isset($_POST['c_3']) ? filter_input(INPUT_POST, 'c_3', FILTER_SANITIZE_STRING) : '';
    $c4 = isset($_POST['c_4']) ? filter_input(INPUT_POST, 'c_4', FILTER_SANITIZE_STRING) : '';
    $c5 = isset($_POST['c_5']) ? filter_input(INPUT_POST, 'c_5', FILTER_SANITIZE_STRING) : '';
    $c6 = isset($_POST['c_6']) ? filter_input(INPUT_POST, 'c_6', FILTER_SANITIZE_STRING) : '';
    $c7 = isset($_POST['c_7']) ? filter_input(INPUT_POST, 'c_7', FILTER_SANITIZE_STRING) : '';
    $c8 = isset($_POST['c_8']) ? filter_input(INPUT_POST, 'c_8', FILTER_SANITIZE_STRING) : '';
    $c9 = isset($_POST['c_9']) ? filter_input(INPUT_POST, 'c_9', FILTER_SANITIZE_STRING) : '';
    $c10 = isset($_POST['c_10']) ? filter_input(INPUT_POST, 'c_10', FILTER_SANITIZE_STRING) : '';
    $c11 = isset($_POST['c_11']) ? filter_input(INPUT_POST, 'c_11', FILTER_SANITIZE_STRING) : '';
    $c12 = isset($_POST['c_12']) ? filter_input(INPUT_POST, 'c_12', FILTER_SANITIZE_STRING) : '';
    $c13 = isset($_POST['c_13']) ? filter_input(INPUT_POST, 'c_13', FILTER_SANITIZE_STRING) : '';
    $c14 = isset($_POST['c_14']) ? filter_input(INPUT_POST, 'c_14', FILTER_SANITIZE_STRING) : '';
    $c15 = isset($_POST['c_15']) ? filter_input(INPUT_POST, 'c_15', FILTER_SANITIZE_STRING) : '';
    $c16 = isset($_POST['c_16']) ? filter_input(INPUT_POST, 'c_16', FILTER_SANITIZE_STRING) : '';
    $c17 = isset($_POST['c_17']) ? filter_input(INPUT_POST, 'c_17', FILTER_SANITIZE_STRING) : '';
    $c18 = isset($_POST['c_18']) ? filter_input(INPUT_POST, 'c_18', FILTER_SANITIZE_STRING) : '';
    $c19 = isset($_POST['c_19']) ? filter_input(INPUT_POST, 'c_19', FILTER_SANITIZE_STRING) : '';
    $c20 = isset($_POST['c_20']) ? filter_input(INPUT_POST, 'c_20', FILTER_SANITIZE_STRING) : '';
    $c21 = isset($_POST['c_21']) ? filter_input(INPUT_POST, 'c_21', FILTER_SANITIZE_STRING) : '';
    $c22 = isset($_POST['c_22']) ? filter_input(INPUT_POST, 'c_22', FILTER_SANITIZE_STRING) : '';
    $c23 = isset($_POST['c_23']) ? filter_input(INPUT_POST, 'c_23', FILTER_SANITIZE_STRING) : '';
    $c24 = isset($_POST['c_24']) ? filter_input(INPUT_POST, 'c_24', FILTER_SANITIZE_STRING) : '';
    $c25 = isset($_POST['c_25']) ? filter_input(INPUT_POST, 'c_25', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananTerbuka = isset($_POST['Kualitas_Pelayanan_Terbuka']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Terbuka', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenTerbuka = isset($_POST['Harapan_Konsumen_Terbuka']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Terbuka', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananKehidupan = isset($_POST['Kualitas_Pelayanan_Kehidupan']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Kehidupan', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenKehidupan = isset($_POST['Harapan_Konsumen_Kehidupan']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Kehidupan', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananDipahami = isset($_POST['Kualitas_Pelayanan_Dipahami']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Dipahami', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenDipahami = isset($_POST['Harapan_Konsumen_Dipahami']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Dipahami', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananPersyaratan = isset($_POST['Kualitas_Pelayanan_Persyaratan']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Persyaratan', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenPersyaratan = isset($_POST['Harapan_Konsumen_Persyaratan']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Persyaratan', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananDiakses = isset($_POST['Kualitas_Pelayanan_Diakses']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Diakses', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenDiakses = isset($_POST['Harapan_Konsumen_Diakses']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Diakses', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananAkurat = isset($_POST['Kualitas_Pelayanan_Akurat']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Akurat', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenAkurat = isset($_POST['Harapan_Konsumen_Akurat']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Akurat', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananData = isset($_POST['Kualitas_Pelayanan_Data']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Data', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenData = isset($_POST['Harapan_Konsumen_Data']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Data', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananSederhana = isset($_POST['Kualitas_Pelayanan_Sederhana']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Sederhana', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananWaktu = isset($_POST['Kualitas_Pelayanan_Waktu']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Waktu', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenWaktu = isset($_POST['Harapan_Konsumen_Waktu']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Waktu', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananBiayaTerbuka = isset($_POST['Kualitas_Pelayanan_Biaya_Terbuka']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Biaya_Terbuka', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenBiayaTerbuka = isset($_POST['Harapan_Konsumen_Biaya_Terbuka']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Biaya_Terbuka', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananKKN = isset($_POST['Kualitas_Pelayanan_KKN']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_KKN', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananSesuai = isset($_POST['Kualitas_Pelayanan_Sesuai']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Sesuai', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenSesuai = isset($_POST['Harapan_Konsumen_Sesuai']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Sesuai', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananDaftar = isset($_POST['Kualitas_Pelayanan_Daftar']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Daftar', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenDaftar = isset($_POST['Harapan_Konsumen_Daftar']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Daftar', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananSarana = isset($_POST['Kualitas_Pelayanan_Sarana']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Sarana', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenSarana = isset($_POST['Harapan_Konsumen_Sarana']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Sarana', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananProsedur = isset($_POST['Kualitas_Pelayanan_Prosedur']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Prosedur', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenProsedur = isset($_POST['Harapan_Konsumen_Prosedur']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Prosedur', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananPetugas = isset($_POST['Kualitas_Pelayanan_Petugas']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Petugas', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenPetugas = isset($_POST['Harapan_Konsumen_Petugas']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Petugas', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananAman = isset($_POST['Kualitas_Pelayanan_Aman']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Aman', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenAman = isset($_POST['Harapan_Konsumen_Aman']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Aman', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananKeberadaan = isset($_POST['Kualitas_Pelayanan_Keberadaan']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Keberadaan', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenKeberadaan = isset($_POST['Harapan_Konsumen_Keberadaan']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Keberadaan', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananSikap = isset($_POST['Kualitas_Pelayanan_Sikap']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Sikap', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenSikap = isset($_POST['Harapan_Konsumen_Sikap']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Sikap', FILTER_SANITIZE_STRING) : '';
    $KualitasPelayananPublik = isset($_POST['Kualitas_Pelayanan_Publik']) ? filter_input(INPUT_POST, 'Kualitas_Pelayanan_Publik', FILTER_SANITIZE_STRING) : '';
    $HarapanKonsumenPublik = isset($_POST['Harapan_Konsumen_Publik']) ? filter_input(INPUT_POST, 'Harapan_Konsumen_Publik', FILTER_SANITIZE_STRING) : '';

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

    if (containsXSS($namaDepan) || containsXSS($namaBelakang) || containsXSS($namaPengguna) || containsXSS($email) || containsXSS($kataSandi) || containsXSS($konfirmasiKataSandi) || containsXSS($nomorTelepon) || containsXSS($jenisKelamin) || containsXSS($peranAdmin) || containsXSS($alamatAdmin)) {
        $pesanKesalahan .= "Input mengandung Serangan XSS, Saya tau anda ingin mennghack web saya 😡👿. ";
    }


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
