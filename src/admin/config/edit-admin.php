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
        $idAdmin = mysqli_real_escape_string($koneksi, $_POST['ID_Admin'] ?? '');
        $namaDepan = filter_input(INPUT_POST, 'Nama_Depan_Admin', FILTER_SANITIZE_STRING);
        $namaBelakang = filter_input(INPUT_POST, 'Nama_Belakang_Admin', FILTER_SANITIZE_STRING);
        $namaPengguna = filter_input(INPUT_POST, 'Nama_Pengguna_Admin', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email_Admin', FILTER_VALIDATE_EMAIL);
        $nomorTelepon = filter_input(INPUT_POST, 'No_Telepon_Admin', FILTER_SANITIZE_STRING);
        $jenisKelamin = filter_input(INPUT_POST, 'Jenis_Kelamin_Admin', FILTER_SANITIZE_STRING);
        $peranAdmin = filter_input(INPUT_POST, 'Peran_Admin', FILTER_SANITIZE_STRING);
        $alamatAdmin = filter_input(INPUT_POST, 'Alamat_Admin', FILTER_SANITIZE_STRING);

        $nomorTeleponFormatted = $nomorTelepon;

        if (strpos($nomorTeleponFormatted, '-') === false) {
            $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . '-' . substr($nomorTeleponFormatted, 3, 4) . '-' . substr($nomorTeleponFormatted, 7);
        }

        if (strpos($nomorTeleponFormatted, '+62') === false) {
            $nomorTeleponFormatted = '+62 ' . $nomorTeleponFormatted;
        }


        $requiredFields = ['ID_Admin', 'Nama_Depan_Admin', 'Nama_Belakang_Admin', 'Nama_Pengguna_Admin', 'Email_Admin', 'No_Telepon_Admin', 'Jenis_Kelamin_Admin', 'Peran_Admin', 'Alamat_Admin'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                echo json_encode(array("success" => false, "message" => "Gagal mengedit data admin. Harap isi semua field."));
                exit;
            }
        }

        $email = filter_var($_POST['Email_Admin'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo json_encode(array("success" => false, "message" => "Format email tidak valid."));
            exit;
        }

        $obyekAdmin = new Admin($koneksi);

        if (!empty($_FILES['Foto_Admin']['name'])) {
            $fotoAdmin = $_FILES['Foto_Admin'];
            $namaFotoAsli = $fotoAdmin['name'];
            $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
            $namaFotoBaru = uniqid() . '.' . $ekstensi;
            $tujuanFoto = "../assets/image/uploads/" . $namaFotoBaru;

            if (!move_uploaded_file($fotoAdmin['tmp_name'], $tujuanFoto)) {
                echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
                exit;
            }

            $namaFotoLama = $obyekAdmin->getFotoAdminById($idAdmin);
            if (!empty($namaFotoLama)) {
                if (file_exists($namaFotoLama)) {
                    unlink($namaFotoLama);
                } else {
                    $pathFotoLama = "../assets/image/uploads/" . $namaFotoLama;
                    if (file_exists($pathFotoLama)) {
                        unlink($pathFotoLama);
                    }
                }
            }
        } else {
            $namaFotoBaru = $obyekAdmin->getFotoAdminById($idAdmin);
        }

        $dataAdmin = array(
            'Foto' => $namaFotoBaru,
            'Nama_Depan_Admin' => $namaDepan,
            'Nama_Belakang_Admin' => $namaBelakang,
            'Nama_Pengguna_Admin' => $namaPengguna,
            'Email_Admin' => $email,
            'No_Telepon_Admin' => $nomorTeleponFormatted,
            'Jenis_Kelamin_Admin' => $jenisKelamin,
            'Peran_Admin' => $peranAdmin,
            'Alamat_Admin' => $alamatAdmin
        );

        $idAdmin = $_POST['ID_Admin'];
        $updateDataAdmin = $obyekAdmin->perbaruiAdmin($idAdmin, $dataAdmin);

        if ($updateDataAdmin) {
            echo json_encode(array("success" => true, "message" => "Data admin berhasil diperbarui."));
            exit;
        } else {
            echo json_encode(array("success" => false, "message" => "Gagal memperbarui data admin."));
            exit;
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Token tidak valid."));
        exit;
    }
