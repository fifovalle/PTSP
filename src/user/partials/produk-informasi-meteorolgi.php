<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/produk-informasi.css">
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid p-0" id="produk-informasi-">
        <div class="container text-center">
            <div class="row">
                <h1 class="mb-5">KATALOG PRODUK</h1>
                <div class="col-md-12" id="informasi">
                    <h4 class="my-3">INFORMASI METEOROLOGI
                        <hr>
                    </h4>
                    <div class="row pt-5 px-3">
                        <div class="col-md-4 mb-4 p-1" id="produk">
                            <div class="card-product">
                                <div class="card-info text-start ps-3 py-2">
                                    <button type="button" class="info p-0 border-0 bg-transparent"><box-icon name='info-circle'></box-icon></button>
                                </div>
                                <div class="card-img my-3">
                                    <span class="dot">
                                        <box-icon name='cloud-lightning' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="card-title">Nama Produk</div>
                                <div class="card-subtitle">Deskripsi Produk</div>
                                <hr class="card-divider">
                                <div class="d-flex card-footer justify-content-between my-4 mx-3">
                                    <div class="card-price text-start"><span>Rp</span>30.000</div>
                                    <div class="card-button">
                                        <button class="card-btn">
                                            <span><box-icon name='cart-alt'></box-icon></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 p-1" id="produk">
                            <div class="card-product">
                                <div class="card-info text-start ps-3 py-2">
                                    <button type="button" class="info p-0 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#produkModal"><box-icon name='info-circle'></box-icon></button>
                                </div>
                                <div class="card-img my-3">
                                    <span class="dot">
                                        <box-icon name='cloud-lightning' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="card-title">Nama Produk</div>
                                <div class="card-subtitle">Deskripsi Produk</div>
                                <hr class="card-divider">
                                <div class="d-flex card-footer justify-content-between my-4 mx-3">
                                    <div class="card-price text-start"><span>Rp</span>30.000</div>
                                    <div class="card-button">
                                        <button class="card-btn">
                                            <span><box-icon name='cart-alt'></box-icon></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 p-1" id="produk">
                            <div class="card-product">
                                <div class="card-info text-start ps-3 py-2">
                                    <button type="button" class="info p-0 border-0 bg-transparent"><box-icon name='info-circle'></box-icon></button>
                                </div>
                                <div class="card-img my-3">
                                    <span class="dot">
                                        <box-icon name='cloud-lightning' id="icon" color='rgba(255,255,255,0.9)' class="product"></box-icon>
                                    </span>
                                </div>
                                <div class="card-title">Nama Produk</div>
                                <div class="card-subtitle">Deskripsi Produk</div>
                                <hr class="card-divider">
                                <div class="d-flex card-footer justify-content-between my-4 mx-3">
                                    <div class="card-price text-start"><span>Rp</span>30.000</div>
                                    <div class="card-button">
                                        <button class="card-btn">
                                            <span><box-icon name='cart-alt'></box-icon></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('modal-produk-informasi.php');
    ?>
    <?php
    include('../partials/footer.php');
    ?>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/modal-produk-informasi.js"></script>
</body>

</html>