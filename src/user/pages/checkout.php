<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/checkout.css">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <title>PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="header mb-5 ps-5">Checkout</h1>
            <div class="d-flex col-md-12 justify-content-end text-right">
                <button type="button" class="btn btn-outline-warning me-4 mb-4" data-bs-toggle="modal" data-bs-target="#Checkout">Checkout</button>
            </div>

            <div class="col-md-12  justify-content-center">
                <div class="row" id="dropdown-informasi">
                    <div class="col-md-12">
                        <button class="btn btn-secondary dropdown-toggle text-start fw-bold fs-4" type="button" aria-expanded="false" id="Informasi_Button" onclick="toggleTable()">
                            Informasi
                        </button>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-success table-striped" id="Informasi" style="display: none;">
                            <tr class="header_informasi">
                                <th class="number_informasi text-center">NO</th>
                                <th class="title_informasi text-center">NAMA INFORMASI</th>
                                <th class="harga_informasi text-center">HARGA</th>
                                <th class="kuantitas_informasi text-center">KUANTITAS</th>
                            </tr>
                            <tr class="content_informasi">
                                <td class="content_number_informasi py-5 text-center">1</td>
                                <td class="content_title_informasi py-5 text-center">INFORMASI IKLIM</td>
                                <td class="content_harga_informasi py-5 text-center">Rp250.000,00</td>
                                <td class="content_kuantitas_informasi py-5 text-center"><button type="button" class="btn btn-danger" onclick="kurangiNilai()"><i class="bi bi-dash"></i></button>
                                    <span id="nilai_informasi">1</span>
                                    <button type="button" class="btn btn-primary" class="plus" onclick="tambahNilai()"><i class="bi bi-plus"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 justify-content-center my-5">
                    <div class="row" id="dropdown-jasa">
                        <div class="col-md-12">
                            <button class="btn btn-secondary dropdown-toggle text-start fw-bold fs-4" type="button" aria-expanded="false" id="Jasa_Button" onclick="toggleTable1()">
                                Jasa
                            </button>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-success table-striped" id="Jasa" style="display: none;">
                                <tr class="header_jasa">
                                    <th class="number_jasa text-center">NO</th>
                                    <th class="title_jasa text-center">NAMA INFORMASI</th>
                                    <th class="harga_jasa text-center">HARGA</th>
                                    <th class="kuantitas_jasa text-center">KUANTITAS</th>
                                </tr>
                                <tr class="content_jasa">
                                    <td class="content_number_jasa py-5 text-center">1</td>
                                    <td class="content_title_jasa py-5 text-center">JASA KALIBRASI ALAT</td>
                                    <td class="content_harga_jasa py-5 text-center">Rp250.000,00</td>
                                    <td class="content_kuantitas_jasa py-5 text-center"><button type="button" class="btn btn-danger" onclick="kurangiNilai1()"><i class="bi bi-dash"></i></button>
                                        <span id="nilai_jasa">1</span>
                                        <button type="button" class="btn btn-primary" onclick="tambahNilai1()"><i class="bi bi-plus"></i></button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Checkout -->
    <div class="modal fade" id="Checkout" aria-labelledby="CheckoutLabel" aria-hidden="true">
        <div class="modal-dialog" id="modalCheckout">
            <div class="modal-content">
                <div class="container p-0">
                    <div class="card cart">
                        <label class="title"><button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>CHECKOUT</label>
                        <div class="steps">
                            <div class="step">
                                <div>
                                    <span>SHIPPING</span>
                                    <p>Alamat</p>
                                    <p>Email</p>
                                </div>
                                <hr>
                                <div>
                                    <span>PRODUCTS</span>
                                    <p>Informasi Barang
                                    </p>
                                    <p>Jumlah</p>
                                </div>
                                <hr>
                                <div>
                                    <span>PAYMENT METHOD</span>
                                    <p>No. Rekening BCA</p>
                                    <p>**** **** **** 4243</p>
                                </div>
                                <hr>
                                <div class="payments">
                                    <span>PAYMENT</span>
                                    <div class="details">
                                        <span>Subtotal:</span>
                                        <span>$240.00</span>
                                        <span>Shipping:</span>
                                        <span>$10.00</span>
                                        <span>Tax:</span>
                                        <span>$30.40</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card checkout">
                        <div class="footer">
                            <label class="price">$280.40</label>
                            <button class="checkout-btn" type="button">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Checkout -->
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/cart.js"></script>
    <!-- ALERT -->
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>