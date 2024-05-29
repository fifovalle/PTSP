<?php
include 'databases.php';

function containsXSS($input)
{
    $xss_patterns = [
        "/<script\b[^>]*>(.*?)<\/script>/is",
        "/<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:/i",
        "/<iframe\b[^>]*>(.*?)<\/iframe>/is",
        "/<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:/i",
        "/<object\b[^>]*>(.*?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<script\b[^>]*>[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
        "/<a\b[^>]*href\s*=\s*(?:\"|')(?:javascript:|.*?\"javascript:).*?(?:\"|')/i",
        "/<embed\b[^>]*>(.*?)<\/embed>/is",
        "/<applet\b[^>]*>(.*?)<\/applet>/is",
        "/<!--.*?-->/",
        "/(<script\b[^>]*>(.*?)<\/script>|<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:|<iframe\b[^>]*>(.*?)<\/iframe>|<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:|<object\b[^>]*>(.*?)<\/object>|on[a-zA-Z]+\s*=\s*\"[^\"]*\"|<[^>]*(>|$)(?:<|>)+|<[^>]*script\s*.*?(?:>|$)|<![^>]*-->|eval\s*\((.*?)\)|setTimeout\s*\((.*?)\)|<[^>]*\bstyle\s*=\s*[\"'][^\"']*[;{][^\"']*['\"]|<meta[^>]*http-equiv=[\"']?refresh[\"']?[^>]*url=|<[^>]*src\s*=\s*\"[^>]*\"[^>]*>|expression\s*\((.*?)\))/i"
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
    $idImprovePengajuan = $_POST['ID_Pengajuan'] ?? '';
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
    $keteranganSurat = NULL;

    $perbaharuiImprovePengajuan = $databasesModel->perbaruiPerbaikanPengajuan(
        $idImprovePengajuan,
        $keteranganSurat,
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
