<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idImprovePengajuan = $_POST['ID_Penngajuan'] ?? '';
    $perbaikanDokumen = $_POST['Perbaikan_Dokumen'] ?? '';

    if (isset($_FILES['Unggah_Dokumen']) && $_FILES['Unggah_Dokumen']['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = array('pdf', 'doc', 'docx');
        $fileExtension = strtolower(pathinfo($_FILES['Unggah_Dokumen']['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(array("success" => false, "message" => "Hanya file PDF, DOC, atau DOCX yang diperbolehkan."));
            exit;
        }

        $uploadDir = '../assets/image/uploads/';
        $fileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['Unggah_Dokumen']['tmp_name'], $uploadPath)) {
            $dokumen = $fileName;
        } else {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah dokumen."));
            exit;
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Dokumen tidak valid atau tidak diunggah."));
        exit;
    }

    $databasesModel = new Pengajuan($koneksi);

    $statusPengajuan = 'Sedang Ditinjau';

    $perbaharuiImprovePengajuan = $databasesModel->perbaruiPerbaikanPengajuan(
        $idImprovePengajuan,
        $perbaikanDokumen,
        $dokumen,
        $statusPengajuan
    );

    if ($perbaharuiImprovePengajuan) {
        echo json_encode(array("success" => true, "message" => "Data pengajuan berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengajuan."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
