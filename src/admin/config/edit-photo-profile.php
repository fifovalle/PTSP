<?php
include 'databases.php';

if (isset($_POST['Simpan'])) {
    if (isset($_FILES['Foto_Admin'])) {
        $fotoAdmin = $_FILES['Foto_Admin'];

        $namaFotoAdmin = $fotoAdmin['name'];
        $fotoAdminTemp = $fotoAdmin['tmp_name'];
        $ukuranFotoAdmin = $fotoAdmin['size'];
        $errorFotoAdmin = $fotoAdmin['error'];

        $tujuanFotoAdmin = '../assets/image/uploads/';
        $ukuranMaksimal = 2 * 1024 * 1024;

        if ($errorFotoAdmin === 0 && !empty($namaFotoAdmin) && $ukuranFotoAdmin <= $ukuranMaksimal) {
            $ekstensi = pathinfo($namaFotoAdmin, PATHINFO_EXTENSION);
            $namaFotoBaru = uniqid() . '.' . $ekstensi;
            $tujuanFileBaru = $tujuanFotoAdmin . $namaFotoBaru;

            if (move_uploaded_file($fotoAdminTemp, $tujuanFileBaru)) {
                $obyekAdmin = new Admin($koneksi);
                $idAdmin = $_SESSION['ID'];

                $namaFotoLama = $obyekAdmin->getFotoAdminById($idAdmin);

                if (!empty($namaFotoLama)) {
                    $pathFotoLama = $tujuanFotoAdmin . $namaFotoLama;
                    if (file_exists($pathFotoLama)) {
                        unlink($pathFotoLama);
                    }
                }

                $dataAdmin = array(
                    'Foto' => $namaFotoBaru
                );

                $statusPerbarui = $obyekAdmin->perbaruiPhotoProfile($idAdmin, $dataAdmin);

                if ($statusPerbarui) {
                    setPesanKeberhasilan("Foto profil berhasil diperbarui.");
                } else {
                    setPesanKesalahan("Gagal memperbarui foto profil.");
                }
            } else {
                setPesanKesalahan("Gagal mengunggah file.");
            }
        } else {
            setPesanKesalahan("Unggah file gagal. Pastikan file berukuran maksimal 2MB dan dalam format yang benar (JPG, JPEG, atau PNG).");
        }
    } else {
        setPesanKesalahan("Tidak ada file yang diunggah.");
    }
}

header("Location: $akarUrl/src/admin/pages/data.php");
exit;
