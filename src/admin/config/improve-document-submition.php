<?php
include 'databases.php';

function containsXSS($input)
{
    $xss_patterns = [
        '/<script\b[^>]*>(.*?)<\/script>/is',
        '/<\/?[a-z][a-z0-9]*[^>]*>/i',
    ];

    foreach ($xss_patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    $idImprovePengajuan = isset($_POST['ID_Pengajuan']) ? $purifier->purify($_POST['ID_Pengajuan']) : '';
    $perbaikanDokumen = isset($_POST['Perbaikan_Dokumen']) ? $purifier->purify($_POST['Perbaikan_Dokumen']) : '';

    // Sanitasi input untuk XSS
    if (containsXSS($idImprovePengajuan) || containsXSS($perbaikanDokumen)) {
        echo json_encode(array("success" => false, "message" => "Input tidak valid."));
        exit;
    }

    $uploadedFiles = [];
    $uploadDir = '../assets/image/uploads/';
    $allowedExtensions = ['pdf', 'doc', 'docx'];

    for ($i = 1; $i <= 4; $i++) {
        $fileInputName = 'file' . $i;

        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $fileExtension = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                echo json_encode(array("success" => false, "message" => "Hanya file PDF, DOC, atau DOCX yang diperbolehkan."));
                exit;
            }

            $fileName = uniqid() . '.' . $fileExtension;
            $uploadPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $uploadPath)) {
                $uploadedFiles[] = $fileName; // Tambahkan nama file ke array
            } else {
                echo json_encode(array("success" => false, "message" => "Gagal mengunggah dokumen: " . $_FILES[$fileInputName]['name']));
                exit;
            }
        } elseif (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_NO_FILE) {
            echo json_encode(array("success" => false, "message" => "Kesalahan saat mengunggah file: " . $_FILES[$fileInputName]['error']));
            exit;
        }
    }

    if (empty($uploadedFiles)) {
        echo json_encode(array("success" => false, "message" => "Tidak ada dokumen yang diunggah."));
        exit;
    }

    $databasesModel = new Pengajuan($koneksi);
    $statusPengajuan = 'Sedang Ditinjau';
    $keteranganSurat = NULL;

    $perbaharuiImprovePengajuan = $databasesModel->perbaruiPerbaikanPengajuan(
        $idImprovePengajuan,
        $keteranganSurat,
        $perbaikanDokumen,
        $uploadedFiles,
        $statusPengajuan
    );

    if ($perbaharuiImprovePengajuan) {
        echo json_encode(array("success" => true, "message" => "Data pengajuan berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengajuan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}
