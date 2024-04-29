<?php
include 'databases.php';

if (isset($_POST['Simpan'])) {
    $perbaikanDokumen = $_POST['Perbaikan_Dokumen'] ?? '';
    $dokumen = $_FILES['dokumen'] ?? '';

    if (!empty($dokumen) && !empty($perbaikanDokumen)) {
        $direktoriTujuan = '../assets/images/uploads/';

        $namaFile = uniqid('dokumen_') . '_' . $dokumen['name'];
        $lokasiFile = $direktoriTujuan . $namaFile;

        if (move_uploaded_file($dokumen['tmp_name'], $lokasiFile)) {
            $objek = new Pengajuan($koneksi);

            $dataDocumentSubmition = array(
                'Jenis_Perbaikan' => $perbaikanDokumen,
                'Status_Pengajuan' => 'Sedang Ditinjau',
                'Nama_File' => $namaFile
            );

            $uploadResult = $objek->uploadDocumentSubmition($dataDocumentSubmition);

            if (!$uploadResult) {
                setPesanKesalahan("Anda belum dapat mengunggah dokumen baru karena dokumen sebelumnya belum ditolak.");
                header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
                exit;
            }

            setPesanKeberhasilan("Dokumen berhasil diunggah.");
            header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
            exit;
        } else {
            setPesanKesalahan("Gagal mengunggah dokumen, silakan coba lagi.");
            header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
            exit;
        }
    }
}

setPesanKesalahan("Gagal mengunggah dokumen, silakan coba lagi.");
header("Location: " . $akarUrl . "src/user/pages/pesanan.php");
exit;
