<?php
include '../../admin/config/databases.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../partials/header.php');
    ?>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                                                } elseif (isset($_SESSION['Nama_Depan_Anggota_Perusahaan']) && isset($_SESSION['Nama_Belakang_Anggota_Perusahaan'])) {
                                                    echo $_SESSION['Nama_Depan_Anggota_Perusahaan'] . ' ' . $_SESSION['Nama_Belakang_Anggota_Perusahaan'];
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
                                        <hr class="my-4">
                                        <div class="col-md-3">
                                            <label for="nameInput">Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="nameInput">
                                                <?php
                                                if (isset($_SESSION['Jenis_Kelamin_Pengguna'])) {
                                                    echo ($_SESSION['Jenis_Kelamin_Pengguna'] == 'Pria') ? 'Pria' : 'Wanita';
                                                } elseif (isset($_SESSION['Jenis_Kelamin_Anggota_Perusahaan'])) {
                                                    echo ($_SESSION['Jenis_Kelamin_Anggota_Perusahaan'] == 'Pria') ? 'Pria' : 'Wanita';
                                                } else {
                                                    echo '';
                                                }
                                                ?>
                                            </label>
                                        </div>
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

                                        <hr class="my-4">
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

                                        <hr class="my-4">
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
                            <form class="form-control profile-setting px-5 py-5" action="../../admin/config/edit-account-profile-user.php" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control my-3" id="username" name="username" value="<?php echo isset($_SESSION['ID_Pengguna']) ? $_SESSION['ID_Pengguna'] : (isset($_SESSION['ID_Perusahaan']) ? $_SESSION['ID_Perusahaan'] : ''); ?>" style="height: 40px">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                            <label for="nameInput">Nama Pengguna</label>
                                            <input type="text" class="form-control my-3" id="username" name="username" value="<?php echo isset($_SESSION['Nama_Pengguna']) ? $_SESSION['Nama_Pengguna'] : (isset($_SESSION['Nama_Perusahaan']) ? $_SESSION['Nama_Perusahaan'] : ''); ?>" placeholder="<?php echo isset($_SESSION['Nama_Pengguna']) ? 'Harap Masukkan Nama Pengguna Anda' : (isset($_SESSION['Nama_Perusahaan']) ? 'Harap Masukkan Nama Pengguna Perusahaan Anda' : ''); ?>" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Nama Lengkap</label>
                                            <input type="text" class="form-control my-3" id="Nama" name="Nama" value="<?php echo isset($_SESSION['Nama_Depan_Pengguna']) && isset($_SESSION['Nama_Belakang_Pengguna']) ? $_SESSION['Nama_Depan_Pengguna'] . ' ' . $_SESSION['Nama_Belakang_Pengguna'] : (isset($_SESSION['Nama_Depan_Anggota_Perusahaan']) && isset($_SESSION['Nama_Belakang_Anggota_Perusahaan']) ? $_SESSION['Nama_Depan_Anggota_Perusahaan'] . ' ' . $_SESSION['Nama_Belakang_Anggota_Perusahaan'] : ''); ?>" placeholder="Harap Di Isikan Nama Lengkap Anda" style="height: 40px" disabled>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="nameInput">Pekerjaan</label>
                                            <input type="text" class="form-control my-3" id="Pekerjaan" name="Pekerjaan" value="<?php echo isset($_SESSION['Pekerjaan_Pengguna']) ? $_SESSION['Pekerjaan_Pengguna'] : (isset($_SESSION['Pekerjaan_Anggota_Perusahaan']) ? $_SESSION['Pekerjaan_Anggota_Perusahaan'] : ''); ?>" placeholder=" Harap Masukkan Pekerjaan Anda" style="height: 40px">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="phonenumberInput">Email</label>
                                            <input type="email" class="form-control my-3" id="Email" name="Email" value="<?php echo isset($_SESSION['Email_Pengguna']) ? $_SESSION['Email_Pengguna'] : (isset($_SESSION['Email_Anggota_Perusahaan']) ? $_SESSION['Email_Anggota_Perusahaan'] : ''); ?>" placeholder="Harap Masukkan Alamat Email Anda" style="height: 40px">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phonenumberInput">No. Handphone</label>
                                            <input type="tel" class="form-control my-3" id="No.HP" name="No_HP" value="<?php echo isset($_SESSION['No_Telepon_Pengguna']) ? $_SESSION['No_Telepon_Pengguna'] : (isset($_SESSION['No_Telepon_Anggota_Perusahaan']) ? $_SESSION['No_Telepon_Anggota_Perusahaan'] : ''); ?>" placeholder="Harap Masukkan No Handphone Anda" style="height: 40px">
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
                                            <input type="text" class="form-control my-3" id="alamat" name="alamat" value="<?php echo isset($_SESSION['Alamat_Pengguna']) ? $_SESSION['Alamat_Pengguna'] : (isset($_SESSION['Alamat_Anggota_Perusahaan']) ? $_SESSION['Alamat_Anggota_Perusahaan'] : 'Masukkan Alamat Anda'); ?>" placeholder="Harap Masukkan Alamat Anda" style="height: 40px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="text-center position-relative">
                                                <div class="profile-img text-center position-relative">
                                                    <?php if (isset($_SESSION['ID_Pengguna']) && !empty($_SESSION['Foto_Pengguna'])) : ?>
                                                        <img src="<?php echo $akarUrl ?>src/admin/assets/image/uploads/<?php echo $_SESSION['Foto_Pengguna'] ?>" class="img-thumbnail" alt="Foto Pengguna" style="border-radius: 50%; width: 250px; height: 250px; border: none;">
                                                    <?php elseif (isset($_SESSION['ID_Perusahaan']) && !empty($_SESSION['Foto_Perusahaan'])) : ?>
                                                        <img src="<?php echo $akarUrl ?>src/admin/assets/image/uploads/<?php echo $_SESSION['Foto_Perusahaan'] ?>" class="img-thumbnail" alt="Foto Perusahaan" style="border-radius: 50%; width: 250px; height: 250px; border: none;">
                                                    <?php else : ?>
                                                        <img src="../../admin/assets/image/uploads/default.jpg" class="img-thumbnail" alt="Foto Default" style="border-radius: 50%; width: 250px; height: 250px; border: none;">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="box position-absolute" style="display: none;">
                                                    <button class="btn border-0 opacity-100" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSuntingFoto">
                                                        <box-icon name='edit-alt' id="icon-edit" color='rgba(255,255,255,0.9)'></box-icon>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-3">
                                    </div>
                                    <div class="row">
                                        <div class="d-flex col p-0">
                                            <button class="btn btn-outline-success px-2 mx-3" type="submit" name="Simpan" style="width:100px;">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSuntingFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sunting Foto Profil</h1>
                    <div class="modalClose" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <form method="POST" action="<?php echo $akarUrl; ?>src/admin/config/edit-profil-user.php" enctype="multipart/form-data">
                        <div class="form-group formUpload">
                            <label class="fw-bold unggahFoto" for="unggahFoto"></label>
                            <label for="unggahFoto" class="upload-icon">
                                <i class='bx bx-cloud-upload'></i>
                            </label>
                            <input type="file" name="Foto" class="form-control-file visually-hidden" id="unggahFoto">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success btnUpload mt-3" name="Simpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/navbar.js"></script>
    <script src="../assets/js/profile.js"></script>
    <?php include '../../../src/admin/partials/utils/alert.php' ?>
</body>

</html>