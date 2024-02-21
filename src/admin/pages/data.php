<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin PTSP</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="../assets/our/css/index.css">
    <link rel="stylesheet" href="../assets/our/css/data.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- FAVICON -->
    <link rel="icon" href="../assets/image/logo/1.png">
</head>

<body>
    <!-- NAVBAR START-->
    <?php
    include "../partials/components/navbar.php";
    ?>
    <!-- NAVBAR END-->

    <section class="container-fluid mainWebsite">
        <section class="row">
            <!-- SIDEBAR START -->
            <?php
            include "../partials/components/sidebar.php"
            ?>
            <!-- SIDEBAR END -->

            <div class="container-fluid">
                <!-- MAIN START -->
                <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <h1 class="breadcrumb">Kumpulan Data</h1>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAdmin active">Admin</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAdmin">Pengguna</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAdmin">Produk</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAdmin">Transaksi</p>
                                </div>
                            </div>
                        </div>
                        <hr class="hrData">
                        <div class="row" style="position: relative;">
                            <div class="col-1">
                                <i class="bx bx-filter iconFilter"></i>
                            </div>
                            <div class="col-10 mb-3">
                                <input id="filterInput" class="filterInput" type="text" placeholder="Filter Data">
                            </div>
                            <div id="dropdownFilter" class="dropdownContentFilter row">
                                <div class="col listDropdownFilter">
                                    <span>Nama Pengguna</span>
                                </div>
                                <div class="col listDropdownFilter">
                                    <span>Nama Depan</span>
                                </div>
                                <div class="col listDropdownFilter">
                                    <span>Nama Belakang</span>
                                </div>
                                <div class="col listDropdownFilter">
                                    <span>Email</span>
                                </div>
                            </div>
                        </div>
                        <hr class="hrData">
                        <div class="row">
                            <div class="col">
                                <!-- ADMIN TABLE START -->
                                <?php include "../partials/utils/admin-table.php" ?>
                                <!-- ADMIN TABLE END -->

                                <!-- USER TABLE START -->
                                <?php include "../partials/utils/user-table.php" ?>
                                <!-- USER TABLE END -->

                                <!-- PRODUCT TABLE START -->
                                <?php include "../partials/utils/product-table.php" ?>
                                <!-- PRODUCT TABLE END -->

                                <!-- TRANSACTION TABLE START -->
                                <?php include "../partials/utils/transaction-table.php" ?>
                                <!-- TRANSACTION TABLE END -->
                            </div>
                        </div>
                        <!-- FOOTER START -->
                        <?php include "../partials/components/footer.php" ?>
                        <!-- FOOTER END -->
                </main>
                <!-- MAIN END -->
            </div>
        </section>
    </section>

    <!-- MODAL UPLOAD PRODUCT START -->

    <!-- MODAL UPLOAD PRODUCT END -->

    <!-- MODAL ADD ADMIN START -->
    <?php
    include "../partials/utils/modal-add-admin.php";
    ?>
    <!-- MODAL ADD ADMIN END -->

    <!-- MODAL EDIT ADMIN START -->
    <?php
    include "../partials/utils/modal-edit-admin.php";
    ?>
    <!-- MODAL EDIT ADMIN END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- OUR JS -->
    <script src="../assets/our/js/data.js"></script>
    <script src="../assets/our/js/index.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>