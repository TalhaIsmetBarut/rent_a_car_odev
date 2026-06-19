<?php
$id = @$_GET["id"];
if (!is_null($id)) {
    $id = (int)$id;
    $sql = "SELECT * FROM kullanicilar WHERE id=$id";
    $ornek = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($ornek, MYSQLI_BOTH);
    if ($row) {
        $kadi = $row["kullanici_adi"];
        $eposta = $row["eposta"];
        $rol = $row["rol"];
    }
} else {
    header("Location: index.php?sayfa=kullanicilar");
    exit;
}
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><i class="bi bi-shield-lock-fill me-2"></i>Kullanıcı Yetki Düzenle</h4>
            </div>
            <div class="card-body">
                <form action="index.php" method="get">
                    <input type="hidden" name="sayfa" value="kullanici_guncelle">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">Kullanıcı Adı</label>
                        <div class="form-control-plaintext bg-light px-3 py-2 rounded border-start border-3 border-dark">
                            <strong><?php echo h($kadi); ?></strong>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">E-Posta</label>
                        <div class="form-control-plaintext bg-light px-3 py-2 rounded border-start border-3 border-dark">
                            <strong><?php echo h($eposta); ?></strong>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="rol" class="form-label fw-bold">Yetki Seviyesi (Rol)</label>
                        <select name="rol" id="rol" class="form-select" required>
                            <option value="user" <?php if ($rol == 'user') echo 'selected'; ?>>Standart Kullanıcı (user)</option>
                            <option value="admin" <?php if ($rol == 'admin') echo 'selected'; ?>>Yönetici (admin)</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2 mt-4">
                        <a href="index.php?sayfa=kullanicilar" class="btn btn-outline-secondary flex-fill">İptal</a>
                        <button type="submit" class="btn btn-primary flex-fill">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
