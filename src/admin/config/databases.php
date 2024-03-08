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
    $query = "INSERT INTO admin (Foto, Nama_Depan_Admin, Nama_Belakang_Admin, Nama_Pengguna_Admin, Email_Admin, Kata_Sandi, Konfirmasi_Kata_Sandi, No_Telepon_Admin, Jenis_Kelamin_Admin, Peran_Admin, Alamat_Admin, Status_Verifikasi_Admin, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $statement = $this->koneksi->prepare($query);
    $statement->bind_param("sssssssssissi", 
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
        $this->escapeString($data['token'])
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
        $query = "INSERT INTO pengguna (Foto, Nama_Depan_Pengguna, Nama_Belakang_Pengguna, Nama_Pengguna, Email_Pengguna, Kata_Sandi, Konfirmasi_Kata_Sandi, No_Telepon_Pengguna, Jenis_Kelamin_Pengguna, Alamat_Pengguna, Status_Verifikasi_Pengguna, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "ssssssssssii",
            $this->escapeString($data['Foto']),
            $this->escapeString($data['Nama_Depan_Pengguna']),
            $this->escapeString($data['Nama_Belakang_Pengguna']),
            $this->escapeString($data['Nama_Pengguna']),
            $this->escapeString($data['Email_Pengguna']),
            $this->escapeString($data['Kata_Sandi']),
            $this->escapeString($data['Konfirmasi_Kata_Sandi']),
            $this->escapeString($data['No_Telepon_Pengguna']),
            $this->escapeString($data['Jenis_Kelamin_Pengguna']),
            $this->escapeString($data['Alamat_Pengguna']),
            $this->escapeString($data['Status_Verifikasi_Pengguna']),
            $this->escapeString($data['token'])
        );

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
        $statement->bind_param(
            "ssssssssi",
            $this->escapeString($data['Foto']),
            $this->escapeString($data['Nama_Depan_Pengguna']),
            $this->escapeString($data['Nama_Belakang_Pengguna']),
            $this->escapeString($data['Nama_Pengguna']),
            $this->escapeString($data['Email_Pengguna']),
            $this->escapeString($data['No_Telepon_Pengguna']),
            $this->escapeString($data['Jenis_Kelamin_Pengguna']),
            $this->escapeString($data['Alamat_Pengguna']),
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
        $query = "INSERT INTO informasi (Foto_Informasi, Nama_Informasi, Deskripsi_Informasi, Harga_Informasi, Pemilik_Informasi, No_Rekening_Informasi, Status_Informasi) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisis", $data['Foto_Informasi'], $data['Nama_Informasi'], $data['Deskripsi_Informasi'], $data['Harga_Informasi'], $data['Pemilik_Informasi'], $data['No_Rekening_Informasi'], $data['Status_Informasi']);

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
            return null;
        }
    }

    public function perbaruiInformasi($id, $data)
    {
        $query = "UPDATE informasi SET Foto_Informasi=?, Nama_Informasi=?, Deskripsi_Informasi=?, Harga_Informasi=?, Pemilik_Informasi=?, No_Rekening_Informasi=?, Status_Informasi=? WHERE ID_Informasi=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisisi", $data['Foto_Informasi'], $data['Nama_Informasi'], $data['Deskripsi_Informasi'], $data['Harga_Informasi'], $data['Pemilik_Informasi'], $data['No_Rekening_Informasi'], $data['Status_Informasi'], $id);

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

    public function cariDataLiveInformasi($kataKunci)
{
    $query = "SELECT * FROM informasi WHERE Nama_Informasi LIKE '%$kataKunci%'";

    $hasil = $this->koneksi->query($query);

    if ($hasil && $hasil->num_rows > 0) {
        $output = "<div class='d-flex justify-content-between mx-5 mb-3'>
            <!-- Tambahkan tombol atau elemen lainnya jika diperlukan -->
            <div class='input-group w-auto' style='margin-top: 5px;'>
                <input type='text' id='informationSearchInput' class='form-control border-0 shadow-none bg-body rounded-start' placeholder='Silahkan Cari...' aria-label='Silahkan Cari...' style='height: 30px;' oninput='cariDataLiveInformasi()'>
            </div>
        </div>
        <table class='table table-hover'>
            <thead>
                <tr class='text-center'>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Informasi</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Pemilik</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class='table-border-bottom-0 text-center'>";

        $nomorUrut = 1;
        while ($baris = $hasil->fetch_assoc()) {
            // Sesuaikan kolom dengan data informasi yang ingin ditampilkan
            $output .= "<tr>
                <td>{$nomorUrut}</td>
                <td class='d-flex justify-content-center align-items-center'>
                    <ul class='list-unstyled users-list m-0 avatar-group'>
                        <li data-bs-toggle='tooltip' data-popup='tooltip-custom' data-bs-placement='top' class='avatar avatar-md pull-up' title='{$baris['Nama_Informasi']}'>
                            <img src='{$baris['Foto_Informasi']}' alt='Avatar' class='rounded-circle img-responsive' style='height: 50px; width: 50px; margin-left: -2px;' />
                        </li>
                    </ul>
                </td>
                <td>{$baris['Nama_Informasi']}</td>
                <td>{$baris['Deskripsi_Informasi']}</td>
                <td>Rp " . number_format($baris['Harga_Informasi'], 0, ',', '.') . "</td>
                <td>{$baris['Pemilik_Informasi']}</td>
                <td>{$baris['Kategori_Informasi']}</td>
                <td>{$baris['Status_Informasi']}</td>
                <td>
                    <div class='dropdown'>
                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                            <i class='mdi mdi-dots-vertical'></i>
                        </button>
                        <div class='dropdown-menu'>
                            <a class='dropdown-item' href='javascript:void(0);' data-id='{$baris['ID_Informasi']}' data-bs-toggle='modal' data-bs-target='#modalSuntingInformasi'>
                                <i class='mdi mdi-pencil-outline me-1'></i> Sunting
                            </a>
                            <a class='dropdown-item' href='javascript:void(0);' onclick='confirmDeleteInformasi({$baris['ID_Informasi']});'>
                                <i class='mdi mdi-trash-can-outline me-1'></i> Hapus
                            </a>
                        </div>
                    </div>
                </td>
            </tr>";
            $nomorUrut++;
        }
        $output .= "</tbody></table>";
    } else {
        $output = "<div class='d-flex justify-content-between mx-5 mb-3'>
            <!-- Tambahkan tombol atau elemen lainnya jika diperlukan -->
            <div class='input-group w-auto' style='margin-top: 5px;'>
                <input type='text' id='informationSearchInput' class='form-control border-0 shadow-none bg-body rounded-start' placeholder='Silahkan Cari...' aria-label='Silahkan Cari...' style='height: 30px;' oninput='cariDataLiveInformasi()'>
            </div>
        </div>
        <table class='table table-hover'>
            <thead>
                <tr class='text-center'>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Informasi</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Pemilik</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class='table-border-bottom-0 text-center'>";
        $output .= "<tr>
            <td colspan='9' class='text-center text-danger fw-bold'>Tidak ada hasil yang ditemukan</td>
            </tr> ";
    }
    echo $output;
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
        $query = "INSERT INTO jasa (Foto_Jasa, Nama_Jasa, Deskripsi_Jasa, Harga_Jasa, Pemilik_Jasa, No_Rekening_Jasa, Status_Jasa) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisis", $data['Foto_Jasa'], $data['Nama_Jasa'], $data['Deskripsi_Jasa'], $data['Harga_Jasa'], $data['Pemilik_Jasa'], $data['No_Rekening_Jasa'], $data['Status_Jasa']);

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
            return null;
        }
    }

    public function perbaruiJasa($id, $data)
    {
        $query = "UPDATE jasa SET Foto_Jasa=?, Nama_Jasa=?, Deskripsi_Jasa=?, Harga_Jasa=?, Pemilik_Jasa=?, No_Rekening_Jasa=?, Status_Jasa=? WHERE ID_Jasa=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("sssisisi", $data['Foto_Jasa'], $data['Nama_Jasa'], $data['Deskripsi_Jasa'], $data['Harga_Jasa'], $data['Pemilik_Jasa'], $data['No_Rekening_Jasa'], $data['Status_Jasa'], $id);

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
}

// ===================================JASA===================================