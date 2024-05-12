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

    public function perbaruiFotoPengguna($id, $data)
    {
        $query = "UPDATE pengguna SET Foto=? WHERE ID_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("si", $data['Foto'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiFotoPerusahaan($id, $data)
    {
        $query = "UPDATE perusahaan SET Foto_Perusahaan=? WHERE ID_Perusahaan=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("si", $data['Foto_Perusahaan'], $id);

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

    public function getFotoPerusahaanById($idPerusahaan)
    {
        $query = "SELECT Foto_Perusahaan FROM perusahaan WHERE ID_Perusahaan = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idPerusahaan);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto_Perusahaan'];
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

    public function tampilkanInformasiTerlaris($limit = 1)
    {
        $query = "SELECT informasi.*, 
                        COUNT(transaksi.ID_Tranksaksi) AS total_transaksi
                FROM informasi 
                LEFT JOIN transaksi ON informasi.ID_Informasi = transaksi.ID_Informasi 
                ORDER BY total_transaksi DESC 
                LIMIT ?";
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

    public function tampilkanJasaTerlaris($limit = 1)
    {
        $query = "SELECT jasa.*, 
                        COUNT(transaksi.ID_Tranksaksi) AS total_transaksi
                FROM jasa 
                LEFT JOIN transaksi ON jasa.ID_Jasa = transaksi.ID_Jasa 
                ORDER BY total_transaksi DESC 
                LIMIT ?";
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
        $query = "INSERT INTO informasi_tarif_pnbp (ID_PNBP, Nama_PNBP, No_Telepon_PNBP, Email_PNBP, Identitas_KTP_PNBP, Surat_Pengantar_PNBP) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssss",
            $data['ID_PNBP'],
            $data['Nama_PNBP'],
            $data['No_Telepon_PNBP'],
            $data['Email_PNBP'],
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
        $query = "INSERT INTO kegiatan_bencana (ID_Bencana, Nama_Bencana, No_Telepon_Bencana, Email_Bencana, Surat_Pengantar_Permintaan_Data_Bencana) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issss",
            $data['ID_Bencana'],
            $data['Nama_Bencana'],
            $data['No_Telepon_Bencana'],
            $data['Email_Bencana'],
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
        $query = "INSERT INTO kegiatan_keagamaan (ID_Keagamaan, Nama_Keagamaan, No_Telepon_Keagamaan, Email_Keagamaan, Surat_Yang_Ditandatangani_Keagamaan) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issss",
            $data['ID_Keagamaan'],
            $data['Nama_Keagamaan'],
            $data['No_Telepon_Keagamaan'],
            $data['Email_Keagamaan'],
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
        $query = "INSERT INTO kegiatan_pertahanan_keamanan (ID_Pertahanan, Nama_Pertahanan, No_Telepon_Pertahanan, Email_Pertahanan, Surat_Yang_Ditandatangani_Pertahanan) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issss",
            $data['ID_Pertahanan'],
            $data['Nama_Pertahanan'],
            $data['No_Telepon_Pertahanan'],
            $data['Email_Pertahanan'],
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
        $query = "INSERT INTO kegiatan_sosial (ID_Sosial, Nama_Sosial, No_Telepon_Sosial, Email_Sosial, Surat_Yang_Ditandatangani_Sosial) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issss",
            $data['ID_Sosial'],
            $data['Nama_Sosial'],
            $data['No_Telepon_Sosial'],
            $data['Email_Sosial'],
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
        $query = "INSERT INTO pemerintah_pusat_daerah (ID_Pusat, Nama_Pusat_Daerah, No_Telepon_Pusat_Daerah, Email_Pusat_Daerah, Memiliki_Kerja_Sama_Dengan_BMKG, Surat_Pengantar_Pusat_Daerah) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssss",
            $data['ID_Pusat'],
            $data['Nama_Pusat_Daerah'],
            $data['No_Telepon_Pusat_Daerah'],
            $data['Email_Pusat_Daerah'],
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
        $query = "INSERT INTO pendidikan_dan_penelitian (ID_Pendidikan_Penelitian, Nama_Pendidikan_Dan_Penelitian, NIM_KTP, Program_Studi_Fakultas, Universitas_Instansi, No_Telepon_Pendidikan_Penelitian, Email_Pendidikan_Penelitian, Identitas_Diri, Surat_Pengantar_Kepsek_Rektor_Dekan, Pernyataan_Tidak_Digunakan_Kepentingan_Lain, Proposal_Penelitian_Telah_Disetujui) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issssssssss",
            $data['ID_Pendidikan_Penelitian'],
            $data['Nama_Pendidikan_Dan_Penelitian'],
            $data['NIM_KTP'],
            $data['Program_Studi_Fakultas'],
            $data['Universitas_Instansi'],
            $data['No_Telepon_Pendidikan_Penelitian'],
            $data['Email_Pendidikan_Penelitian'],
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

    public function tampilkanDataPengajuan()
    {
        $query = "SELECT * FROM pengajuan";
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

    public function tampilkanDataLihatPengajuan()
    {
        $query = "SELECT transaksi.*, pengajuan.*, pengguna.*, perusahaan.*, informasi.*, jasa.*, kegiatan_bencana.* FROM transaksi LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa LEFT JOIN kegiatan_bencana ON pengajuan.ID_Bencana = kegiatan_bencana.ID_Bencana";
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

    public function ambilIDPengajuanTerakhir()
    {
        $query = "SELECT ID_Pengajuan FROM pengajuan ORDER BY ID_Pengajuan DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Pengajuan'];
        } else {
            return null;
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


    public function ambilIDSosialTerakhir()
    {
        $query = "SELECT ID_Sosial FROM kegiatan_sosial ORDER BY ID_Sosial DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Sosial'];
        } else {
            return null;
        }
    }

    public function ambilIDKeagamaanTerakhir()
    {
        $query = "SELECT ID_Keagamaan FROM kegiatan_keagamaan ORDER BY ID_Keagamaan DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Keagamaan'];
        } else {
            return null;
        }
    }

    public function ambilIDKeamananTerakhir()
    {
        $query = "SELECT ID_Pertahanan FROM kegiatan_pertahanan_keamanan ORDER BY ID_Pertahanan DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Pertahanan'];
        } else {
            return null;
        }
    }

    public function ambilIDPenelitianTerakhir()
    {
        $query = "SELECT ID_Pendidikan_Penelitian FROM pendidikan_dan_penelitian ORDER BY ID_Pendidikan_Penelitian DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Pendidikan_Penelitian'];
        } else {
            return null;
        }
    }

    public function ambilIDPusatTerakhir()
    {
        $query = "SELECT ID_Pusat FROM pemerintah_pusat_daerah ORDER BY ID_Pusat DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Pusat'];
        } else {
            return null;
        }
    }

    public function ambilIDTarfiTerakhir()
    {
        $query = "SELECT ID_PNBP FROM informasi_tarif_pnbp ORDER BY ID_PNBP DESC LIMIT 1";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_PNBP'];
        } else {
            return null;
        }
    }

    public function tambahDataPengajuanBencana($dataPengajuanBencana)
    {
        $query = "INSERT INTO pengajuan (ID_Bencana, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "is",
            $dataPengajuanBencana['ID_Bencana'],
            $dataPengajuanBencana['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPengajuanSosial($dataPengajuanSosial)
    {
        $query = "INSERT INTO pengajuan (ID_Sosial, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "is",
            $dataPengajuanSosial['ID_Sosial'],
            $dataPengajuanSosial['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPengajuanKeagamaan($dataPengajuanKeagamaan)
    {
        $query = "INSERT INTO pengajuan (ID_Keagamaan, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "is",
            $dataPengajuanKeagamaan['ID_Keagamaan'],
            $dataPengajuanKeagamaan['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPengajuanPertahanaan($dataPengajuanPertahanan)
    {
        $query = "INSERT INTO pengajuan (ID_Pertahanan, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "is",
            $dataPengajuanPertahanan['ID_Pertahanan'],
            $dataPengajuanPertahanan['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPengajuanPenelitian($dataPengajuanPenelitian)
    {
        $query = "INSERT INTO pengajuan (ID_Pusat_Daerah, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "is",
            $dataPengajuanPenelitian['ID_Pusat_Daerah'],
            $dataPengajuanPenelitian['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahDataPengajuanPusat($dataPengajuanPusat)
    {
        $query = "INSERT INTO pengajuan (ID_Pusat_Daerah, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "is",
            $dataPengajuanPusat['ID_Pusat_Daerah'],
            $dataPengajuanPusat['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadDocumentSubmition($dataDocumentSubmition)
    {
    }

    public function tambahDataPengajuanTarif($dataPengajuanTarif)
    {
        $query = "INSERT INTO pengajuan (ID_Tarif, Status_Pengajuan, Tanggal_Pengajuan) 
              VALUES (?, ?, NOW())";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "is",
            $dataPengajuanTarif['ID_Tarif'],
            $dataPengajuanTarif['Status_Pengajuan'],
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanSemuaDataPengajuan()
    {
        $query = "SELECT transaksi.*, pengguna.*, perusahaan.*, pengajuan.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
               ";
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

    public function tampilkanSemuaDataPembayaran()
    {
        $query = "SELECT transaksi.*, pengguna.*, perusahaan.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
               ";
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

    public function getDataPengajuanById($id)
    {
        $query = "SELECT * FROM pengajuan WHERE ID_Pengajuan = ?";
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

    public function perbaruiPengajuan($pengajuanID, $statusPengajuan, $apakahGratis, $keteranganSuratDitolak)
    {
        $pengajuanID = mysqli_real_escape_string($this->koneksi, $pengajuanID);
        $statusPengajuan = mysqli_real_escape_string($this->koneksi, $statusPengajuan);
        $apakahGratis = mysqli_real_escape_string($this->koneksi, $apakahGratis);
        $keteranganSuratDitolak = mysqli_real_escape_string($this->koneksi, $keteranganSuratDitolak);

        $query = "UPDATE pengajuan SET Status_Pengajuan = '$statusPengajuan', Apakah_Gratis = '$apakahGratis'";

        if ($statusPengajuan === 'Ditolak') {
            $query .= ", Keterangan_Surat_Ditolak = '$keteranganSuratDitolak'";
        } else {
            $query .= ", Keterangan_Surat_Ditolak = NULL";
        }

        $query .= " WHERE ID_Pengajuan = '$pengajuanID'";

        $result = mysqli_query($this->koneksi, $query);

        return $result;
    }

    public function perbaruiPerbaikanPengajuan($idImprovePengajuan, $PerbaikanDokumen, $Dokumen, $statusPengajuan)
    {
        $idImprovePengajuan = mysqli_real_escape_string($this->koneksi, $idImprovePengajuan);
        $PerbaikanDokumen = mysqli_real_escape_string($this->koneksi, $PerbaikanDokumen);
        $Dokumen = mysqli_real_escape_string($this->koneksi, $Dokumen);

        $query = "UPDATE pengajuan SET Perbaikan_Dokumen = '$Dokumen', Jenis_Perbaikan = '$PerbaikanDokumen', Status_Pengajuan = '$statusPengajuan'";

        $query .= " WHERE ID_Pengajuan = '$idImprovePengajuan'";

        $result = mysqli_query($this->koneksi, $query);

        return $result;
    }

    public function hapusPengajuan($id)
    {
        $querySelect = "SELECT ID_Pengajuan, Surat_Keterangan_Ditolak FROM pengajuan WHERE ID_Pengajuan=?";
        $statementSelect = $this->koneksi->prepare($querySelect);
        $statementSelect->bind_param("i", $id);
        $statementSelect->execute();
        $resultSelect = $statementSelect->get_result();
        $row = $resultSelect->fetch_assoc();
        $idPengajuan = $row['ID_Pengajuan'];
        $namaFileSurat = $row['Surat_Keterangan_Ditolak'];

        if ($idPengajuan != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM pengajuan WHERE ID_Pengajuan=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            if (!empty($namaFileSurat)) {
                $direktoriFileSurat = "../assets/image/uploads/";

                if (file_exists($direktoriFileSurat . $namaFileSurat)) {
                    if (unlink($direktoriFileSurat . $namaFileSurat)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } else {
            return false;
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

    public function uploadFileBuktiPembayaran($idPengguna, $namaFile)
    {
        $query = "UPDATE transaksi SET Bukti_Pembayaran = ?, Tanggal_Upload_Bukti = NOW(), Status_Transaksi = 'Sedang Ditinjau' WHERE ID_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("si", $namaFile, $idPengguna);

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

    public function perbaruiPembayaran($pembayaranID, $keterangan, $status, $statusPesanan)
    {
        $pembayaranID = mysqli_real_escape_string($this->koneksi, $pembayaranID);
        $keterangan = mysqli_real_escape_string($this->koneksi, $keterangan);
        $status = mysqli_real_escape_string($this->koneksi, $status);
        $statusPesanan = mysqli_real_escape_string($this->koneksi, $statusPesanan);

        $query = "UPDATE transaksi SET Keterangan_Pembayaran_Ditolak = '$keterangan', Status_Transaksi = '$status', Status_Pesanan = '$statusPesanan'";
        $query .= " WHERE ID_Tranksaksi = '$pembayaranID'";

        $result = mysqli_query($this->koneksi, $query);

        if (!$result) {
            error_log("Error updating payment: " . mysqli_error($this->koneksi));
            return false;
        }

        return true;
    }


    public function perbaharuiPengajuanBencanaKeTransaksiSesuaiSession($dataTransaksiPengajuanBencana, $idSession)
    {
        $query = "UPDATE transaksi SET ID_Pengajuan = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $dataTransaksiPengajuanBencana['ID_Pengajuan'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaharuiPengajuanSosialKeTransaksiSesuaiSession($dataTransaksiPengajuanSosial, $idSession)
    {
        $query = "UPDATE transaksi SET ID_Pengajuan = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $dataTransaksiPengajuanSosial['ID_Pengajuan'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaharuiPengajuanKeagamaanKeTransaksiSesuaiSession($dataTransaksiPengajuanKeagamaan, $idSession)
    {
        $query = "UPDATE transaksi SET ID_Pengajuan = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $dataTransaksiPengajuanKeagamaan['ID_Pengajuan'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaharuiPengajuanPertahananKeTransaksiSesuaiSession($dataTransaksiPengajuanPertahanan, $idSession)
    {
        $query = "UPDATE transaksi SET ID_Pengajuan = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $dataTransaksiPengajuanPertahanan['ID_Pengajuan'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaharuiPengajuanPendidikanKeTransaksiSesuaiSession($dataTransaksiPengajuanPendidikan, $idSession)
    {
        $query = "UPDATE transaksi SET ID_Pengajuan = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $dataTransaksiPengajuanPendidikan['ID_Pengajuan'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaharuiPengajuanPusatKeTransaksiSesuaiSession($dataTransaksiPengajuanPusat, $idSession)
    {
        $query = "UPDATE transaksi SET ID_Pengajuan = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $dataTransaksiPengajuanPusat['ID_Pengajuan'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaharuiPengajuanTarifKeTransaksiSesuaiSession($dataTransaksiPengajuanTarif, $idSession)
    {
        $query = "UPDATE transaksi SET ID_Pengajuan = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $dataTransaksiPengajuanTarif['ID_Pengajuan'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cekDataDiKeranjangPengguna($idInformasi, $idPengguna)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi WHERE ID_Informasi = ? AND ID_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ii", $idInformasi, $idPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $jumlah = $row['jumlah'];

        if ($jumlah > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekDataDiKeranjangPerusahaan($idInformasi, $idPerusahaan)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi WHERE ID_Informasi = ? AND ID_Perusahaan = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ii", $idInformasi, $idPerusahaan);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $jumlah = $row['jumlah'];

        if ($jumlah > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekJasaDiKeranjangPengguna($idJasa, $idPengguna)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi WHERE ID_Jasa = ? AND ID_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ii", $idJasa, $idPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $jumlah = $row['jumlah'];

        if ($jumlah > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cekJasaDiKeranjangPerusahaan($idJasa, $idPerusahaan)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi WHERE ID_Jasa = ? AND ID_Perusahaan = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ii", $idJasa, $idPerusahaan);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $jumlah = $row['jumlah'];

        if ($jumlah > 0) {
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

    public function cekPengguna($ID)
    {
        $query = "SELECT transaksi.*, pengguna.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  WHERE transaksi.ID_Pengguna = ? AND transaksi.ID_Pengajuan IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $ID);
        $statement->execute();
        $result = $statement->get_result();

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

    public function tampilkanTransaksiPembayaran()
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Diterima' and transaksi.Status_Transaksi = 'Belum Disetujui' OR transaksi.Status_Transaksi = 'Ditolak' OR transaksi.Status_Transaksi = 'Sedang Ditinjau'";
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

    public function tampilkanTransaksi()
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Diterima' and transaksi.Status_Transaksi = 'Belum Disetujui' OR transaksi.Status_Transaksi = 'Ditolak' OR transaksi.Status_Transaksi = 'Sedang Ditinjau'";
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

    public function tampilkanTransaksiTerbaru()
    {
        $query = "SELECT * FROM transaksi
        LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
        LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
        ORDER BY ID_Tranksaksi DESC LIMIT 1";
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

    public function tampilkanPengajuanTransaksi()
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, pengajuan.*, perusahaan.*, jasa.* FROM transaksi 
                LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.Total_Transaksi IS NOT NULL AND transaksi.Jumlah_Barang IS NOT NULL AND pengajuan.Status_Pengajuan ='Sedang Ditinjau' OR pengajuan.Status_Pengajuan ='Ditolak'";
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

    public function tampilkanSemuaPengajuanTransaksi()
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, pengajuan.*, kegiatan_bencana.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN kegiatan_bencana ON pengajuan.ID_Bencana = kegiatan_bencana.ID_Bencana
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Sedang Ditinjau'";
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

    public function tampilkanSemuaDataTransaksi()
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, pengajuan.*, kegiatan_bencana.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN kegiatan_bencana ON pengajuan.ID_Bencana = kegiatan_bencana.ID_Bencana
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

    public function tampilkanPembuatanTransaksi()
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, pengajuan.*, perusahaan.*, jasa.* FROM transaksi 
          LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
          LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
          LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
          LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
          LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
          WHERE (transaksi.Status_Transaksi = 'Disetujui' AND transaksi.ID_IKM IS NULL)
          AND (transaksi.File_Penerimaan IS NULL AND transaksi.Bukti_Pembayaran IS NOT NULL AND transaksi.Status_Transaksi = 'Disetujui')";
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

    public function tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiA($idPembeli)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* 
                  FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE (Total_Transaksi IS NULL AND Jumlah_Barang IS NULL) AND (transaksi.ID_Pengguna = '$idPembeli' OR transaksi.ID_Perusahaan = '$idPembeli') 
                  AND (informasi.Pemilik_Informasi = 'Instansi A' OR jasa.Pemilik_Jasa = 'Instansi A')";

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

    public function tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceA($idPembeli)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* 
                  FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE (transaksi.ID_Pengguna = '$idPembeli' OR transaksi.ID_Perusahaan = '$idPembeli') 
                  AND (informasi.Pemilik_Informasi = 'Instansi A' OR jasa.Pemilik_Jasa = 'Instansi A')";

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

    public function tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiB($idPembeli)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* 
                  FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE (Total_Transaksi IS NULL AND Jumlah_Barang IS NULL) AND (transaksi.ID_Pengguna = '$idPembeli' OR transaksi.ID_Perusahaan = '$idPembeli') 
                  AND (informasi.Pemilik_Informasi = 'Instansi B' OR jasa.Pemilik_Jasa = 'Instansi B')";

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

    public function tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceB($idPembeli)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* 
                  FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE  (transaksi.ID_Pengguna = '$idPembeli' OR transaksi.ID_Perusahaan = '$idPembeli') 
                  AND (informasi.Pemilik_Informasi = 'Instansi B' OR jasa.Pemilik_Jasa = 'Instansi B')";

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

    public function tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiC($idPembeli)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* 
                  FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE (Total_Transaksi IS NULL AND Jumlah_Barang IS NULL) AND (transaksi.ID_Pengguna = '$idPembeli' OR transaksi.ID_Perusahaan = '$idPembeli') 
                  AND (informasi.Pemilik_Informasi = 'Instansi C' OR jasa.Pemilik_Jasa = 'Instansi C')";

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

    public function tampilkanTransaksiPembeliSesuaiPemilikProdukInstansiInovoiceC($idPembeli)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* 
                  FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE (transaksi.ID_Pengguna = '$idPembeli' OR transaksi.ID_Perusahaan = '$idPembeli') 
                  AND (informasi.Pemilik_Informasi = 'Instansi C' OR jasa.Pemilik_Jasa = 'Instansi C')";

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

    public function tampilkanTransaksiSesuaiCheckoutPembeli($idPembeli)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
        LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
        LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
        LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
        LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.ID_Tranksaksi = $idPembeli OR transaksi.ID_Jasa = $idPembeli";
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
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.Status_Transaksi = 'Disetujui' AND  transaksi.ID_IKM IS NOT NULL AND transaksi.File_Penerimaan IS NOT NULL";
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

    public function tampilkanRiwayatTransaksiSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.Status_Transaksi = 'Disetujui' AND transaksi.File_Penerimaan IS NOT NULL AND transaksi.ID_IKM IS NOT NULL AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
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

    public function hitungRiwayatTransaksiSesuaiSession($id)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi 
              LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
              LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
              LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
              LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
              WHERE transaksi.Status_Transaksi = 'Disetujui' AND transaksi.File_Penerimaan IS NOT NULL  AND transaksi.ID_IKM IS NOT NULL AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['jumlah'];
        } else {
            return 0;
        }
    }

    public function tampilkanPengajuanTransaksiSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE transaksi.Total_Transaksi IS NOT NULL AND transaksi.Jumlah_Barang IS NOT NULL AND transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id";
        $result = $this->koneksi->query($query);

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

    public function tampilkanPerbaikanDokumenPengajuanTransaksiSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Ditolak' AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

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

    public function tampilkanPembayaranTransaksiSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Diterima' AND transaksi.Status_Transaksi = 'Belum Disetujui' OR transaksi.Status_Transaksi = 'Sedang Ditinjau' OR transaksi.Status_Transaksi = 'Ditolak' AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

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

    public function getDataTransaksiById($id)
    {
        $query = "SELECT * FROM transaksi WHERE ID_Tranksaksi = ?";
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

    public function tampilkanDataTransaksi()
    {
        $query = "SELECT * FROM transaksi";
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

    public function perbaruiTransaksi($transaksiID, $statusTransaksi, $keteranganPembayaranDitolak)
    {
        $transaksiID = mysqli_real_escape_string($this->koneksi, $transaksiID);
        $statusTransaksi = mysqli_real_escape_string($this->koneksi, $statusTransaksi);
        $keteranganPembayaranDitolak = mysqli_real_escape_string($this->koneksi, $keteranganPembayaranDitolak);
        $query = "UPDATE transaksi SET Status_Transaksi = '$statusTransaksi'";

        if ($statusTransaksi === 'Ditolak') {
            $query .= ", Keterangan_Pembayaran_Ditolak = '$keteranganPembayaranDitolak'";
        } else {
            $query .= ", Keterangan_Pembayaran_Ditolak = NULL";
        }

        $query .= " WHERE ID_Tranksaksi = '$transaksiID'";

        $result = mysqli_query($this->koneksi, $query);

        return $result;
    }



    public function tampilkanPembayaranTransaksiASesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Diterima' AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id) AND (informasi.Pemilik_Informasi = 'Instansi A' OR jasa.Pemilik_Jasa = 'Instansi A')";
        $result = $this->koneksi->query($query);

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

    public function tampilkanPembayaranTransaksiBSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Diterima' AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id) AND (informasi.Pemilik_Informasi = 'Instansi B' OR jasa.Pemilik_Jasa = 'Instansi B')";
        $result = $this->koneksi->query($query);

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

    public function tampilkanPembayaranTransaksiCSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, pengajuan.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Diterima' AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id) AND (informasi.Pemilik_Informasi = 'Instansi C' OR jasa.Pemilik_Jasa = 'Instansi C')";
        $result = $this->koneksi->query($query);

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

    public function tampilkanPembuatanTransaksiSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE transaksi.Bukti_Pembayaran IS NOT NULL AND transaksi.Status_Transaksi = 'Disetujui' AND transaksi.File_Penerimaan IS NULL AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

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


    public function tampilkanPembuatanTanggalTransaksi($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id";
        $result = $this->koneksi->query($query);

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

    public function tampilkanSelesaiTransaksiSesuaiSession($id)
    {
        $query = "SELECT transaksi.*, pengguna.*, informasi.*, perusahaan.*, jasa.* FROM transaksi 
                  LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE transaksi.Status_Transaksi = 'Disetujui' AND transaksi.ID_IKM IS NULL AND transaksi.File_Penerimaan IS NOT NULL AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

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

    public function hitungPengajuanTransaksiSesuaiSession($id)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi 
              LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
              LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
              LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
              LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
              LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Sedang Ditinjau' OR pengajuan.Status_Pengajuan = 'Ditolak' AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['jumlah'];
        } else {
            return 0;
        }
    }

    public function hitungPembayaranTransaksiSesuaiSession($id)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi 
              LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
              LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
              LEFT JOIN pengajuan ON transaksi.ID_Pengajuan = pengajuan.ID_Pengajuan
              LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
              LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE pengajuan.Status_Pengajuan = 'Diterima' AND transaksi.Status_Transaksi = 'Belum Disetujui' OR transaksi.Status_Transaksi = 'Sedang Ditinjau' OR transaksi.Status_Transaksi = 'Ditolak' AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['jumlah'];
        } else {
            return 0;
        }
    }

    public function hitungPembuatanTransaksiSesuaiSession($id)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi 
              LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
              LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
              LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
              LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
              WHERE transaksi.Bukti_Pembayaran IS NOT NULL AND transaksi.Status_Transaksi = 'Disetujui' AND transaksi.File_Penerimaan IS NULL AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['jumlah'];
        } else {
            return 0;
        }
    }

    public function hitungSelesaiTransaksiSesuaiSession($id)
    {
        $query = "SELECT COUNT(*) as jumlah FROM transaksi 
              LEFT JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
              LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
              LEFT JOIN perusahaan ON transaksi.ID_Perusahaan = perusahaan.ID_Perusahaan
              LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
              WHERE transaksi.Status_Transaksi = 'Disetujui' AND transaksi.File_Penerimaan IS NOT NULL  AND transaksi.ID_IKM IS NULL AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";
        $result = $this->koneksi->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['jumlah'];
        } else {
            return 0;
        }
    }

    public function tampilkanTransaksiInformasi($id)
    {
        $query = "SELECT transaksi.*, informasi.* FROM transaksi 
                  INNER JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  WHERE (Total_Transaksi IS NULL AND Jumlah_Barang IS NULL) AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";

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
                  INNER JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa WHERE (Total_Transaksi IS NULL AND Jumlah_Barang IS NULL) AND (transaksi.ID_Pengguna = $id OR transaksi.ID_Perusahaan = $id)";

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

    public function updateTransaksi($id, $file)
    {
        $query = "UPDATE transaksi SET File_Penerimaan=?, Tanggal_Upload_File_Penerimaan = NOW() WHERE ID_Tranksaksi=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("si", $file, $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTransaksiDetail($transaksiID, $jumlahBarang, $totalHarga)
    {
        $query = "UPDATE transaksi SET Jumlah_Barang=?, Total_Transaksi=?, Status_Pesanan='Sedang Ditinjau' WHERE ID_Tranksaksi=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("iii", $jumlahBarang, $totalHarga, $transaksiID);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getHargaPerBarang($transaksiID)
    {
        $query = "SELECT COALESCE(informasi.Harga_Informasi, jasa.Harga_Jasa) AS Harga
                  FROM transaksi 
                  LEFT JOIN informasi ON transaksi.ID_Informasi = informasi.ID_Informasi
                  LEFT JOIN jasa ON transaksi.ID_Jasa = jasa.ID_Jasa 
                  WHERE transaksi.ID_Tranksaksi = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $transaksiID);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Harga'];
        } else {
            return 0;
        }
    }

    public function getPengajuanID($transaksiID)
    {
        $query = "SELECT ID_Pengajuan FROM transaksi WHERE ID_Pengajuan  IS NOT NULL AND ID_Tranksaksi = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $transaksiID);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['ID_Pengajuan'];
        } else {
            return null;
        }
    }

    public function hapusTransaksi($id)
    {
        $querySelect = "SELECT ID_Tranksaksi, File_Penerimaan FROM transaksi WHERE ID_Tranksaksi=?";
        $statementSelect = $this->koneksi->prepare($querySelect);
        $statementSelect->bind_param("i", $id);
        $statementSelect->execute();
        $resultSelect = $statementSelect->get_result();
        $row = $resultSelect->fetch_assoc();
        $idTransaksi = $row['ID_Tranksaksi'];
        $namaFilePenerimaan = $row['File_Penerimaan'];

        if ($idTransaksi != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM transaksi WHERE ID_Tranksaksi=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            if (!empty($namaFilePenerimaan)) {
                $direktoriFilePenerimaan = "../assets/image/uploads/";

                if (file_exists($direktoriFilePenerimaan . $namaFilePenerimaan)) {
                    if (unlink($direktoriFilePenerimaan . $namaFilePenerimaan)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function hapusRiwayatTransaksi($id)
    {
        $querySelect = "SELECT ID_Tranksaksi, File_Penerimaan FROM transaksi WHERE ID_Tranksaksi=?";
        $statementSelect = $this->koneksi->prepare($querySelect);
        $statementSelect->bind_param("i", $id);
        $statementSelect->execute();
        $resultSelect = $statementSelect->get_result();
        $row = $resultSelect->fetch_assoc();
        $idTransaksi = $row['ID_Tranksaksi'];
        $namaFilePenerimaan = $row['File_Penerimaan'];

        if ($idTransaksi != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM transaksi WHERE ID_Tranksaksi=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            if (!empty($namaFilePenerimaan)) {
                $direktoriFilePenerimaan = "../assets/image/uploads/";

                if (file_exists($direktoriFilePenerimaan . $namaFilePenerimaan)) {
                    if (unlink($direktoriFilePenerimaan . $namaFilePenerimaan)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function updateIKMNULLSesuaiTransaksi($IDIKM, $idSession)
    {

        $query = "UPDATE transaksi SET ID_IKM = ? WHERE (ID_Pengguna = ? OR ID_Perusahaan = ?) AND ID_IKM IS NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $IDIKM['ID_IKM'],
            $idSession,
            $idSession
        );
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================TRANSAKSI===================================

// ===================================IKM=====================================
class Ikm
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function tambahDataIkm($data)
    {
        $query = "INSERT INTO ikm (Nama, Jenis_Kelamin, Pendidikan_Terakhir, NIK, Umur, Pekerjaan, Koresponden, Jenis_Layanan, Asal_Daerah,
        Informasi_Cuaca_Publik, Informasi_Cuaca_Khusus, Analisis_Cuaca, Informasi_Titik_Panas,
        Informasi_Tentang_Tingkat, Prakiraan_Musim, Informasi_Iklim_Khusus, Analisis_Prakiraan, 
        Tren_Curah_Hujan, Informasi_Kualitas_Udara, Analisis_Iklim_Ekstrim, Informasi_Iklim_Terapan,
        Informasi_Perubahan_Iklim, Pengambilan_Pengujian, Informasi_Gempabumi, Peta_Seismisitas,
        Informasi_Tanda_Waktu, Informasi_Geofisika_Potensial, Peta_Rendaman_Tsunami,
        Informasi_Seismologi_Teknik, Data_MKG, Kalibrasi, Konsultasi, Sewa_Peralatan_MKG, Kunjungan,
        Kualitas_Pelayanan_Terbuka, Harapan_Konsumen_Terbuka, Kualitas_Pelayanan_Kehidupan, Harapan_Konsumen_Kehidupan, 
        Kualitas_Pelayanan_Dipahami, Harapan_Konsumen_Dipahami, Kualitas_Pelayanan_Persyaratan, Harapan_Konsumen_Persyaratan, 
        Kualitas_Pelayanan_Diakses, Harapan_Konsumen_Diakses, Kualitas_Pelayanan_Akurat, Harapan_Konsumen_Akurat,
        Kualitas_Pelayanan_Data, Harapan_Konsumen_Data, Kualitas_Pelayanan_Sederhana,
        Kualitas_Pelayanan_Waktu, Harapan_Konsumen_Waktu, Kualitas_Pelayanan_Biaya_Terbuka, Harapan_Konsumen_Biaya_Terbuka,
        Kualitas_Pelayanan_KKN, Kualitas_Pelayanan_Sesuai, Harapan_Konsumen_Sesuai,
        Kualitas_Pelayanan_Daftar, Harapan_Konsumen_Daftar, Kualitas_Pelayanan_Sarana, Harapan_Konsumen_Sarana,
        Kualitas_Pelayanan_Prosedur, Harapan_Konsumen_Prosedur, Kualitas_Pelayanan_Petugas, Harapan_Konsumen_Petugas,
        Kualitas_Pelayanan_Aman, Harapan_Konsumen_Aman, Kualitas_Pelayanan_Keberadaan, Harapan_Konsumen_Keberadaan,
        Kualitas_Pelayanan_Sikap, Harapan_Konsumen_Sikap, Kualitas_Pelayanan_Publik, Harapan_Konsumen_Publik)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sssissssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss",
            $data['Nama'],
            $data['Jenis_Kelamin'],
            $data['Pendidikan_Terakhir'],
            $data['NIK'],
            $data['Umur'],
            $data['Pekerjaan'],
            $data['Koresponden'],
            $data['Jenis_Layanan'],
            $data['Asal_Daerah'],
            $data['Informasi_Cuaca_Publik'],
            $data['Informasi_Cuaca_Khusus'],
            $data['Analisis_Cuaca'],
            $data['Informasi_Titik_Panas'],
            $data['Informasi_Tentang_Tingkat'],
            $data['Prakiraan_Musim'],
            $data['Informasi_Iklim_Khusus'],
            $data['Analisis_Prakiraan'],
            $data['Tren_Curah_Hujan'],
            $data['Informasi_Kualitas_Udara'],
            $data['Analisis_Iklim_Ekstrim'],
            $data['Informasi_Iklim_Terapan'],
            $data['Informasi_Perubahan_Iklim'],
            $data['Pengambilan_Pengujian'],
            $data['Informasi_Gempabumi'],
            $data['Peta_Seismisitas'],
            $data['Informasi_Tanda_Waktu'],
            $data['Informasi_Geofisika_Potensial'],
            $data['Peta_Rendaman_Tsunami'],
            $data['Informasi_Seismologi_Teknik'],
            $data['Data_MKG'],
            $data['Kalibrasi'],
            $data['Konsultasi'],
            $data['Sewa_Peralatan_MKG'],
            $data['Kunjungan'],
            $data['Kualitas_Pelayanan_Terbuka'],
            $data['Harapan_Konsumen_Terbuka'],
            $data['Kualitas_Pelayanan_Kehidupan'],
            $data['Harapan_Konsumen_Kehidupan'],
            $data['Kualitas_Pelayanan_Dipahami'],
            $data['Harapan_Konsumen_Dipahami'],
            $data['Kualitas_Pelayanan_Persyaratan'],
            $data['Harapan_Konsumen_Persyaratan'],
            $data['Kualitas_Pelayanan_Diakses'],
            $data['Harapan_Konsumen_Diakses'],
            $data['Kualitas_Pelayanan_Akurat'],
            $data['Harapan_Konsumen_Akurat'],
            $data['Kualitas_Pelayanan_Data'],
            $data['Harapan_Konsumen_Data'],
            $data['Kualitas_Pelayanan_Sederhana'],
            $data['Kualitas_Pelayanan_Waktu'],
            $data['Harapan_Konsumen_Waktu'],
            $data['Kualitas_Pelayanan_Biaya_Terbuka'],
            $data['Harapan_Konsumen_Biaya_Terbuka'],
            $data['Kualitas_Pelayanan_KKN'],
            $data['Kualitas_Pelayanan_Sesuai'],
            $data['Harapan_Konsumen_Sesuai'],
            $data['Kualitas_Pelayanan_Daftar'],
            $data['Harapan_Konsumen_Daftar'],
            $data['Kualitas_Pelayanan_Sarana'],
            $data['Harapan_Konsumen_Sarana'],
            $data['Kualitas_Pelayanan_Prosedur'],
            $data['Harapan_Konsumen_Prosedur'],
            $data['Kualitas_Pelayanan_Petugas'],
            $data['Harapan_Konsumen_Petugas'],
            $data['Kualitas_Pelayanan_Aman'],
            $data['Harapan_Konsumen_Aman'],
            $data['Kualitas_Pelayanan_Keberadaan'],
            $data['Harapan_Konsumen_Keberadaan'],
            $data['Kualitas_Pelayanan_Sikap'],
            $data['Harapan_Konsumen_Sikap'],
            $data['Kualitas_Pelayanan_Publik'],
            $data['Harapan_Konsumen_Publik']
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanRiwayatIKMSesuaiPenggunaYangLogin($id)
    {
        $query = "SELECT transaksi.*, ikm.* FROM transaksi 
        LEFT JOIN ikm ON transaksi.ID_IKM = ikm.ID_Ikm 
        WHERE (transaksi.ID_Pengguna = ? OR transaksi.ID_Perusahaan = ?) 
        AND transaksi.ID_IKM IS NOT NULL";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ii", $id, $id);
        $statement->execute();
        $result = $statement->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanRiwayatIKM()
    {
        $query = "SELECT * FROM ikm";

        $statement = $this->koneksi->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        if ($result && $result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanIkmTerbaru()
    {
        $query = "SELECT * FROM ikm ORDER BY ID_Ikm DESC LIMIT 1";
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

    public function ambilIDIKMTerakhir()
    {
        $query = "SELECT ID_Ikm FROM ikm ORDER BY ID_Ikm DESC LIMIT 1";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['ID_Ikm'];
        } else {
            return null;
        }
    }
}

// ===================================IKM=====================================
