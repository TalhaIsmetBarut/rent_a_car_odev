<?php
$aracID = @$_GET["aracID"];
if (!is_null($aracID)) {
    $aracID = (int)$aracID;
    $sql = "SELECT * FROM araclar WHERE id=$aracID";
    $ornek = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($ornek, MYSQLI_BOTH);
    if ($row) {
        $aracAd = $row["marka"] . " " . $row["model"];
    } else {
        $aracAd = "Bilinmeyen Araç";
    }
} else {
    header("Location: index.php?sayfa=arabalar");
    exit;
}


$user_email = "";
$user_name = "";
if (isset($_SESSION["kullanici_adi"])) {
    $session_username = mysqli_real_escape_string($conn, $_SESSION["kullanici_adi"]);
    $user_sql = "SELECT eposta, kullanici_adi FROM kullanicilar WHERE kullanici_adi = '$session_username'";
    $user_res = mysqli_query($conn, $user_sql);
    if ($user_res && $u_row = mysqli_fetch_assoc($user_res)) {
        $user_email = $u_row['eposta'];
        $user_name = $u_row['kullanici_adi'];
    }
}
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><i class="bi bi-calendar-check-fill me-2"></i>Araç Kiralama Talebi</h4>
            </div>
            <div class="card-body">
                <div class="card bg-light mb-4 border-0 shadow-sm">
                    <div class="row g-0">
                        <?php if (!empty($row['gorsel'])): ?>
                            <div class="col-sm-4">
                                <img src="<?php echo h($row['gorsel']); ?>" class="img-fluid rounded-start h-100 w-100" style="object-fit: cover !important; min-height: 120px;" alt="<?php echo $aracAd; ?>" onerror="this.src='https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop&q=60'">
                            </div>
                        <?php endif; ?>
                        <div class="<?php echo !empty($row['gorsel']) ? 'col-sm-8' : 'col-12'; ?>">
                            <div class="card-body p-3">
                                <h5 class="card-title fw-bold mb-1"><?php echo $aracAd; ?></h5>
                                <p class="card-text text-muted mb-2" style="font-size: 0.85rem;">
                                    Model Yılı: <strong><?php echo (int)$row['yil']; ?></strong> | 
                                    Yakıt: <strong><?php echo h($row['yakit']); ?></strong> | 
                                    Vites: <strong><?php echo h($row['vites']); ?></strong>
                                </p>
                                <div class="mt-2 pt-2 border-top d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-bold" style="font-size: 0.95rem;">
                                        <?php echo number_format($row['gunluk_fiyat'], 0, ',', '.'); ?> TL / Gün
                                    </span>
                                    <span class="text-success fw-bold" style="font-size: 0.95rem;">
                                        Toplam: <span id="toplam_tutar"><?php echo number_format($row['gunluk_fiyat'], 0, ',', '.'); ?></span> TL
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="index.php" method="get">
                    <input type="hidden" name="sayfa" value="talep_ekleme">
                    <input type="hidden" name="arac_id" value="<?php echo $aracID; ?>">
                    
                    <div class="mb-3">
                        <label for="ad_soyad" class="form-label fw-bold">Ad Soyad</label>
                        <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" value="<?php echo h($user_name); ?>" required placeholder="Adınızı ve soyadınızı girin">
                    </div>
                    
                    <div class="mb-3">
                        <label for="eposta" class="form-label fw-bold">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="eposta" name="eposta" value="<?php echo h($user_email); ?>" required placeholder="ornek@mail.com">
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefon" class="form-label fw-bold">Telefon</label>
                        <input type="text" class="form-control" id="telefon" name="telefon" value="+90 " required placeholder="+90 555 123 45 67" pattern="\+90\s5[0-9]{2}\s[0-9]{3}\s[0-9]{2}\s[0-9]{2}" title="Telefon numarası +90 5XX XXX XX XX biçiminde olmalıdır.">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gun_sayisi" class="form-label fw-bold">Kiralama Gün Sayısı</label>
                            <input type="number" class="form-control" id="gun_sayisi" name="gun_sayisi" min="1" required placeholder="1">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="alis_tarihi" class="form-label fw-bold">Alış Tarihi</label>
                            <input type="date" class="form-control" id="alis_tarihi" name="alis_tarihi" min="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mesaj" class="form-label fw-bold">Ek Mesaj (İsteğe Bağlı)</label>
                        <textarea class="form-control" id="mesaj" name="mesaj" rows="3" placeholder="İletmek istediğiniz not varsa buraya yazabilirsiniz..."></textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="?sayfa=arabalar" class="btn btn-outline-secondary flex-fill">İptal</a>
                        <button type="submit" class="btn btn-primary flex-fill">Talebi Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('telefon');
    
    
    phoneInput.addEventListener('input', function() {
        if (!this.value.startsWith('+90 ')) {
            this.value = '+90 ';
        }
        
        let numberPart = this.value.substring(4).replace(/\D/g, '');
        
        if (numberPart.length > 10) {
            numberPart = numberPart.substring(0, 10);
        }
        
        let formatted = '';
        if (numberPart.length > 0) {
            formatted += numberPart.substring(0, 3);
        }
        if (numberPart.length > 3) {
            formatted += ' ' + numberPart.substring(3, 6);
        }
        if (numberPart.length > 6) {
            formatted += ' ' + numberPart.substring(6, 8);
        }
        if (numberPart.length > 8) {
            formatted += ' ' + numberPart.substring(8, 10);
        }
        
        this.value = '+90 ' + formatted;
    });

    
    phoneInput.addEventListener('keydown', function(e) {
        if (this.selectionStart < 4 && (e.key === 'Backspace' || e.key === 'Delete')) {
            e.preventDefault();
        }
    });
    
    
    phoneInput.addEventListener('focus', function() {
        if (this.value === '') {
            this.value = '+90 ';
        }
    });

    
    const gunSayisiInput = document.getElementById('gun_sayisi');
    const toplamTutarSpan = document.getElementById('toplam_tutar');
    const gunlukFiyat = <?php echo (int)($row['gunluk_fiyat'] ?? 0); ?>;

    function updateCalculatedTotal() {
        let gunSayisi = parseInt(gunSayisiInput.value) || 1;
        if (gunSayisi < 1) gunSayisi = 1;
        let toplam = gunSayisi * gunlukFiyat;
        toplamTutarSpan.textContent = new Intl.NumberFormat('tr-TR').format(toplam);
    }

    if (gunSayisiInput && toplamTutarSpan) {
        gunSayisiInput.addEventListener('input', updateCalculatedTotal);
        gunSayisiInput.addEventListener('change', updateCalculatedTotal);
    }
});
</script>
