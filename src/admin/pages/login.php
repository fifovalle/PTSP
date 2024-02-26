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
</head>

<body>
    <img class="wave" src="../assets/image/pages/wave.png">
    <!-- MAIN START -->
    <div class="container">
        <div class="img">
            <img src="../assets/image/pages/loginbg.svg">
            <div class="img2">
                <img src="../assets/image/pages/loginbg2.svg">
            </div>
        </div>
        <div class="login-content">
            <form action="../config/login.php" method="post">
                <img class="imgForm" src="../assets/image/logo/logo2.png">
                <h2 class="title">Selamat Datang</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Nama Pengguna</h5>
                        <input type="text" class="input" name="Email_Nama_Pengguna" autocomplete="off">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Kata Sandi</h5>
                        <input type="password" class="input" name="Kata_Sandi" id="passwordInput" autocomplete="off">
                        <i class="fas fa-eye iconInputContainer" id="togglePassword"></i>
                    </div>
                </div>
                <a href="forgotpass.html">Lupa kata sandi?</a>
                <button name="Masuk" type="submit" class="btn">Masuk</button>
            </form>
        </div>
    </div>
    <!-- MAIN END -->

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <!-- OUR JS -->
    <script type="text/javascript" src="../assets/our/js/login.js"></script>
    <!-- ICON -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <!-- ALERT -->
    <?php include '../partials/utils/alert.php' ?>
</body>

</html>