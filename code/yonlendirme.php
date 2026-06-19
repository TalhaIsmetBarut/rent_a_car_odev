<?php
$sayfa = @$_GET["sayfa"];

switch ($sayfa) {
    case "main":
        $dosya = "main.php";
        $title = "Anasayfa";
        break;
    case "rapor":
        $dosya = "rapor.php";
        $title = "Proje Raporu";
        break;
    default:
        $dosya = "main.php";
        $title = "Anasayfa";
        break;
    case "arabalar":
        $dosya = "arabalar.php";
        $title = "Kiralık Araçlar";
        break;
    case "talep_ekle":
        $dosya = "talep_ekle.php";
        $title = "Kiralama Talebi";
        break;
    case "talep_ekleme":
        $dosya = "talep_ekleme.php";
        $title = "Kiralama Sonucu";
        break;
    case "giris":
        $dosya = "giris.php";
        $title = "Giriş Yap";
        break;
    case "giris_kontrol":
        $dosya = "giris_kontrol.php";
        $title = "Giriş Yapılıyor";
        break;
    case "kayit":
        $dosya = "kayit.php";
        $title = "Kayıt Ol";
        break;
    case "kayit_ekleme":
        $dosya = "kayit_ekleme.php";
        $title = "Kayıt Sonucu";
        break;
    case "cikis":
        $dosya = "cikis.php";
        $title = "Çıkış Yapılıyor";
        break;
    case "taleplerim":
        $dosya = "taleplerim.php";
        $title = "Kiralama Taleplerim";
        break;
}
?>
