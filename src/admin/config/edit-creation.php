<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pembayaranID = $_POST['ID_Pembuatan'] ?? '';


    if (isset($_FILES['Upload_File'])) {
        $fileTransaksi = $_FILES['Upload_File'];

        $namaFileTransaksi = $fileTransaksi['name'];
        $fileTransaksiTemp = $fileTransaksi['tmp_name'];
        $ukuranFileTransaksi = $fileTransaksi['size'];
        $errorFileTransaksi = $fileTransaksi['error'];

        $tujuanFileTransaksi = '../assets/image/uploads/';
        $ukuranMaksimal = 2 * 1024 * 1024;

        if ($errorFileTransaksi === 0 && !empty($namaFileTransaksi) && $ukuranFileTransaksi <= $ukuranMaksimal) {
            $ekstensi = pathinfo($namaFileTransaksi, PATHINFO_EXTENSION);
            if (in_array($ekstensi, ['pdf', 'docx', 'xlsx', 'txt'])) {
                $namaFileBaru = uniqid() . '.' . $ekstensi;
                $tujuanFileBaru = $tujuanFileTransaksi . $namaFileBaru;

                if (move_uploaded_file($fileTransaksiTemp, $tujuanFileBaru)) {
                    $transaksi->updateTransaksi($pembayaranID, $namaFileBaru);
                    echo json_encode(array("success" => true, "message" => "Transaksi berhasil diperbarui."));
                } else {
                    echo json_encode(array("success" => false, "message" => "Gagal mengunggah file."));
                }
            } else {
                echo json_encode(array("success" => false, "message" => "Unggah file gagal. Pastikan file berformat PDF, DOCX, XLSX, atau TXT."));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Unggah file gagal. Pastikan file berukuran maksimal 2MB dan dalam format yang benar."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Tidak ada file yang diunggah."));
    }
}
