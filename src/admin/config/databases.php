<?php
include 'connection.php';

// ===================================ADMIN===================================
class Admin
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahAdmin($data)
    {
        $query = "INSERT INTO admin (Foto, Nama_Depan_Admin, Nama_Belakang_Admin, Nama_Pengguna_Admin, Email_Admin, Kata_Sandi, Konfirmasi_Kata_Sandi, No_Telepon_Admin, Jenis_Kelamin_Admin, Peran_Admin, Alamat_Admin, Status_Verifikasi_Admin, Token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sssssssssissi",
            $this->escapeString($data['Foto']),
            $this->escapeString($data['Nama_Depan_Admin']),
            $this->escapeString($data['Nama_Belakang_Admin']),
            $this->escapeString($data['Nama_Pengguna_Admin']),
            $this->escapeString($data['Email_Admin']),
            $this->escapeString($data['Kata_Sandi']),
            $this->escapeString($data['Konfirmasi_Kata_Sandi']),
            $this->escapeString($data['No_Telepon_Admin']),
            $this->escapeString($data['Jenis_Kelamin_Admin']),
            $this->escapeString($data['Peran_Admin']),
            $this->escapeString($data['Alamat_Admin']),
            $this->escapeString($data['Status_Verifikasi_Admin']),
            $this->escapeString($data['Token'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function tampilkanDataAdmin()
    {
        $query = "SELECT * FROM admin";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    function tampilkanAdminDenganSessionId($idSessionAdmin)
    {
        $idSessionAdmin = intval($idSessionAdmin);
        $query = "SELECT * FROM admin WHERE ID_Admin = $idSessionAdmin";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    function tampilkanDataAdminOlehPeran($peranAdmin)
    {
        $peranAdmin = intval($peranAdmin);
        $query = "SELECT * FROM admin WHERE Peran_Admin = $peranAdmin";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function perbaruiAdmin($id, $data)
    {
        $query = "UPDATE admin SET Foto=?, Nama_Depan_Admin=?, Nama_Belakang_Admin=?, Nama_Pengguna_Admin=?, Email_Admin=?, No_Telepon_Admin=?, Jenis_Kelamin_Admin=?, Peran_Admin=?, Alamat_Admin=? WHERE ID_Admin=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssssssisi", $data['Foto'], $data['Nama_Depan_Admin'], $data['Nama_Belakang_Admin'], $data['Nama_Pengguna_Admin'], $data['Email_Admin'], $data['No_Telepon_Admin'], $data['Jenis_Kelamin_Admin'], $data['Peran_Admin'], $data['Alamat_Admin'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiProfile($id, $data)
    {
        $query = "UPDATE admin SET Nama_Depan_Admin=?, Nama_Belakang_Admin=?, Nama_Pengguna_Admin=?, Email_Admin=?, No_Telepon_Admin=?, Alamat_Admin=? WHERE ID_Admin=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ssssssi", $data['Nama_Depan_Admin'], $data['Nama_Belakang_Admin'], $data['Nama_Pengguna_Admin'], $data['Email_Admin'], $data['No_Telepon_Admin'], $data['Alamat_Admin'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiKataSandi($id, $data)
    {
        $query = "UPDATE admin SET Kata_Sandi=?, Konfirmasi_Kata_Sandi=? WHERE ID_Admin=?";

        $statement = $this->koneksi->prepare($query);

        $statement->bind_param("ssi", $data['Kata_Sandi'], $data['Konfirmasi_Kata_Sandi'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function perbaruiPhotoProfile($id, $data)
    {
        $query = "UPDATE admin SET Foto=? WHERE ID_Admin=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("si", $data['Foto'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusAdmin($id)
    {
        $query = "SELECT ID_Admin, Foto FROM admin WHERE ID_Admin=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['ID_Admin'];
        $namaFoto = $row['Foto'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM admin WHERE ID_Admin=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../assets/image/uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getDataById($id)
    {
        $query = "SELECT * FROM admin WHERE ID_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function getFotoAdminById($idAdmin)
    {
        $query = "SELECT Foto FROM admin WHERE ID_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idAdmin);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto'];
        } else {
            return null;
        }
    }

    public function autentikasiAdmin($email, $kataSandi)
    {
        $query = "SELECT * FROM admin WHERE Email_Admin = ? OR Nama_Pengguna_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ss", $email, $email);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedKataSandi = $row['Kata_Sandi'];
            if (password_verify($kataSandi, $hashedKataSandi)) {
                return $row;
            }
        }
        return null;
    }

    public function cekEmailSudahAda($email)
    {
        $query = "SELECT COUNT(*) as total FROM admin WHERE Email_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminByToken($token)
    {
        $query = "SELECT * FROM admin WHERE Token = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function updateStatusVerifikasi($adminId, $status)
    {
        $query = "UPDATE admin SET Status_Verifikasi_Admin = ? WHERE ID_Admin = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "si", $status, $adminId);
        return mysqli_stmt_execute($stmt);
    }

    public function updateToken($adminId, $token)
    {
        $query = "UPDATE admin SET token = ? WHERE ID_Admin = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "si", $token, $adminId);
        return mysqli_stmt_execute($stmt);
    }

    public function getAdminByEmail($email)
    {
        $query = "SELECT * FROM admin WHERE Email_Admin = '$email'";
        $result = mysqli_query($this->koneksi, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $adminData = mysqli_fetch_assoc($result);
            return $adminData;
        } else {
            return null;
        }
    }

    public function updateTokenByEmail($email, $newToken)
    {
        $query = "UPDATE admin SET Token = '$newToken' WHERE Email_Admin = '$email'";
        $result = mysqli_query($this->koneksi, $query);

        if ($result) {
            return true;
            return false;
        }
    }
}
// ===================================ADMIN===================================


// ===================================PENGGUNA===================================
class Pengguna
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahPengguna($data)
    {
        $query = "INSERT INTO pengguna (NPWP_Pengguna, No_Identitas_Pengguna, Pekerjaan_Pengguna, Nama_Depan_Pengguna, Nama_Belakang_Pengguna, Pendidikan_Terakhir_Pengguna, Nama_Pengguna, Email_Pengguna, Kata_Sandi, Konfirmasi_Kata_Sandi, No_Telepon_Pengguna, Jenis_Kelamin_Pengguna, Alamat_Pengguna, Provinsi, Kabupaten_Kota, Status_Verifikasi_Pengguna, Token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->koneksi->prepare($query);

        if (!$statement) {
            die('Query error: ' . $this->koneksi->error);
        }

        $kabupatenKota = isset($data['Kabupaten_Kota']) ? $data['Kabupaten_Kota'] : null;

        $bindParams = [
            'ssssssssssssssssi',
            &$data['NPWP_Pengguna'],
            &$data['No_Identitas_Pengguna'],
            &$data['Pekerjaan_Pengguna'],
            &$data['Nama_Depan_Pengguna'],
            &$data['Nama_Belakang_Pengguna'],
            &$data['Pendidikan_Terakhir_Pengguna'],
            &$data['Nama_Pengguna'],
            &$data['Email_Pengguna'],
            &$data['Kata_Sandi'],
            &$data['Konfirmasi_Kata_Sandi'],
            &$data['No_Telepon_Pengguna'],
            &$data['Jenis_Kelamin_Pengguna'],
            &$data['Alamat_Pengguna'],
            &$data['Provinsi'],
            &$kabupatenKota,
            &$data['Status_Verifikasi_Pengguna'],
            &$data['Token']
        ];

        if (count($bindParams) - 1 !== substr_count($query, '?')) {
            die('Mismatch in number of bind parameters and placeholders in query');
        }

        call_user_func_array([$statement, 'bind_param'], $bindParams);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahPerusahaan($data)
    {
        $query = "INSERT INTO perusahaan (No_Identitas_Anggota_Perusahaan, Nama_Depan_Anggota_Perusahaan, Nama_Belakang_Anggota_Perusahaan, Pekerjaan_Anggota_Perusahaan, Pendidikan_Terakhir_Anggota_Perusahaan, Jenis_Kelamin_Anggota_Perusahaan, Alamat_Anggota_Perusahaan, No_Telepon_Anggota_Perusahaan, Provinsi_Anggota_Perusahaan, Kabupaten_Kota_Anggota_Perusahaan, No_NPWP, Nama_Perusahaan, Alamat_Perusahaan, Provinsi_Perusahaan, Kabupaten_Kota_Perusahaan, Email_Perusahaan, No_Telepon_Perusahaan, Email_Anggota_Perusahaan, Nama_Pengguna_Anggota_Perusahaan, Kata_Sandi_Anggota_Perusahaan, Konfirmasi_Kata_Sandi_Anggota_Perusahaan, Status_Verifikasi_Perusahaan, Token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->koneksi->prepare($query);

        if (!$statement) {
            die('Query error: ' . $this->koneksi->error);
        }

        $bindParams = [
            &$data['No_Identitas_Anggota_Perusahaan'],
            &$data['Nama_Depan_Anggota_Perusahaan'],
            &$data['Nama_Belakang_Anggota_Perusahaan'],
            &$data['Pekerjaan_Anggota_Perusahaan'],
            &$data['Pendidikan_Terakhir_Anggota_Perusahaan'],
            &$data['Jenis_Kelamin_Anggota_Perusahaan'],
            &$data['Alamat_Anggota_Perusahaan'],
            &$data['No_Telepon_Anggota_Perusahaan'],
            &$data['Provinsi_Anggota_Perusahaan'],
            &$data['Kabupaten_Kota_Anggota_Perusahaan'],
            &$data['No_NPWP'],
            &$data['Nama_Perusahaan'],
            &$data['Alamat_Perusahaan'],
            &$data['Provinsi_Perusahaan'],
            &$data['Kabupaten_Kota_Perusahaan'],
            &$data['Email_Perusahaan'],
            &$data['No_Telepon_Perusahaan'],
            &$data['Email_Anggota_Perusahaan'],
            &$data['Nama_Pengguna_Anggota_Perusahaan'],
            &$data['Kata_Sandi_Anggota_Perusahaan'],
            &$data['Konfirmasi_Kata_Sandi_Anggota_Perusahaan'],
            &$data['Status_Verifikasi_Perusahaan'],
            &$data['Token']
        ];

        $types = "ssssssssssssssssssssssi";
        if (strlen($types) !== substr_count($query, '?')) {
            die('Mismatch in number of bind parameters and placeholders in query');
        }

        array_unshift($bindParams, $types);
        call_user_func_array([$statement, 'bind_param'], $bindParams);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function tampilkanDataPengguna()
    {
        $query = "SELECT * FROM pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataPerusahaan()
    {
        $query = "SELECT * FROM perusahaan";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function perbaruiPengguna($id, $data)
    {
        $query = "UPDATE pengguna SET Nama_Depan_Pengguna=?, Nama_Belakang_Pengguna=?, Nama_Pengguna=?, Email_Pengguna=?, No_Telepon_Pengguna=?, Jenis_Kelamin_Pengguna=?, Alamat_Pengguna=?, Pekerjaan_Pengguna=?, Pendidikan_Terakhir_Pengguna=? WHERE ID_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sssssssssi",
            $this->escapeString($data['Nama_Depan_Pengguna']),
            $this->escapeString($data['Nama_Belakang_Pengguna']),
            $this->escapeString($data['Nama_Pengguna']),
            $this->escapeString($data['Email_Pengguna']),
            $this->escapeString($data['No_Telepon_Pengguna']),
            $this->escapeString($data['Jenis_Kelamin_Pengguna']),
            $this->escapeString($data['Alamat_Pengguna']),
            $this->escapeString($data['Pekerjaan_Pengguna']),
            $this->escapeString($data['Pendidikan_Terakhir_Pengguna']),
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiPerusahaan($id, $data)
    {
        $query = "UPDATE perusahaan SET Nama_Depan_Anggota_Perusahaan=?, Nama_Belakang_Anggota_Perusahaan=?, Nama_Pengguna_Anggota_Perusahaan=?, Email_Anggota_Perusahaan=?, No_Telepon_Anggota_Perusahaan=?, Jenis_Kelamin_Anggota_Perusahaan=?, Alamat_Anggota_Perusahaan=?, Pekerjaan_Anggota_Perusahaan=?, Pendidikan_Terakhir_Anggota_Perusahaan=? WHERE ID_Perusahaan=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sssssssssi",
            $this->escapeString($data['Nama_Depan_Anggota_Perusahaan']),
            $this->escapeString($data['Nama_Belakang_Anggota_Perusahaan']),
            $this->escapeString($data['Nama_Pengguna_Anggota_Perusahaan']),
            $this->escapeString($data['Email_Anggota_Perusahaan']),
            $this->escapeString($data['No_Telepon_Anggota_Perusahaan']),
            $this->escapeString($data['Jenis_Kelamin_Anggota_Perusahaan']),
            $this->escapeString($data['Alamat_Anggota_Perusahaan']),
            $this->escapeString($data['Pekerjaan_Anggota_Perusahaan']),
            $this->escapeString($data['Pendidikan_Terakhir_Anggota_Perusahaan']),
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function autentikasiPengguna($email, $kataSandi)
    {
        $query = "SELECT * FROM pengguna WHERE Email_Pengguna = ? OR Nama_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ss", $email, $email);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedKataSandi = $row['Kata_Sandi'];
            if (password_verify($kataSandi, $hashedKataSandi)) {
                return $row;
            }
        }
        return null;
    }

    public function autentikasiPerusahaan($email, $kataSandi)
    {
        $query = "SELECT * FROM perusahaan WHERE Email_Perusahaan = ? OR Nama_Perusahaan = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ss", $email, $email);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedKataSandi = $row['Kata_Sandi_Anggota_Perusahaan'];
            if (password_verify($kataSandi, $hashedKataSandi)) {
                return $row;
            }
        }
        return null;
    }

    public function hapusPengguna($id)
    {
        $query = "SELECT ID_Pengguna, Foto FROM pengguna WHERE ID_Pengguna=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['ID_Pengguna'];
        $namaFoto = $row['Foto'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM pengguna WHERE ID_Pengguna=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../assets/image/uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getDataById($id)
    {
        $query = "SELECT * FROM pengguna WHERE ID_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function getDataPerusahaanById($id)
    {
        $query = "SELECT * FROM perusahaan WHERE ID_Perusahaan = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }


    public function getPenggunaByToken($token)
    {
        $query = "SELECT * FROM pengguna WHERE Token = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function getPerusahaanByToken($token)
    {
        $query = "SELECT * FROM perusahaan WHERE Token = ?";
        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }


    public function getFotoPenggunaById($idPengguna)
    {
        $query = "SELECT Foto FROM pengguna WHERE ID_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idPengguna);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto'];
        } else {
            return null;
        }
    }

    public function generateRandomCaptchaPengguna($length = 5)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captcha = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $captcha .= $characters[mt_rand(0, $max)];
        }

        return $captcha;
    }

    public function generateRandomCaptchaPerusahaan($length = 5)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captcha = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $captcha .= $characters[mt_rand(0, $max)];
        }

        return $captcha;
    }
}
// ===================================PENGGUNA===================================



// ===================================INFORMASI===================================
class Informasi
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function tambahInformasi($data)
    {
        $query = "INSERT INTO informasi (Foto_Informasi, Nama_Informasi, Deskripsi_Informasi, Harga_Informasi, Pemilik_Informasi, No_Rekening_Informasi, Kategori_Informasi, Status_Informasi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisiss", $data['Foto_Informasi'], $data['Nama_Informasi'], $data['Deskripsi_Informasi'], $data['Harga_Informasi'], $data['Pemilik_Informasi'], $data['No_Rekening_Informasi'], $data['Kategori_Informasi'], $data['Status_Informasi']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataInformasi()
    {
        $query = "SELECT * FROM informasi";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataInformasiMeteorologi()
    {
        $query = "SELECT * FROM informasi WHERE Kategori_Informasi = 'Meteorologi'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataInformasiKlimatologi()
    {
        $query = "SELECT * FROM informasi WHERE Kategori_Informasi = 'Klimatologi'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataInformasiGeofisika()
    {
        $query = "SELECT * FROM informasi WHERE Kategori_Informasi = 'Geofisika'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataInformasiTerbaru($limit = 3)
    {
        $query = "SELECT * FROM informasi ORDER BY ID_Informasi DESC LIMIT ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $limit);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return [];
        }
    }

    public function perbaruiInformasi($id, $data)
    {
        $query = "UPDATE informasi SET Foto_Informasi=?, Nama_Informasi=?, Deskripsi_Informasi=?, Harga_Informasi=?, Pemilik_Informasi=?, No_Rekening_Informasi=?, Kategori_Informasi=?, Status_Informasi=? WHERE ID_Informasi=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisissi", $data['Foto_Informasi'], $data['Nama_Informasi'], $data['Deskripsi_Informasi'], $data['Harga_Informasi'], $data['Pemilik_Informasi'], $data['No_Rekening_Informasi'], $data['Kategori_Informasi'], $data['Status_Informasi'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusInformasi($id)
    {
        $query = "SELECT ID_Informasi, Foto_Informasi FROM informasi WHERE ID_Informasi=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['ID_Informasi'];
        $namaFoto = $row['Foto_Informasi'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM informasi WHERE ID_Informasi=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../assets/image/uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }


    public function getDataInformasiById($id)
    {
        $query = "SELECT * FROM informasi WHERE ID_Informasi = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function getFotoInformasiById($idInformasi)
    {
        $query = "SELECT Foto_Informasi FROM informasi WHERE ID_Informasi = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idInformasi);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto_Informasi'];
        } else {
            return null;
        }
    }

    public function perbaruiNomorRekening($id, $nomorRekening)
    {
        $query = "UPDATE informasi SET No_Rekening_Informasi=? WHERE ID_Informasi=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("si", $nomorRekening, $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cariDataInformasi($kataKunci)
    {
        $query = "SELECT * FROM informasi WHERE Nama_Informasi LIKE ? OR Deskripsi_Informasi LIKE ?";
        $kataKunci = "%$kataKunci%";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ss", $kataKunci, $kataKunci);
        $statement->execute();

        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return [];
        }
    }
}

// ===================================INFORMASI===================================



// ===================================JASA===================================
class Jasa
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function tambahJasa($data)
    {
        $query = "INSERT INTO jasa (Foto_Jasa, Nama_Jasa, Deskripsi_Jasa, Harga_Jasa, Pemilik_Jasa, No_Rekening_Jasa, Kategori_Jasa, Status_Jasa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisiss", $data['Foto_Jasa'], $data['Nama_Jasa'], $data['Deskripsi_Jasa'], $data['Harga_Jasa'], $data['Pemilik_Jasa'], $data['No_Rekening_Jasa'], $data['Kategori_Jasa'], $data['Status_Jasa']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataJasa()
    {
        $query = "SELECT * FROM jasa";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataJasaTerbaru($limit = 3)
    {
        $query = "SELECT * FROM jasa ORDER BY ID_Jasa DESC LIMIT ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $limit);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return [];
        }
    }

    public function tampilkanDataJasaMeteorologi()
    {
        $query = "SELECT * FROM jasa WHERE Kategori_Jasa = 'Meteorologi'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataJasaKlimatologi()
    {
        $query = "SELECT * FROM jasa WHERE Kategori_Jasa = 'Klimatologi'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataJasaGeofisika()
    {
        $query = "SELECT * FROM jasa WHERE Kategori_Jasa = 'Geofisika'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function perbaruiJasa($id, $data)
    {
        $query = "UPDATE jasa SET Foto_Jasa=?, Nama_Jasa=?, Deskripsi_Jasa=?, Harga_Jasa=?, Pemilik_Jasa=?, No_Rekening_Jasa=?, Kategori_Jasa=?, Status_Jasa=? WHERE ID_Jasa=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisissi", $data['Foto_Jasa'], $data['Nama_Jasa'], $data['Deskripsi_Jasa'], $data['Harga_Jasa'], $data['Pemilik_Jasa'], $data['No_Rekening_Jasa'], $data['Kategori_Jasa'], $data['Status_Jasa'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusJasa($id)
    {
        $query = "SELECT ID_Jasa, Foto_Jasa FROM jasa WHERE ID_Jasa=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['ID_Jasa'];
        $namaFoto = $row['Foto_Jasa'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM jasa WHERE ID_Jasa=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../assets/image/uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getDataJasaById($id)
    {
        $query = "SELECT * FROM jasa WHERE ID_Jasa = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function getFotoJasaById($idJasa)
    {
        $query = "SELECT Foto_Jasa FROM jasa WHERE ID_Jasa = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idJasa);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto_Jasa'];
        } else {
            return null;
        }
    }
    public function perbaruiNomorRekening($id, $nomorRekening)
    {
        $query = "UPDATE jasa SET No_Rekening_Jasa=? WHERE ID_Jasa=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("si", $nomorRekening, $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cariDataJasa($kataKunci)
    {
        $query = "SELECT * FROM jasa WHERE Nama_Jasa LIKE ? OR Deskripsi_Jasa LIKE ?";
        $kataKunci = "%$kataKunci%";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ss", $kataKunci, $kataKunci);
        $statement->execute();

        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return [];
        }
    }
}

// ===================================JASA===================================

// ===================================PENGAJUAN===================================
class Pengajuan
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function tambahInformasiPNBP($data)
    {
        $query = "INSERT INTO informasi_tarif_pnbp (ID_PNBP, Nama_PNBP, No_Telepon_PNBP, Email_PNBP, Informasi_PNBP_Yang_Dibutuhkan, Identitas_KTP_PNBP, Surat_Pengantar_PNBP) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issssss",
            $data['ID_PNBP'],
            $data['Nama_PNBP'],
            $data['No_Telepon_PNBP'],
            $data['Email_PNBP'],
            $data['Informasi_PNBP_Yang_Dibutuhkan'],
            $data['Identitas_KTP_PNBP'],
            $data['Surat_Pengantar_PNBP']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataBencana($data)
    {
        $query = "INSERT INTO kegiatan_bencana (ID_Bencana, Nama_Bencana, No_Telepon_Bencana, Email_Bencana, Informasi_Bencana_Yang_Dibutuhkan, Surat_Pengantar_Permintaan_Data_Bencana) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssss",
            $data['ID_Bencana'],
            $data['Nama_Bencana'],
            $data['No_Telepon_Bencana'],
            $data['Email_Bencana'],
            $data['Informasi_Bencana_Yang_Dibutuhkan'],
            $data['Surat_Pengantar_Permintaan_Data_Bencana']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataKeagamaan($data)
    {
        $query = "INSERT INTO kegiatan_keagamaan (ID_Keagamaan, Nama_Keagamaan, No_Telepon, Email, Informasi_Keagamaan_Yang_Dibutuhkan, Surat_Yang_Ditandatangani_Keagamaan) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssss",
            $data['ID_Keagamaan'],
            $data['Nama_Keagamaan'],
            $data['No_Telepon'],
            $data['Email'],
            $data['Informasi_Keagamaan_Yang_Dibutuhkan'],
            $data['Surat_Yang_Ditandatangani_Keagamaan']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPertahanan($data)
    {
        $query = "INSERT INTO kegiatan_pertahanan_keamanan (ID_Pertahanan, Nama_Pertahanan, No_Telepon_Pertahanan, Email_Pertahanan, Informasi_Pertahanan_Yang_Dibutuhkan, Surat_Yang_Ditandatangani_Pertahanan) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssss",
            $data['ID_Pertahanan'],
            $data['Nama_Pertahanan'],
            $data['No_Telepon_Pertahanan'],
            $data['Email_Pertahanan'],
            $data['Informasi_Pertahanan_Yang_Dibutuhkan'],
            $data['Surat_Yang_Ditandatangani_Pertahanan']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataSosial($data)
    {
        $query = "INSERT INTO kegiatan_sosial (ID_Sosial, Nama_Sosial, No_Telepon, Email, Informasi_Sosial_Yang_Dibutuhkan, Surat_Yang_Ditandatangani_Sosial) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssss",
            $data['ID_Sosial'],
            $data['Nama_Sosial'],
            $data['No_Telepon'],
            $data['Email'],
            $data['Informasi_Sosial_Yang_Dibutuhkan'],
            $data['Surat_Yang_Ditandatangani_Sosial']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPusatDaerah($data)
    {
        $query = "INSERT INTO pemerintah_pusat_daerah (ID_Pusat, Nama_Pusat_Daerah, No_Telepon_Pusat_Daerah, Email_Pusat_Daerah, Informasi_Pusat_Daerah_Yang_Dibutuhkan, Memiliki_Kerja_Sama_Dengan_BMKG, Surat_Pengantar_Pusat_Daerah) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issssss",
            $data['ID_Pusat'],
            $data['Nama_Pusat_Daerah'],
            $data['No_Telepon_Pusat_Daerah'],
            $data['Email_Pusat_Daerah'],
            $data['Informasi_Pusat_Daerah_Yang_Dibutuhkan'],
            $data['Memiliki_Kerja_Sama_Dengan_BMKG'],
            $data['Surat_Pengantar_Pusat_Daerah']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPendidikanPenelitian($data)
    {
        $query = "INSERT INTO pendidikan_dan_penelitian (ID_Pendidikan_Penelitian, Nama_Pendidikan_Dan_Penelitian, NIM_KTP, Program_Studi_Fakultas, Universitas_Instansi, No_Telepon_Pendidikan_Penelitian, Email_Pendidikan_Penelitian, Informasi_Pendidikan_Penelitian_Yang_Dibutuhkan, Identitas_Diri, Surat_Pengantar_Kepsek_Rektor_Dekan, Pernyataan_Tidak_Digunakan_Kepentingan_Lain, Proposal_Penelitian_Telah_Disetujui) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssssssssss",
            $data['ID_Pendidikan_Penelitian'],
            $data['Nama_Pendidikan_Dan_Penelitian'],
            $data['NIM_KTP'],
            $data['Program_Studi_Fakultas'],
            $data['Universitas_Instansi'],
            $data['No_Telepon_Pendidikan_Penelitian'],
            $data['Email_Pendidikan_Penelitian'],
            $data['Informasi_Pendidikan_Penelitian_Yang_Dibutuhkan'],
            $data['Identitas_Diri'],
            $data['Surat_Pengantar_Kepsek_Rektor_Dekan'],
            $data['Pernyataan_Tidak_Digunakan_Kepentingan_Lain'],
            $data['Proposal_Penelitian_Telah_Disetujui']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilIDBencanaTerakhir()
    {
        $query = "SELECT ID_Bencana FROM kegiatan_bencana ORDER BY ID_Bencana DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Bencana'];
        } else {
            return null;
        }
    }

    public function tambahDataPengajuanBencana($dataPengajuanBencana)
    {
        $query = "INSERT INTO pengajuan (ID_Pengguna, ID_Perusahaan, ID_Bencana, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, ?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iiis",
            $dataPengajuanBencana['ID_Pengguna'],
            $dataPengajuanBencana['ID_Perusahaan'],
            $dataPengajuanBencana['ID_Bencana'],
            $dataPengajuanBencana['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataPengajuan()
    {
        $query = "SELECT pengajuan.*, pengguna.*, perusahaan.*, admin.*, kegiatan_bencana.*, kegiatan_keagamaan.*, kegiatan_pertahanan_keamanan.*, kegiatan_sosial.*, pemerintah_pusat_daerah.*, pendidikan_dan_penelitian.* FROM pengajuan 
                  LEFT JOIN pengguna ON pengajuan.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN perusahaan ON pengajuan.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN admin ON pengajuan.ID_Admin = admin.ID_Admin
                  LEFT JOIN kegiatan_bencana ON pengajuan.ID_Bencana = kegiatan_bencana.ID_Bencana
                  LEFT JOIN kegiatan_keagamaan ON pengajuan.ID_Keagamaan = kegiatan_keagamaan.ID_Keagamaan
                  LEFT JOIN kegiatan_pertahanan_keamanan ON pengajuan.ID_Pertahanan = kegiatan_pertahanan_keamanan.ID_Pertahanan
                  LEFT JOIN kegiatan_sosial ON pengajuan.ID_Sosial = kegiatan_sosial.ID_Sosial
                  LEFT JOIN pemerintah_pusat_daerah ON pengajuan.ID_Pusat_Daerah = pemerintah_pusat_daerah.ID_Pusat
                  LEFT JOIN pendidikan_dan_penelitian ON pengajuan.ID_Penelitian = pendidikan_dan_penelitian.ID_Pendidikan_Penelitian WHERE Status_Pengajuan = 'Sedang Ditinjau'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanSemuaDataPengajuan()
    {
        $query = "SELECT pengajuan.*, pengguna.*, perusahaan.*, admin.*, kegiatan_bencana.*, kegiatan_keagamaan.*, kegiatan_pertahanan_keamanan.*, kegiatan_sosial.*, pemerintah_pusat_daerah.*, pendidikan_dan_penelitian.* FROM pengajuan 
                  LEFT JOIN pengguna ON pengajuan.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN perusahaan ON pengajuan.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN admin ON pengajuan.ID_Admin = admin.ID_Admin
                  LEFT JOIN kegiatan_bencana ON pengajuan.ID_Bencana = kegiatan_bencana.ID_Bencana
                  LEFT JOIN kegiatan_keagamaan ON pengajuan.ID_Keagamaan = kegiatan_keagamaan.ID_Keagamaan
                  LEFT JOIN kegiatan_pertahanan_keamanan ON pengajuan.ID_Pertahanan = kegiatan_pertahanan_keamanan.ID_Pertahanan
                  LEFT JOIN kegiatan_sosial ON pengajuan.ID_Sosial = kegiatan_sosial.ID_Sosial
                  LEFT JOIN pemerintah_pusat_daerah ON pengajuan.ID_Pusat_Daerah = pemerintah_pusat_daerah.ID_Pusat
                  LEFT JOIN pendidikan_dan_penelitian ON pengajuan.ID_Penelitian = pendidikan_dan_penelitian.ID_Pendidikan_Penelitian";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }
}
// ===================================PENGAJUAN===================================

// ===================================TRANSAKSI===================================

class Transaksi
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function masukKeranjangTransaksiPengguna($data)
    {
        $query = "INSERT INTO transaksi (ID_Informasi, ID_Pengguna, Tanggal_Pembelian, Status_Transaksi) VALUES (?, ?, NOW(), ?)";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("iss", $data['ID_Informasi'], $data['ID_Pengguna'], $data['Status_Transaksi']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function masukKeranjangTransaksiPerusahaan($data)
    {
        $query = "INSERT INTO transaksi (ID_Informasi, ID_Perusahaan, Tanggal_Pembelian, Status_Transaksi) VALUES (?, ?, NOW(), ?)";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("iss", $data['ID_Informasi'], $data['ID_Perusahaan'], $data['Status_Transaksi']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function masukKeranjangTransaksiPenggunaJasa($data)
    {
        $query = "INSERT INTO transaksi (ID_Jasa, ID_Pengguna, Tanggal_Pembelian, Status_Transaksi) VALUES (?, ?, NOW(), ?)";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("iss", $data['ID_Jasa'], $data['ID_Pengguna'], $data['Status_Transaksi']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function masukKeranjangTransaksiPerusahaanJasa($data)
    {
        $query = "INSERT INTO transaksi (ID_Jasa, ID_Perusahaan, Tanggal_Pembelian, Status_Transaksi) VALUES (?, ?, NOW(), ?)";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("iss", $data['ID_Jasa'], $data['ID_Perusahaan'], $data['Status_Transaksi']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cekPenggunaTerdaftar($pengguna_id)
    {
        $query = "SELECT * FROM pengguna WHERE ID_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $pengguna_id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekPerusahaanTerdaftar($perusahaan_id)
    {
        $query = "SELECT * FROM perusahaan WHERE ID_Perusahaan = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $perusahaan_id);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanTransaksi()
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.Status_Transaksi = 'Belum Disetujui'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanRiwayatTransaksi()
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.Status_Transaksi = 'Disetujui'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanTransaksiInformasi($id)
    {
        $query = "SELECT transaksi.*, informasi.* FROM transaksi 
                  INNER JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  WHERE transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanTransaksiJasa($id)
    {
        $query = "SELECT transaksi.*, jasa.* FROM transaksi 
                  INNER JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }
}
// ===================================TRANSAKSI===================================
