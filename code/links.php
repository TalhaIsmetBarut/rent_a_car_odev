<?php
$s = $_GET["sayfa"] ?? "main";
$is_logged_in = isset($_SESSION["kullanici_adi"]);
$user_role = $_SESSION["rol"] ?? "";
$user_name = $_SESSION["kullanici_adi"] ?? "";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow" style="background-color: rgb(33 37 41 / 95%) !important;">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="?sayfa=main">
            <img src="logo.ico" alt="Logo" height="40" class="d-inline-block">
            <span>Barut Car Rent</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header border-bottom border-secondary">
                <h5 class="offcanvas-title fw-bold d-flex align-items-center gap-2" id="offcanvasNavbarLabel">
                    <img src="logo.ico" alt="Logo" height="30" class="d-inline-block">
                    <span>Barut Car Rent</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav me-auto align-items-lg-center mb-3 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($s == 'main') echo 'active'; ?>" href="?sayfa=main">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($s == 'arabalar') echo 'active'; ?>" href="?sayfa=arabalar">Kiralık Araçlar</a>
                    </li>
                    <?php if ($is_logged_in): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($s == 'taleplerim') echo 'active'; ?>" href="?sayfa=taleplerim">Taleplerim</a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <?php if ($is_logged_in): ?>
                        <li class="nav-item text-white-50 me-lg-3 mb-2 mb-lg-0 text-nowrap">
                            <i class="bi bi-person-circle text-light me-1"></i> Hoş geldin, <strong><?php echo h($user_name); ?></strong>
                        </li>
                        <?php if ($user_role === 'admin'): ?>
                            <li class="nav-item mb-2 mb-lg-0 w-100 w-lg-auto">
                                <a href="yonetim/index.php" class="btn btn-warning btn-sm fw-bold w-100 w-lg-auto text-nowrap">Yönetim Paneli</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item w-100 w-lg-auto">
                            <a href="?sayfa=cikis" class="btn btn-outline-danger btn-sm w-100 w-lg-auto text-nowrap">Çıkış Yap</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item w-100 w-lg-auto text-nowrap">
                            <a class="nav-link <?php if ($s == 'giris') echo 'active'; ?>" href="?sayfa=giris">Giriş Yap</a>
                        </li>
                        <li class="nav-item w-100 w-lg-auto text-nowrap">
                            <a class="nav-link <?php if ($s == 'kayit') echo 'active'; ?>" href="?sayfa=kayit">Kayıt Ol</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
