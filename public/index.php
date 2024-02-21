<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../src/admin/assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../src/admin/assets/our/css/index.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- FAVICON -->
    <link rel="icon" href="../src/admin/assets/image/logo/1.png">
</head>

<body>
    <!-- NAVBAR START-->
    <nav class="navbar navbar-expand-lg color px-3 fixed-top">
        <div class="overlay z-2"></div>
        <div class="container-fluid">
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                <div class="d-flex align-items-center">
                    <img class="logo" src="../src/admin/assets/image/logo/1.png" alt="logo">
                    <p class="fw-bolder fs-5 ms-1 ptsp">PTSP</p>
                </div>
                <form class="z-3">
                    <div class="dropdown">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <i class="fas fa-times position-absolute top-50 end-0 translate-middle-y me-3 close-icon"
                            style="display: none;"></i>
                        <input class="form-control ps-5 search" placeholder="Cari Produk Anda" aria-label="Search"
                            id="searchInput" autocomplete="off">
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <hr>
                            <p class="list">Produk terbaru anda <a class="text-decoration-none viewAll" href="#">Lihat
                                    semua</a>
                            </p>
                            <hr>
                            <div class="d-flex align-items-center justify-content-between list boxParent">
                                <img class="imageProduct" src="../src/admin/assets/image/uploads/1.jpg"
                                    alt="imageProduct">
                                <div class="box">
                                    <p>Nama Produk</p>
                                    <p class="descriptionProduct">Lorem ipsum dolor sit amet consectetur adipisicing...
                                    </p>
                                </div>
                                <div class="box date">
                                    <p>Feb 16, 2024</p>
                                    <p class="stok">1 Stok</p>
                                </div>
                                <a class="linkProduk" href=""><span class="edit-icon"><i class="fas fa-edit"></i>
                                        Sunting</span></a>
                                <a class="linkProduk" href=""><span class="delete-icon"><i class="fas fa-trash"></i>
                                        Hapus</span></a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="relative d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between uploadParent">
                        <div class="dropdown addData" id="dropdown" onclick="toggleDropdownUpload()">
                            <i class="fas fa-upload"></i> Tambah Data
                        </div>
                        <div class="dropdown-menu optionUpload" aria-labelledby="dropdownMenuButton"
                            id="dropdownMenuUpload">
                            <div>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#uploadProduct"
                                    href="#"><i class="fas fa-user-secret me-2 my-2"></i>Tambah Admin</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#uploadProduct"
                                    href="#"><i class="fas fa-users me-2 my-2"></i>Tambah Pengguna</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#uploadProduct"
                                    href="#"><i class="fas fa-cart-plus me-2 my-2"></i>Tambah Produk</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown" id="dropdown" onclick="toggleDropdown()">
                        <img class="image" src="../src/admin/assets/image/uploads/1.jpg" alt="image">
                    </div>
                    <div class="dropdown-menu option" aria-labelledby="dropdownMenuButton" id="dropdownMenu">
                        <div class="d-flex align-items-center justify-content-between">
                            <img class="image-option" src="../src/admin/assets/image/uploads/1.jpg" alt="image">
                            <div>
                                <p class="info fw-bolder">zonaDeveloper</p>
                                <p class="info role fw-semibold">Super Admin</p>
                            </div>
                        </div>
                        <hr>
                        <a class="dropdown-item" href="#"><i class="fas fa-user me-2 my-2"></i>Profil Saya</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2 my-2"></i>Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END-->

    <section class="container-fluid mainWebsite">
        <section class="row">
            <!-- SIDEBAR START -->
            <aside class="col-md-2 d-none d-md-block" id="sidebar">
                <div class="sidebar-sticky sidebar-heading d-flex flex-column align-content-center flex-wrap">
                    <img class="sidebarImage" src="../src/admin/assets/image/uploads/1.jpg" alt="imageAdmin">
                    <div class="parentTextSidebar fw-medium">
                        <p>Super Admin</p>
                        <p class="textAdmin">zonaDeveloper</p>
                    </div>
                </div>
                <ul class="list-unstyled components listSidebar">
                    <a href="../../../public/index.html">
                        <li class="liSidebar active">
                            <span class="textSidebar"><i class="fas fa-home me-2 my-2"></i>Beranda</span>
                        </li>
                    </a>
                    <a href="../src/admin/pages/data.html">
                        <li class="liSidebar">
                            <span class="textSidebar"><i class="fas fa-database me-2 my-2"></i>Kumpulan Data</span>
                        </li>
                    </a>
                    <a href="analitic.html">
                        <li class="liSidebar">
                            <span class="textSidebar"><i class="fas fa-chart-bar me-2 my-2"></i>Analitik</span>
                        </li>
                    </a>
                </ul>
                <hr class="hrSidebar">
                <ul class="list-unstyled components listSidebar">
                    <li class="liSidebar">
                        <a class="textSidebar" href="#"><i class="fas fa-envelope-open-text me-2 my-2"></i>Kirim
                            Masukan</a>
                    </li>
                </ul>
            </aside>
            <!-- SIDEBAR END -->

            <!-- MAIN START -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between align-items-center text-center">
                    <h1 class="breadcrumb">Beranda</h1>
                    <div class="iconBreadcrumb d-flex justify-content-between align-content-center gap-3">
                        <div class="iconServer" data-toggle="tooltip" title="Instansi A">
                            <i class="fas fa-server"></i>
                        </div>
                        <div class="iconServer" data-toggle="tooltip" title="Instansi B">
                            <i class="fas fa-server"></i>
                        </div>
                        <div class="iconServer" data-toggle="tooltip" title="Instansi C">
                            <i class="fas fa-server"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-title py-4 mx-auto">Performa Produk Terbaru</h5>
                            <div class="position-relative mx-auto">
                                <img src="../src/admin/assets/image/uploads/2.png" class="imageCard card-img-top"
                                    alt="Performa Produk Terbaru">
                                <h5 class="card-title titleProduct fw-bold">Nama Produk</h5>
                            </div>
                            <div class="d-flex justify-content-around align-items-center mt-4">
                                <div class="d-flex justify-content-between gap-3">
                                    <i class="fas fa-users"><span class="ms-2 many">10</span></i>
                                    <i class="fas fa-money-bill"><span class="ms-2 many">Rp.1.000.000</span></i>
                                </div>
                                <div>
                                    <i class="fas fa-caret-up caret-icon"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body hidden-content">
                                <p class="card-text textCardProduct my-3 mb-4">Performa Selama Ini</p>
                                <div class="row ms-auto">
                                    <div class="col-7 me-4">Pembeli</div>
                                    <div class="col-2">10</div>
                                </div>
                                <div class="row ms-auto">
                                    <div class="col-7 me-4">Penghasilan</div>
                                    <div class="col-4">Rp.1.000.000</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="card-link">Lihat Analitik</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <h5 class="card-title pt-4 mx-auto">IKM Terbaru</h5>
                            <hr>
                            <div class="row mx-2 my-3">
                                <div class="col-3">
                                    <img src="../src/admin/assets/image/uploads/1.jpg" alt="GambarPengunjung"
                                        class="surveyImageCard">
                                </div>
                                <div class="col-9">
                                    <h5>Naufal FIFA</h5>
                                    <p class="card-text textCardProduct">Waduh Saya Puas Banget Sih Bang :)..</p>
                                </div>
                            </div>
                            <div class="card-body btnAnalitic">
                                <a href="#" class="card-link">Lihat Analitik</a>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-4 my-4 mt-5 border-top">
                    <div class="col-4 d-flex align-items-center">
                        <span class="mb-3 mb-md-0 textFooter">Dibuat Oleh Sangar ©
                            <script>document.write(new Date().getFullYear())</script> PTSP, BMKG
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="textFooter iconFooter"><i class='bx bxl-instagram'></i></div>
                        </div>
                        <div class="col-4">
                            <div class="textFooter iconFooter"><i class='bx bxl-instagram'></i></div>
                        </div>
                        <div class="col-4">
                            <div class="textFooter iconFooter"><i class='bx bxl-instagram'></i></div>
                        </div>
                    </div>
                </footer>
            </main>
            <!-- MAIN END -->
        </section>
    </section>


    <!-- MODAL UPLOAD PRODUCT START -->
    <div class="modal fade" id="uploadProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="fotoAdd" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="fotoAdd">
                        </div>
                        <div class="mb-3">
                            <label for="emailAdd" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="emailAdd">
                        </div>
                        <button type="submit" class="btn btnUpload">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL UPLOAD PRODUCT END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- OUR JS -->
    <script src="../src/admin/assets/our/js/index.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../src/admin/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>