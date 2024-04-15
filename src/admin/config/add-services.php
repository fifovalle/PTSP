<?php
include 'databases.php';

if (isset($_POST['Simpan'])) {
    $fotoJasa = $_FILES['Foto_Jasa'];
    $namaJasa = $_POST['Nama_Jasa'];
    $deskripsiJasa = $_POST['Deskripsi_Jasa'];
    $hargaJasa = $_POST['Harga_Jasa'];
    $pemilikJasa = $_POST['Pemilik_Jasa'];
    $noRekening = $_POST['No_Rekening_Jasa'];
    $kategoriJasa = $_POST['Kategori_Jasa'];
    $statusJasa = $_POST['Status_Jasa'];

    $jasaModel = new Jasa($koneksi);

    $pesanKesalahan = '';

    if ($pemilikJasa === 'Instansi A') {
        $nomorRekeningJasa = '1111';
    } elseif ($pemilikJasa === 'Instansi B') {
        $nomorRekeningJasa = '2222';
    } elseif ($pemilikJasa === 'Instansi C') {
        $nomorRekeningJasa = '3333';
    } else {
        $pesanKesalahan .= "Instansi tidak valid. ";
    }

    $nomorRekeningJasaFormatted = $nomorRekeningJasa;

    $namaFotoJasa = $fotoJasa['name'];
    $tempFotoJasa = $fotoJasa['tmp_name'];
    $ukuranFotoJasa = $fotoJasa['size'];
    $errorFotoJasa = $fotoJasa['error'];

    $tujuanFotoJasa = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    if (($errorFotoJasa === 0 && !empty($namaFotoJasa)) && ($ukuranFotoJasa <= $ukuranMaksimal)) {
        $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
        $formatFotoJasa = strtolower(pathinfo($namaFotoJasa, PATHINFO_EXTENSION));

        if (in_array($formatFotoJasa, $formatYangDisetujui)) {
            $namaFotoJasaBaru = uniqid() . '.' . $formatFotoJasa;
            $tujuanFotoJasa = '../assets/image/uploads/' . $namaFotoJasaBaru;
            $berhasilDiupload = move_uploaded_file($tempFotoJasa, $tujuanFotoJasa);

            if (!$berhasilDiupload) {
                $pesanKesalahan .= "Gagal mengupload foto jasa. ";
            }
        } else {
            $pesanKesalahan .= "Format foto jasa harus berupa JPG, JPEG, atau PNG. ";
        }
    } else {
        $pesanKesalahan .= "Gagal mengupload foto jasa atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data.php");
        exit;
    }

    $dataJasa = array(
        'Foto_Jasa' => $namaFotoJasaBaru,
        'Nama_Jasa' => $namaJasa,
        'Deskripsi_Jasa' => $deskripsiJasa,
        'Harga_Jasa' => $hargaJasa,
        'Pemilik_Jasa' => $pemilikJasa,
        'No_Rekening_Jasa' => $nomorRekeningJasaFormatted,
        'Kategori_Jasa' => $kategoriJasa,
        'Status_Jasa' => $statusJasa
    );

    $simpanDataJasa = $jasaModel->tambahJasa($dataJasa);

    if ($simpanDataJasa) {
        setPesanKeberhasilan("Data jasa berhasil disimpan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data jasa.");
    }
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
} else {
    header("Location: $akarUrl" . "src/admin/pages/data.php");
    exit;
}
