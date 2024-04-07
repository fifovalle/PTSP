<?php
// DATABASES
include '../config/databases.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login admin</title>
    <!-- OUR CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/our/css/login.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <!-- FAVICON -->
    <link rel="icon" href="../assets/image/logo/1.png">
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- DRIVE JS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />
</head>

<body>
    <img class="wave" src="../assets/image/pages/wave.png">
    <!-- MAIN START -->
    <div class="container">
        <div class="img">
            <img src="../assets/image/pages/loginbg.svg">
            <div class="forgotBG">
                <img src="../assets/image/pages/forgotbg.svg">
            </div>
        </div>
        <div class="login-content">
            <form id="formForgotForDrive" action="../config/forgot-password.php" method="post">
                <img class="imgForm" src="../assets/image/logo/logo2.png">
                <h2 class="title">Lupa Kata Sandi ?</h2>
                <div id="emailForgotForDrive" class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" class="input" name="Email_Forgot" autocomplete="off">
                    </div>
                </div>
                <p>Masukan Email Anda !</p>
                <button id="btnForgotForDrive" name="Kirim" type="submit" class="btn">Kirim</button>
            </form>
        </div>
    </div>
    <!-- MAIN END -->
    <div class="fab-wrapper">
        <input id="fabCheckbox" type="checkbox" class="fab-checkbox" />
        <label class="fab" for="fabCheckbox">
            <span class="fab-dots fab-dots-1"></span>
            <span class="fab-dots fab-dots-2"></span>
            <span class="fab-dots fab-dots-3"></span>
        </label>
        <div class="fab-wheel">
            <a class="fab-action fab-action-1" id="spanHelp">
                <i class="fas fa-question"></i>
            </a>
            <a class="fab-action fab-action-2">
            </a>
            <a class="fab-action fab-action-3">
            </a>
            <a class="fab-action fab-action-4">
            </a>
        </div>
    </div>

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- CDN DRIVE.JS -->
    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <!-- OUR JS -->
    <script src="../assets/our/js/login.js"></script>
    <script src="../assets/our/js/drive-all.js"></script>
    <!-- ICON -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <!-- ALERT -->
    <?php include '../partials/utils/alert.php' ?>
</body>

</html>