<?php
$filtre = $_GET["filtre"] ?? "tumu";
$sutun = $_GET["sutun"] ?? "fiyat";
$sirala = $_GET["sirala"] ?? "";

function get_sort_header($sutun_adi, $label, $current_sutun, $current_sirala, $filtre) {
    $yeni_sira = ($current_sutun == $sutun_adi && $current_sirala == 'asc') ? 'desc' : 'asc';
    $sort_link = "?sayfa=arabalar&filtre=$filtre&sutun=$sutun_adi&sirala=$yeni_sira";
    
    $sort_icon = '<i class="bi bi-chevron-expand text-muted ms-1" style="font-size: 0.85rem;"></i>';
    if ($current_sutun == $sutun_adi) {
        if ($current_sirala == 'asc') {
            $sort_icon = '<i class="bi bi-chevron-up text-dark ms-1" style="font-size: 0.85rem;"></i>';
        } elseif ($current_sirala == 'desc') {
            $sort_icon = '<i class="bi bi-chevron-down text-dark ms-1" style="font-size: 0.85rem;"></i>';
        }
    }
    
    return '<a href="' . $sort_link . '" class="text-decoration-none text-dark d-inline-flex align-items-center fw-bold">'
        . h($label) . $sort_icon
        . '</a>';
}

$where_clause = "WHERE a.durum IN ('Aktif', 'Kiralandı')";
if ($filtre == 'musait') {
    $where_clause = "WHERE a.durum = 'Aktif'";
} elseif ($filtre == 'kiralandi') {
    $where_clause = "WHERE a.durum = 'Kiralandı'";
}

$order_by = "ORDER BY a.id DESC";
if (!empty($sirala)) {
    $column_map = [
        "fiyat" => "a.gunluk_fiyat",
        "durum" => "a.durum",
        "kategori" => "k.ad",
        "vites" => "a.vites",
        "yil" => "a.yil",
        "marka" => "a.marka"
    ];
    $db_column = $column_map[$sutun] ?? "a.gunluk_fiyat";
    $direction = ($sirala == "asc") ? "ASC" : "DESC";
    $order_by = "ORDER BY $db_column $direction";
}

$sql = "SELECT a.*, k.ad as kategori_ad FROM araclar a JOIN kategoriler k ON a.kategori_id = k.id $where_clause $order_by";
$ornek = mysqli_query($conn, $sql);

$araclar_listesi = [];
if ($ornek) {
    while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
        $araclar_listesi[] = $row;
    }
}

$sirala_param = $sirala ? "&sutun=$sutun&sirala=$sirala" : "";

echo '<div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">';
echo '    <h2 class="mb-0">Araç Listesi</h2>';
echo '    <div class="btn-group" role="group" aria-label="Araç Filtreleme">';
echo '        <a href="?sayfa=arabalar&filtre=tumu' . $sirala_param . '" class="btn btn-outline-dark btn-sm ' . ($filtre == 'tumu' ? 'active' : '') . '">Tümü</a>';
echo '        <a href="?sayfa=arabalar&filtre=musait' . $sirala_param . '" class="btn btn-outline-dark btn-sm ' . ($filtre == 'musait' ? 'active' : '') . '">Müsait (Kiralık)</a>';
echo '        <a href="?sayfa=arabalar&filtre=kiralandi' . $sirala_param . '" class="btn btn-outline-dark btn-sm ' . ($filtre == 'kiralandi' ? 'active' : '') . '">Kiralandı</a>';
echo '    </div>';
echo '</div>';

if (empty($araclar_listesi)) {
    echo '<div class="alert alert-info text-center py-3">Seçilen kriterlere uygun araç bulunamadı.</div>';
} else {
    $marka_header = get_sort_header('marka', 'Marka', $sutun, $sirala, $filtre);
    $yil_header = get_sort_header('yil', 'Yıl', $sutun, $sirala, $filtre);
    $vites_header = get_sort_header('vites', 'Vites', $sutun, $sirala, $filtre);
    $kategori_header = get_sort_header('kategori', 'Kategori', $sutun, $sirala, $filtre);
    $durum_header = get_sort_header('durum', 'Durum', $sutun, $sirala, $filtre);
    $fiyat_header = get_sort_header('fiyat', 'Günlük Fiyat', $sutun, $sirala, $filtre);

    
    echo "<div class=\"d-none d-md-block table-responsive\">
    <table class=\"table table-bordered table-striped align-middle\">
        <thead>
            <tr>
                <th>Görsel</th>
                <th>$marka_header</th>
                <th>Model</th>
                <th>$yil_header</th>
                <th>Yakıt</th>
                <th>$vites_header</th>
                <th>$kategori_header</th>
                <th>$durum_header</th>
                <th>$fiyat_header</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($araclar_listesi as $row) {
        $id = $row["id"];
        $marka = $row["marka"];
        $model = $row["model"];
        $yil = $row["yil"];
        $yakit = $row["yakit"];
        $vites = $row["vites"];
        $gorsel = $row["gorsel"];
        $kategori = $row["kategori_ad"];
        $fiyat = $row["gunluk_fiyat"];
        $durum = $row["durum"];

        if ($durum == 'Aktif') {
            $durum_text = "Müsait";
            $durum_badge = "bg-success";
            $islem_btn = "<a class='btn btn-success btn-sm' href='?sayfa=talep_ekle&aracID=$id'>Şimdi Kirala</a>";
        } else {
            $durum_text = "Kiralandı";
            $durum_badge = "bg-warning text-dark";
            $islem_btn = "<button class='btn btn-secondary btn-sm' disabled>Dolu</button>";
        }

        echo "<tr>";
        echo "<td><img src='$gorsel' width='100' height='60' style='object-fit: cover !important;' onerror=\"this.src='https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop&q=60'\"></td>";
        echo "<td>$marka</td>";
        echo "<td>$model</td>";
        echo "<td>$yil</td>";
        echo "<td>$yakit</td>";
        echo "<td>$vites</td>";
        echo "<td>$kategori</td>";
        echo "<td><span class='badge $durum_badge'>$durum_text</span></td>";
        echo "<td>$fiyat TL</td>";
        echo "<td>$islem_btn</td>";
        echo "</tr>";
    }
    echo "</tbody></table></div>";

    
    echo '<div class="d-block d-md-none">';
    echo '<div class="row g-3">';
    foreach ($araclar_listesi as $row) {
        $id = $row["id"];
        $marka = $row["marka"];
        $model = $row["model"];
        $yil = $row["yil"];
        $yakit = $row["yakit"];
        $vites = $row["vites"];
        $gorsel = $row["gorsel"];
        $kategori = $row["kategori_ad"];
        $fiyat = $row["gunluk_fiyat"];
        $durum = $row["durum"];

        if ($durum == 'Aktif') {
            $durum_text = "Müsait";
            $durum_badge = "bg-success";
            $islem_btn = "<a class='btn btn-success btn-sm px-3' href='?sayfa=talep_ekle&aracID=$id'>Şimdi Kirala</a>";
        } else {
            $durum_text = "Kiralandı";
            $durum_badge = "bg-warning text-dark";
            $islem_btn = "<button class='btn btn-secondary btn-sm px-3' disabled>Dolu</button>";
        }

        echo '<div class="col-12">
            <div class="card shadow-sm border">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="' . h($gorsel) . '" class="img-fluid rounded-start h-100 w-100" style="object-fit: cover !important; min-height: 120px;" alt="' . h($marka) . '" onerror="this.src=\'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=500&auto=format&fit=crop&q=60\'">
                    </div>
                    <div class="col-8">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="card-title mb-0 fw-bold">' . h($marka) . ' ' . h($model) . '</h6>
                                <span class="badge ' . $durum_badge . '" style="font-size: 0.75rem;">' . $durum_text . '</span>
                            </div>
                            <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">' . h($kategori) . ' | Yıl: ' . (int)$yil . '</p>
                            <div class="row g-0 mb-2" style="font-size: 0.8rem;">
                                <div class="col-6"><strong>Yakıt:</strong> ' . h($yakit) . '</div>
                                <div class="col-6"><strong>Vites:</strong> ' . h($vites) . '</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-primary fw-bold" style="font-size: 0.95rem;">' . number_format($fiyat, 0, ',', '.') . ' TL / Gün</span>
                                ' . $islem_btn . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
    echo '</div>';
    echo '</div>';
}
?>
