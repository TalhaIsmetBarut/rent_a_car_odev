<?php
ob_start();
session_start();
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
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    include("code/links.php");
    ?>
    
    <div class="<?php echo ($dosya == 'main.php' ? 'container-fluid p-0' : 'container'); ?> flex-grow-1">
    <?php
    include("code/$dosya");
    ?>
    </div>

    <footer class="bg-light text-center text-lg-start mt-5 py-4 border-top">
        <div class="container text-center text-muted">
                        <p class="mb-0 text-secondary" style="font-size: 0.9rem;">
                Geliştirici: <strong>Talha İsmet Barut</strong> 
                | <a href="?sayfa=rapor" class="text-decoration-none text-secondary fw-bold">Proje Raporu</a>
            </p>
            <p class="mb-1">&copy; <?php echo date("Y"); ?> Barut Car Rent. Tüm Haklar <a href="https://lab.t1b.com.tr" target="_blank" class="text-decoration-none text-secondary">T1B</a> Tarafından Saklıdır.</p>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    mysqli_close($conn);
    ?>
</body>

</html>
