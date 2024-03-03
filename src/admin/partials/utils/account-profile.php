<div class="dataAccount">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div>
                            <h5 class="card-title fw-bold">Informasi Saya</h5>
                        </div>
                        <hr>
                    </div>
                    <?php
                    $idSessionAdmin = $_SESSION['ID'];
                    $adminModel = new Admin($koneksi);
                    $dataAdmin = $adminModel->tampilkanAdminDenganSessionId($idSessionAdmin);
                    if (!empty($dataAdmin)) {
                        $admin = $dataAdmin[0];
                    ?>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Nama Depan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $admin['Nama_Depan_Admin']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Nama Belakang</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $admin['Nama_Belakang_Admin']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Nama Pengguna</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $admin['Nama_Pengguna_Admin']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $admin['Email_Admin']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">No Telpon</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php
                                $noTelepon = $admin['No_Telepon_Admin'];
                                if (strpos($noTelepon, '+62') === 0) {
                                    $noTelepon = '(' . substr($noTelepon, 0, 3) . ') ' . substr($noTelepon, 3);
                                }
                                ?>
                                <?php echo $noTelepon; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $admin['Alamat_Admin']; ?>
                            </div>
                        </div>
                        <hr>
                    <?php
                    } else {
                        echo "<p>Data admin tidak ditemukan.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div>
                            <h5 class="card-title fw-bold">Informasi Status Saya</h5>
                        </div>
                        <hr>
                    </div>
                    <?php
                    $idSessionAdmin = $_SESSION['ID'];
                    $adminModel = new Admin($koneksi);
                    $dataAdmin = $adminModel->tampilkanAdminDenganSessionId($idSessionAdmin);
                    if (!empty($dataAdmin)) {
                        $admin = $dataAdmin[0];
                    ?>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Peran Anda</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <h6 class="mb-0">
                                    <?php
                                    echo ($admin['Peran_Admin'] == '1') ? 'Super Admin' : (($admin['Peran_Admin'] == '2') ? 'Instansi A' : (($admin['Peran_Admin'] == '3') ? 'Instansi B' : (($admin['Peran_Admin'] == '4') ? 'Instansi C' : 'Tidak Diketahui')));
                                    ?></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Status Verifikasi</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo ($admin['Status_Verifikasi_Admin'] == 'Terverifikasi') ? '<span class="badge text-bg-success">Terverifikasi</span>' : '<span class="badge text-bg-danger">Belum Terverifikasi</span>'; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <h6 class="mb-0">Jenis Kelamin</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <h6 class="mb-0"><?php echo $admin['Jenis_Kelamin_Admin']; ?></h6>
                            </div>
                        </div>
                        <hr>
                    <?php
                    } else {
                        echo "<p>Data admin tidak ditemukan.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>