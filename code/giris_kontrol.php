<?php
$kullanici_adi = mysqli_real_escape_string($conn, $_GET["kullanici_adi"]);
$sifre         = $_GET["sifre"];

$sql = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$kullanici_adi'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    $db_sifre = $row["sifre"];
    $rol      = $row["rol"];
    
    
    if (password_verify($sifre, $db_sifre)) {
        $_SESSION["kullanici_adi"] = $kullanici_adi;
        $_SESSION["rol"]           = $rol;
        
        echo "Giriş başarılı! Yönlendiriliyorsunuz...";
        echo '<meta http-equiv="refresh" content="2;url=index.php?sayfa=main">';
    } else {
        header("Location: index.php?sayfa=giris&hata=" . urlencode("Hatalı şifre girdiniz."));
        exit;
    }
} else {
    header("Location: index.php?sayfa=giris&hata=" . urlencode("Kullanıcı adı bulunamadı."));
    exit;
}
?>
