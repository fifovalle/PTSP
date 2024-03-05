<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="../../../src/admin/assets/image/logo/1.png">
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="../assets/js/javascript.js"></script>
    <title>Login-PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <div class="container-fluid w-100 section1">
        <div class="row text-center">
            <div class="col-md-6 left-content" style="background-image: url('../assets/img/landpage1.png');">
            </div>
            <div class="align-middle col-lg-6 text-center justify-content-center right-content">
                <form class="form">
                    <h1 class="mb-3 fw-normal my-5 py-3"> <b>LOGIN</b></h1>
                    <div class="form-floating my-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Alamat Email</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Kata Sandi</label>
                    </div>
                    <div class="form-check text-start my-3 ">
                        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Ingat saya
                        </label>
                        <label class="form-check-label" for="flexCheckDefault" style="float: right; display: block;">
                            <a href="../pages/resetpassword.php" class="text-primary" style="text-decoration: none;">Lupa
                                Sandi</a>
                        </label>
                    </div>
                    <div class="form-check text-end my-3 ">
                        <label class="form-check-label" for="flexCheckDefault" style="float: right; display: block;">
                            <a href="../pages/cover-signup.php" class="text-primary" style="text-decoration: none;">Daftar
                                Sekarang</a>
                        </label>
                    </div>
                    <button class="button py-2 my-4" type="submit">Masuk</button>
                    <p class="mt-5 text-body-secondary">© PTSP BMKG Provinsi Bengkulu – 2024</p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>