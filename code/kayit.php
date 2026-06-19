<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Kullanıcı Kayıt Formu</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_GET["hata"])): ?>
                    <div class="alert alert-danger py-2"><?php echo h($_GET["hata"]); ?></div>
                <?php endif; ?>

                <form action="index.php" method="get">
                    <input type="hidden" name="sayfa" value="kayit_ekleme">
                    
                    <div class="mb-3">
                        <label for="kullanici_adi" class="form-label fw-bold">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" required placeholder="Kullanıcı adınızı girin">
                    </div>
                    
                    <div class="mb-3">
                        <label for="eposta" class="form-label fw-bold">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="eposta" name="eposta" required placeholder="ahmet@example.com">
                    </div>
                    
                    <div class="mb-3">
                        <label for="sifre" class="form-label fw-bold">Şifre</label>
                        <input type="password" class="form-control" id="sifre" name="sifre" required placeholder="Şifrenizi belirleyin">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
                </form>
            </div>
        </div>
    </div>
</div>
