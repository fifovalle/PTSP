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
    $jasaID = filter_input(INPUT_POST, 'ID_Jasa', FILTER_SANITIZE_STRING);
    $namaJasa = filter_input(INPUT_POST, 'Nama_Jasa', FILTER_SANITIZE_STRING);
    $deskripsiJasa = filter_input(INPUT_POST, 'Deskripsi_Jasa', FILTER_SANITIZE_STRING);
    $hargaJasa = filter_input(INPUT_POST, 'Harga_Jasa', FILTER_SANITIZE_STRING);
    $pemilikJasa = filter_input(INPUT_POST, 'Pemilik_Jasa', FILTER_SANITIZE_STRING);
    $kategoriJasa = filter_input(INPUT_POST, 'Kategori_Jasa', FILTER_SANITIZE_STRING);
    $statusJasa = filter_input(INPUT_POST, 'Status_Jasa', FILTER_SANITIZE_STRING);
    $fotoJasa = $_FILES['Foto_Jasa'] ?? '';


    $jasaModel = new Jasa($koneksi);

    $jasaLama = $jasaModel->getDataJasaById($jasaID);
    $pemilikJasaLama = $jasaLama['Pemilik_Jasa'];
    $nomorRekeningJasaLama = $jasaLama['No_Rekening_Jasa'];
    $fotoJasaLama = $jasaLama['Foto_Jasa'];

    if ($pemilikJasaLama !== $pemilikJasa) {
        if ($pemilikJasa === 'Instansi A') {
            $nomorRekeningJasa = '1111';
        } elseif ($pemilikJasa === 'Instansi B') {
            $nomorRekeningJasa = '2222';
        } elseif ($pemilikJasa === 'Instansi C') {
            $nomorRekeningJasa = '3333';
        } else {
            echo json_encode(array("success" => false, "message" => "Instansi tidak valid."));
            exit;
        }

        $updateNomorRekeningJasa = $jasaModel->perbaruiNomorRekening($jasaID, $nomorRekeningJasa);

        if (!$updateNomorRekeningJasa) {
            echo json_encode(array("success" => false, "message" => "Gagal memperbarui nomor rekening jasa."));
            exit;
        }
    } else {
        $nomorRekeningJasa = $nomorRekeningJasaLama;
    }

    if (empty($fotoJasa['name'])) {
        $namaFotoBaru = $fotoJasaLama;
    } else {
        $ekstensi = pathinfo($fotoJasa['name'], PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../assets/image/uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoJasa['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        if (!empty($fotoJasaLama)) {
            if (file_exists($fotoJasaLama)) {
                unlink($fotoJasaLama);
            } else {
                $pathFotoLama = "../assets/image/uploads/" . $fotoJasaLama;
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        }
    }

    $dataJasa = array(
        'Foto_Jasa' => $namaFotoBaru,
        'Nama_Jasa' => $namaJasa,
        'Deskripsi_Jasa' => $deskripsiJasa,
        'Harga_Jasa' => $hargaJasa,
        'Pemilik_Jasa' => $pemilikJasa,
        'Kategori_Jasa' => $kategoriJasa,
        'Status_Jasa' => $statusJasa
    );

    $updateDataJasa = $jasaModel->perbaruiJasa($jasaID, $dataJasa);

    if ($updateDataJasa) {
        echo json_encode(array("success" => true, "message" => "Data jasa berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data jasa."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}
