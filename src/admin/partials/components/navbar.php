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
                    <input class="form-control ps-5 search" placeholder="Cari Informasi Dan Jasa Anda" aria-label="Search" id="searchInput" autocomplete="off">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <hr>
                        <p class="list">Produk terbaru anda <a class="text-decoration-none viewAll" href="<?php echo $akarUrl; ?>src/admin/pages/data.php">Lihat
                                semua</a>
                        </p>
                        <hr>
                        <?php
                        $informasiModel = new Informasi($koneksi);
                        $dataInformasiTerbaru = $informasiModel->tampilkanDataInformasi();
                        if (!empty($dataInformasiTerbaru)) {
                            foreach ($dataInformasiTerbaru as $informasi) {
                        ?>
                                <div class="d-flex align-items-center justify-content-between list boxParent mb-3">
                                    <img class="imageProduct" src="<?php echo $akarUrl; ?>src/admin/assets/image/uploads/<?php echo $informasi['Foto_Informasi']; ?>" alt="imageProduct">
                                    <div class="box">
                                        <p><?php echo $informasi['Nama_Informasi']; ?></p>
                                        <p class="descriptionProduct"><?php echo $informasi['Deskripsi_Informasi']; ?></p>
                                    </div>
                                    <div class="box date">
                                        <p><?php echo $informasi['Pemilik_Informasi']; ?></p>
                                        <p class="stok"><?php echo $informasi['Kategori_Informasi']; ?></p>
                                    </div>
                                    <a class="linkProduk" href="#"><span class="edit-icon"><i class="fas fa-edit"></i>
                                            Sunting</span></a>
                                    <a class="linkProduk" href="#"><span class="delete-icon"><i class="fas fa-trash"></i>
                                            Hapus</span></a>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p class='text-center text-danger fw-bold pt-4 pb-2'>Tidak Ada Data Informasi Dan Jasa!</p>";
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