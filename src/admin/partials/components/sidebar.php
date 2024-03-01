<aside class="col-md-2 d-none d-md-block" id="sidebar">
    <div class="sidebar-sticky sidebar-heading d-flex flex-column align-content-center flex-wrap">
        <span class="parentImageSidebar">
            <img class="sidebarImage" src="<?php echo $akarUrl; ?>src/admin/assets/image/uploads/<?php echo $_SESSION['Foto']; ?>" alt="imageAdmin">
            <a href="<?php echo $akarUrl; ?>src/admin/pages/profile.php">
                <span class="spanImageIcon">
                    <i class='bx bx-window-open'></i>
                </span>
            </a>
        </span>
        <div class="parentTextSidebar fw-medium">
            <?php
            $teksPeranAdmin = "Peran Tidak Diketahui";
            if (isset($_SESSION['Peran_Admin'])) {
                $peranAdmin = $_SESSION['Peran_Admin'];
                $teksPeranAdmin = ($peranAdmin == 1) ? "Super Admin" : ($peranAdmin == 2 ? "Instansi A" : ($peranAdmin == 3 ? "Instansi B" : ($peranAdmin == 4 ? "Instansi C" : "Tidak Di Ketahui")));
            }
            ?>
            <p><?php echo $teksPeranAdmin; ?></p>
            <p class="textAdmin"><?php echo $_SESSION['Nama_Pengguna']; ?></p>
        </div>
    </div>
    <ul class="list-unstyled components listSidebar">
        <a href="<?php echo $akarUrl; ?>public">
            <li class="liSidebar <?php echo ($halamanSaatIni == 'index.php') ? 'active' : '' ?>">
                <span class="textSidebar"><i class="fas fa-home me-2 my-2"></i>Beranda</span>
            </li>
        </a>
        <a href="<?php echo $akarUrl; ?>src/admin/pages/data.php">
            <li class="liSidebar <?php echo ($halamanSaatIni == 'data.php') ? 'active' : '' ?>">
                <span class="textSidebar"><i class="fas fa-database me-2 my-2"></i>Kumpulan Data</span>
            </li>
        </a>
        <a href="<?php echo $akarUrl; ?>src/admin/pages/analitic.php">
            <li class="liSidebar <?php echo ($halamanSaatIni == 'analitic.php') ? 'active' : '' ?>">
                <span class="textSidebar"><i class="fas fa-chart-bar me-2 my-2"></i>Analitik</span>
            </li>
        </a>
    </ul>
    <hr class="hrSidebar">
    <ul class="list-unstyled components listSidebar">
        <a data-bs-toggle="modal" data-bs-target="#sendFeedbackModal">
            <li class="liSidebar">
                <span class="textSidebar"><i class="fas fa-envelope-open-text me-2 my-2"></i>Kirim
                    Masukan</span>
            </li>
        </a>
    </ul>
</aside>