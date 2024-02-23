<?php
include 'connection.php';

class Admin
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function tambahAdmin($data)
    {
        $query = "INSERT INTO admin (Foto, Nama_Depan_Admin, Nama_Belakang_Admin, Nama_Pengguna_Admin, Email_Admin, No_Telepon_Admin, Jenis_Kelamin_Admin, Peran_Admin, Alamat_Admin, Status_Verifikasi_Admin, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssssssissi", $data['Foto'], $data['Nama_Depan_Admin'], $data['Nama_Belakang_Admin'], $data['Nama_Pengguna_Admin'], $data['Email_Admin'], $data['No_Telepon_Admin'], $data['Jenis_Kelamin_Admin'], $data['Peran_Admin'], $data['Alamat_Admin'], $data['Status_Verifikasi_Admin'], $data['token']);

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

    public function perbaruiAdmin($id, $data)
    {
        $query = "UPDATE admin SET Foto=?, Nama_Depan_Admin=?, Nama_Belakang_Admin=?, Nama_Penggguna_Admin=?, Email_Admin=?, No_Telepon_Admin=?, Jenis_Kelamin_Admin=?, Peran_Admin=?, Alamat_Admin=?, Status_Verivikasi_Admin=?, token=? WHERE ID_Admin=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssssisissii", $data['Foto'], $data['Nama_Depan_Admin'], $data['Nama_Belakang_Admin'], $data['Nama_Penggguna_Admin'], $data['Email_Admin'], $data['No_Telepon_Admin'], $data['Jenis_Kelamin_Admin'], $data['Peran_Admin'], $data['Alamat_Admin'], $data['Status_Verivikasi_Admin'], $data['token'], $id);

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
            $lokasiFoto =  $namaFoto;

            if (file_exists($lokasiFoto)) {
                if (unlink($lokasiFoto)) {
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
}

class Pengguna
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function tambahPengguna($data)
    {
        $query = "INSERT INTO pengguna (Foto, Nama_Depan_Pengguna, Nama_Belakang_Pengguna, Nama_Pengguna_Pengguna, Email_Pengguna, No_Telepon_Pengguna, Jenis_Kelamin_Pengguna, Alamat_Pengguna, Status_Verifikasi_Pengguna, token, Peran_Admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssssisiss", $data['Foto'], $data['Nama_Depan_Pengguna'], $data['Nama_Belakang_Pengguna'], $data['Nama_Pengguna_Pengguna'], $data['Email_Pengguna'], $data['No_Telepon_Pengguna'], $data['Jenis_Kelamin_Pengguna'], $data['Alamat_Pengguna'], $data['Status_Verifikasi_Pengguna'], $data['token']);

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

    public function perbaruiPengguna($id, $data)
    {
        $query = "UPDATE pengguna SET Foto=?, Nama_Depan_Pengguna=?, Nama_Belakang_Pengguna=?, Nama_Penggguna_Pengguna=?, Email_Pengguna=?, No_Telepon_Pengguna=?, Jenis_Kelamin_Pengguna=?, Alamat_Pengguna=?, Status_Verivikasi_Pengguna=?, token=? WHERE ID_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssssisissi", $data['Foto'], $data['Nama_Depan_Pengguna'], $data['Nama_Belakang_Pengguna'], $data['Nama_Penggguna_Pengguna'], $data['Email_Pengguna'], $data['No_Telepon_Pengguna'], $data['Jenis_Kelamin_Pengguna'], $data['Alamat_Pengguna'], $data['Status_Verivikasi_Pengguna'], $data['token'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
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
            $lokasiFoto = $namaFoto;

            if (file_exists($lokasiFoto)) {
                if (unlink($lokasiFoto)) {
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
}
