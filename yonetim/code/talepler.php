<?php if (($_GET['sayfa'] ?? 'main') !== 'main'): ?>
    <h2 class="mb-4">Kiralama Talepleri</h2>
<?php endif; ?>

<?php
$sql = "SELECT t.*, a.marka, a.model, a.gunluk_fiyat FROM talepler t JOIN araclar a ON t.arac_id = a.id ORDER BY t.id DESC";
$ornek = mysqli_query($conn, $sql);
echo "<div class=\"d-none d-lg-block table-responsive\">
<table class=\"table table-bordered table-striped align-middle\">
    <thead>
        <tr>
            <th>ID</th>
            <th>Müşteri</th>
            <th>E-Posta</th>
            <th>Telefon</th>
            <th>Araç</th>
            <th>Gün Süresi</th>
            <th>Toplam Tutar</th>
            <th>Alış Tarihi</th>
            <th>Ek Mesaj</th>
            <th>Durum</th>
            <th>Onayla</th>
            <th>Reddet</th>
            <th>Sil</th>
        </tr>
    </thead>
    <tbody>";
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $ad_soyad = $row["ad_soyad"];
    $eposta = $row["eposta"];
    $telefon = $row["telefon"];
    $arac = $row["marka"] . " " . $row["model"];
    $gun_sayisi = $row["gun_sayisi"];
    $toplam_tutar = (int)($row["toplam_tutar"] ?? 0);
    if ($toplam_tutar == 0) {
        $toplam_tutar = $gun_sayisi * (int)$row["gunluk_fiyat"];
    }
    $toplam_tutar_formatted = number_format($toplam_tutar, 0, ',', '.') . " TL";
    $alis_tarihi = $row["alis_tarihi"];
    $mesaj = $row["mesaj"];
    $durum = $row["durum"];
    $badge = "bg-warning text-dark";
    if ($durum == 'Onaylandı') $badge = "bg-success";
    if ($durum == 'Reddedildi') $badge = "bg-danger";
    $durum_display = "<span class=\"badge $badge\">$durum</span>";

    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$ad_soyad</td>";
    echo "<td>$eposta</td>";
    echo "<td>$telefon</td>";
    echo "<td>$arac</td>";
    echo "<td>$gun_sayisi Gün</td>";
    echo "<td class=\"fw-bold text-success\">$toplam_tutar_formatted</td>";
    echo "<td>$alis_tarihi</td>";
    echo "<td>$mesaj</td>";
    echo "<td>$durum_display</td>";
    
    if ($durum == 'Beklemede') {
        echo "<td><a href=\"?sayfa=talep_islem&islem=onayla&id=$id\" class=\"btn btn-success btn-sm fw-bold\"><i class=\"bi bi-check-lg me-1\"></i> Onayla</a></td>";
        echo "<td><a href=\"?sayfa=talep_islem&islem=reddet&id=$id\" class=\"btn btn-danger btn-sm fw-bold\"><i class=\"bi bi-x-lg me-1\"></i> Reddet</a></td>";
    } else {
        echo "<td><span class=\"text-muted\">-</span></td>";
        echo "<td><span class=\"text-muted\">-</span></td>";
    }
    echo "<td><a href=\"?sayfa=talep_islem&islem=sil&id=$id\" onclick=\"return confirm('Bu talebi silmek istediğinize emin misiniz?')\"><i class=\"bi bi-trash\"></i></a></td>";
    echo "</tr>";
}
echo "</tbody></table></div>";


echo '<div class="d-block d-lg-none">';
echo '<div class="row g-3">';
mysqli_data_seek($ornek, 0); 
while ($row = mysqli_fetch_array($ornek, MYSQLI_BOTH)) {
    $id = $row["id"];
    $ad_soyad = $row["ad_soyad"];
    $eposta = $row["eposta"];
    $telefon = $row["telefon"];
    $arac = $row["marka"] . " " . $row["model"];
    $gun_sayisi = $row["gun_sayisi"];
    $toplam_tutar = (int)($row["toplam_tutar"] ?? 0);
    if ($toplam_tutar == 0) {
        $toplam_tutar = $gun_sayisi * (int)$row["gunluk_fiyat"];
    }
    $toplam_tutar_formatted = number_format($toplam_tutar, 0, ',', '.') . " TL";
    $alis_tarihi = $row["alis_tarihi"];
    $mesaj = $row["mesaj"];
    $durum = $row["durum"];
    
    $badge = "bg-warning text-dark";
    if ($durum == 'Onaylandı') $badge = "bg-success";
    if ($durum == 'Reddedildi') $badge = "bg-danger";
    $durum_display = "<span class=\"badge $badge\">$durum</span>";

    echo '<div class="col-12">
        <div class="card shadow-sm border">
            <div class="card-header d-flex justify-content-between align-items-center py-2 bg-light">
                <span class="fw-bold">Talep #' . $id . '</span>
                ' . $durum_display . '
            </div>
            <div class="card-body p-3">
                <h6 class="card-title fw-bold mb-2">' . h($ad_soyad) . '</h6>
                <p class="card-text mb-1" style="font-size: 0.85rem;"><strong>Araç:</strong> ' . h($arac) . '</p>
                <p class="card-text mb-1" style="font-size: 0.85rem;"><strong>Süre / Tutar:</strong> ' . (int)$gun_sayisi . ' Gün | <span class="text-success fw-bold">' . $toplam_tutar_formatted . '</span></p>
                <p class="card-text mb-1" style="font-size: 0.85rem;"><strong>Alış Tarihi:</strong> ' . h($alis_tarihi) . '</p>
                <p class="card-text mb-1" style="font-size: 0.85rem;"><strong>İletişim:</strong> ' . h($telefon) . ' | ' . h($eposta) . '</p>';
                
    if (!empty($mesaj)) {
        echo '<p class="card-text mb-2 p-2 bg-light rounded text-muted" style="font-size: 0.8rem; font-style: italic;"><strong>Mesaj:</strong> ' . h($mesaj) . '</p>';
    }
    
    echo '<div class="d-flex gap-2 mt-3">';
    if ($durum == 'Beklemede') {
        echo '<a href="?sayfa=talep_islem&islem=onayla&id=' . $id . '" class="btn btn-success btn-sm flex-fill fw-bold"><i class="bi bi-check-lg me-1"></i> Onayla</a>';
        echo '<a href="?sayfa=talep_islem&islem=reddet&id=' . $id . '" class="btn btn-danger btn-sm flex-fill fw-bold"><i class="bi bi-x-lg me-1"></i> Reddet</a>';
    }
    echo '<a href="?sayfa=talep_islem&islem=sil&id=' . $id . '" class="btn btn-outline-danger btn-sm ' . ($durum != 'Beklemede' ? 'w-100' : '') . '" onclick="return confirm(\'Bu talebi silmek istediğinize emin misiniz?\')"><i class="bi bi-trash"></i> Sil</a>';
    echo '</div>';
    
    echo '</div>
        </div>
    </div>';
}
echo '</div></div>';
?>
