<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><i class="bi bi-tags-fill me-2"></i>Kategori Ekle</h4>
            </div>
            <div class="card-body">
                <form action="index.php" method="get">
                    <input type="hidden" name="sayfa" value="kategori_ekleme">
                    
                    <div class="mb-3">
                        <label for="ad" class="form-label fw-bold">Kategori Adı</label>
                        <input type="text" class="form-control" id="ad" name="ad" required placeholder="Örn. Sedan, SUV, Hatchback">
                    </div>
                    
                    <div class="d-flex gap-2 mt-4">
                        <a href="index.php?sayfa=kategoriler" class="btn btn-outline-secondary flex-fill">İptal</a>
                        <button type="submit" class="btn btn-primary flex-fill">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
