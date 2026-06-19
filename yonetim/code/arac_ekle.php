<?php
$kategoriler = tabloOku("kategoriler", $conn);

$id = @$_GET["id"];
$form_title = "Yeni Araç Ekle";
if (!is_null($id)) {
    $id = (int)$id;
    $form_title = "Araç Düzenle";
    $sql = "SELECT * FROM araclar WHERE id=$id";
    $ornek = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($ornek, MYSQLI_BOTH);
    if ($row) {
        $marka = $row["marka"];
        $model = $row["model"];
        $yil = $row["yil"];
        $gunluk_fiyat = $row["gunluk_fiyat"];
        $yakit = $row["yakit"];
        $vites = $row["vites"];
        $gorsel = $row["gorsel"];
        $kategori_id = $row["kategori_id"];
        $durum = $row["durum"];
    }
}
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-sm border">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><i class="bi bi-car-front-fill me-2"></i><?php echo $form_title; ?></h4>
            </div>
            <div class="card-body">
                <?php if (!is_null($id)): ?>
                    <div class="alert alert-info py-2">
                        <i class="bi bi-info-circle me-1"></i> ID'si <strong><?php echo $id; ?></strong> olan aracı düzenliyorsunuz.
                    </div>
                <?php else: ?>
                    <div class="alert alert-info py-2">
                        <i class="bi bi-info-circle me-1"></i> Yeni bir araç ekliyorsunuz.
                    </div>
                <?php endif; ?>

                <form action="index.php?sayfa=arac_ekleme" method="post" enctype="multipart/form-data">
                    <?php if (!is_null($id)) {
                        echo '<input type="hidden" name="edit" value="True">';
                        echo '<input type="hidden" name="id" value="' . $id . '">';
                    } ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="marka" class="form-label fw-bold">Marka</label>
                            <input type="text" class="form-control" id="marka" name="marka" value="<?php if (!is_null($id)) echo h($marka); ?>" required placeholder="Örn. Toyota">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="model" class="form-label fw-bold">Model</label>
                            <input type="text" class="form-control" id="model" name="model" value="<?php if (!is_null($id)) echo h($model); ?>" required placeholder="Örn. Corolla">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="yil" class="form-label fw-bold">Model Yılı</label>
                            <input type="number" class="form-control" id="yil" name="yil" value="<?php if (!is_null($id)) echo (int)$yil; ?>" required placeholder="Örn. 2023">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="gunluk_fiyat" class="form-label fw-bold">Günlük Fiyat (TL)</label>
                            <input type="number" class="form-control" id="gunluk_fiyat" name="gunluk_fiyat" value="<?php if (!is_null($id)) echo (int)$gunluk_fiyat; ?>" required placeholder="Örn. 1200">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="yakit" class="form-label fw-bold">Yakıt Türü</label>
                            <select name="yakit" id="yakit" class="form-select">
                                <option value="Benzin" <?php if (!is_null($id) && $yakit == 'Benzin') echo 'selected'; ?>>Benzin</option>
                                <option value="Dizel" <?php if (!is_null($id) && $yakit == 'Dizel') echo 'selected'; ?>>Dizel</option>
                                <option value="Elektrik" <?php if (!is_null($id) && $yakit == 'Elektrik') echo 'selected'; ?>>Elektrik</option>
                                <option value="Hibrit" <?php if (!is_null($id) && $yakit == 'Hibrit') echo 'selected'; ?>>Hibrit</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="vites" class="form-label fw-bold">Vites Türü</label>
                            <select name="vites" id="vites" class="form-select">
                                <option value="Manuel" <?php if (!is_null($id) && $vites == 'Manuel') echo 'selected'; ?>>Manuel</option>
                                <option value="Otomatik" <?php if (!is_null($id) && $vites == 'Otomatik') echo 'selected'; ?>>Otomatik</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-select">
                                <?php foreach ($kategoriler as $kat): ?>
                                    <option value="<?php echo $kat['id']; ?>" <?php if (!is_null($id) && $kategori_id == $kat['id']) echo 'selected'; ?>>
                                        <?php echo h($kat['ad']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="durum" class="form-label fw-bold">Durum</label>
                            <select name="durum" id="durum" class="form-select">
                                <option value="Aktif" <?php if (!is_null($id) && $durum == 'Aktif') echo 'selected'; ?>>Aktif</option>
                                <option value="Pasif" <?php if (!is_null($id) && $durum == 'Pasif') echo 'selected'; ?>>Pasif</option>
                                <option value="Kiralandı" <?php if (!is_null($id) && $durum == 'Kiralandı') echo 'selected'; ?>>Kiralandı</option>
                            </select>
                        </div>
                    </div>
                    
                    <?php if (!is_null($id) && !empty($gorsel)): ?>
                        <div class="mb-3">
                            <label class="form-label d-block fw-bold">Mevcut Görsel</label>
                            <img src="<?php echo (strpos($gorsel, 'http://') === 0 || strpos($gorsel, 'https://') === 0) ? h($gorsel) : '../' . h($gorsel); ?>" class="img-thumbnail" style="max-height: 150px; object-fit: cover;" alt="Mevcut Görsel">
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="gorsel_dosya" class="form-label fw-bold">Görsel Yükle</label>
                            <input type="file" class="form-control" id="gorsel_dosya" name="gorsel_dosya" accept="image/*">
                            <div class="form-text text-muted" style="font-size: 0.75rem;">Cihazınızdan bir resim dosyası seçin (PNG, JPG, JPEG, GIF, WEBP).</div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label for="gorsel" class="form-label fw-bold">Veya Görsel URL'si</label>
                            <input type="text" class="form-control" id="gorsel" name="gorsel" value="<?php if (!is_null($id)) echo h($gorsel); ?>" placeholder="https://images.unsplash.com/...">
                            <div class="form-text text-muted" style="font-size: 0.75rem;">Eğer dosya yüklemek istemiyorsanız, doğrudan görsel internet adresini de yapıştırabilirsiniz.</div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="index.php?sayfa=araclar" class="btn btn-outline-secondary flex-fill">İptal</a>
                        <button type="submit" class="btn btn-primary flex-fill">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
