<?php if (($_GET['sayfa'] ?? 'main') !== 'main'): ?>
    <h2 class="mb-4">Araç Yönetimi</h2>
<?php endif; ?>

<a href="?sayfa=arac_ekle" class="btn btn-primary mb-3"><i class="bi bi-plus-circle me-1"></i> Yeni Araç Ekle</a>

<?php
$sql = "SELECT a.*, k.ad as kategori_ad FROM araclar a JOIN kategoriler k ON a.kategori_id = k.id ORDER BY a.id DESC";
$ornek = mysqli_query($conn, $sql);
echo "<div class=\"d-none d-md-block table-responsive\">
<table class=\"table table-bordered table-striped align-middle\">
    <thead>
        <tr>
            <th>Görsel</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Yıl</th>
            <th>Kategori</th>
            <th>Fiyat</th>
            <th>Yakıt</th>
            <th>Vites</th>
            <th>Durum</th>
            <th>Düzenle</th>
            <th>Sil</th>
        </tr>
    </thead>
    <tbody>";
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $marka = $row["marka"];
    $model = $row["model"];
    $yil = $row["yil"];
    $kategori = $row["kategori_ad"];
    $fiyat = $row["gunluk_fiyat"];
    $yakit = $row["yakit"];
    $vites = $row["vites"];
    $gorsel = $row["gorsel"];
    $durum = $row["durum"];

    $badge = "bg-success";
    if ($durum == 'Pasif') $badge = "bg-danger";
    if ($durum == 'Kiralandı') $badge = "bg-warning text-dark";
    $durum_display = "<span class=\"badge $badge\">$durum</span>";

    $gorsel_src = (strpos($gorsel, 'http://') === 0 || strpos($gorsel, 'https://') === 0) ? $gorsel : '../' . $gorsel;

    echo "<tr>";
    echo "<td><img src='" . h($gorsel_src) . "' width='60' height='36' style='object-fit: cover !important;'></td>";
    echo "<td>$marka</td>";
    echo "<td>$model</td>";
    echo "<td>$yil</td>";
    echo "<td>$kategori</td>";
    echo "<td>$fiyat TL</td>";
    echo "<td>$yakit</td>";
    echo "<td>$vites</td>";
    echo "<td>$durum_display</td>";
    echo "<td><a href=\"?sayfa=arac_ekle&id=$id\"><i class=\"bi bi-pencil-fill\"></i></a></td>";
    echo "<td><a href=\"?sayfa=arac_sil&id=$id\" onclick=\"return confirm('Bu aracı silmek istediğinize emin misiniz?')\"><i class=\"bi bi-trash\"></i></a></td>";
    echo "</tr>";
}
echo "</tbody></table></div>";


echo '<div class="d-block d-md-none">';
echo '<div class="row g-3">';
mysqli_data_seek($ornek, 0); 
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $marka = $row["marka"];
    $model = $row["model"];
    $yil = $row["yil"];
    $kategori = $row["kategori_ad"];
    $fiyat = $row["gunluk_fiyat"];
    $yakit = $row["yakit"];
    $vites = $row["vites"];
    $gorsel = $row["gorsel"];
    $durum = $row["durum"];

    $badge = "bg-success";
    if ($durum == 'Pasif') $badge = "bg-danger";
    if ($durum == 'Kiralandı') $badge = "bg-warning text-dark";
    $durum_display = "<span class=\"badge $badge\">$durum</span>";

    $gorsel_src = (strpos($gorsel, 'http://') === 0 || strpos($gorsel, 'https://') === 0) ? $gorsel : '../' . $gorsel;

    echo '<div class="col-12">
        <div class="card shadow-sm border">
            <div class="row g-0">
                <div class="col-4">
                    <img src="' . h($gorsel_src) . '" class="img-fluid rounded-start h-100 w-100" style="object-fit: cover !important; min-height: 110px;" alt="' . h($marka) . '" onerror="this.src=\'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop&q=60\'">
                </div>
                <div class="col-8">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h6 class="card-title mb-0 fw-bold">' . h($marka) . ' ' . h($model) . '</h6>
                            ' . $durum_display . '
                        </div>
                        <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">' . h($kategori) . ' | Yıl: ' . (int)$yil . '</p>
                        <div class="row g-0 mb-3" style="font-size: 0.8rem;">
                            <div class="col-6"><strong>Fiyat:</strong> ' . number_format($fiyat, 0, ',', '.') . ' TL</div>
                            <div class="col-6"><strong>Vites/Yakıt:</strong> ' . h($vites) . '/' . h($yakit) . '</div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="?sayfa=arac_ekle&id=' . $id . '" class="btn btn-outline-primary btn-sm flex-fill fw-bold"><i class="bi bi-pencil-fill me-1"></i> Düzenle</a>
                            <a href="?sayfa=arac_sil&id=' . $id . '" class="btn btn-outline-danger btn-sm flex-fill fw-bold" onclick="return confirm(\'Bu aracı silmek istediğinize emin misiniz?\')"><i class="bi bi-trash me-1"></i> Sil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}
echo '</div></div>';
?>
