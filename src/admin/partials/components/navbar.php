<nav class="navbar navbar-expand-lg color px-3 fixed-top">
    <div class="overlay z-2"></div>
    <div class="container-fluid">
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <img class="logo" src="<?php echo $akarUrl; ?>src/admin/assets/image/logo/1.png" alt="logo">
                <p class="fw-bolder fs-5 ms-1 ptsp">PTSP</p>
            </div>
            <form id="formSearchForDrive" class="z-3">
                <div class="dropdown">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                    <i class="fas fa-times position-absolute top-50 end-0 translate-middle-y me-3 close-icon" style="display: none;"></i>
                    <input class="form-control ps-5 search" placeholder="Cari Informasi Dan Jasa Anda" aria-label="Search" id="searchInput" autocomplete="off" oninput="cariDataLangsung()" type="search">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <hr>
                        <p class="list">Informasi dan Jasa terbaru anda <a class="text-decoration-none viewAll" href="<?php echo $akarUrl; ?>src/admin/pages/data.php">Lihat
                                semua</a>
                        </p>
                        <hr>
                        <?php
                        $jasaModel = new Jasa($koneksi);
                        $informasiModel = new Informasi($koneksi);
                        $dataJasaTerbaru = $jasaModel->tampilkanDataJasaTerbaru();
                        $dataInformasiTerbaru = $informasiModel->tampilkanDataInformasiTerbaru();
                        $dataTerbaru = array_merge($dataInformasiTerbaru, $dataJasaTerbaru);
                        usort($dataTerbaru, function ($a, $b) {
                            $waktuA = isset($a['Waktu_Terakhir_Modifikasi']) ? strtotime($a['Waktu_Terakhir_Modifikasi']) : 0;
                            $waktuB = isset($b['Waktu_Terakhir_Modifikasi']) ? strtotime($b['Waktu_Terakhir_Modifikasi']) : 0;

                            return $waktuB - $waktuA;
                        });
                        $dataTerbaru = array_slice($dataTerbaru, 0, 3);
                        $searchResult = '';
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST["keyword"])) {
                                $keyword = htmlspecialchars($_POST["keyword"]);
                                $hasilInformasi = $informasiModel->cariDataInformasi($keyword);
                                $hasilJasa = $jasaModel->cariDataJasa($keyword);
                                $hasilPencarian = array_merge($hasilInformasi, $hasilJasa);
                                if (!empty($hasilPencarian)) {
                                    foreach ($hasilPencarian as $item) {
                                        $searchResult .= '<div class="d-flex align-items-center justify-content-between list boxParent mb-3">';
                                        $searchResult .= '<img class="imageProduct" src="' . $akarUrl . 'src/admin/assets/image/uploads/' . (isset($item['Foto_Informasi']) ? $item['Foto_Informasi'] : $item['Foto_Jasa']) . '" alt="imageProduct">';
                                        $searchResult .= '<div class="box">';
                                        $searchResult .= '<p>' . (isset($item['Nama_Informasi']) ? $item['Nama_Informasi'] : $item['Nama_Jasa']) . '</p>';
                                        $searchResult .= '<p class="descriptionProduct">' . (isset($item['Deskripsi_Informasi']) ? $item['Deskripsi_Informasi'] : $item['Deskripsi_Jasa']) . '</p>';
                                        $searchResult .= '</div>';
                                        $searchResult .= '<div class="box date">';
                                        $searchResult .= '<p>' . (isset($item['Pemilik_Informasi']) ? $item['Pemilik_Informasi'] : $item['Pemilik_Jasa']) . '</p>';
                                        $searchResult .= '<p class="stok">' . (isset($item['Kategori_Informasi']) ? $item['Kategori_Informasi'] : $item['Kategori_Jasa']) . '</p>';
                                        $searchResult .= '<p class="fs-6 fw-bolder">' . (isset($item['Foto_Informasi']) ? 'Informasi' : 'Jasa') . '</p>';
                                        $searchResult .= '</div>';
                                        $searchResult .= '<a class="linkProduk" href="#"><span class="edit-icon"><i class="fas fa-edit"></i> Sunting</span></a>';
                                        $searchResult .= '<a class="linkProduk" href="#"><span class="delete-icon"><i class="fas fa-trash"></i> Hapus</span></a>';
                                        $searchResult .= '</div>';
                                    }
                                } else {
                                    $searchResult = "<p class='text-center text-danger fw-bold pt-4 pb-2'>Tidak ada hasil yang ditemukan untuk pencarian ini.</p>";
                                }
                                echo $searchResult;
                            }
                        } else {
                            if (!empty($dataTerbaru)) {
                                foreach ($dataTerbaru as $item) {
                                    $searchResult .= '<div class="d-flex align-items-center justify-content-between list boxParent mb-3">';
                                    $searchResult .= '<img class="imageProduct" src="' . $akarUrl . 'src/admin/assets/image/uploads/' . (isset($item['Foto_Informasi']) ? $item['Foto_Informasi'] : $item['Foto_Jasa']) . '" alt="imageProduct">';
                                    $searchResult .= '<div class="box">';
                                    $searchResult .= '<p>' . (isset($item['Nama_Informasi']) ? $item['Nama_Informasi'] : $item['Nama_Jasa']) . '</p>';
                                    $searchResult .= '<p class="descriptionProduct">' . (isset($item['Deskripsi_Informasi']) ? $item['Deskripsi_Informasi'] : $item['Deskripsi_Jasa']) . '</p>';
                                    $searchResult .= '</div>';
                                    $searchResult .= '<div class="box date">';
                                    $searchResult .= '<p>' . (isset($item['Pemilik_Informasi']) ? $item['Pemilik_Informasi'] : $item['Pemilik_Jasa']) . '</p>';
                                    $searchResult .= '<p class="stok">' . (isset($item['Kategori_Informasi']) ? $item['Kategori_Informasi'] : $item['Kategori_Jasa']) . '</p>';
                                    $searchResult .= '<p class="fs-6 fw-bolder">' . (isset($item['Foto_Informasi']) ? 'Informasi' : 'Jasa') . '</p>';
                                    $searchResult .= '</div>';
                                    $searchResult .= '<a class="linkProduk" href="#"><span class="edit-icon"><i class="fas fa-edit"></i> Sunting</span></a>';
                                    $searchResult .= '<a class="linkProduk" href="#"><span class="delete-icon"><i class="fas fa-trash"></i> Hapus</span></a>';
                                    $searchResult .= '</div>';
                                }
                            } else {
                                $searchResult = "<p class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Informasi Dan Jasa!</p>";
                            }
                            echo $searchResult;
                        }
                        ?>
                    </div>
                </div>
            </form>
            <div class="relative d-flex align-items-center justify-content-between">
                <div id="addDataAllFormForDrive" class="d-flex align-items-center justify-content-between uploadParent">
                    <div class="dropdown addData" id="dropdown" onclick="toggleDropdownUpload()">
                        <i class="fas fa-upload"></i> Tambah Data
                    </div>
                    <div class="dropdown-menu optionUpload" aria-labelledby="dropdownMenuButton" id="dropdownMenuUpload">
                        <div>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addAdmin" href="#"><i class="fas fa-user-secret me-2 my-2"></i>Tambah Admin</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addUser" href="#"><i class="fas fa-users me-2 my-2"></i>Tambah Pengguna</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addInformation" href="#"><i class="bx bxs-info-circle me-2 my-2"></i>Tambah Informasi</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addServices" href="#"><i class="bx bxs-file-plus me-2 my-2"></i>Tambah Jasa</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown" id="dropdown" onclick="toggleDropdown()">
                    <img id="fotoNavbarAdminSessionForDrive" class="image" src="<?php echo $akarUrl; ?>src/admin/assets/image/uploads/<?php echo $_SESSION['Foto']; ?>" alt="imageAdmin">
                </div>
                <div class="dropdown-menu option" aria-labelledby="dropdownMenuButton" id="dropdownMenu">
                    <div class="d-flex align-items-center justify-content-between">
                        <img class="image-option" src="<?php echo $akarUrl; ?>src/admin/assets/image/uploads/<?php echo $_SESSION['Foto']; ?>" alt="imageAdmin">
                        <div>
                            <p class="info fw-bolder"><?php echo $_SESSION['Nama_Pengguna']; ?></p>
                            <?php
                            $teksPeranAdmin = "Peran Tidak Diketahui";
                            if (isset($_SESSION['Peran_Admin'])) {
                                $peranAdmin = $_SESSION['Peran_Admin'];
                                $teksPeranAdmin = ($peranAdmin == 1) ? "Super Admin" : ($peranAdmin == 2 ? "Instansi A" : ($peranAdmin == 3 ? "Instansi B" : ($peranAdmin == 4 ? "Instansi C" : "Tidak Di Ketahui")));
                            }
                            ?>
                            <p class="info role fw-semibold">
                                <?php echo $teksPeranAdmin; ?>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <a class="dropdown-item" href="<?php echo $akarUrl; ?>src/admin/pages/profile.php"><i class="fas fa-user me-2 my-2"></i>Profil Saya</a>
                    <a class="dropdown-item" href="<?php echo $akarUrl; ?>src/admin/config/logout.php"><i class="fas fa-sign-out-alt me-2 my-2"></i>Keluar</a>
                </div>
            </div>
        </div>
    </div>
</nav>