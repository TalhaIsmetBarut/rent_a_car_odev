<?php
$s = $_GET["sayfa"] ?? "main";
?>
<h5 class="fw-bold mb-3 pb-2 border-bottom d-none d-lg-block">Yönetim Paneli</h5>
<ul class="nav nav-pills flex-column mb-auto w-100">
    <li class="nav-item mb-1">
        <a href="?sayfa=main" class="nav-link text-white <?php if ($s == 'main') echo 'active'; ?>">
            <i class="bi bi-grid-1x2 me-2"></i> Yönetim Paneli
        </a>
    </li>
    <li class="nav-item mb-1">
        <a href="?sayfa=araclar" class="nav-link text-white <?php if ($s == 'araclar' || $s == 'arac_ekle') echo 'active bg-primary'; ?>">
            <i class="bi bi-car-front me-2"></i> Araç Yönetimi
        </a>
    </li>
    <li class="nav-item mb-1">
        <a href="?sayfa=kategoriler" class="nav-link text-white <?php if ($s == 'kategoriler' || $s == 'kategori_ekle') echo 'active bg-primary'; ?>">
            <i class="bi bi-folder me-2"></i> Kategori Yönetimi
        </a>
    </li>
    <li class="nav-item mb-1">
        <a href="?sayfa=talepler" class="nav-link text-white <?php if ($s == 'talepler') echo 'active bg-primary'; ?>">
            <i class="bi bi-clipboard-data me-2"></i> Talep Yönetimi
        </a>
    </li>
    <li class="nav-item mb-1">
        <a href="?sayfa=kullanicilar" class="nav-link text-white <?php if ($s == 'kullanicilar' || $s == 'kullanici_duzenle') echo 'active bg-primary'; ?>">
            <i class="bi bi-person-gear me-2"></i> Kullanıcı Yetkileri
        </a>
    </li>
    
    <li class="nav-item mt-3 border-top border-secondary pt-3 d-lg-none">
        <a href="../index.php" class="nav-link text-warning fw-bold">
            <i class="bi bi-house-door-fill me-2"></i> Web Sitesine Dön
        </a>
    </li>
</ul>
<div class="mt-auto pt-3 border-top border-secondary w-100 d-none d-lg-block">
    <a href="../index.php" class="btn btn-outline-light btn-sm w-100"><i class="bi bi-box-arrow-left me-1"></i> Web Sitesine Dön</a>
</div>

