<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/signup1.css">
    <script src="../assets/js/javascript.js"></script>
    <title>SignUp-PTSP BMKG Provinsi Bengkulu</title>
</head>

<body>
    <div class="container-fluid w-100 section1">
        <div class="row text-center">
            <div class="col-lg-6 text-center justify-content-center left-content">
                <form class="main-form" id="multiStepForm" method="post" action="">
                    <h3 class="form-header fw-normal py-3 text-white mt-1 mb-5"><b>DAFTAR PERORANGAN</b></h3>
                    <!-- Form 1 -->
                    <div class="step" id="wizard-h-0" style="display: flex;">
                        <div class="row form">
                            <div class="col-md-12 p-0">
                                <div class="alert alert-info justify-content-center align-middle p-1 m-0">
                                    <b>DATA DIRI</b>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0">
                                <div class="form-floating my-3">
                                    <input type="number" class="form-control" id="NPWP" name="NPWP" placeholder="123*****">
                                    <label for="floatingInput">NPWP</label>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-floating my-3">
                                    <input type="number" class="form-control" id="NoIdentitas" name="NoIdentitas" placeholder="123*****">
                                    <label for="floatingInput">No Identitas (KTP/SIM/KITAS/PASSPORT) <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="Pekerjaan" name="Pekerjaan" placeholder="Mengaja***">
                                    <label for="floatingInput">Pekerjaan <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap" placeholder="Ridwan***">
                                    <label for="floatingInput">Nama Lengkap <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="Pendidikan" name="Pendidikan" placeholder="Ridwan***">
                                    <label for="floatingInput">Pendidikan Terakhir <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-floating my-3">
                                    <select class="form-select" aria-label="Default select example" id="Jenis_Kelamin" name="Jenis_Kelamin">
                                        <option selected>Pilih Jenis Kelamin</option>
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                    <label for="floatingInput">Jenis Kelamin <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-9"></div>
                            <div class="col-md-3 pe-0">
                                <button class="nextBtn pushable" type="button" onclick="nextStep(1)">
                                    <span class="shadow"></span>
                                    <span class="edge"></span>
                                    <span class="front">
                                        Selanjutnya
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Form 1 -->

                    <!-- Form 2 -->
                    <div class="step" id="wizard-h-1">
                        <div class="row form">
                            <div class="col-md-12 p-0">
                                <div class="alert alert-info justify-content-center align-middle p-1 m-0">
                                    <b>ALAMAT LENGKAP</b>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="Alamat" name="Alamat" placeholder="Jl.****">
                                    <label for="floatingInput">Alamat <b>*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-floating my-3">
                                    <input type="number" class="form-control" id="NoTelepon" name="NoTelepon" placeholder="123*****">
                                    <label for="floatingInput">No Hp / No Telepon <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="Provinsi" name="Provinsi" placeholder="Jawa ***">
                                    <label for="floatingInput">Provinsi <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="KotaKab" name="KotaKab" placeholder="Kab. ***">
                                    <label for="floatingInput">Kabupaten/Kota <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-3 ps-0">
                                <button class="prevBtn pushable" type="button" onclick="prevStep(1)">
                                    <span class="shadow"></span>
                                    <span class="edge"></span>
                                    <span class="front">
                                        Sebelumnya
                                    </span>
                                </button>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3 pe-0">
                                <button class="nextBtn pushable" type="button" onclick="nextStep(2)">
                                    <span class="shadow"></span>
                                    <span class="edge"></span>
                                    <span class="front">
                                        Selanjutnya
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Form 2 -->

                    <!-- Form 3 -->
                    <div class="step" id="wizard-h-2">
                        <div class="row form">
                            <div class="col-md-12 p-0">
                                <div class="alert alert-info justify-content-center align-middle p-1 m-0">
                                    <b>DATA AKUN</b>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0">
                                <div class="form-floating my-3">
                                    <input type="email" class="form-control" id="Email" name="Email" placeholder="***@example.com">
                                    <label for="floatingInput">Email <b>*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="Username" name="Username" placeholder="***sd**">
                                    <label for="floatingInput">Username <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0">
                                <div class="form-floating my-3">
                                    <input type="password" class="form-control" id="Password" name="Password" placeholder="*****">
                                    <label for="floatingInput">Provinsi <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-floating my-3">
                                    <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="*****">
                                    <label for="floatingInput">Confirm Password <b>*</b> </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6 ps-0 pe-0">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="CaptchaCode" name="CaptchaCode" placeholder="*****">
                                    <label for="floatingInput" class="d-flex align-items-center">Code Captcha <b>*</b>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <button class="prevBtn pushable" type="button" onclick="prevStep(1)">
                                    <span class="shadow"></span>
                                    <span class="edge"></span>
                                    <span class="front">
                                        Sebelumnya
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Form 3 -->

                    <!-- Terms and Condition -->
                    <div class="row">
                        <div class="alert alert-info mt-4 p-4">
                            <p class="text-start">Ketentuan Pengguna Perseorangan :</p>
                            <ol class="list text-start">
                                <li> Username akun Anda adalah NPWP perseorangan, maka pastikan bahwa NPWP anda sudah
                                    benar dan masih berlaku.</li>
                                <li> Pengguna yang telah terdaftar pada Web PTSP BMKG akan tunduk dan patuh terhadap
                                    segala aturan yang berlaku.</li>
                                <li> Tidak menyalahgunakan akun terdaftar kepada pihak yang tidak berkepentingan dan
                                    memanfaatkannya untuk melakukan tindakan kriminal.</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Terms and Condition -->

                    <div class="form-check text-start my-4">
                        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Dengan ini saya menyetujui semua syarat dan ketentuan sebagai pengguna Web PTSP BMKG
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn" type="submit">
                            <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
                                <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                                </path>
                            </svg>
                            <span class="text">Daftar</span>
                        </button>
                    </div>
                </form>
                <div class="text-start text-dark my-5">
                    <p>Sudah Mendaftar, <a href="../pages/login.php" class="text-primary" style="text-decoration: none;">Login
                            Sekarang</a></p>
                </div>
                <p class="mt-5 mb-3 text-body-secondary">© PTSP BMKG Provinsi Bengkulu – 2024</p>
            </div>
            <div class="col-md-6 p-0 right-content" style="background-image: url('../assets/img/landpage1.png');">
            </div>
        </div>
    </div>
    <script src="../assets/js/sign-up.js"></script>
</body>

</html>