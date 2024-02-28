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

    public function tambahAdmin($data)
    {
        $query = "INSERT INTO admin (Foto, Nama_Depan_Admin, Nama_Belakang_Admin, Nama_Pengguna_Admin, Email_Admin, Kata_Sandi, Konfirmasi_Kata_Sandi, No_Telepon_Admin, Jenis_Kelamin_Admin, Peran_Admin, Alamat_Admin, Status_Verifikasi_Admin, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssssssssissi", $data['Foto'], $data['Nama_Depan_Admin'], $data['Nama_Belakang_Admin'], $data['Nama_Pengguna_Admin'], $data['Email_Admin'], $data['Kata_Sandi'], $data['Konfirmasi_Kata_Sandi'], $data['No_Telepon_Admin'], $data['Jenis_Kelamin_Admin'], $data['Peran_Admin'], $data['Alamat_Admin'], $data['Status_Verifikasi_Admin'], $data['token']);

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
        $query = "UPDATE admin SET Foto=?, Nama_Depan_Admin=?, Nama_Belakang_Admin=?, Nama_Pengguna_Admin=?, Email_Admin=?, No_Telepon_Admin=?, Jenis_Kelamin_Admin=?, Peran_Admin=?, Alamat_Admin=? WHERE ID_Admin=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssssssisi", $data['Foto'], $data['Nama_Depan_Admin'], $data['Nama_Belakang_Admin'], $data['Nama_Pengguna_Admin'], $data['Email_Admin'], $data['No_Telepon_Admin'], $data['Jenis_Kelamin_Admin'], $data['Peran_Admin'], $data['Alamat_Admin'], $id);

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

    public function tambahPengguna($data)
    {
        $query = "INSERT INTO pengguna (Foto, Nama_Depan_Pengguna, Nama_Belakang_Pengguna, Nama_Pengguna, Email_Pengguna, Kata_Sandi, Konfirmasi_Kata_Sandi, No_Telepon_Pengguna, Jenis_Kelamin_Pengguna, Alamat_Pengguna, Status_Verifikasi_Pengguna, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ssssssssssii", $data['Foto'], $data['Nama_Depan_Pengguna'], $data['Nama_Belakang_Pengguna'], $data['Nama_Pengguna'], $data['Email_Pengguna'], $data['Kata_Sandi'], $data['Konfirmasi_Kata_Sandi'], $data['No_Telepon_Pengguna'], $data['Jenis_Kelamin_Pengguna'], $data['Alamat_Pengguna'], $data['Status_Verifikasi_Pengguna'], $data['token']);

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
        $query = "UPDATE pengguna SET Foto=?, Nama_Depan_Pengguna=?, Nama_Belakang_Pengguna=?, Nama_Pengguna=?, Email_Pengguna=?, No_Telepon_Pengguna=?, Jenis_Kelamin_Pengguna=?, Alamat_Pengguna=? WHERE ID_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("ssssssssi", $data['Foto'], $data['Nama_Depan_Pengguna'], $data['Nama_Belakang_Pengguna'], $data['Nama_Pengguna'], $data['Email_Pengguna'], $data['No_Telepon_Pengguna'], $data['Jenis_Kelamin_Pengguna'], $data['Alamat_Pengguna'], $id);


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
}
// ===================================PENGGUNA===================================


// ===================================PRODUK===================================

class Produk
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function tambahProduk($data)
    {
        $query = "INSERT INTO produk (Foto_Produk, Nama_Produk, Deskripsi_Produk, Harga_Produk, Pemilik_Produk, No_Rekening, Status_Produk) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisii", $data['Foto_Produk'], $data['Nama_Produk'], $data['Deskripsi_Produk'], $data['Harga_Produk'], $data['Pemilik_Produk'], $data['No_Rekening'], $data['Status_Produk']);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataProduk()
    {
        $query = "SELECT * FROM produk";
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

    public function tampilkanDataProdukTerbaru($limit = 3)
    {
        $query = "SELECT * FROM produk ORDER BY ID_Produk DESC LIMIT ?";
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
            return null;
        }
    }

    public function perbaruiProduk($id, $data)
    {
        $query = "UPDATE produk SET Foto_Produk=?, Nama_Produk=?, Deskripsi_Produk=?, Harga_Produk=?, Pemilik_Produk=?, No_Rekening=?, Status_Produk=? WHERE ID_Produk=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisiii", $data['Foto_Produk'], $data['Nama_Produk'], $data['Deskripsi_Produk'], $data['Harga_Produk'], $data['Pemilik_Produk'], $data['No_Rekening'], $data['Status_Produk'], $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusProduk($id)
    {
        $query = "SELECT ID_Produk, Foto_Produk FROM produk WHERE ID_Produk=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['ID_Produk'];
        $namaFoto = $row['Foto_Produk'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM produk WHERE ID_Produk=?";
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

    public function getDataProdukById($id)
    {
        $query = "SELECT * FROM produk WHERE ID_Produk = ?";
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

    public function getFotoProdukById($idProduk)
    {
        $query = "SELECT Foto_Produk FROM produk WHERE ID_Produk = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idProduk);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto_Produk'];
        } else {
            return null;
        }
    }
}

// ===================================PRODUK===================================
