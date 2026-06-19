<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Kullanıcı Giriş Formu</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_GET["hata"])): ?>
                    <div class="alert alert-danger py-2"><?php echo h($_GET["hata"]); ?></div>
                <?php endif; ?>
                <?php if (isset($_GET["mesaj"])): ?>
                    <div class="alert alert-success py-2"><?php echo h($_GET["mesaj"]); ?></div>
                <?php endif; ?>

                <form action="index.php" method="get">
                    <input type="hidden" name="sayfa" value="giris_kontrol">
                    
                    <div class="mb-3">
                        <label for="kullanici_adi" class="form-label fw-bold">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" required placeholder="Kullanıcı adınızı girin">
                    </div>
                    
                    <div class="mb-3">
                        <label for="sifre" class="form-label fw-bold">Şifre</label>
                        <input type="password" class="form-control" id="sifre" name="sifre" required placeholder="Şifrenizi girin">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mb-3">Giriş Yap</button>
                    
                    <div class="text-center">
                        <span class="text-muted">Henüz hesabınız yok mu?</span> <a href="?sayfa=kayit" class="text-decoration-none fw-bold">Kayıt Ol</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
