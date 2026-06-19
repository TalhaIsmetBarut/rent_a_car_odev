<?php
$sayfa = @$_GET["sayfa"];

switch ($sayfa) {
    case "main":
        $dosya = "main.php";
        $title = "Anasayfa";
        break;
    default:
        $dosya = "main.php";
        $title = "Anasayfa";
        break;
    case "araclar":
        $dosya = "araclar.php";
        $title = "Araç Yönetimi";
        break;
    case "arac_ekle":
        $dosya = "arac_ekle.php";
        $title = "Araç Ekle/Düzenle";
        break;
    case "arac_ekleme":
        $dosya = "arac_ekleme.php";
        $title = "Araç Kayıt";
        break;
    case "arac_sil":
        $dosya = "arac_sil.php";
        $title = "Araç Sil";
        break;
    case "kategoriler":
        $dosya = "kategoriler.php";
        $title = "Kategori Yönetimi";
        break;
    case "kategori_ekle":
        $dosya = "kategori_ekle.php";
        $title = "Kategori Ekle";
        break;
    case "kategori_ekleme":
        $dosya = "kategori_ekleme.php";
        $title = "Kategori Kayıt";
        break;
    case "kategori_sil":
        $dosya = "kategori_sil.php";
        $title = "Kategori Sil";
        break;
    case "talepler":
        $dosya = "talepler.php";
        $title = "Kiralama Talepleri";
        break;
    case "talep_islem":
        $dosya = "talep_islem.php";
        $title = "Talep İşlem";
        break;
    case "kullanicilar":
        $dosya = "kullanicilar.php";
        $title = "Kullanıcı Yetki Yönetimi";
        break;
    case "kullanici_duzenle":
        $dosya = "kullanici_duzenle.php";
        $title = "Kullanıcı Yetki Düzenle";
        break;
    case "kullanici_guncelle":
        $dosya = "kullanici_guncelle.php";
        $title = "Kullanıcı Yetki Güncelle";
        break;
    case "kullanici_sil":
        $dosya = "kullanici_sil.php";
        $title = "Kullanıcı Sil";
        break;
}
?>
