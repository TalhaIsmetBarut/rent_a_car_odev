<?php
ob_start();
session_start();
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 'admin') {
    header("Location: ../index.php?sayfa=giris&hata=" . urlencode("Bu alana erişim yetkiniz yoktur. Lütfen yönetici olarak giriş yapın."));
    exit;
}
include("code/yonlendirme.php");
include("code/baglan.php");
include("code/fonksiyonlar.php");
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/x-icon" href="../logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        #adminSidebar {
            width: 280px;
        }
        
        @media (min-width: 992px) {
            #adminSidebar {
                min-width: 280px;
                height: 100vh;
                position: sticky;
                top: 0;
                z-index: 1020;
            }
        }
        
        @media (max-width: 991.98px) {
            .admin-content {
                padding-top: 75px !important;
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }
        }
    </style>
</head>

<body>
    
    <div class="d-lg-none w-100 bg-dark text-white p-3 d-flex justify-content-between align-items-center fixed-top border-bottom border-secondary" style="z-index: 1030; height: 60px;">
        <span class="fw-bold">Yönetim Paneli</span>
        <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="d-flex">
        
        <div class="offcanvas-lg offcanvas-start text-white bg-dark border-end border-secondary" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
            <div class="offcanvas-header border-bottom border-secondary d-lg-none">
                <h5 class="offcanvas-title fw-bold" id="adminSidebarLabel">Yönetim Paneli</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#adminSidebar" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-3 h-100">
                <?php
                include("code/links.php");
                ?>
            </div>
        </div>
        
        
        <div class="admin-content flex-grow-1" style="padding: 2.5rem; background-color: #f8f9fa; min-height: 100vh; overflow-x: hidden;">
            <?php
            include("code/$dosya");
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    mysqli_close($conn);
    ?>
</body>

</html>
