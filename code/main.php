<style>
.hero-carousel-img {
    height: 650px;
}
@media (max-width: 991.98px) {
    .hero-carousel-img {
        height: 400px;
    }
}
@media (max-width: 575.98px) {
    .hero-carousel-img {
        height: 250px;
    }
    .carousel-indicators {
        display: none !important;
    }
    .carousel-caption {
        padding: 8px !important;
        left: 5% !important;
        right: 5% !important;
        bottom: 15px !important;
    }
    .carousel-caption h5 {
        font-size: 0.95rem !important;
        margin-bottom: 2px !important;
    }
    .carousel-caption p {
        font-size: 0.75rem !important;
        margin-bottom: 0 !important;
    }
}
</style>

<div id="heroCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4000">
            <img src="uploads/slider/slider1.webp" class="d-block w-100 hero-carousel-img" alt="Premium Araçlar" style="object-fit: cover !important;">
            <div class="carousel-caption bg-dark bg-opacity-50 rounded px-2 py-1 px-md-3 py-md-2">
                <h5>Barut Car Rent Premium Araçlar</h5>
                <p>Range Rover ve diğer premium SUV modellerimiz ile yolların hakimi olun.</p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img src="uploads/slider/slider2.webp" class="d-block w-100 hero-carousel-img" alt="Mercedes Sedan" style="object-fit: cover !important;">
            <div class="carousel-caption bg-dark bg-opacity-50 rounded px-2 py-1 px-md-3 py-md-2">
                <h5>Konfor ve Güvenlik</h5>
                <p>Mercedes C-Class ve premium sedan araçlarımızla iş veya tatil seyahatlerinizi taçlandırın.</p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img src="uploads/slider/slider3.webp" class="d-block w-100 hero-carousel-img" alt="Ekonomik ve Pratik Çözümler" style="object-fit: cover !important;">
            <div class="carousel-caption bg-dark bg-opacity-50 rounded px-2 py-1 px-md-3 py-md-2">
                <h5>Ekonomik ve Pratik Çözümler</h5>
                <p>Şehir içinde kolay park edilebilen, düşük yakıt tüketimli kompakt araç modellerimiz.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Önceki</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sonraki</span>
    </button>
</div>

<div class="container">
    <h3 class="my-4">Öne Çıkan Kiralık Araçlarımız</h3>

    <div class="row">
        <?php
        $sql = "SELECT a.*, k.ad as kategori_ad FROM araclar a JOIN kategoriler k ON a.kategori_id = k.id WHERE a.durum = 'Aktif' LIMIT 9";
        $ornek = mysqli_query($conn, $sql);
        
        if ($ornek && mysqli_num_rows($ornek) > 0) {
            while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
                $id = $row["id"];
                $marka = $row["marka"];
                $model = $row["model"];
                $yil = $row["yil"];
                $gorsel = $row["gorsel"];
                $fiyat = $row["gunluk_fiyat"];
                $kategori = $row["kategori_ad"];
                $yakit = $row["yakit"];
                $vites = $row["vites"];
                
                echo '<div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="' . h($gorsel) . '" class="card-img-top" alt="' . h($marka) . '" style="height: 180px; object-fit: cover !important;" onerror="this.src=\'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop&q=60\'">
                        <div class="card-body">
                            <h5 class="card-title"><strong>' . h($marka) . ' ' . h($model) . '</strong></h5>
                            <p class="card-text text-muted mb-2">Kategori: ' . h($kategori) . ' | Yıl: ' . (int)$yil . '</p>
                            <p class="card-text">
                                <strong>Yakıt:</strong> ' . h($yakit) . '<br>
                                <strong>Vites:</strong> ' . h($vites) . '
                            </p>
                            <h6 class="text-primary mb-3"><strong>Fiyat: ' . number_format($fiyat, 0, ',', '.') . ' TL / Gün</strong></h6>
                            <a href="?sayfa=talep_ekle&aracID=' . $id . '" class="btn btn-success w-100">Şimdi Kirala</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12"><p class="text-muted text-center">Henüz öne çıkan araç eklenmemiş.</p></div>';
        }
        ?>
    </div>
</div>


