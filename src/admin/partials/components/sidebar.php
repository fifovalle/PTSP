<?php
// AKAR TAUTAN
$akarUrl = "http://localhost/PTSP/";
// HALAMAN SAAT DIBUKA
$halamanSaatIni = basename($_SERVER['PHP_SELF']);
?>

<aside class="col-md-2 d-none d-md-block" id="sidebar">
    <div class="sidebar-sticky sidebar-heading d-flex flex-column align-content-center flex-wrap">
        <img class="sidebarImage" src="<?php echo $akarUrl; ?>src/admin/assets/image/uploads/1.jpg" alt="imageAdmin">
        <div class="parentTextSidebar fw-medium">
            <p>Super Admin</p>
            <p class="textAdmin">zonaDeveloper</p>
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
        <li class="liSidebar">
            <a class="textSidebar" href="#"><i class="fas fa-envelope-open-text me-2 my-2"></i>Kirim
                Masukan</a>
        </li>
    </ul>
</aside>