<?php
session_start();
?>

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
                    <div class="btn btn-success" id="profile-info" onclick="showProfileSetting('opsi-profileinfo')">Informasi Profil</div>
                </div>
                <div class="row mx-5 my-3">
                    <div class="btn btn-outline-success" id="profile-setting" onclick="showProfileSetting('opsi-profilesetting')">Pengaturan Profil</div>
                </div>
            </div>
            <div class="col-md-10 p-0" id="opsi-profileinfo">
                <div class="container-fluid w-100">
                    <div class="d-flex row status">
                        <div class="col-md-12">
                            <div class="row mx-5 p-5 profile-status">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h3 class="title-profile mb-5 mt-2">Informasi Pribadi</h3>
                                        <div class="col-md-3">
                                            <label for="nameInput">Nama Lengkap</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Nama_Depan_Pengguna']) && isset($_SESSION['Nama_Belakang_Pengguna'])) {
                                                    echo $_SESSION['Nama_Depan_Pengguna'] . ' ' . $_SESSION['Nama_Belakang_Pengguna'];
                                                } elseif (isset($_SESSION['Nama_Depan_Anggota_Perusahaan'])) {
                                                    echo $_SESSION['Nama_Belakang_Anggota_Perusahaan'];
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">Pekerjaan</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Pekerjaan_Pengguna'])) {
                                                    echo $_SESSION['Pekerjaan_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['Pekerjaan_Anggota_Perusahaan']) ? $_SESSION['Pekerjaan_Anggota_Perusahaan'] : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">No. Identitas</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['No_Identitas_Pengguna'])) {
                                                    echo $_SESSION['No_Identitas_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['No_Identitas_Anggota_Perusahaan']) ? $_SESSION['No_Identitas_Anggota_Perusahaan'] : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">NPWP</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['NPWP_Pengguna'])) {
                                                    echo $_SESSION['NPWP_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['No_NPWP']) ? $_SESSION['No_NPWP'] : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">Pendidikan Terakhir</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Pendidikan_Terakhir_Pengguna'])) {
                                                    echo $_SESSION['Pendidikan_Terakhir_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['Pendidikan_Terakhir_Anggota_Perusahaan']) ? $_SESSION['Pendidikan_Terakhir_Anggota_Perusahaan'] : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Jenis_Kelamin_Pengguna'])) {
                                                    echo ($_SESSION['Jenis_Kelamin_Pengguna'] == '1') ? 'Laki-laki' : 'Perempuan';
                                                } else {
                                                    echo isset($_SESSION['Jenis_Kelamin_Anggota_Perusahaan']) ? ($_SESSION['Jenis_Kelamin_Anggota_Perusahaan'] == '1' ? 'Laki-laki' : 'Perempuan') : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">Alamat</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Alamat_Pengguna'])) {
                                                    echo $_SESSION['Alamat_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['Alamat_Anggota_Perusahaan']) ? $_SESSION['Alamat_Anggota_Perusahaan'] : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">No. Handphone / Telepon</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['No_Telepon_Pengguna'])) {
                                                    echo $_SESSION['No_Telepon_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['No_Telepon_Anggota_Perusahaan']) ? $_SESSION['No_Telepon_Anggota_Perusahaan'] : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">Email</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Email_Pengguna'])) {
                                                    echo $_SESSION['Email_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['Email_Anggota_Perusahaan']) ? $_SESSION['Email_Anggota_Perusahaan'] : '';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">Username</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Nama_Pengguna'])) {
                                                    echo $_SESSION['Nama_Pengguna'];
                                                } else {
                                                    echo isset($_SESSION['Nama_Pengguna_Anggota_Perusahaan']) ? $_SESSION['Nama_Pengguna_Anggota_Perusahaan'] : '';
                                                }
                                                ?>
                                            </label>
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
                            <form class="form-control profile-setting px-5 py-5" action="<?php echo $akarUrl; ?>src/admin/config/edit-account-profile-user.php" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control my-3" id="username" name="username" placeholder="<?php echo isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : 'Masukkan Username'); ?>" style="height: 40px">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                            <label for="nameInput">Username</label>
                                            <input type="text" class="form-control my-3" id="username" name="username" placeholder="<?php echo isset($_SESSION['Nama_Pengguna']) ? $_SESSION['Nama_Pengguna'] : (isset($_SESSION['Nama_Pengguna_Anggota_Perusahaan']) ? $_SESSION['Nama_Pengguna_Anggota_Perusahaan'] : 'Masukkan Username'); ?>" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Nama Lengkap</label>
                                            <input type="text" class="form-control my-3" id="Nama" name="Nama" placeholder="<?php echo isset($_SESSION['Nama_Depan_Pengguna']) && isset($_SESSION['Nama_Belakang_Pengguna']) ? $_SESSION['Nama_Depan_Pengguna'] . ' ' . $_SESSION['Nama_Belakang_Pengguna'] : (isset($_SESSION['Nama_Depan_Anggota_Perusahaan']) && isset($_SESSION['Nama_Belakang_Anggota_Perusahaan']) ? $_SESSION['Nama_Depan_Anggota_Perusahaan'] . ' ' . $_SESSION['Nama_Belakang_Anggota_Perusahaan'] : 'Masukkan Nama'); ?>" style="height: 40px">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="nameInput">Pekerjaan</label>
                                            <input type="text" class="form-control my-3" id="Pekerjaan" name="Pekerjaan" placeholder="<?php echo isset($_SESSION['Pekerjaan_Pengguna']) ? $_SESSION['Pekerjaan_Pengguna'] : (isset($_SESSION['Pekerjaan_Anggota_Perusahaan']) ? $_SESSION['Pekerjaan_Anggota_Perusahaan'] : 'Masukkan Pekerjaan'); ?>" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Pendidikan Terakhir</label>
                                            <input type="text" class="form-control my-3" id="PendidikanTerakhir" name="PendidikanTerakhir" placeholder="<?php echo isset($_SESSION['Pendidikan_Terakhir_Pengguna']) ? $_SESSION['Pendidikan_Terakhir_Pengguna'] : (isset($_SESSION['Pendidikan_Terakhir_Anggota_Perusahaan']) ? $_SESSION['Pendidikan_Terakhir_Anggota_Perusahaan'] : 'Masukkan Pendidikan Terakhir'); ?>" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phonenumberInput">Email</label>
                                            <input type="email" class="form-control my-3" id="Email" name="Email" placeholder="<?php echo isset($_SESSION['Email_Pengguna']) ? $_SESSION['Email_Pengguna'] : (isset($_SESSION['Email_Anggota_Perusahaan']) ? $_SESSION['Email_Anggota_Perusahaan'] : 'Masukkan Alamat Email'); ?>" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phonenumberInput">No. Handphone</label>
                                            <input type="tel" class="form-control my-3" id="No.HP" name="No.HP" placeholder="<?php echo isset($_SESSION['No_Telepon_Pengguna']) ? $_SESSION['No_Telepon_Pengguna'] : (isset($_SESSION['No_Telepon_Anggota_Perusahaan']) ? $_SESSION['No_Telepon_Anggota_Perusahaan'] : 'Masukkan Nomor Handphone'); ?>" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phonenumberInput">Jenis Kelamin</label>
                                            <select class="form-select my-3" aria-label="Pilih Jenis Kelamin" id="Jenis_Kelamin" name="Jenis_Kelamin">
                                                <option selected>Pilih Jenis Kelamin</option>
                                                <option value="Pria" <?php echo (isset($_SESSION['Jenis_Kelamin_Pengguna']) && $_SESSION['Jenis_Kelamin_Pengguna'] == 'Pria') ? ' selected' : ''; ?>>Pria</option>
                                                <option value="Wanita" <?php echo (isset($_SESSION['Jenis_Kelamin_Pengguna']) && $_SESSION['Jenis_Kelamin_Pengguna'] == 'Wanita') ? ' selected' : ''; ?>>Wanita</option>
                                                <?php if (isset($_SESSION['Jenis_Kelamin_Anggota_Perusahaan'])) : ?>
                                                    <option value="Pria" <?php echo ($_SESSION['Jenis_Kelamin_Anggota_Perusahaan'] == 'Pria') ? ' selected' : ''; ?>>Pria</option>
                                                    <option value="Wanita" <?php echo ($_SESSION['Jenis_Kelamin_Anggota_Perusahaan'] == 'Wanita') ? ' selected' : ''; ?>>Wanita</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Alamat</label>
                                            <input type="text" class="form-control my-3" id="alamat" name="alamat" placeholder="<?php echo isset($_SESSION['Alamat_Pengguna']) ? $_SESSION['Alamat_Pengguna'] : (isset($_SESSION['Alamat_Anggota_Perusahaan']) ? $_SESSION['Alamat_Anggota_Perusahaan'] : 'Masukkan Alamat Anda'); ?>" style="height: 40px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="text-center position-relative">
                                                <img src="../assets/img/landpage2.jpg" class="img-thumbnail" alt="..." style="border-radius: 50%; width :250px; height:250px; border: none;">
                                            </div>
                                            <div class="box position-absolute" style="display: none;">
                                                <button class="btn border-0 opacity-100" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gantiProfil">
                                                    <box-icon name='edit-alt' id="icon-edit" color='rgba(255,255,255,0.9)'></box-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                </div>
                                <div class="row">
                                    <div class="d-flex col p-0">
                                        <button class="btn btn-outline-danger px-2 mx-3" type="submit" name="Simpan"="width:100px;">Simpan</button>
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
    <div class="modal fade" id="gantiProfil" tabindex="-1" aria-labelledby="gantiProfilLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="ganti_profil">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="gantiProfilLabel">Ganti Profil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="custum-file-upload" for="file">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="text">
                            <span>Click to upload image</span>
                        </div>
                        <input type="file" id="file">
                    </label>
                </div>
            </div>
        </div>
    </div>
</body>

</html>