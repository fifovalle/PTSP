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

    $objekIkm = new Ikm($koneksi);


    $dataIkm = array(
        'Nama' =>  $nama,
        'Jenis_Kelamin' => $jenisKelamin,
        'Pendidikan_Terakhir' => $pendidikanTerakhir,
        'NIK' => $NIK,
        'Umur' => $umur,
        'Pekerjaan' => $pekerjaan,
        'Koresponden' =>  $koresponden,
        'Jenis_Layanan' => $jenisLayanan,
        'Asal_Daerah' => $asalDaerah
    );

    $simpanDataIkm = $objekIkm->tambahDataIkm($dataIkm);

    if ($simpanDataIkm) {
        setPesanKeberhasilan("Data berhasilan ditambahkan.");
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
