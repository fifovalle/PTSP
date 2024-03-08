<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<body>
    <?php
    include('../partials/navbar.php');
    ?>
    <div class="container-fluid w-100 mt-5">
        <div class="row mb-5">
            <div class="col-md-2 h-100" id="opsi-profile">
                <div class="row mx-5 my-3">
                    <div class="btn btn-success" id="profile-info" onclick="showProfileSetting('opsi-profileinfo')">Profile Info</div>
                </div>
                <div class="row mx-5 my-3">
                    <div class="btn btn-outline-success" id="profile-setting" onclick="showProfileSetting('opsi-profilesetting')">Profile Setting</div>
                </div>
                <div class="row mx-5 my-3">
                    <div class="btn btn-outline-success" id="alamat-setting" onclick="showProfileSetting('opsi-alamatsetting')">Additional Settings</div>
                </div>
            </div>
            <div class="col-md-10 p-0" id="opsi-profileinfo">
                <div class="container-fluid w-100">
                    <div class="d-flex row status">
                        <div class="col-md-12">
                            <div class="row mx-5 p-5 profile-status">
                                <div class="col-md-12 ">
                                    <div class="row">
                                        <h3 class="title-profile mb-5 mt-2">Informasi Pribadi</h3>
                                        <div class="col-md-3">
                                            <label for="nameInput">Nama Lengkap</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">Pekerjaan</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">No. Identitas</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">NPWP</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">Pendidikan Terakhir</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">Alamat</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">No. Handphone / Telepon</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">Email</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">Username</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">***</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 p-0" id="opsi-profilesetting" style="display:none;">
                <div class="container-fluid w-100">
                    <div class="d-flex row status">
                        <div class="col-md-12">
                            <form class="form-control profile-setting px-5 py-5" action="" method="POST">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                            <label for="nameInput">Username</label>
                                            <input type="text" class="form-control my-3" id="username" name="username" placeholder="Masukkan Username" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Nama Lengkap</label>
                                            <input type="text" class="form-control my-3" id="Nama" name="Nama" placeholder="Masukkan Nama" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Pekerjaan</label>
                                            <input type="text" class="form-control my-3" id="Pekerjaan" name="Pekerjaan" placeholder="Masukkan Pekerjaan" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Pendidikan Terakhir</label>
                                            <input type="text" class="form-control my-3" id="PendidikanTerakhir" name="PendidikanTerakhir" placeholder="Masukkan Pendidikan Terakhir" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phonenumberInput">Email</label>
                                            <input type="email" class="form-control my-3" id="Email" name="Email" placeholder="Masukkan Alamat Email" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phonenumberInput">No. Handphone</label>
                                            <input type="tel" class="form-control my-3" id="No.HP" name="No.HP" placeholder="Masukkan Nomor Handphone" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phonenumberInput">Jenis Kelamin</label>
                                            <select class="form-select my-3" aria-label="Pilih Jenis Kelamin" id="Jenis_Kelamin" name="Jenis_Kelamin">
                                                <option selected>Pilih Jenis Kelamin</option>
                                                <option value="1">Laki-laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="suratpengantarInput">Ganti Foto Profile</label>
                                            <input type="file" class="form-control my-3" id="Ganti_profil" name="Ganti_profil" style="height: 40px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="text-center">
                                                <img src="../assets/img/landpage2.jpg" class="img-thumbnail" alt="..." style="border-radius: 50%; width :250px; height:250px; border: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                </div>
                                <div class="row">
                                    <div class="d-flex col p-0">
                                        <button class="btn btn-outline-danger px-2 mx-3" type="submit" style="width:100px;">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 p-0" id="opsi-alamatsetting" style="display:none;">
                <div class="container-fluid w-100">
                    <div class="d-flex row status">
                        <div class="col-md-12">
                            <form class="form-control profile-setting px-5 py-5" action="" method="POST">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                            <label for="nameInput">Alamat</label>
                                            <input type="text" class="form-control my-3" id="alamat" name="alamat" placeholder="Masukkan Alamat Anda" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Email Tambahan</label>
                                            <input type="email" class="form-control my-3" id="email" name="email" placeholder="Masukkan Email" style="height: 40px">
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                </div>
                                <div class="row">
                                    <div class="d-flex col ">
                                        <button class="btn btn-outline-danger px-2 mx-3" type="submit" style="width:100px;">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/profile.js"></script>
</body>

</html>