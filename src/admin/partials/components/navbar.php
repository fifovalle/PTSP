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
                        $keluaran = '';
                        if (!empty($dataTerbaru)) {
                            foreach ($dataTerbaru as $item) {
                                $keluaran .= '<div id="boxParent">';
                                $keluaran .= '<div id="boxParent2" class="boxParent d-flex align-items-center justify-content-between list mb-3">';
                                $keluaran .= '<img class="imageProduct" src="' . $akarUrl . 'src/admin/assets/image/uploads/' . (isset($item['Foto_Informasi']) ? $item['Foto_Informasi'] : $item['Foto_Jasa']) . '" alt="imageProduct">';
                                $keluaran .= '<div class="box">';
                                $keluaran .= '<p>' . (isset($item['Nama_Informasi']) ? $item['Nama_Informasi'] : $item['Nama_Jasa']) . '</p>';
                                $keluaran .= '<p class="descriptionProduct">' . (isset($item['Deskripsi_Informasi']) ? $item['Deskripsi_Informasi'] : $item['Deskripsi_Jasa']) . '</p>';
                                $keluaran .= '</div>';
                                $keluaran .= '<div class="box date">';
                                $keluaran .= '<p>' . (isset($item['Pemilik_Informasi']) ? $item['Pemilik_Informasi'] : $item['Pemilik_Jasa']) . '</p>';
                                $keluaran .= '<p class="stok">' . (isset($item['Kategori_Informasi']) ? $item['Kategori_Informasi'] : $item['Kategori_Jasa']) . '</p>';
                                $keluaran .= '<p class="fs-6 fw-bolder">' . (isset($item['Foto_Informasi']) ? 'Informasi' : 'Jasa') . '</p>';
                                $keluaran .= '</div>';
                                $keluaran .= '<a class="linkProduk ' . (isset($item['ID_Informasi']) ? 'buttonInformation' : 'buttonServices') . '" data-id="' . (isset($item['ID_Informasi']) ? $item['ID_Informasi'] : $item['ID_Jasa']) . '"><span class="edit-icon"><i class="fas fa-edit"></i> Sunting</span></a>';
                                $keluaran .= '<a class="linkProduk" href="javascript:void(0);" onclick="' . (isset($item['ID_Informasi']) ? 'confirmDeleteInformation(' . $item['ID_Informasi'] . ')' : 'confirmDeleteServices(' . $item['ID_Jasa'] . ')') . '"><span class="delete-icon"><i class="fas fa-trash"></i> Hapus</span></a>';
                                $keluaran .= '</div>';
                                $keluaran .= '</div>';
                            }
                        } else {
                            $keluaran .= '<p class="text-center text-danger fw-bold pt-4 pb-2">Tidak Ada Data Informasi Dan Jasa!</p>';
                        }
                        echo $keluaran;
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
                            <p class="info fw-bolder"><?php echo $_SESSION['Nama_Admin']; ?></p>
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