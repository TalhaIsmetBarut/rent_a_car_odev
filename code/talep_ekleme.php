<?php
$arac_id = (int)$_GET["arac_id"];
$ad_soyad = mysqli_real_escape_string($conn, $_GET["ad_soyad"]);
$eposta = mysqli_real_escape_string($conn, $_GET["eposta"]);
$telefon = mysqli_real_escape_string($conn, $_GET["telefon"]);
$gun_sayisi = (int)$_GET["gun_sayisi"];
$alis_tarihi = mysqli_real_escape_string($conn, $_GET["alis_tarihi"]);
$mesaj = mysqli_real_escape_string($conn, $_GET["mesaj"]);


$price_sql = "SELECT gunluk_fiyat FROM araclar WHERE id=$arac_id";
$price_res = mysqli_query($conn, $price_sql);
$gunluk_fiyat = 0;
if ($price_res && $row = mysqli_fetch_assoc($price_res)) {
    $gunluk_fiyat = (int)$row['gunluk_fiyat'];
}
$toplam_tutar = $gun_sayisi * $gunluk_fiyat;

$sql = "INSERT INTO talepler (arac_id, ad_soyad, eposta, telefon, gun_sayisi, toplam_tutar, alis_tarihi, mesaj, durum) 
        VALUES ($arac_id, '$ad_soyad', '$eposta', '$telefon', $gun_sayisi, $toplam_tutar, '$alis_tarihi', '$mesaj', 'Beklemede')";

$ornek = mysqli_query($conn, $sql);

if ($ornek) {
    echo '<div class="alert alert-success mt-4 p-4" role="alert">
            <h4 class="alert-heading"><i class="bi bi-check-circle-fill"></i> Talebiniz Alındı!</h4>
            <p>Sayın <strong>' . h($ad_soyad) . '</strong>, kiralama talebiniz başarıyla kaydedilmiştir. Müşteri temsilcilerimiz sizinle en kısa sürede iletişime geçecektir.</p>
          </div>';
} else {
    echo '<div class="alert alert-danger mt-4 p-4" role="alert">
            <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Hata Oluştu!</h4>
            <p>Talebiniz kaydedilirken bir hata oluştu. Lütfen bilgilerinizi kontrol edip tekrar deneyin.</p>
          </div>';
}
?>
<br>
<a class="btn btn-primary" href="?sayfa=arabalar">Araç Listesine Dön</a>
