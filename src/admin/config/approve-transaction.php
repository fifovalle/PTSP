<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);

if (isset($_POST['Simpan'])) {
    if (isset($_POST['ID_Admin'])) {
        $idAdmin = $_POST['ID_Admin'];

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
                        $statusTransaksi = $_POST['Status_Transaksi'];
                        if ($statusTransaksi == "Belum Disetujui" || $statusTransaksi == "Disetujui") {
                            $transaksi->updateTransaksi($idAdmin, $namaFileBaru, $statusTransaksi);
                            setPesanKeberhasilan("Transaksi berhasil diperbarui.");
                        } else {
                            setPesanKesalahan("Status transaksi tidak valid.");
                        }
                    } else {
                        setPesanKesalahan("Gagal mengunggah file.");
                    }
                } else {
                    setPesanKesalahan("Unggah file gagal. Pastikan file berformat PDF, DOCX, XLSX, atau TXT.");
                }
            } else {
                setPesanKesalahan("Unggah file gagal. Pastikan file berukuran maksimal 2MB dan dalam format yang benar.");
            }
        } else {
            setPesanKesalahan("Tidak ada file yang diunggah.");
        }

        if (isset($_POST['Status_Transaksi'])) {
            $statusTransaksi = $_POST['Status_Transaksi'];
            if ($statusTransaksi == "Belum Disetujui" || $statusTransaksi == "Disetujui") {
                $transaksi->updateTransaksi($idAdmin, null, $statusTransaksi);
                setPesanKeberhasilan("Status transaksi berhasil diperbarui.");
            } else {
                setPesanKesalahan("Status transaksi tidak valid.");
            }
        } else {
            setPesanKesalahan("Status transaksi tidak ditemukan.");
        }
    } else {
        setPesanKesalahan("ID Admin tidak tersedia.");
    }
}

header("Location: $akarUrl/src/admin/pages/data.php");
exit;
?>
