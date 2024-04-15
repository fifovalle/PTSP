<?php
include 'databases.php';

if (isset($_POST['Simpan'])) {
    $fotoInformasi = $_FILES['Foto_Informasi'];
    $namaInformasi = $_POST['Nama_Informasi'];
    $deskripsiInformasi = $_POST['Deskripsi_Informasi'];
    $hargaInformasi = $_POST['Harga_Informasi'];
    $pemilikInformasi = $_POST['Pemilik_Informasi'];
    $noRekening = $_POST['No_Rekening_Informasi'];
    $kategoriInformasi = $_POST['Kategori_Informasi'];
    $statusInformasi = $_POST['Status_Informasi'];

    $informasiModel = new Informasi($koneksi);

    $pesanKesalahan = '';

    if ($pemilikInformasi === 'Instansi A') {
        $nomorRekeningInformasi = '1111';
    } elseif ($pemilikInformasi === 'Instansi B') {
        $nomorRekeningInformasi = '2222';
    } elseif ($pemilikInformasi === 'Instansi C') {
        $nomorRekeningInformasi = '3333';
    } else {
        $pesanKesalahan .= "Instansi tidak valid. ";
    }

    $nomorRekeningInformasiFormatted = $nomorRekeningInformasi;


    $namaFotoInformasi = $fotoInformasi['name'];
    $tempFotoInformasi = $fotoInformasi['tmp_name'];
    $ukuranFotoInformasi = $fotoInformasi['size'];
    $errorFotoInformasi = $fotoInformasi['error'];

    $tujuanFotoInformasi = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    if (($errorFotoInformasi === 0 && !empty($namaFotoInformasi)) && ($ukuranFotoInformasi <= $ukuranMaksimal)) {
        $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
        $formatFotoInformasi = strtolower(pathinfo($namaFotoInformasi, PATHINFO_EXTENSION));

        if (in_array($formatFotoInformasi, $formatYangDisetujui)) {
            $namaFotoInformasiBaru = uniqid() . '.' . $formatFotoInformasi;
            $tujuanFotoInformasi = '../assets/image/uploads/' . $namaFotoInformasiBaru;
            $berhasilDiupload = move_uploaded_file($tempFotoInformasi, $tujuanFotoInformasi);

            if (!$berhasilDiupload) {
                $pesanKesalahan .= "Gagal mengupload foto informasi. ";
            }
        } else {
            $pesanKesalahan .= "Format foto informasi harus berupa JPG, JPEG, atau PNG. ";
        }
    } else {
        $pesanKesalahan .= "Gagal mengupload foto informasi atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }

    $dataInformasi = array(
        'Foto_Informasi' => $namaFotoInformasiBaru,
        'Nama_Informasi' => $namaInformasi,
        'Deskripsi_Informasi' => $deskripsiInformasi,
        'Harga_Informasi' => $hargaInformasi,
        'Pemilik_Informasi' => $pemilikInformasi,
        'No_Rekening_Informasi' => $nomorRekeningInformasiFormatted,
        'Kategori_Informasi' => $kategoriInformasi,
        'Status_Informasi' => $statusInformasi
    );

    $simpanDataInformasi = $informasiModel->tambahInformasi($dataInformasi);

    if ($simpanDataInformasi) {
        setPesanKeberhasilan("Data informasi berhasil disimpan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data informasi.");
    }
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
}
