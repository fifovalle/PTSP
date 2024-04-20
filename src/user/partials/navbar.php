<header class="" data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark p-0">
        <div class="container-fluid" id="box-navbar">
            <a class="navbar-brand" href="../pages/main.php"><img src="../assets/img/Logo PTSP1.png" alt="Logo PTSP BMKG Provinsi Bengkulu" width="100" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <input type="checkbox" id="checkbox">
                <label for="checkbox" class="toggle">
                    <div class="bars" id="bar1"></div>
                    <div class="bars" id="bar2"></div>
                    <div class="bars" id="bar3"></div>
                </label>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <button class="nav-item mx-2" id="btnBeranda">
                        <a class="nav-link mx-2" id="Beranda" aria-current="page" href="../pages/main.php">Beranda</a>
                    </button>
                    <button class="nav-item mx-2" id="btnAjukan">
                        <a class="nav-link " id="Ajukan" href="../pages/ajukan.php">Ajukan</a>
                    </button>
                    <button class="nav-item mx-2" id="btnProduk">
                        <a class="nav-link " id="Produk" href="../pages/katalogproduk.php">Produk</a>
                    </button>
                    <button class="nav-item mx-2 dropdown" id="btnRegulasi">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="Regulasi">
                            Regulasi
                        </a>
                        <ul class="dropdown-menu regulasi-menu" aria-labelledby="Regulasi">
                            <a class="ps-4 nav-link" data-bs-toggle="modal" data-bs-target="#AlurPelayanan">
                                <box-icon name='shape-circle'></box-icon>Alur Layanan</a>
                            <a class="ps-4 nav-link" data-bs-toggle="modal" data-bs-target="#StandarLayanan"><box-icon name='layer'></box-icon>Standar
                                Pelayanan</a>
                            <a class="ps-4 nav-link" data-bs-toggle="modal" data-bs-target="#RegulasiLayanan"><box-icon name='shield-quarter'></box-icon>Regulasi
                                Pelayanan</a>
                            <a class="ps-4 nav-link" data-bs-toggle="modal" data-bs-target="#TarifLayanan"><box-icon name='wallet'></box-icon>Tarif
                                Pelayanan</a>
                        </ul>
                    </button>
                    <button class="nav-item mx-2" id="btnPesanan" active>
                        <a class="nav-link" id="Pesanan" href="../pages/pesanan.php">Pesanan</a>
                    </button>
                </ul>
                <hr>
                <div class="profile-cart" role="search">
                    <button type="button" class="btn btn-outline-warning" id=btnCart><box-icon name='cart-alt'></box-icon></button>
                    <hr class="vertical">
                    <button id="btnLogin" class="btn btn-outline-success" type="button" style="display: none;">Login</button>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="btnProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex;">
                            <?php
                            if (isset($_SESSION['ID_Pengguna'])) {
                                echo "<box-icon name='user' id='icon-profile'></box-icon>" . $_SESSION['Nama_Pengguna'];
                            } elseif (isset($_SESSION['ID_Perusahaan'])) {
                                echo "<box-icon name='user' id='icon-profile'></box-icon>" . $_SESSION['Nama_Perusahaan'];
                            } else {
                                echo "<box-icon name='user' id='icon-profile'></box-icon> Tamu";
                            }
                            ?>
                        </button>
                        <ul class="dropdown-menu profile-menu">
                            <a class="ps-4 nav-link" href="../pages/profile.php">
                                <box-icon type='solid' name='user-detail'></box-icon>Profil Saya</a>
                            <a class="ps-4 nav-link" href="http://localhost/PTSP/src/admin/config/logout-user.php">
                                <box-icon name='power-off'></box-icon>Keluar</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Modal Alur Pelayanan -->
<div class="modal fade" id="AlurPelayanan" aria-labelledby="AlurPelayananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" id="modalAlurPelayanan">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AlurPelayananLabel">ALUR PELAYANAN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="../assets/img/AlurLayanan.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</div>
<!-- End Modal Alur Pelayanan -->

<!-- Modal Standar Pelayanan -->
<div class="modal fade" id="StandarLayanan" aria-labelledby="StandarLayananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" id="modalStandarLayanan">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="StandarLayananLabel">STANDAR PELAYANAN PTSP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="../assets/img/StandarLayanan1.jpg" class="d-block w-100" alt="...">
                <img src="../assets/img/StandarLayanan2.jpg" class="d-block w-100" alt="...">
                <p>* Jika ingin melihat detail, klik kanan gambar dan buka pada tab baru.</p>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Standar Pelayanan -->

<!-- Modal Regulasi Pelayanan -->
<div class="modal fade" id="RegulasiLayanan" aria-labelledby="RegulasiLayananLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalRegulasiLayanan">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="RegulasiLayananLabel">STANDAR PELAYANAN PTSP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Syarat dan Tata Cara Pengenaan Tarif Rp.0,00 (Nol Rupiah) Atas Jenis Penerimaan Negara Bukan
                    Pajak Terhadap Kegiatan Tertentu di Lingkungan BMKG.</p>
                <p>Sesuai dengan : <a href="https://ptsp.bmkg.go.id/upload/file_menu/20220413101834.PDF">Perka No.
                        12 Tahun 2019 Persyaratan dan Tata Cara Pengenaan Tarif Nol Rupiah Atas Jenis PNBP</a></p>
                <p>Produk dan Tarif sesuai PP No. 47 Tahun 2018 Tentang Jenis dan Tarif penerimaan Negara Bukan
                    Pajak yang Berlaku di BMKG.</p>
                <p>Sesuai dengan : <a href="https://ptsp.bmkg.go.id/upload/file_menu/20181102103810.pdf">PP No. 47
                        Tahun 2018</a></p>
                <p>Peraturan PTSP sesuai Perka No. 01 Tahun 2019 Tentang Pelayanan Terpadu Satu Pintu di BMKG.</p>
                <p>Sesuai dengan : <a href="https://ptsp.bmkg.go.id/upload/file_menu/20190731091546.pdf">Perka No.
                        01 Tahun 2019</a></p>
                <p>Manual PTSP BMKG untuk Pelanggan Untuk Alur Layanan Informasi dan Jasa Konsultasi MKG, Jasa Sewa
                    Alat MKG dan Jasa Kalibrasi Alat MKG.</p>
                <p><a href="https://ptsp.bmkg.go.id/upload/file_menu/20230113084609.pdf">Manual Alur Layanan PTSP
                        BMKG</a></p>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Alur Pelayanan -->

<!-- Modal Tarif Pelayanan -->
<div class="modal fade" id="TarifLayanan" aria-labelledby="TarifLayananLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalTarifLayanan">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="TarifLayananLabel">TARIF PELAYANAN PTSP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>I. INFORMASI METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h5>
                <div class="container1">
                    <div class="box">
                        <div class="header">
                            <button class="part_one row_one selected-navbar" onclick="showContent1('content1')">INFORMASI UMUM METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</button>
                            <button class="part_one row_one" onclick="showContent1('content2')">INFORMASI KHUSUS METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA SESUAI PERMINTAAN</button>
                        </div>
                        <div class="content_one " id="content1" style="display: block;">
                            <?php
                            include('../partials/table-tariflayanan1.php');
                            ?>
                        </div>
                        <div class="content_one" id="content2">
                            <?php
                            include('../partials/table-tariflayanan2.php');
                            ?>
                        </div>
                    </div>
                </div>
                <h5 class="mt-5">II. JASA KONSULTASI METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h5>
                <div class="container2">
                    <div class="box">
                        <div class="header">
                            <button class="part_one selected-navbar">JASA KONSULTASI METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</button>
                        </div>
                        <div class="content_two" id="content3">
                            <?php
                            include('../partials/table-tariflayanan3.php');
                            ?>
                        </div>
                    </div>
                </div>
                <h5 class="mt-5">III. JASA PENGGUNAAN ALAT METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA</h5>
                <div class="container3">
                    <div class="box">
                        <div class="header">
                            <button class="part_one row_three selected-navbar" onclick="showContent2('content4')">PERALATAN SEDERHANA MEKANIK (KONVENSIONAL)</button>
                            <button class="part_one row_three" onclick="showContent2('content5')">PERALATAN SEDERHANA ELEKTRONIK (OTOMATIS)</button>
                            <button class="part_one row_three" onclick="showContent2('content6')">PERALATAN TEKNOLOGI CANGGIH (MODERN)</button>
                        </div>
                        <div class="content_three" id="content4" style="display: block;">
                            <?php
                            include('../partials/table-tariflayanan4.php');
                            ?>
                        </div>
                        <div class="content_three" id="content5">
                            <?php
                            include('../partials/table-tariflayanan5.php');
                            ?>
                        </div>
                        <div class="content_three" id="content6">
                            <?php
                            include('../partials/table-tariflayanan6.php');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Alur Pelayanan -->