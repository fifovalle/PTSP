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
    <link rel="stylesheet" href="../assets/our/css/analitic.css">
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
                        <h1 class="breadcrumb">Kumpulan Analitik</h1>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="row">
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll active">Semua</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Produk</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">IKM</p>
                                </div>
                                <div class="menu col-2">
                                    <p class="fw-semibold dataAll">Transaksi</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="menu text-center menuAnalitic">
                                    <p class="fw-semibold">7 Hari Terakhir</p>
                                </div>
                            </div>
                        </div>
                        <hr class="hrData">
                        <div class="row">
                            <div class="col">
                                <!-- ALL ANALITIC START -->
                                <?php include "../partials/utils/all-analitic.php" ?>
                                <?php include "../partials/utils/all-analitic-product.php" ?>
                                <?php include "../partials/utils/all-analitic-IKM.php" ?>
                                <?php include "../partials/utils/all-analitic-transaction.php" ?>
                                <!-- ALL ANALITIC END -->
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

    <!-- ALL MODAL START -->
    <?php
    include "../partials/utils/modal-add-admin.php";
    ?>
    <?php
    include "../partials/utils/send-feedback.php";
    ?>
    <!-- ALL MODAL END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- OUR JS -->
    <script src="../assets/our/js/analitic.js"></script>
    <script src="../assets/our/js/index.js"></script>
    <script src="../assets/our/js/chart-analytics.js"></script>
    <script src="../assets/our/js/apexcharts.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>