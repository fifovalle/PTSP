<?php
include 'databases.php';

$transaksi = new Transaksi($koneksi);
$idPembeli = $_SESSION['ID_Pengguna'] ?? $_SESSION['ID_Perusahaan'];

if (isset($_POST['Kirim'])) {
    if (isset($_FILES['File_Instansi_A'])) {
        $fileA = $_FILES['File_Instansi_A'];
        $namaFileA = $fileA['name'];
        $fileAtemp = $fileA['tmp_name'];
        $ukuranFileA = $fileA['size'];
        $errorFileA = $fileA['error'];

        if ($errorFileA === 0) {
            $ukuranMaksimal = 2 * 1024 * 1024;
            if ($ukuranFileA <= $ukuranMaksimal) {
                $ekstensiValid = ['jpg', 'jpeg', 'png'];
                $ekstensiA = pathinfo($namaFileA, PATHINFO_EXTENSION);
                if (in_array($ekstensiA, $ekstensiValid)) {
                    $namaFileBaruA = uniqid() . '.' . $ekstensiA;

                    $tujuanFileA = '../assets/image/uploads/';
                    $tujuanFileBaruA = $tujuanFileA . $namaFileBaruA;

                    if (move_uploaded_file($fileAtemp, $tujuanFileBaruA)) {
                        $transaksi->uploadFileBuktiPembayaran($idPembeli, $namaFileBaruA);
                        setPesanKeberhasilan("File A berhasil diunggah.");
                    } else {
                        setPesanKesalahan("Gagal mengunggah file A.");
                    }
                } else {
                    setPesanKesalahan("Unggah file A gagal. Pastikan file berformat JPG, JPEG, atau PNG.");
                }
            } else {
                setPesanKesalahan("Unggah file A gagal. Pastikan file berukuran maksimal 2MB.");
            }
        } else {
            setPesanKesalahan("Gagal mengunggah file A.");
        }
    }

    if (isset($_FILES['File_Instansi_B'])) {
        $fileB = $_FILES['File_Instansi_B'];
        $namaFileB = $fileB['name'];
        $fileBtemp = $fileB['tmp_name'];
        $ukuranFileB = $fileB['size'];
        $errorFileB = $fileB['error'];

        if ($errorFileB === 0) {
            $ukuranMaksimal = 2 * 1024 * 1024;
            if ($ukuranFileB <= $ukuranMaksimal) {
                $ekstensiValid = ['jpg', 'jpeg', 'png'];
                $ekstensiB = pathinfo($namaFileB, PATHINFO_EXTENSION);
                if (in_array($ekstensiB, $ekstensiValid)) {
                    $namaFileBaruB = uniqid() . '.' . $ekstensiB;

                    $tujuanFileB = '../assets/image/uploads/';
                    $tujuanFileBaruB = $tujuanFileB . $namaFileBaruB;

                    if (move_uploaded_file($fileBtemp, $tujuanFileBaruB)) {
                        $transaksi->uploadFileBuktiPembayaran($idPembeli, $namaFileBaruB);
                        setPesanKeberhasilan("File B berhasil diunggah.");
                    } else {
                        setPesanKesalahan("Gagal mengunggah file B.");
                    }
                } else {
                    setPesanKesalahan("Unggah file B gagal. Pastikan file berformat JPG, JPEG, atau PNG.");
                }
            } else {
                setPesanKesalahan("Unggah file B gagal. Pastikan file berukuran maksimal 2MB.");
            }
        } else {
            setPesanKesalahan("Gagal mengunggah file B.");
        }
    }

    if (isset($_FILES['File_Instansi_C'])) {
        $fileC = $_FILES['File_Instansi_C'];
        $namaFileC = $fileC['name'];
        $fileCtemp = $fileC['tmp_name'];
        $ukuranFileC = $fileC['size'];
        $errorFileC = $fileC['error'];

        if ($errorFileC === 0) {
            $ukuranMaksimal = 2 * 1024 * 1024;
            if ($ukuranFileC <= $ukuranMaksimal) {
                $ekstensiValid = ['jpg', 'jpeg', 'png'];
                $ekstensiC = pathinfo($namaFileC, PATHINFO_EXTENSION);
                if (in_array($ekstensiC, $ekstensiValid)) {
                    $namaFileBaruC = uniqid() . '.' . $ekstensiC;

                    $tujuanFileC = '../assets/image/uploads/';
                    $tujuanFileBaruC = $tujuanFileC . $namaFileBaruC;

                    if (move_uploaded_file($fileCtemp, $tujuanFileBaruC)) {
                        $transaksi->uploadFileBuktiPembayaran($idPembeli, $namaFileBaruC);
                        setPesanKeberhasilan("File C berhasil diunggah.");
                    } else {
                        setPesanKesalahan("Gagal mengunggah file C.");
                    }
                } else {
                    setPesanKesalahan("Unggah file C gagal. Pastikan file berformat JPG, JPEG, atau PNG.");
                }
            } else {
                setPesanKesalahan("Unggah file C gagal. Pastikan file berukuran maksimal 2MB.");
            }
        } else {
            setPesanKesalahan("Gagal mengunggah file C.");
        }
    }

    header("Location: $akarUrl/src/user/pages/pesanan.php");
    exit;
}
